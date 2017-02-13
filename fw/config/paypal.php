<?php
return array(
    // set your paypal credential
    /* produccion */
        'client_id' => 'Af-pU77T_4PZViFvJ1sbPnlNJyDLfvwbvKv3sxKxVy7PQSm-6ZUUm4rcglw1USzA6s9Kzpa1Z7c_0LAv',
        'secret' => 'EEF1eEK3eiyKGS4ftcnjha3eA3qjYj1C0m5bfv4GjjMAtH4JM8JRJfeUNQfhW7BIN0U-l2yBtBhDUNUG',
    /* Sandbox */
//    'client_id' => 'AR3RufCk6OU44nrbGF2nDIvOxRYjpzYvWyAxAFRedJrL6eSzay9jLyqTTr2xZNgfGtzUg3j2BehjuvyI',
//    'secret' => 'EPUBTP0rB7NsvsZluLmcsreaGP1z7bj9cKhUkDSiRgxkc4lH5tDDhCRM-8l9sqqTEigkTJQtn8mKfDqI',
    /**
     * SDK configuration  
     *  
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'live',

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
