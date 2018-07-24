<section id="prokatit-popular" ng-controller="PopularProductsController">
    <div class="col-md-10 col-md-offset-1 paper-white">
        <div class="row section-heading">
            <div class="col-md-12">
                <h2>Популярные товары</h2>
            </div>
        </div>
        <div class="hidden-sm" ng-repeat="rows in chunkedProductsLargeScreen">
            <div class="row">
                <div ng-repeat="product in rows" class="col-md-3 col-md-offset-0 col-xs-6 col-xs-offset-0 text-center item">
                    <div class="gradient">
                        <a href="<?= URL ?>product/name/{{product.shortName}}">
                            <img class="showing-image" alt="" ng-src="<?= URL .PROJECT;?>content/images/{{product.image}}">
                        </a>
                    </div>

                    <h3 class="productName">
                        <a href="<?= URL ?>product/name/{{product.shortName}}">
                            {{product.name}}
                        </a>
                    </h3>

                    <div>
                        <span class="price">{{product.price}} руб.</span>
                    </div>

                    <div class="cartButton" ng-switch on="isInCart(product)">
                        <div ng-switch-when="true">
                            <a href="<?= URL;?>cart" class="btn btn-default btn-success">
                                <span class="glyphicon glyphicon-ok"></span>
                                Оформить
                            </a>
                        </div>
                        <div ng-switch-when="false">
                            <a class="btn btn-default" ng-click="addToCart(product)">
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                                Заказать
                            </a>
                        </div>
                    </div>
                </div>
            </div>
<!--            <div class="divider hidden-sm hidden-xs"></div>-->
        </div>
        <div class="hidden visible-sm" ng-repeat="rows in chunkedProductsSmallScreen">
            <div class="row">
                <div ng-repeat="product in rows" class="col-sm-4 col-sm-offset-0 item text-center">
                    <a href="<?= URL ?>product/name/{{product.shortName}}">
                        <img class="showing-image" alt="" ng-src="<?= URL .PROJECT;?>content/images/{{product.image}}">
                    </a>

                    <h3 class="productName">
                        <a href="<?= URL ?>product/name/{{product.shortName}}">
                            {{product.name}}
                        </a>
                    </h3>

                    <div>
                        <span class="price">{{product.price}} руб.</span>
                    </div>

                    <div class="cartButton" ng-switch on="isInCart(product)">
                        <div ng-switch-when="true">
                            <a href="<?= URL;?>cart" class="btn btn-default btn-success">
                                <span class="glyphicon glyphicon-ok"></span>
                                Оформить
                            </a>
                        </div>
                        <div ng-switch-when="false">
                            <a class="btn btn-default" ng-click="addToCart(product)">
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                                Заказать
                            </a>
                        </div>
                    </div>
                </div>
            </div>
<!--            <div class="divider hidden-sm hidden-xs"></div>-->
        </div>
    </div>


</section>