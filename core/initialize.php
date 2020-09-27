<?php
define('APP_NAME', 'PHP_REST_OPEN_API');
define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', DS.'xampp'.DS.'htdocs'.DS.'RESTAPI'.DS.'PHPRestOpenAPI');
define('INC_PATH',SITE_ROOT.DS.'includes');
define('CORE_PATH',SITE_ROOT.DS.'core');

require_once(INC_PATH.DS.'config.php');
require_once(CORE_PATH.DS.'posti.php');