<section ng-controller="CartController" id="cart" ng-init="initCart()">
    <div class="col-md-12">
        <div class="row text-center" ng-if="!cartItems.length">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="col-md-12 emptyCartWrap">
                        <img src="<?=URL .PROJECT;?>content/images/cart/empty.png">
                        <h2><strong>Упс...видимо, корзина пуста</strong></h2>
                        <h3>Не обижай корзину - переходи в каталог.</h3>
                        <a class="btn btn-success" href="<?= URL;?>catalogue">Перейти в каталог</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row cart-wrapper" ng-if="cartItems.length">
            <div class="col-lg-9 col-md-12">
                <div class="row cartProductWrapper">
                    <div class="col-md-12">
                        <div class="row cartItem verticalCenter" ng-class="orderError{{product.id}}"
                             ng-mouseenter="showIcon=true" ng-mouseleave="showIcon=false"
                             ng-repeat="product in cartItems track by product.id">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <a href=<?= URL ?>product/name/{{product.shortName}}>
                                    <img class="productImage" ng-src=<?= URL .PROJECT ?>content/images/{{product.image}}>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <h3 class="productName">
                                    <a href="<?= URL ?>product/name/{{product.shortName}}">
                                        {{product.name}}
                                    </a>
                                </h3>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-5 hidden-xs text-center">
                                <span class="productPrice">{{formatPrice(product.price)}} руб.</span>
                            </div>
                            <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
                                <a class="btn btn-success" href="#" role="button">
                                    {{formatPrice(product.price)}} руб.
                                </a>
                                <a class="btn btn-default btn-delete" ng-click="delete(product.id)" title="Удалить позицию" role="button">
                                    Удалить
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-2 col-xs-2 hidden-xs text-center">
                                <span class="deleteIcon glyphicon glyphicon-remove" ng-click="delete(product.id)" title="Удалить позицию">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="row orderWrapper">
                    <div class="col-lg-12 col-lg-offset-0 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                            <form id="orderForm" method="post" action="" class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="phone" ng-model="phoneTest" placeholder="Телефон"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="input-group date" id="fromDate">
                                            <input type="text" name="from" placeholder="Начиная с даты" class="form-control" autocomplete="off">
                                            <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="input-group date" id="toDate">
                                            <input type="text" name="to" placeholder="Заканчивая датой" class="form-control" autocomplete="off">
                                            <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <select class="form-control" name="delivery" ng-model="delivery" ng-change="makeDelivery(delivery)">
                                            <option value="">Способ доставки</option>
                                            <option value="pickup">Самовывоз Гомель ул. Трудовая д. 3а</option>
                                            <option value="courier">Курьером +{{deliveryPrice}} руб.</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" ng-show="delivery == 'courier'">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="address" placeholder="Адрес"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="fio" placeholder="ФИО"/>
                                    </div>
                                </div>

                                <div class="totalText text-center">
                                    <h4>Все вместе:</h4>
                                    <h2 id="summary"></h2>
                                </div>

                                <div class="form-group makeOrderBtnWrap">
                                    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-6">
                                        <button type="submit" class="makeOrderBtn btn btn-success">Подтвердить</button>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-sm-6 col-xs-6">
                                        <a class="makeOrderBtn btn btn-primary" href="<?= URL ?>catalogue" role="button">
                                            Еще каталог
                                        </a>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>