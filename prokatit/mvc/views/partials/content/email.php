<section id="prokatit-email">
    <div class="col-md-10 col-md-offset-1 paper-white">
        <div class="row section-heading">
            <div class="col-md-12">
                <h2>Связаться с нами</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 contactWrap hidden-sm hidden-xs">
                <div class="row contact">
                        <div class="col-md-4 text-center">
                            <img src="<?= URL .PROJECT;?>content/images/home/phone.png">
                        </div>
                        <div class="col-md-8">
                            <h3>Контактный телефон:</h3>
                            <div class="text-phone">+375(25) 927-51-26</div>
                        </div>
                </div>
                <div class="row contact">
                    <div class="col-md-4 text-center">
                        <img src="<?= URL .PROJECT; ?>content/images/home/vk.png">
                    </div>
                    <div class="col-md-8">
                        <h3>Группа вконтакте:</h3>
                        <div class="text-link smaller">
                            <a href="http://vk.com/gomelprokatxboxby" target="_blank">vk.com/gomelprokatxboxby</a>
                        </div>
                    </div>
                </div>
                <div class="row contact">
                        <div class="col-md-4 text-center">
                            <img src="<?= URL .PROJECT; ?>content/images/home/email.png">
                        </div>
                        <div class="col-md-8">
                            <h3>Почта e-mail:</h3>
                            <div class="text-link smaller">
                                <a href="mailto:prokatitgomel@gmail.com">prokatitgomel@gmail.com</a>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-sm-12 col-xs-12 hidden-md hidden-lg">
                <div class="row contactWrap">
                    <div class="col-md-4 col-md-offset-0 col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1 text-center contact">
                        <div class="row">
                            <img src="<?= URL .PROJECT;?>content/images/home/phone.png">
                        </div>
                        <div class="row">
                            <h3>Контактный телефон:</h3>
                            <div class="text-phone">+375(25) 927-51-26</div>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-0 col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1 text-center contact">
                        <div class="row">
                            <img src="<?= URL .PROJECT; ?>content/images/home/vk.png">
                        </div>
                        <div class="row">
                            <h3>Группа вконтакте:</h3>
                            <div class="text-link">
                                <a href="http://vk.com/gomelprokatxbox" target="_blank">vk.com/gomelprokatxbox</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-0 col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1 text-center contact">
                        <div class="row">
                            <img src="<?= URL .PROJECT; ?>content/images/home/email.png">
                        </div>
                        <div class="row">
                            <h3>Почта e-mail:</h3>
                            <div class="text-link">
                                <a href="mailto:prokatitgomel@gmail.com">prokatitgomel@gmail.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-0 col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0 emailWrap">
                <div class="row">
                    <div id="send" class="col-md-10 col-md-offset-1">
                        <h2>Написать письмо</h2>
                        <form id="emailForm" method="post">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" id="inputName" placeholder="Ваше имя">
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Ваш e-mail">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="4" name="message" placeholder="Ваше сообщение"></textarea>
                            </div>
                            <button type="submit" class="btn btn-default" data-disable="false">Отправить</button>
                        </form>
                        <h3 class="hidden success text-center">Сообщение успешно отправлено !</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>