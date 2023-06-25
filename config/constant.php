<?php 

return [
  
    'PLATFORM_NAME'                     => "Acidbase",
    'ADMIN_PREFIX'                      => 'admin',
    
    'SYSTEM_EMAIL'                      => 'acidbase@no-reply.com',
    'SYSTEM_EMAIL_NAME'                 => 'Acidbase',
    'SUPPORT_EMAIL'                     => env('SUPPORT_EMAIL', "info@acidbase.com"),

    'SALE_TYPE'=>[
        "SEED"=>1,
        "PRIVATE"=>2,
        "PUBLIC"=>3
    ],
    
];