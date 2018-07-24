<?php
	class catalogueModel extends Model {
        function getSubcategoryProducts($category, $subcategory){
            $query = (
                "SELECT *
                FROM product
                WHERE idCategory = :idCategory AND id IN (
                    SELECT idProduct
                    FROM catalogue
                    WHERE idSubcategory = :idSubcategory
                )
                ORDER BY id desc
                "
            );

            return $this->getResult($query, array(
                "idCategory" => $category,
                "idSubcategory" => $subcategory
            ));
        }
	}
	