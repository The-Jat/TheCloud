<?php

use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;

return [
    'media_sizes' => env('CLOUDIFY_MEDIA_SIZES'),
    'media_allowed_extensions' => env('CLOUDIFY_MEDIA_ALLOWED_EXTENSIONS', 'jpg,jpeg,png,gif,txt,docx,zip,mp3,bmp,csv,xls,xlsx,ppt,pptx,pdf,mp4,m4v,doc,mpga,wav,webp,webm,mov,jfif,avif,rar,x-rar'),

    'middleware' => [
        'api',
        ThrottleRequests::using('cloudify-api'),
        SubstituteBindings::class,
    ],

    'rate_limit_per_minute' => env('CLOUDIFY_RATE_LIMIT_PER_MINUTE', 300),
];
