# SMS API

SMS API is a Third Party PHP Library for Short Message Service API

# Table of Contents
 - [Installation](#installation)
 - [Semaphore](#semaphore)
   - [Sending Messages](#sending-messages)
   - [Sending Bulk Messages](#sending-bulk-messages)
   - [Sending Priority Messages](#sending-priority-messages)
   - [Retrieving Messages](#retrieving-messages)
   - [Retrieving Your Account](#retrieving-your-account)
   - [Retrieving Your Transactions](#retrieving-your-transactions)
   - [Retrieving Your SenderNames](#retrieving-your-sendernames)
   - [Retrieving Your Users](#retrieving-your-users)

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

You can specify up to 1,000 recipients/numbers at a time.

```php
echo $semaphore->send(['09123456789', '09987654321'], 'Your message here');
```

### Sending Priority Messages

Normally messages are processed in the order they are received and during periods of heavy traffic messaging, messages can be delayed. If your message is time sensitive, you may wish to use our premium priority queue which bypasses the default message queue and sends the message immediately. <b>This service is 2 credits per 160 character SMS</b>.

```php
echo $semaphore->priority('09123456789', 'Your message here');
```

### Retrieving Messages

You can retrieve up to 100 sent messages at a time, with support for pagination by passing the optional $page variable:

```php
echo $semaphore->messages(['limit' => 100, 'page' => 3]);
```

Filter by date range: 

```php
echo $semaphore->messages(['startDate' => '0000-00-00', 'endDate' => '0000-00-00']);
```

Filter by telco network e.g. "globe", "smart": 

```php
echo $semaphore->messages(['network' => 'globe']);
```

Filter by status e.g. "pending", "success": 

```php
echo $semaphore->messages(['status' => 'success']);
```

### Retrieving Your Account

```php
echo $semaphore->account();
```

Response: 

```json
{
  "account_id": 12345,
  "account_name": "Your Organization",
  "status": "Active",
  "credit_balance": 1000
}
```

### Retrieving Your Transactions

```php
echo $semaphore->transactions();
```

### Retrieving Your SenderNames

```php
echo $semaphore->sendernames();
```

Response: 

```json
[
  {
    "name":"Semaphore",
    "status":"Active",
    "created":"0000-00-00 00:00:00"
  },
  {
    "name":"Example",
    "status":"Active",
    "created":"0000-00-00 00:00:00"
  }
]
```

### Retrieving Your Users

```php
echo $semaphore->users();
```

Response:

```json
[
  {
    "user_id": 12345,
    "email": "owner@example.com",
    "role": "Owner"
  },
  {
    "user_id": 54321,
    "email": "user@example.com",
    "role": "User"
  }
]
```

