<?php

$mysqli = new mysqli("localhost", "volga", "", "volga", 8889);

if($mysqli->connect_error)
    die('MySQL Connection error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
