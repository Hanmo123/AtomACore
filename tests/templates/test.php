<?php

use Atomstudio\Atomacore\PageComposer;

require_once __DIR__ . '/../../vendor/autoload.php';

echo 'This is test.php' . PHP_EOL;

$page = new PageComposer('template.php');
$page->construct();
