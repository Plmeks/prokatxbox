<div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#navbar1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    
    <a class="navbar-brand hidden-xs" href="<?= URL; ?>"><img src="<?= URL .PROJECT;?>content/images/home/logo_orange.png" alt="Prokatit">
    </a>
    
    <a class="navbar-brand pull-right hidden-lg hidden-md hidden-sm" href="<?= URL; ?>"><img src="<?= URL .PROJECT;?>content/images/home/logo-orange-xs.png" alt="Prokatit">
    </a>
</div>
<div id="navbar1" class="navbar-collapse collapse">
    <ul class="navbarMenu nav navbar-nav navbar-left">
        <li><a href="<?= URL ?>">Главная</a></li>
        <li><a href="<?= URL ?>catalogue">Каталог</a></li>
        <li><a href="<?= URL ?>clients">Для клиентов</a></li>
        <li><a href="<?= URL ?>contacts">Контакты</a></li>
        <li><a href="https://vk.com/prokatxboxby" target="_blank">Сообщество</a></li>
        <li class="visible-xs">
            <a href="<?= URL ?>cart"">
                <span class="glyphicon glyphicon-shopping-cart"></span>
                Заказы
                <span class="badge">
                    {{cartItems.length ? cartItems.length : ""}}
                </span>
            </a>
        </li>
    </ul>
    <? $this->generatePartial("navigations/helpers/navbarCart"); ?>
</div>