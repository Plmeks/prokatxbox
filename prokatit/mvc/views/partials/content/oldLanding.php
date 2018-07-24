<section id="prokatit-landing" ng-controller="PopularProductsController">
    <div id="slider" class="owl-carousel">
        <div class="item">
            <img src="<?= URL .PROJECT;?>content/images/home/parallax1.jpg" alt="Xbox one">
        </div>
        <div class="item">
            <img src="<?= URL .PROJECT;?>content/images/home/parallax2.jpg" alt="Xbox 360">
        </div>
        <div class="item">
            <img src="<?= URL .PROJECT;?>content/images/home/parallax3.jpg" alt="PlayStation 3">
        </div>
        <div class="item">
            <img src="<?= URL .PROJECT;?>content/images/home/parallax4.jpg" alt="PlayStation 4">
        </div>
    </div>
    <div id="upper">
        <div id="info" class="text-center">
            <h1 class="text-center">Выгодный прокат приставок в Гомеле</h1>
            <h2 class="hidden-xs">Лучший способ хорошо провести время !</h2>
        </div>
        <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 text-center" style="">
            <form autocomplete="off" data-disable="false" data-toggle="validator" data-delay="100000">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="from" class="control-label">От</label>
                            <div class="inner-addon right-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                                <input id="from" type="text" name="dateFrom" class="date form-control input-lg" data-error="Введите начальную дату" required placeholder="Дата начала аренды">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="to" class="control-label">До</label>
                            <div class="inner-addon right-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                                <input id="to" name="dateTo" type="text" class="date form-control input-lg" data-error="Введите начальную дату" required placeholder="Дата конца аренды">
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group" class="control-label">
                            <label for="console">Выберите товар:</label>
                            <div class="inner-addon right-addon">
                                <i class="glyphicon glyphicon-credit-card"></i>
                                <select id="console" name="console" class="form-control input-lg">
                                    <option ng-repeat="product in popularProducts">{{product.name}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="inputPhone" class="control-label">Ваш телефон:</label>
                            <div class="inner-addon right-addon">
                                <i class="glyphicon glyphicon-phone"></i>
                                <input type="tel" name="phone" class="form-control input-lg" id="inputPhone" placeholder="Телефон" data-error="Введите номер телефона" required>
                            </div>
                        </div>
                    </div>

                    <button id="submit-order" type="submit" class="btn btn-default" data-disable="false">Быстрый заказ</button>
                </div>

            </form>
        </div>
    </div>
</section>