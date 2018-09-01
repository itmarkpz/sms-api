# SMS API

SMS API is a Third Party PHP Library for the Semaphore SMS API

# Table of Contents
 - [Installation](#installation)
 - [Semaphore](#semaphore)

## Installation

```sh
composer require codehub/sms-api
```

## Semaphore

### Initialization
```php
<?php

require_once('vendor/autoload.php');

use CodeHub\SMS\Semaphore;

$semaphore = new Semaphore('{API_KEY}', '{SENDER_NAME}'); // Optional SENDER_NAME default to Semaphore
```

### Sending Messages

```php
echo $semaphore->send('09123456789', 'Your message here');
```

Response: 

```json
[
  {
    "message_id": 1234567,
    "user_id": 12345,
    "user": "user@example.com",
    "account_id": 54321,
    "account": "Your Account Name",
    "recipient": "09123456789",
    "message": "The message you sent",
    "sender_name": "SEMAPHORE",
    "network": "Globe",
    "status": "Sent",
    "type": "Single",
    "source": "Api",
    "created_at": "0000-00-00 00:00:00",
    "updated_at": "0000-00-00 00:00:00"
  }
]
```

### Sending Bulk Messages

```php
echo $semaphore->send(['09123456789', '09987654321'], 'Your message here');
```

