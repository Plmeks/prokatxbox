<section id="product" ng-controller="ProductController">
    <div class="col-md-9">
        <div class="row productWrapper">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <img class="productImage" src=<?= URL .PROJECT ?>content/images/{{product.image}}>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12 articleTypographySmall">
                <h2>{{product.name}}</h2>
                <div class="description" ng-bind-html="helperMethodsService.trustedHtml(product.description)"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row cartWrapper">
            <div class="col-md-12 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-12">
                <div class="totalText text-center">
                    <h4>День аренды:</h4>
                    <h2>{{helperMethodsService.formatPrice(product.price)}} руб.</h2>
                </div>
                <div class="buttons row text-center">
                	<div class="col-md-12 col-sm-6 col-xs-6">
                		<div ng-if="isInCart(product.id)">
		                    <a href="<?= URL;?>cart" class="cartBtn btn btn-success">
		                        <span class="glyphicon glyphicon-ok"></span>
		                        Оформить
		                    </a>
		                </div>
		                <div ng-if="!isInCart(product.id)">
		                    <a ng-click="addToCart(product)" class="cartBtn btn btn-primary">
		                        <span class="glyphicon glyphicon-shopping-cart"></span>
		                        Заказать
		                    </a>
		                </div>
                	</div>
                	<div class="col-md-12 col-sm-6 col-xs-6">
                		<div>
		                    <a href="<?= URL;?>catalogue" class="catalogueBtn btn">
		                        В каталог
		                    </a>
		                </div>
                	</div>
                </div>
            </div>
        </div>
    </div>
</section>