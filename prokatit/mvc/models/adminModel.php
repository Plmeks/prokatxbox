<?php
	class adminModel extends Model {
        function selectCatalogue($productId) {
            $query = ("
                SELECT catalogue.id, idProduct, subcategory.id as subcategoryId, subcategory.name as subcategoryName
                FROM catalogue INNER JOIN subcategory
                ON catalogue.idSubcategory = subcategory.id
                WHERE idProduct = :idProduct
            ");

            return $this->getResult($query, array("idProduct" => $productId));
        }

        function selectProducts() {
            $query = ("
                SELECT product.id, product.name, subcategory.name AS subcategoryName, subcategory.id as subcategoryId
                FROM product
                INNER JOIN catalogue
                  ON catalogue.idSubcategory = subcategory.id

            ");

            return $this->getResult($query);
        }

        function selectPopularProducts() {
            $query = ("
                SELECT product.name, popularProducts.id, popularProducts.idProduct
                FROM product
                INNER JOIN popularProducts
                  ON product.id = popularProducts.idProduct

            ");

            return $this->getResult($query);
        }

        function selectCategories() {
            $query = ("
                SELECT *
                FROM category
            ");

            return $this->getResult($query);
        }

        function selectSubcategories() {
            $query = ("
                SELECT subcategory.id, subcategory.name, subcategory.shortName,
                  subcategory.description, category.id AS categoryId, category.name AS categoryName
                FROM subcategory, category
                WHERE category.id = subcategory.idCategory
            ");

            return $this->getResult($query);
        }


	}
