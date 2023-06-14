<?php 

return [
  
    'PLATFORM_NAME'                     => "Acidbase",
    'ADMIN_PREFIX'                      => 'admin',
    
    'SYSTEM_EMAIL'                      => 'coffeerun@no-reply.com',
    'SYSTEM_EMAIL_NAME'                 => 'CoffeeRun',
    'SUPPORT_EMAIL'                     => env('SUPPORT_EMAIL', "info@coffeerun.com"),

    'AUTH_TOKEN_STATUS'                 => 0,
    'WEB_DEVICE'                        => 0,
    'ANDROID_APP_DEVICE'                => 1,
    'IPHONE_APP_DEVICE'                 => 2,

    'DRIVER_PENDING_ORDER'              => 0,
    'DRIVER_ACCEPT_ORDER'               => 1,
    'DRIVER_READY_PICKUP_ORDER'         => 2,
    'DRIVER_OUT_FOR_DELIVERY'           => 4,
    'DRIVER_COMPLETE_ORDER'             => 3,


    'RESTAURANT_PENDING_ORDER'              => 0,
    'RESTAURANT_IN_PROGRESS_ORDER'          => 1,
    'RESTAURANT_READY_TO_PICK_ORDER'        => 2,
    'RESTAURANT_OUT_FOR_DELIVERY'           => 4,
    'RESTAURANT_COMPLETE_ORDER'             => 3,
    'RESTAURANT_ACCEPT_ORDER'             => 5,
    
    "ADD_ON"                            =>1,
    "SELECTION"                            =>3,
    "SIZE"                            =>2,
    
];