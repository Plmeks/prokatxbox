<?php if(!Session::get('loggedIn')):?>
    <div class="authModal modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
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
                                    <h2>Авторизация</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <form id="loginForm" method="post" class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Логин или e-mail" class="form-control" name="login" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input placeholder="Пароль" type="password" class="form-control" name="password" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-success modalButton">Войти</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button data-toggle="modal" data-dismiss="modal" data-target="#registrationModal" class="btn btn-primary modalButton">
                                                    Регистрация
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <a data-toggle="modal" data-target="#registrationModal" data-dismiss="modal">Восстановить пароль</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="authModal modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="Registration" aria-hidden="true">
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
                                    <h2>Регистрация</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <form id="registrationForm" method="post" class="form-horizontal" action="">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input placeholder="Логин" type="text" class="form-control" name="login" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input placeholder="E-mail" type="text" class="form-control" name="email" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input placeholder="Пароль" type="password" class="form-control" name="password" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input placeholder="Повторите пароль" type="password" class="form-control" name="confirmPassword" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success modalButton">Зарегестрировать</button>
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
<?php endif;?>