<?php

$db = new PDO('mysql:host=localhost;dbname=geneslyt_prakashdangar;charset=utf8mb4', 'xyz', '22222');

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

?>