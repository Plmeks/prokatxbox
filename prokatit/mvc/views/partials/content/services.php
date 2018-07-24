<section id="prokatit-services" ng-controller="PopularProductsController">
    <div class="col-md-10 col-md-offset-1 paper-white">
        <div class="row section-heading">
            <div class="col-md-12">
                <h2>Популярные товары</h2>
            </div>
        </div>
        <div ng-repeat="rows in chunkedProducts">
            <div class="row">
                <div ng-repeat="product in rows" class="col-md-4 col-md-offset-0 col-sm-6 col-xs-12 col-xs-offset-0 text-center">
                    <a href="<?= URL ?>catalogue/product/name/{{product.shortName}}">
                    <div class="showing-box"><img class="showing-image" alt="" ng-src="<?= URL .PROJECT;?>content/images/{{product.image}}">
                        <div class="showing-wrap">
                            <h3>{{product.name}}</h3>
                            <p class="description">{{product.shortDescription}}</p>
                            <p class="showing-complect">В комплекте идут:</p>
                            <div class="row">
                                <ul>
                                    <li><span class="glyphicon glyphicon glyphicon-ok-circle"></span> 2 джойстика</li>
                                    <li><span class="glyphicon glyphicon glyphicon-ok-circle"></span> большое количество игр</li>
                                </ul>

                            </div>
                            <p class="showing-complect">Cтоимость:</p>
                            <div class="row">
                                <ul>
                                    <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Первые сутки - {{product.price}}.</li>
                                    <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Вторые - 130 тыс.</li>
                                    <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Третьи и последующие - 100 тыс.</li>
                                    <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Неделя - 550 тыс.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <!--<div class="col-md-4 col-md-offset-0 col-sm-6 col-xs-12 col-xs-offset-0 text-center">
                    <div class="showing-box"><img class="showing-image" alt="" src="<?/*= URL .PROJECT;*/?>content/images/home/xbo360.png">
                        <div class="showing-wrap">
                            <h3>Xbox 360</h3>
                            <p>Прокат одной из самых популярных приставок в мире.</p>
                            <p class="showing-complect">В комплекте идут:</p>
                            <div class="row">
                                <ul>
                                    <li><span class="glyphicon glyphicon glyphicon-ok-circle"></span> 2 джойстика</li>
                                    <li><span class="glyphicon glyphicon glyphicon-ok-circle"></span> большое количество игр</li>
                                </ul>

                            </div>
                            <p class="showing-complect">Cтоимость:</p>
                            <div class="row">
                                <ul>
                                    <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Первые сутки - 120 тыс.</li>
                                    <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Вторые - 100 тыс.</li>
                                    <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Третьи и последующие - 80 тыс.</li>
                                    <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Неделя - 450 тыс.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-0 col-sm-6 col-xs-12 col-xs-offset-0 text-center">
                    <div class="showing-box"><img class="showing-image" alt="" src="<?/*= URL .PROJECT;*/?>content/images/home/ps3.png">
                        <div class="showing-wrap">
                            <h3>PlayStation 3</h3>
                            <p>Популярная игровая консоль от компании Sony.</p>
                            <p class="showing-complect">В комплекте идут:</p>
                            <div class="row">
                                <ul>
                                    <li><span class="glyphicon glyphicon glyphicon-ok-circle"></span> 2 джойстика</li>
                                    <li><span class="glyphicon glyphicon glyphicon-ok-circle"></span> большое количество игр</li>
                                </ul>
                            </div>
                            <p class="showing-complect">Cтоимость:</p>
                            <div class="row">
                                <ul>
                                    <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Первые сутки - 120 тыс.</li>
                                    <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Вторые - 100 тыс.</li>
                                    <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Третьи и последующие - 80 тыс.</li>
                                    <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Неделя - 450 тыс.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
            <div class="divider hidden-sm hidden-xs"></div>
        </div>
        <!--<div class="row">
            <div class="col-md-4 col-md-offset-0 col-sm-6 col-xs-12 col-xs-offset-0 text-center">
                <div class="showing-box"><img class="showing-image" alt="" src="<?/*= URL .PROJECT;*/?>content/images/home/projector.png">
                    <div class="showing-wrap">
                        <h3>Проектор NEC V260X</h3>
                        <p>Проектор отличного качества для игр в консоли и не только.</p>
                        <p class="showing-complect">В комплекте идут:</p>
                        <div class="row">
                            <ul>
                                <li><span class="glyphicon glyphicon glyphicon-ok-circle"></span> штатив</li>
                                <li><span class="glyphicon glyphicon glyphicon-ok-circle"></span> пульт управления</li>
                            </ul>

                        </div>
                        <p class="showing-complect">Cтоимость:</p>
                        <div class="row">
                            <ul>
                                <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Первые сутки - 200 тыс.</li>
                                <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Вторые - 150 тыс.</li>
                                <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Третьи и последующие - 130 тыс.</li>
                                <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Неделя - 600 тыс.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-0 col-sm-6 col-xs-12 col-xs-offset-0 text-center">
                <div class="showing-box"><img class="showing-image" alt="" src="<?/*= URL .PROJECT;*/?>content/images/home/sonyone.png">
                    <div class="showing-wrap">
                        <h3>PlayStation One</h3>
                        <p>Легендарная олдскульная приставка уже у Вас в руках.</p>
                        <p class="showing-complect">В комплекте идут:</p>
                        <div class="row">
                            <ul>
                                <li><span class="glyphicon glyphicon glyphicon-ok-circle"></span> 2 джойстика</li>
                                <li><span class="glyphicon glyphicon glyphicon-ok-circle"></span> большое количество игр</li>
                            </ul>

                        </div>
                        <p class="showing-complect">Cтоимость:</p>
                        <div class="row">
                            <ul>
                                <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Первые сутки - 30 тыс.</li>
                                <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Последующие - 20 тыс.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-0 col-sm-6 col-xs-12 col-xs-offset-0 text-center">
                <div class="showing-box"><img class="showing-image" alt="" src="<?/*= URL .PROJECT;*/?>content/images/home/gopro.png">
                    <div class="showing-wrap">
                        <h3>GoPro 4 Hero</h3>
                        <p>Легендарная экшн камера от компании GoPro.</p>
                        <p class="showing-complect">В комплекте идут:</p>
                        <div class="row">
                            <ul>
                                <li><span class="glyphicon glyphicon glyphicon-ok-circle"></span> зашитный контейнер</li>
                                <li><span class="glyphicon glyphicon glyphicon-ok-circle"></span> различные крепления</li>
                            </ul>
                        </div>
                        <p class="showing-complect">Cтоимость:</p>
                        <div class="row">
                            <ul>
                                <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Первые сутки - 120 тыс.</li>
                                <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Вторые - 100 тыс.</li>
                                <li><span class="glyphicon glyphicon glyphicon-share-alt"></span> Третьи и последующие - 80 тыс.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>


</section>