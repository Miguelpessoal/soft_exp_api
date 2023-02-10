<?php 
    class DB
    {
        public static function connect()
        {
            $params = parse_ini_file('connection.ini');
            
            $request = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s", 
                $params['DB_HOST'], 
                $params['DB_PORT'], 
                $params['DB_NAME'], 
                $params['DB_USER'], 
                $params['DB_PASSWORD']
            );
            $connection = new \PDO($request);
            $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            
            return $connection;
        }
    }