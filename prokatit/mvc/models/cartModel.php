<?php
	class cartModel extends Model {
        function selectRentedOrders() {
            $query = ("
                SELECT *
                FROM orders INNER JOIN orderList
                  ON idOrder = orders.id
                WHERE
                  orders.toDate >= CURDATE()
            ");

            return $this->getResult($query);
        }

        function selectProductNames ($productIds) {
            $query = ("
                SELECT name
                FROM product
                WHERE
                  id in($productIds)
            ");

            return $this->getResult($query);
        }

        function insertOrders($data) {
			$query = "INSERT INTO orders(";
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
	}
	