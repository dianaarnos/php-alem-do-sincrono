<?php

$host = "dummy.restapiexample.com";
$resource = [
    "api/v1/employee/1",
    "api/v1/employee/2",
];

$clients = [];

foreach ($resource as $url) {
    $socketClient = stream_socket_client(
        'tcp://' . $host . ':80',
        $errno,
        $errstr,
        10,
        STREAM_CLIENT_ASYNC_CONNECT
    );

    $clients[$url] = $socketClient;
    $request =  "GET /" . $url . " HTTP/1.1" . PHP_EOL . "Host: " . $host . PHP_EOL . PHP_EOL;

    fwrite($socketClient, $request);

    stream_set_blocking($socketClient, 0);
}

stream_select($clients, $write, $ex, 10);

if (count($clients)) {
    foreach ($clients as $id => $socket) {
        echo fread($socket, 2000);
    }
}
