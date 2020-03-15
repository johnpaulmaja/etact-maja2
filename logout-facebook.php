<?php

//logout.php ------ credits: john paul maja :D <3 
include('facebook/config2.php');
session_destroy();

header('location:index.php');

?>