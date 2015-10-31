<?php

namespace jwdr\ZyXEL;

class Connection
{
    private $connection;

    public function __construct(Config $config)
    {
        $connection = $this->openConnection($config);
        $this->authenticateConnection($connection, $config);

        $this->connection = $connection;
    }

    private function openConnection(Config $config)
    {
        $connection = ssh2_connect($config->getIpAddress(), $config->getPortNumber());

        if ($connection === false) {
            throw new ConnectionFailedException('ZyXEL could not be reached');
        }

        return $connection;
    }

    /**
     * @param resource $connection
     * @param Config $config
     * @return resource
     * @throws ConnectionFailedException
     */
    private function authenticateConnection($connection, Config $config)
    {
        $auth = @ssh2_auth_password($connection, $config->getUserName(), $config->getPassWord());

        if (!$auth) {
            throw new ConnectionFailedException('Authentication with ZyXEL failed');
        }

        return $connection;
    }

    public function executeCommand($command)
    {
        $rawOutPut = $this->getRawCommandOutput($command);

        return $this->cleanupOutput($rawOutPut, $command);
    }

    protected function cleanupOutput($rawOutPut, $command)
    {
        $rawOutPut = substr($rawOutPut, 0, strpos($rawOutPut, "\r\n > quit"));

        $output = explode("\r\n", $rawOutPut);

        foreach ($output as $key => $val) {
            switch ($val) {
                case $command:
                case 'quit':
                case " > $command";
                    unset($output[$key]);
                break;
            }
        }

        return array_slice($output, 0);
    }

    protected function getRawCommandOutput($command, $timeout = 2)
    {
        $stream = ssh2_shell($this->connection);

        fwrite($stream, "$command\n");
        stream_set_blocking($stream, true);
        fwrite($stream, "quit\n");

        $output = '';
        while ($o = stream_get_contents($stream)){
            $output = $o;
        }

        return $output;
    }
}