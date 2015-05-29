<?php
use nikosglikis\ModStatusParser\ModStatusParser;

/**
 * Test Run File.
 */
require_once __DIR__ . '/../vendor/autoload.php';

$modStatusParser = new ModStatusParser("http://www.easter.nationalparks.org/server-status");

