<?php

define("DS", DIRECTORY_SEPARATOR);
require_once __DIR__ . DS ."config" . DS . "config.php";

require_once __DIR__ . DS . "libs" . DS . "App.php";
require_once __DIR__ . DS . "libs" . DS . "View.php";
require_once __DIR__ . DS . "libs" . DS . "Model.php";
require_once __DIR__ . DS . "libs" . DS . "Controller.php";

require_once __DIR__ . DS . "libs" . DS . "Database.php";
require_once __DIR__ . DS . "libs" . DS . "Airport.php";
require_once __DIR__ . DS . "libs" . DS . "Flight.php";
require_once __DIR__ . DS . "libs" . DS . "F.php";


new App();
