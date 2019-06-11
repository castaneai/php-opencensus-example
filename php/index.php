<?php
require __DIR__.'/vendor/autoload.php';

use OpenCensus\Trace\Exporter\OneLineEchoExporter;
use OpenCensus\Trace\Tracer;

$exporter = new OneLineEchoExporter();
// $exporter = new \OpenCensus\Trace\Exporter\StackdriverExporter();
Tracer::start($exporter);

Tracer::inSpan(['name' => 'hello-world'], function () {
    sleep(1);
    echo 'hello';
});

