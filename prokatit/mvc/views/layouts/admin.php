<!DOCTYPE html>
<html>
<head>
    <? $this->generatePartial("headers/admin");?>
</head>
<body id="admin" ng-app="adminApp" ng-controller="adminController">
    <div class="container-fluid">
        <div class="row showTitle">
            <div class="callout-bubble text-center fade-in-b">
                <h1>{{title}}</h1>
                <h3></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="row empty-wrapper gridWrapper">
                    <div id="grid"></div>
                    <div ng-if="main">
                        <? $this->generateBody(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row empty-wrapper treeWrapper">
                    <div id="adminTree"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
