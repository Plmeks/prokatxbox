<section id="clients" ng-controller="clientsController">
    <div class="col-md-9">
        <div class="row articleWrapper articleTypographyLarge">
            <div class="description" ng-bind-html="helperMethodsService.trustedHtml(paper.description)"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row treeWrapper">
            <div id="clientsTree"></div>
        </div>
    </div>

</section>
