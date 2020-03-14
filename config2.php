<?php

require_once 'vendor/autoload.php';

if (!session_id())
{
    session_start();
}

// Call Facebook API

$facebook = new \Facebook\Facebook([
  'app_id'      => '2621185531323878',
  'app_secret'     => 'e96b253c6d17a45a674710eefe2153f1',
  'default_graph_version'  => 'v2.10'
]);

?>
