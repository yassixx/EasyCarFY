<?php
require '../vendor/autoload.php';
use App\Helper;
Helper::startSession();
session_destroy();
header('Location: /');

