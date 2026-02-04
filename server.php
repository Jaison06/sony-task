<?php
// avoid websocket warnings
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/WebSocket.php';

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

$port   = 8080;
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new WebSocket()
        )
    ),
    $port
);

echo "Listening on port {$port}\n";
$server->run();
