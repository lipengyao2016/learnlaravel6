<?php return array (
  'beyondcode/laravel-dump-server' => 
  array (
    'providers' => 
    array (
      0 => 'BeyondCode\\DumpServer\\DumpServerServiceProvider',
    ),
  ),
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'laravel/passport' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Passport\\PassportServiceProvider',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'nunomaduro/collision' => 
  array (
    'providers' => 
    array (
      0 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    ),
  ),
  'smartins/passport-multiauth' => 
  array (
    'providers' => 
    array (
      0 => 'SMartins\\PassportMultiauth\\Providers\\MultiauthServiceProvider',
    ),
  ),
  'swooletw/laravel-swoole' => 
  array (
    'providers' => 
    array (
      0 => 'SwooleTW\\Http\\LaravelServiceProvider',
    ),
    'aliases' => 
    array (
      'Server' => 'SwooleTW\\Http\\Server\\Facades\\Server',
      'Table' => 'SwooleTW\\Http\\Server\\Facades\\Table',
      'Room' => 'SwooleTW\\Http\\Websocket\\Facades\\Room',
      'Websocket' => 'SwooleTW\\Http\\Websocket\\Facades\\Websocket',
    ),
  ),
);