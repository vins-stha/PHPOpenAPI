<?php
require_once ('../core/initialize.php');
require(SITE_ROOT.'\vendor\autoload.php');
$openapi = \OpenApi\scan(SITE_ROOT.'\core');
header('Content-Type: application/json');
echo $openapi->toJson();