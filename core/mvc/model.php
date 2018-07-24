<?php
	class Model {
        private $dataBase;

        function __construct(){
            $this->dataBase = new DataBase();
        }

        public function getDB() {
            return $this->dataBase;
        }

        protected function getResult($query, $data = null) {
            $dbc = $this->dataBase->prepare($query);
            $data ? $dbc->execute($data): $dbc->execute();

            return $dbc;
        }

        public function selectData($table, $data = null, $fields = null, $condition = null, $orderBy = null) {
        	if(is_null($data))
        		$data = array();
        		
        	if(is_null($fields))
        		$fields = array("*");
       
        	if(is_null($condition))
        		$condition = "AND";

        	if(is_null($orderBy))
        		$orderBy = "";

            $query = "SELECT ";
            foreach($fields as $val) {
                $query .= $val .", ";
            }
            $query = substr($query, 0, strrpos($query, ","));


            $query .= " FROM " .$table ." WHERE";

            foreach($data as $key => $val) {
                $query .= " " .$key ." = :" .$key ." " .$condition;
            }
            
            
            $query = substr($query, 0, strrpos($query, " "));
            
            if($orderBy) {
            	$query .= " ORDER BY " . $orderBy;
            }
            
            return $this->getResult($query, $data);
        }

        public function insertData($table, $data) {
            $query = "INSERT INTO " .$table ."(";
            $fields = "";

            foreach($data as $key => $val){
                $query .= $key .", ";
                $fields .= ":" .$key .", ";
            }

            $query = substr($query, 0, strrpos($query, ","));
            $fields = substr($fields, 0, strrpos($fields, ","));

            $query .= ") VALUES(" .$fields .")";

            return $this->getResult($query, $data);
        }

        public function deleteData($table, $data) {
            $query = "DELETE FROM " .$table ." WHERE";

            foreach($data as $key => $val) {
                $query .= " " .$key ." = :" .$key ." AND";
            }
            $query = substr($query, 0, strrpos($query, " "));

            return $this->getResult($query, $data);
        }

        public function updateData($table, $data = array(), $where = array()) {
            $query = "UPDATE " .$table ." SET";

            foreach($data as $key => $val) {
                $query .= " " .$key ." = '" .$val ."' ,";
            }
            $query = substr($query, 0, strrpos($query, " "));

            $query .= " WHERE";

            foreach($where as $key => $val) {
                $query .= " " .$key ." = '" .$val ."' " ."AND";
            }
            $query = substr($query, 0, strrpos($query, " "));

            return $this->getResult($query);
        }

	}