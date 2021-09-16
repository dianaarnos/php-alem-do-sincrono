<?php

$urls = [
    "http://dummy.restapiexample.com/api/v1/employee/1",
    "http://dummy.restapiexample.com/api/v1/employee/2",
];

$multiHandle = curl_multi_init();
$curls = [];
$resultados = [];

$callback = function ($dados) {
  echo $dados . PHP_EOL;
};

foreach ($urls as $url) {
    $handle = curl_init();

    curl_setopt_array($handle, [CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_HEADER => false]);

    $curls[$url] = $handle;
    curl_multi_add_handle($multiHandle, $handle);
}

$taRodando = null;

do {
    $multiCurlStatus = curl_multi_exec($multiHandle, $taRodando);
    $recurso = curl_multi_info_read($multiHandle);
    if ($recurso) {
        $callback(curl_multi_getcontent($recurso['handle']));
        curl_multi_remove_handle($multiHandle, $recurso['handle']);
    }
} while ($multiCurlStatus == CURLM_CALL_MULTI_PERFORM || $taRodando);
