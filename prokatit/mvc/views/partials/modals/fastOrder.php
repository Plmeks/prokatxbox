<div ng-controller="PopularProductsController" class="authModal modal fade" id="fastOrderModal" tabindex="-1" role="dialog" aria-labelledby="Fast Order" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row text-center">
                            <div class="col-md-12 title">
                                <h2>Быстрый заказ</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <form id="fastOrderForm" method="post" class="form-horizontal">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Ваш телефон" class="form-control" name="phone" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select id="console" name="product" class="form-control styled-select">
                                                <option value="">Выберите товар аренды</option>
                                                <option ng-repeat="product in popularProducts">{{product.name}}</option>
                                                <option value="catalogue">Весь каталог</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="input-group date" id="fromDate">
                                                <input type="text" name="from" placeholder="Аренда начиная с даты" class="form-control" autocomplete="off">
                                                <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="input-group date" id="toDate">
                                                <input type="text" name="to" placeholder="Аренда заканчивая датой" class="form-control" autocomplete="off">
                                                <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success modalButton">Заказать</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>