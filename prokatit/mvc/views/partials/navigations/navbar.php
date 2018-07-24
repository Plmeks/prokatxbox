<div id="navbar" ng-controller="NavbarController">
    <nav class="navbar navbar-fixed-top">
        <div class="container hidden-sm">
            <? $this->generatePartial("navigations/helpers/navbarContent"); ?>
        </div>
        <div class="container-fluid hidden visible-sm">
            <? $this->generatePartial("navigations/helpers/navbarContent"); ?>
        </div>
    </nav>
</div>

<?// $this->generatePartial("partialHelpers/navbarAuth"); ?>