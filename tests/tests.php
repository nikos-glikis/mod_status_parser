<?php
use nikosglikis\ModStatusParser\ModStatusParser;

/**
 * Test Run File.
 */
require_once __DIR__ . '/../vendor/autoload.php';

$modStatusParser = new ModStatusParser("http://www.easter.nationalparks.org/server-status");

$modStatusOutput = $modStatusParser->getModStatusOutput();

$workers = $modStatusOutput->getWorkers();

//var_dump($modStatusOutput->getWorkers());
//var_dump($modStatusOutput->getCpuLoad());
//var_dump($modStatusOutput->getCpuLoadHumanReadable());


foreach ($workers as $worker) {
	var_dump($worker);
}