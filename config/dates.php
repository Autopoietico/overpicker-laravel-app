<?php

$url_version = __DIR__ . "/../resources/api/version.json";
$data_version = file_get_contents($url_version);
$data_obj = json_decode($data_version, true); 

return [
    'LAST_DATA_UPDATE' => $data_obj["last-update"],
    'COPY_DATE' => "2023",
    'PRIVACY_DATE' => date("Y")
];