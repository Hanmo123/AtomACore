<?php

use Atomstudio\Atomacore\Locale;

require_once __DIR__ . '/../../vendor/autoload.php';

// For test only
$_ENV['BASE_PATH'] = __DIR__ . '/..';

$locale = new Locale('localeFile');
echo $locale->test;
