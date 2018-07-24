
<ul class="nav navbar-nav navbar-right hidden-xs" id="userMenu">
    <?if(Session::get('loggedIn')):?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span class="glyphicon glyphicon-user"></span> <?= Session::get('loginUser'); ?> <span class="caret"></span>
            </a>
            <ul class="userDropDown dropdown-menu" role="menu">
                <li><a href="<?= URL?>admin">Админка</a></li>
                <li><a class="exit" ng-click="exit()">Выйти</a></li>
            </ul>
        </li>
    <? endif; ?>
    <?/* else: */?>
    <!-- <li><a data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-user"></span> Войти</a></li>
    --><?/* endif; */?>
    <li class="dropdown">
        <a href="<?= URL ?>cart" class="dropdown-toggle disabled" data-toggle="dropdown" role="button" aria-expanded="false">
            <span class="glyphicon glyphicon-shopping-cart"></span> Заказы <span class="badge">{{cartItems.length ? cartItems.length : ""}}</span>
        </a>
        <ul class="smallCart dropdown-menu dropdown-cart" role="menu" ng-if="cartItems.length">
            <li>
                <span class="smallCartWrap" ng-repeat="item in cartItems track by item.id" ng-mouseover="showClose=true" ng-mouseleave="showClose=false">
                    <span class="productWrap">
                        <a href=<?= URL ?>product/name/{{item.shortName}}>
                            <img class="smallCartImage" ng-src=<?= URL .PROJECT ?>content/images/{{item.image}} alt="" />
                        </a>
                        <span class="productInfo">
                            <a class="productName" href=<?= URL ?>product/name/{{item.shortName}}>
                                <span>{{item.name}}</span>
                            </a>
                            <span>{{formatPrice(item.price)}} руб.</span>
                        </span>
                    </span>
                    <span ng-show="showClose" title="Удалить из заказов" ng-click="delete(item.id)" class="deleteIcon glyphicon glyphicon-remove"></span>
                </span>
            </li>
            <li class="text-center"><a class="goToCart" href="<?= URL ?>cart">Перейти в корзину</a></li>
        </ul>
    </li>
</ul>