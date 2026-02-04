<?php

declare (strict_types = 1);

error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

require __DIR__ . '/vendor/autoload.php';

use WebSocket\Client;

require_once __DIR__ . '/Dashboard.php';
require_once __DIR__ . '/Machine.php';
require_once __DIR__ . '/data.php';

// Connect to WebSocket server
$client = new Client('ws://localhost:8080');

// Dashboard instance
$dashboard = new Dashboard();

// Infinite loop to send machine updates
while (true) {
    foreach ($machinesData as $machineName) {
        $machine = new Machine($machineName);
        $machine->attach($dashboard);
        $machine->setState($states[array_rand($states)]);

        $data    = $dashboard->getData();
        $payload = json_encode($data);

        // Send update to WebSocket server
        $client->send($payload);

        // Optional debug
        // echo sprintf("Sent: %s%s", $payload, PHP_EOL);
    }

    sleep(3);
}
