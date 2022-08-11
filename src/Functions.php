<?php

if (!function_exists('mongodb_pool_config')) {
    

     /**
      * $options = [
      *     'database' => 'admin',
      *     'authMechanism' => $authMechanism,
      *     设置复制集,没有不设置
      *     'replica' => $replica,
      *     'readPreference' => $readPreference,
      * ],
      */

      /**
       * MongoDb
       *
       * @param array|string $hostWithPort
       * @param string $dbName
       * @param string $replica
       * @param string $readPreference
       * @param array $options
       * @param string $username
       * @param string $password
       * @param integer $maxConn
       * @param float $connTimeout
       * @param float $maxIdleTime
       * @return array
       */
    function mongodb_pool_config($hostWithPort, string $dbName, string $replica = 'rs0', string $readPreference = 'primary',
        array $options = [
            'database' => 'admin'
        ],
        string $username = '', string $password = '',
        int $maxConn = 100, float $connTimeout = 10, float $maxIdleTime = 60 ): array {

        $_options = array_merge(
            $options,
            [
                'replica' => $replica,
                'readPreference' => $readPreference
            ]
        );

        return [
            'username' => $username,
            'password' => $password,
            'host' => $hostWithPort,
            'db' => $dbName,
            'options'  => $_options,
            'pool' => [
                'min_connections' => 1,
                'max_connections' => $maxConn,
                'connect_timeout' => $connTimeout,
                'wait_timeout' => 3.0,
                'heartbeat' => -1,
                'max_idle_time' => $maxIdleTime,
            ]
        ];
    }

}