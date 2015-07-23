Introduction
============

mod_status_parser
-----------------

Parses Apache mod_status output and returns an array with each line as a php object.

Example
--------

	<?php 
		use nikosglikis\ModStatusParser\ModStatusParser;

		require_once __DIR__ . '/../vendor/autoload.php';

		$modStatusParser = new ModStatusParser("http://www.easter.nationalparks.org/server-status");

		$modStatusOutput = $modStatusParser->getModStatusOutput();

		$workers = $modStatusOutput->getWorkers();

		foreach ($workers as $worker) {
			var_dump($worker);
		}

	?>