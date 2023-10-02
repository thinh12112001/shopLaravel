<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send any email
    | messages sent by your application. Alternative mailers may be setup
    | and used as needed; however, this mailer will be used by default.
    |
    */

    'default' => env('MAIL_MAILER', 'smtp'),

    // 'stream' => [
    //     'ssl' => [
    //         'allow_self_signed' => true,
    //         'verify_peer' => false,
    //         'verify_peer_name' => false,
    //     ],

    // ],

    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
        ],

        'coupon' => [
            'transport' => env('MAIL_MAILER_COUPON'),
            'host' => env('MAIL_HOST_COUPON'),
            'port' => env('MAIL_PORT_COUPON'),
            'username' => env('MAIL_USERNAME_COUPON'),
            'password' => env('MAIL_PASSWORD_COUPON'),
            'encryption' => env('MAIL_ENCRYPTION_COUPON'),
            'from' => [
                'address' => env('MAIL_FROM_ADDRESS_COUPON'),
                'name' => env('APP_NAME'),
            ],
        ],

        'ses' => [
            'transport' => 'ses',
        ],

        'mailgun' => [
            'transport' => 'mailgun',
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        'postmark' => [
            'transport' => 'postmark',
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
        ],
    ],



    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],



    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

];
