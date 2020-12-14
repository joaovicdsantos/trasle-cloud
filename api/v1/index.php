<?php
// Header
header('Content-Type: application/json; charset=utf-8');


// Import Classes


// Import Rest Class
require_once('./lib/Rest.php');


// ??? run LOL
if (isset($_REQUEST)) {
    echo Rest::open($_REQUEST);
}
