ZyXEL
=====

Installation
------------

The best way to add the library to your project is using [composer](http://getcomposer.org).

```json
{
    "require": {
        "jwdr/ZyXEL": "*"
    }
}
```

How it works
------------

Create the needed parameter value objects:
```php
$ipAddress = new \ValueObjects\Web\IPAddress('your-router-ip-address');
$portNumber = new \ValueObjects\Web\PortNumber(22);
$userName = new \ValueObjects\String\String('your-user-name');
$passWord = new \ValueObjects\String\String('your-password');
```

Instantiate the config object, and use it to create the connection
```php
$ZyXELConfig = new \jwdr\ZyXEL\Config($ipAddress, $portNumber, $userName, $passWord);
$ZyXELConnection = new \jwdr\ZyXEL\Connection($ZyXELConfig);
```
Instantiate the ZyXEL object
```php
$ZyXEL = new \jwdr\ZyXEL\ZyXEL($ZyXELConnection);
```
Finally ready to start reading information from the router!

Get the current connected lan devices
```php
$lanHosts = $ZyXEL->lanHosts();
```