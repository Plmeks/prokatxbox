<?php
 class homeModel extends Model {
     function getPopularProducts() {
         $query = ("
            SELECT prod.name, prod.shortName, prod.shortDescription, prod.price, prod.image, prod.id, prod.popular
            FROM product as prod
            INNER JOIN popularProducts
            ON prod.id = popularProducts.idProduct
            ORDER BY id DESC
          ");

         return $this->getResult($query);
     }
 }