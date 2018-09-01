# Semaphore SMS

Semaphore SMS is a Third Party PHP Library for the Semaphore SMS API

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

