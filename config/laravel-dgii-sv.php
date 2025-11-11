<?php

return [
    'test' => env('DGII_TEST', false),
    'auth' => [
        'nit' => env('DGII_AUTH_NIT'),
        'password' => env('DGII_AUTH_PASSWORD'),
    ],
    'certificate' => [
        'path' => env('DGII_CERTIFICATE_PATH'),
        'password' => env('DGII_CERTIFICATE_PASSWORD'),
    ],
    'path' => env('DGII_PATH'),
];
