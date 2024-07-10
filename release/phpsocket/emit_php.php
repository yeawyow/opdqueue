<?php

include( "vendor/autoload.php" );
echo "2";

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;
echo "3";
$version = new Version2x( "http://localhost:3000/" );
echo "1";
$client = new Client( $version );

    $client->initialize();
    $client->emit( "hn",["test"=>"test","jogn"=>"xxxx"] );
    $client->close();



?>