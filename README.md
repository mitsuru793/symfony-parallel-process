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
$procManager->runParallel($processes, $maxParallelProcesses, $pollingInterval);
```
