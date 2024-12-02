<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | A great default configuration has been defined for you which utilizes
    | session storage plus the Eloquent user provider.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
            // Level 1: Admin
        ],

        'superadmin' => [
            'driver' => 'session',
            'provider' => 'superadmins',
            // Level 2: Super Admin
        ],

        'supervisor' => [
            'driver' => 'session',
            'provider' => 'supervisors',
            // Level 3: Supervisor
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication guards have a user provider, which defines how the
    | users are retrieved from your database or storage system used by
    | the application. Typically, Eloquent is utilized.
    |
    | If you have multiple user tables or models you may configure multiple
    | providers to represent each model/table. These providers can then be
    | assigned to any extra authentication guards you've defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,  // Level 0: Normal User
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,  // Assuming Admins are also Users, level 1
        ],

        'superadmins' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,  // Assuming SuperAdmins are also Users, level 2
        ],

        'supervisors' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,  // Assuming Supervisors are also Users, level 3
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Here you can configure the password reset settings. The expire value
    | defines how long the reset token is valid (in minutes).
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        'admins' => [
            'provider' => 'admins',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        'superadmins' => [
            'provider' => 'superadmins',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        'supervisors' => [
            'provider' => 'supervisors',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | The amount of seconds before a password confirmation window expires,
    | requiring the user to re-enter their password. Default is three hours.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
