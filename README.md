# symfony-parallel-process

A simple wrapper to enable parallel processing using [Symfony Process](http://symfony.com/doc/current/components/process.html) component.

## Installation

`composer require mitsuru793/symfony-parallel-process`

## Example

```php
<?php

use Symfony\Component\Process\Process;
use Jack\Symfony\ProcessManager;

$proc1 = new Process('ls -l');
$proc2 = new Process('ls -l');

$procManager = new ProcessManager();

$processes = array();
array_push($processes, $proc1, $proc2);

$maxParallelProcesses = 5;
$pollingInterval = 1000; // microseconds
$callback = function (string $type, string $data, Process $process) {
    // do streaming
};
$procManager->runParallel($processes, $maxParallelProcesses, $pollingInterval, $callback);
```

## Thank you very much

Fork:  
https://github.com/jagandecapri/symfony-parallel-process

Callback argument of runParallel:   
https://github.com/chubidu/symfony-parallel-process
