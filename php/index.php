<?php
require __DIR__.'/vendor/autoload.php';

use OpenCensus\Trace\Exporter\OneLineEchoExporter;
use OpenCensus\Trace\Tracer;

$exporter = new OneLineEchoExporter();
Tracer::start($exporter);

Tracer::inSpan(['name' => 'test-span'], function () {
    sleep(1);
    echo 'hello' . PHP_EOL;
});

