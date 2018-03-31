## Apple Push Notification Service via PHP
#### A PHP Library for Apple Push Notification Service

### Features
- [x] Send Push Notification
- [x] Customise as JSON Payload

### Installation

You can install apnsPHP via Composer.
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

```php

$apns = new apnsPHP();
$apns->sendPushNotification("This is my Message", $token);

```

2. Send Push Notification when you've complete JSON Payload

As, Apple Push Notification payload looks like this where, **alert** is the push-notification message, **badge** is the badge number which comes on AppIcon in numeric form with red bubble and last is **sound** which is alert tone when push notification pops.

```json
{
  aps:{
    'alert' : 'Hello World :D',
    'badge' : '1',
    'sound' : 'default'
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

$apns = new apnsPHP();
$apns->sendPushNotification($payloadJSON, $token);

```

## Reference
You can refer Apple [Documentation](https://developer.apple.com/library/content/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/APNSOverview.html) for Apple Push Notification Service.
