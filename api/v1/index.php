<?php
// Header
header('Content-Type: application/json; charset=utf-8');


// Import Classes
require_once('./lib/User.php');
require_once('./lib/File.php');

// Import Rest Class
require_once('./lib/Rest.php');


// ??? run LOL
if (isset($_REQUEST)) {
    echo Rest::open($_REQUEST);
}
