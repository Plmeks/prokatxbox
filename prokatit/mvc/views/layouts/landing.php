<!DOCTYPE html>
<html>
<head>
    <? $this->generatePartial("headers/landing");?>
</head>
<body ng-app="app">
    <? $this->generatePartial("navigations/navbar");?>
    <div class="container-fluid">
        <div class="row">
            <? $this->generateBody(); ?>
        </div>
    </div>
    <? $this->generatePartial("footers/stickyFooter");?>
</body>
</html>