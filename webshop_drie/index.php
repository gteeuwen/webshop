<?php
include_once('defines.php');
require_once('controllers/main_controller.php');

$main_controller = new MainController();
$main_controller->runPage();
?>