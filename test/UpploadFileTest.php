<?php

require_once '../vendor/autoload.php';
use iboxs\authapi\Client;

$upload = new Client("2021","");
echo $upload->Auth("ssss");
