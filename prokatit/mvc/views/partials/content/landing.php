<section id="prokatit-landing" ng-controller="PopularProductsController">
    <div class="col-md-10 col-md-offset-1">
        <div class="row">
            <div class="col-md-10">
                <div class="row slider-wrap">
                	
            		<div id="cornerWrap" ng-if="competition">
            			<a href="{{competition.link}}" target="_blank">
	                		<div id="corner"></div>
		                	<div id="cornerText">
		                		<h3>КОНКУРС</h3>
		                	</div>
	                	</a>
                	</div>
                	
                    <div id="slider" class="owl-carousel">
                        <div class="item">
                            <img src="<?= URL .PROJECT;?>content/images/home/landing1.png" alt="Xbox one">
                            <div class="slider-text">
                                <h1>Прокат хорошего настроения</h1>
                                <h2>Возьмите напрокат у нас и не покупайте ничего лишнего.</h2>
                            </div>
                            <div class="slider-buttons">
                                <button class="action-button fast-order-btn" data-toggle="modal" data-target="#fastOrderModal">Быстрый заказ</button>
                                <a href="<?= URL ?>catalogue"><button class="action-button" data-disable="false">Весь каталог</button></a>
                            </div>
                        </div>
                        <div class="item">
                            <img src="<?= URL .PROJECT;?>content/images/home/landing-console.png" alt="Xbox 360">
                            <div class="slider-text">
                                <h1>Прокат приставок любого поколения</h1>
                                <h2>PS4, Xbox One, Xbox 360, Олдскул. Подберем консоль на любой вкус, а наша коллекция дисков Вас приятно удивит.</h2>
                            </div>
                            <div class="slider-buttons">
                                <button class="action-button fast-order-btn" data-toggle="modal" data-target="#fastOrderModal">Быстрый заказ</button>
                                <a href="<?= URL ?>catalogue/category/pristavki"><button class="action-button" data-disable="false">Выбрать приставку</button></a>
                            </div>
                        </div>
                        <div class="item">
                            <img src="<?= URL .PROJECT;?>content/images/home/landing-vr.png" alt="PlayStation 3">
                            <div class="slider-text">
                                <h1>Опыт вирутальной реальности</h1>
                                <h2>Playstation VR + мощная консоль PS4 pro. Погрузитесь в виртуальную реальность уже сегодня.</h2>
                            </div>
                            <div class="slider-buttons">
                                <button class="action-button fast-order-btn" data-toggle="modal" data-target="#fastOrderModal">Быстрый заказ</button>
                                <a href="<?= URL ?>catalogue/category/pristavki/subcategory/virtual_realnost"><button class="action-button" data-disable="false">Попробовать VR</button></a>
                            </div>
                        </div>
                        <div class="item">
                            <img src="<?= URL .PROJECT;?>content/images/home/landing-tv.png" alt="PlayStation 3">
                            <div class="slider-text">
                                <h1>Телевизоры и проекторы</h1>
                                <h2>На случай, когда не к чему подключить. Все доставим, настроим и запустим!</h2>
                            </div>
                            <div class="slider-buttons">
                                <button class="action-button fast-order-btn" data-toggle="modal" data-target="#fastOrderModal">Быстрый заказ</button>
                                <a href="<?= URL ?>catalogue/category/televizori_projectori"><button class="action-button" data-disable="false">Выбрать телевизор</button></a>
                            </div>
                        </div>
                        <div class="item">
                            <img src="<?= URL .PROJECT;?>content/images/home/landing-bicycle.png" alt="PlayStation 4">
                            <div class="slider-text">
                                <h1>Отдых и туризм</h1>
                                <h2>Аренда снаряжения для туризма и активного отдыха. Велосипеды прилагаются :)</h2>
                            </div>
                            <div class="slider-buttons">
                                <button class="action-button fast-order-btn" data-toggle="modal" data-target="#fastOrderModal">Быстрый заказ</button>
                                <a href="<?= URL ?>catalogue/category/otdyx_tyrizm"><button class="action-button" data-disable="false">Товары для туризма</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 popular-categories">
                <div class="row">
                	<a href="<?= URL;?>catalogue/category/pristavki">
	                    <img src="<?= URL .PROJECT;?>content/images/home/consoles.jpg" alt="Приставки">
	                    <div class="categories-text">
	                        <h2>Приставки</h2>
	                    </div>
                    </a>
                </div>
                <div class="row">
                	<a href="<?= URL;?>catalogue/category/velosiped">
	                    <img src="<?= URL .PROJECT;?>content/images/home/velosiped.png" alt="Велосипеды">
	                    <div class="categories-text">
	                        <h2>Велосипеды</h2>
	                    </div>
                    </a>
                </div>
                <div class="row">
                	<a href="<?= URL;?>catalogue/category/otdyx_tyrizm">
	                    <img src="<?= URL .PROJECT;?>content/images/home/active_otdyx.jpg" alt="PlayStation 3">
	                    <div class="categories-text">
	                        <h2>Активный отдых</h2>
	                    </div>
                    </a>
                </div>
                <div class="row">
                	<a href="<?= URL;?>catalogue/category/televizori_projectori">
	                    <img src="<?= URL .PROJECT;?>content/images/home/tv_projector.png" alt="Телевизоры и проекторы">
	                    <div class="categories-text">
	                        <h2>Телевизоры проекторы</h2>
	                    </div>
                    </a>
                </div>
                <div class="row">
                	<a href="<?= URL;?>catalogue/category/action_kameri">
	                    <img src="<?= URL .PROJECT;?>content/images/home/cameras.jpg" alt="PlayStation 3">
	                    <div class="categories-text">
	                        <h2>Action камеры</h2>
	                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

</section>