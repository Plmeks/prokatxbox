<?php
	class DataBase extends PDO {
		function __construct(){
            $dsn = DB_TYPE .":" ."host=" .DB_HOST .";" ."dbname=" .DB_NAME;
            $user = DB_USER;
            $password = DB_PASSWORD;

            try {
                parent::__construct($dsn, $user, $password);
                // Fot showing exceptions
                parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                parent::setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch(PDOException $e){
                //die("Connection failed: " . $e->getMessage());
                echo "Connection failed: " . $e->getMessage();
            }

		}
	}