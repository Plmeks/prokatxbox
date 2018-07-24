<section id="show" ng-controller="CatalogueShowController">
    <div class="col-md-12">
        <div class="row showTitle" ng-if="!currentBranch.image">
            <div class="callout-bubble text-center fade-in-b">
                <h1>{{currentBranch.name}}</h1>
                <h3>{{currentBranch.description}}</h3>
            </div>
        </div>
        <div class="row catalogueHeader" ng-if="currentBranch.image">
        	<div class="imageWrap">
        		<img ng-src=<?= URL .PROJECT ?>content/images/{{currentBranch.image}}>
        	</div>
        	<div class="overlap text-center">
        		<h1>{{currentBranch.name}}</h1>
                <h3>{{currentBranch.description}}</h3>
        	</div>
        </div>

        <div class="row showArea">
            <div class="col-md-9 col-md-push-3">
                <div class="row productWrapper">
                    <div class="col-md-12" ng-if="products.length">
                    	<div id="filters" class="row">
		                    <div class="col-md-4 col-sm-4">
		                        <input id="search" class="form-control" placeholder="Поиск по товарам" ng-model="query" ng-change="setQuery(query)">
		                    </div>
		                    <div class="col-md-4 col-sm-4">
		                        <select class="form-control" ng-model="sort">
		                        	<option value="-popular">Сначала популярные</option>
		                            <option value="">По новизне</option>
		                            <option value="+price">Дешевле</option>
		                            <option value="-price">Дороже</option>
		                        </select>
		                    </div>
		                    <div class="col-md-4 col-sm-4">
		                        <select class="form-control" ng-model="pageSize">
		                        	<option value="10">Товаров на странице</option>
		                            <option value="5">5</option>
		                            <option value="10">10</option>
		                            <option value="20">20</option>
		                            <option value="50">50</option>
		                        </select>
		                    </div>
		                </div>
                        <div dir-paginate="product in products | filter:search | orderBy: sort | itemsPerPage: pageSize"
                             current-page="currentPage" class="row productItemWrap verticalCenter">

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center">
                                <a href="<?= URL ?>product/name/{{product.shortName}}">
                                    <img class="productImage" ng-src=<?= URL .PROJECT ?>content/images/{{product.image}}>
                                </a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 productText">
                                <h3 class="productName">
                                    <a href="<?= URL ?>product/name/{{product.shortName}}">
                                        {{product.name}}
                                    </a>
                                </h3>
                                <div class="productShortDescription">
                                    <p class="productDescription">
                                        {{
                                        product.shortDescription
                                        }}
                                    </p>
                                </div>
                                <span class="hidden-xs">
                                    <a href="<?= URL ?>product/name/{{product.shortName}}" class="btn btn-primary" href="#" role="button">
                                        Подробнее
                                    </a>
                                </span>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center productCart">
                                <div class="row">
                                    <h4 class="productPrice hidden-xs">{{formatPrice(product.price)}} руб.</h4>
                                </div>
                                <div class="row productCartBtn">
                                    <div class="col-md-12">
                                        <a href="<?= URL ?>product/name/{{product.shortName}}" class="btn btn-primary hidden-lg hidden-md hidden-sm" href="#" role="button">
                                            Подробнее
                                        </a>

                                        <span ng-switch on="isInCart(product)">
                                            <span ng-switch-when="true">
                                                <a href="<?= URL;?>cart" class="btn btn-default btn-success">
                                                    <span class="glyphicon glyphicon-ok"></span>
                                                    Оформить
                                                </a>
                                            </span>
                                            <span ng-switch-when="false">
                                                <a class="btn btn-default" ng-click="addToCart(product)">
                                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                                    <span class="hidden-lg hidden-md hidden-sm"> {{formatPrice(product.price)}} руб.</span>
                                                    <span class="hidden-xs"> Заказать</span>
                                                </a>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="pagination">
                            <dir-pagination-controls on-page-change="scrollTop()">
                            </dir-pagination-controls>
                        </div>
                    </div>
                    <div class="col-md-10 col-md-offset-1 text-center" ng-if="!products.length">
                        <div class="row productWrapper emptyBox hidden">
                            <img src="<?= IMG_URL;?>catalogue/empty_box.jpg" alt=""/>
                            <div class="text">
                                <h2><strong>А вот сюда товаров не завезли</strong></h2>
                                <h3>В другом разделе наверняка что-нибудь, да найдется.</h3>
                            </div>
                            <a class="btn btn-success" href="<?= URL;?>catalogue">Посмотреть все товары</a>
                            <a class="btn btn-primary" href="<?= URL;?>contacts">Сообщить о проблеме</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-md-pull-9">
                <div class="row treeWrapper">
                    <div id="catalogueTree"></div>
                </div>
            </div>
        </div>
    </div>
</section>
