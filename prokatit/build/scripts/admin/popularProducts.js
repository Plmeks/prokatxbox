$(document).ready(function(){
});
var adminApp = angular.module('adminApp', []);

$(document).ready(function() {
    $('#adminTree').treeview({
        enableLinks: true,
        expandIcon: 'glyphicon glyphicon-chevron-right',
        collapseIcon: 'glyphicon glyphicon-chevron-down',
        data: [{
            text: "Советы и подсказки",
            selectable: false,
            href: "https://" + window.location.host +
                "/admin"
        }, {
            text: "Главная страница",
            selectable: false,
            nodes: [{
                text: "Конкурсы",
                selectable: false,
                href: "https://" + window.location.host +
                    "/admin/competition"
            }, {
                text: "Популярные товары",
                selectable: false,
                href: "https://" + window.location.host +
                    "/admin/popularProducts"
            }]
        }, {
            text: "Для клиентов",
            selectable: false,
            nodes: [{
                text: "Статьи",
                selectable: false,
                href: "https://" + window.location.host +
                    "/admin/articles"
            }]
        }, {
            text: "Каталог",
            selectable: false,
            nodes: [{
                text: "Категории",
                selectable: false,
                href: "https://" + window.location.host +
                    "/admin/categories"
            }, {
                text: "Товары",
                selectable: false,
                href: "https://" + window.location.host +
                    "/admin/products"
            }]
        }]
    });

    $("#adminTree").treeview('getEnabled').forEach(function(node) {
        if(node.href) {
            var currentLink = window.location.href;
            var nodePart = node.href.substr(node.href.lastIndexOf('/') + 1, node.href.length);
            var linkPart = currentLink.substr(currentLink.lastIndexOf('/') + 1, currentLink.length);

            if(nodePart == linkPart) {
                $("#adminTree").treeview('selectNode', node.nodeId);
            }
        }
    });
});


adminApp.controller('adminController', function($scope) {
    $scope.title = "Редактор блока популярных продуктов"
});

$(document).ready(function () {
    var serverUrl =  "https://" + window.location.host + "/admin/popularProducts";

    $("#grid").kendoGrid({
        dataSource: {
            type: "odata",
            transport: {
                read: {
                    url: serverUrl,
                    dataType: "json"
                },
                update: {
                    url: serverUrl,
                    dataType: "json"
                },
                destroy: {
                    url: serverUrl,
                    dataType: "json"
                },
                create: {
                    url: serverUrl,
                    dataType: "json"
                },
                parameterMap: function(data) {
                    return kendo.stringify(data);
                }
            },
            schema: {
                data: function (data) {
                    return data;
                },
                total: "total",
                model: {
                    id: "id",
                    fields: {
                       product: {
                            defaultValue: {
                                id: 0, name: "Выберите продукт"
                            },
                            validation: {
                                required: true,
                                isChosen: function (input, test) {
                                    if(input[0].name == "product" && input[0].value == "0") {
                                        console.log('here');
                                        input.attr("data-ischosen-msg", "Выберите продукт!");
                                        return false;
                                    }

                                    return true;
                                }
                            }
                        }
                    }
                }
            },
            //autoSync: true,
            batch: true
        },
        height: 700,
        groupable: false,
        sortable: true,
        editable: "inline",
        toolbar: ["create"],
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 15
        },
        columns: [{
            field: "product",
            template: "#=product.name#",
            editor: productDropDownEditor,
            sortable: true
        }, {
            command: ["edit", "destroy"],
            title: "&nbsp;",
            width: 250
        }]
    });

    function productDropDownEditor(container, options) {
        $('<input required name="' + options.field + '"/>')
            .appendTo(container)
            .kendoDropDownList({
                autoBind: false,
                dataTextField: "name",
                dataValueField: "id",
                dataSource: {
                    type: "odata",
                    transport: {
                        read: {
                            url: "https://" + window.location.host + "/admin/products",
                            dataType: "json"
                        }
                    },
                    schema: {
                        data: function (data) {
                            return data;
                        },
                        total: "total"
                    }
                }
            });

        // баг с валидатором
        $('<span class="k-invalid-msg" data-for="product"></span>').appendTo(container);
    }
});
