<?php
return array(
    // set your paypal credential
    /* produccion */
    //    'client_id' => 'AZrSGAu4da84eWhszQxl2OPI3eWDd5DUHYVQPXVaOmdfm7uZOgihF8zTylJXIEbK8sIh2WVfniTFiWVv',
    //    'secret' => 'EK5ssjCDgM69EKcaDDZQPpqbT3eIpGzHltQxJU4girT6TTyCyr0lcxYG4_fqUSAzJQC7usCHzvgyKwFw',
    /* Sandbox */
    'client_id' => 'AR3RufCk6OU44nrbGF2nDIvOxRYjpzYvWyAxAFRedJrL6eSzay9jLyqTTr2xZNgfGtzUg3j2BehjuvyI',
    'secret' => 'EPUBTP0rB7NsvsZluLmcsreaGP1z7bj9cKhUkDSiRgxkc4lH5tDDhCRM-8l9sqqTEigkTJQtn8mKfDqI',
    /**
     * SDK configuration  
     *  
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);