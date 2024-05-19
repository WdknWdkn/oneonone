<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    | このファイルは、Laravel CORS パッケージの設定ファイルです。
    | ここで、クロスオリジンリソース共有の設定を行うことができます。
    | これにより、Web ブラウザで実行されるクロスオリジン操作を決定します。
    | 必要に応じてこれらの設定を調整することができます。
    | 詳細については、以下のリンクを参照してください。
    | https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
