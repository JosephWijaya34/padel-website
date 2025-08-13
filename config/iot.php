<?php
// config/iot.php untuk konfigurasi IoT API
return [
    'base_url' => env('API_CLIPPING_URL'),
    'timeout' => env('API_CLIPPING_TIMEOUT', 30),
    'retries' => env('API_CLIPPING_RETRIES', 3),
    'streaming_url' => env('API_STREAMING_CLIP_URL'),
];
?>
