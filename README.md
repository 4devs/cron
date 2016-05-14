Cron
====

Easily configure cron through PHP.

If you use Symfony 2, you could use our [cool bridge](https://github.com/4devs/cron-bidge) in order to configure your app jobs in config!

## Setup and Configuration
FDevsCron uses Composer, please checkout the [composer website](http://getcomposer.org) for more information.

The simple following command will install `cron` into your project. It also add a new
entry in your `composer.json` and update the `composer.lock` as well.
```bash
$ composer require fdevs/cron
```

> FDevsCron follows the PSR-4 convention names for its classes, which means you can easily integrate `cron` classes loading in your own autoloader.

## Usage

### Build Cron
```php
<?php

require 'vendor/autoload.php';

use FDevs\Cron\Cron;
use FDevs\Cron\Model\Job;
use FDevs\Cron\Model\Time;
use FDevs\Cron\Model\Output;

$cron = new Cron();

$time = new Time();
$time
    ->setMinute(1)
    ->setHour(2)
    ->setDay(3)
    ->setMonth(4)
    ->setDayOfWeek(5)
    ;
    
$output = new Output();
$output
    ->setOutFile('log')
    ->setErrFile('error');
    
$job = new Job('/bin/bash command', $time, $output);

$cron
    ->addHeader(Cron::HEADER_PATH, 'path')
    ->addHeader(Cron::HEADER_HOME, 'home')
    ->addHeader(Cron::HEADER_MAILTO, 'test@example.com')
    ->addHeader(Cron::HEADER_SHELL, 'shell')
    ->addHeader(Cron::HEADER_CONTENT_TYPE, 'text')
    ->addHeader(Cron::HEADER_CONTENT_TRANSFER_ENCODING, 'utf8')
    ->addJob($job)
    ;

echo strval($cron);
```

That will print

    MAILTO=test@example.com
    HOME=home
    SHELL=shell
    PATH=path
    CONTENT_TYPE=text
    CONTENT_TRANSFER_ENCODING=utf8

    #Comment
    1    2    3    4    5    /bin/bash command --env=dev > log 2>> error

### Updating Cron

```php
<?php

require 'vendor/autoload.php';

use FDevs\Cron\CrontabUpdater;
use FDevs\Cron\Cron;

$cron = new Cron();
// $cron configuration...

$cronUpdater = new CrontabUpdater('unique_key');
$cronUpdater->update($cron);
```

---
Created by [4devs](http://4devs.pro/) - Check out our [blog](http://4devs.io/) for more insight into this and other open-source projects we release.
