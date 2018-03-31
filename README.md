## Apple Push Notification Service via PHP
#### A PHP Library for Apple Push Notification Service

### Features
- [x] Send Push Notification
- [x] Customise as JSON Payload

## Pre-requisite

1. **Device Token** which you will get as callback (in AppDelegate.swift) when you register for Push Notification.
2. **PEM Certificate** of your app which you get from Apple Developer Portal.

### Installation

You can install [apnsPHP](https://packagist.org/packages/apns/apnsphp) via **Composer**.
First, add **composer.json** file in your project

```json
{
  "require": {
    	"apns/apnsPHP": "*"
    }
}
```

And, install dependencies by command

```
composer install
```

### Code

1. Send Push Notification when you've text only

I'm assuming you have **pem** certificate with you.

```php

//Path of Certfiicate
$pathOfCertificate = $_SERVER['DOCUMENT_ROOT']."/certificate.pem";

// Initialise APNS
$apns = new apnsPHP($pathOfCertificate);
$apns->sendPushNotification("This is my Message", $token);

```

2. Send Push Notification when you've complete JSON Payload

As, Apple Push Notification payload looks like this where, **alert** is the push-notification message, **badge** is the badge number which comes on AppIcon in numeric form with red bubble and last is **sound** which is alert tone when push notification pops.

```json
{
  "aps":{
    "alert" : "Hello World :D",
    "badge" : 1,
    "sound" : "default"
  }
}
```

So, you have to first prepare the payload and then call apns defined method,

```php
// Token
$token = "FCFFA7C61D647BA62DAxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

// Associative Array
$payload['aps'] = array('alert' => 'Hello World :D', 'badge' => 1, 'sound' => 'default');

// Convert Array into JSON
$payloadJSON = json_encode($payload);
```

And, last you have to call APNS method.

```php

$apns = new apnsPHP($pathOfCertificate);
$apns->sendPushNotification($payloadJSON, $token);

```

## Reference
You can refer Apple [Documentation](https://developer.apple.com/library/content/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/APNSOverview.html) for Apple Push Notification Service.
