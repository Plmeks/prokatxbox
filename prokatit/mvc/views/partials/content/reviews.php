<section  id="prokatit-reviews" ng-controller="ReviewsController">
    <div class="col-md-10 col-md-offset-1 paper-white" ng-if="reviews">
        <div class="row section-heading">
            <div class="col-md-12">
                <h2>Отзывы и предложения клиентов</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
                <div id="slider" class="owl-carousel">
                    <div ng-repeat="review in ::reviews" class="item col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 text-center" ng-if="reviews">
                        <a ng-if="review.user.hidden || !review.user.photo_400_orig || review.user.deactivated" href="https://vk.com/id{{review.user.id}}" target="_blank">
                        	<img class="review-photo" src="<?= URL .PROJECT;?>content/images/home/person.png">
                        </a>
                        <a ng-if="!review.user.hidden && !review.user.deactivated && review.user.photo_400_orig"  href="https://vk.com/id{{review.user.id}}" target="_blank">
                        	<img class="review-photo" ng-src="{{review.user.photo_400_orig}}">
                        </a>
                        <h3><a href="https://vk.com/id{{review.user.id}}" target="_blank">{{review.user.first_name}} {{review.user.last_name}}</a></h3>
                        <p>
                            {{review.text}}
                        </p>
                    </div>
                    <div class="item col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 text-center">
                        <a href="https://vk.com/topic-85009498_32873935" target="_blank">
                        	<img class="all-reviews" class="review-photo" src="<?= URL .PROJECT;?>content/images/home/reviews-all.png">
                        </a>
                        <h3><a href="https://vk.com/topic-85009498_32873935" target="_blank">Читать все отзывы</a></h3>
                        <p>
                            Читать или оставить свой. Это очень поможет нам в дальнейшем развитии и улучшении проката. <a href="https://vk.com/topic-85009498_32873935" target="_blank">Оставить отзыв.</a>
                        </p>
                    </div>
                </div>
                <div class="control left">
                    <span class="glyphicon glyphicon-menu-left"></span>
                </div>
                <div class="control right">
                    <span class="glyphicon glyphicon-menu-right"></span>
                </div>
            </div>
        </div>
    </div>
</section>