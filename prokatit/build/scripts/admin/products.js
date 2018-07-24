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
    $scope.title = "Редактор продуктов"
});

$(document).ready(function () {
    var serverUrl =  "https://" + window.location.host + "/admin/";
    var imageUrl = "https://" + window.location.host + "/prokatit/content/images/";

    $("#grid").kendoGrid({
        dataSource: {
            type: "odata",
            transport: {
                read: {
                    url: serverUrl + "products",
                    dataType: "json"
                },
                update: {
                    url: serverUrl + "products",
                    dataType: "json"
                },
                destroy: {
                    url: serverUrl + "products",
                    dataType: "json"
                },
                create: {
                    url: serverUrl + "products",
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
                        id: { editable: false, nullable: true},
                        name: {
                            validation: { required: true }
                        },
                        shortName: { validation: { required: true } },
                        price: { validation: { required: true } },
                        description: { defaultValue: "Введите полное описание"},
                        shortDescription: { defaultValue: "Введите короткое описание"},
                        category: {
                            defaultValue: {
                                id: 0,
                                name: "Выберите категорию"
                            },
                            validation: {
                                required: true,
                                isChosen: function (input, test) {
                                    if(input[0].name == "category" && input[0].value == "0") {
                                        input.attr("data-ischosen-msg", "Выберите категорию!");
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
        editable: {
            mode: "popup",
            window: {
                resizable: true,
                width: "50%",
                open: function(e) {
                    e.sender.wrapper.addClass("batchEditWindow");
                }
            }
        },
        toolbar: ["create"],
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 15
        },
        detailInit: subcategoriesDetailGrid,
        dataBound: function() {
            this.expandRow(this.tbody.find("tr.k-master-row").first());
        },
        columns: [{
            field: "name",
            title: "Название",
            width: 250
        }, {
            field: "category",
            title: "Категория",
            template: "#=category.name#",
            editor: categoryDropDownEditor,
            width: 200
        }, {
            field: "price",
            title: "Цена"
        }, {
            field: "shortName",
            title: "Название для ссылки",
            hidden: true
        }, {
            field: "description",
            title: "Описание",
            editor: descriptionEditor,
            hidden: true
        }, {
            field: "shortDescription",
            title: "Короткое описание",
            editor: shortDescriptionEditor,
            hidden: true
        }, {
            field: "image",
            title: "Изображение",
            editor: imageEditor,
            hidden: true
        }, {
            field: "popular",
            title: "Популярность (0 - 100)"
        }, { command: ["edit", "destroy"],
            title: "&nbsp;",
            width: "250px"
        }]
    });

    function subcategoriesDetailGrid(e) {
        $("<div/>")
            .appendTo(e.detailCell)
            .kendoGrid({
                dataSource: {
                    type: "odata",
                    transport: {
                        read: {
                            url: serverUrl + "catalogue?productId=" + e.data.id,
                            dataType: "json"
                        },
                        update: {
                            url: serverUrl + "catalogue",
                            dataType: "json"
                        },
                        create: {
                            url: serverUrl + "catalogue?productId=" + e.data.id,
                            dataType: "json"
                        },
                        destroy: {
                            url: serverUrl + "catalogue",
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
                                subcategory: {
                                    defaultValue: {
                                        id: 0,
                                        name: "Выберите подкатегорию"
                                    },
                                    validation: {
                                        required: true,
                                        isChosen: function (input, test) {
                                            if(input[0].name == "subcategory" && input[0].value == "0") {
                                                input.attr("data-ischosen-msg", "Выберите подкатегорию!");
                                                return false;
                                            }

                                            return true;
                                        }
                                    }
                                }
                            }
                        }
                    },
                    batch: true
                },
                scrollable: false,
                sortable: true,
                pageable: true,
                editable: "inline",
                toolbar: ["create"],
                columns: [{
                    field: "subcategory",
                    template: "#=subcategory.name#",
                    editor: function(container, options) {
                        subcategoryDropDownEditor(container, options, e.data.idCategory);
                    }
                }, {
                    command: ["edit", "destroy"],
                    title: "&nbsp;",
                    width: 250
                }]
            });
    }

    var iconCustomToolTemplate = kendo.template("");

    function getCustomToolTemplate() {
        var icons = [
            "search",
            "earphone",
            "globe"
        ];

        var options = "";

        icons.forEach(function(icon) {
            options += `<option>glyphicon-${icon}</option>`;
        });

        var template = `
            <select id="icons" style="width: 100%;" >
                ${options}
            </select>
        `;

        return template;
    }

    function getEditorToolsList() {
//        iconsCustomToolDropDown();
//        injectBootstrapToEditors();
        return [
            "bold",
            "italic",
            "underline",

            "justifyLeft",
            "justifyCenter",
            "justifyRight",
            "justifyFull",



            "insertUnorderedList",
            "insertOrderedList",

            "createLink",
            "unlink",
            "insertImage",
//            {
//                name: "custom",
//                template: getCustomToolTemplate
//            },

            "formatting",
            "cleanFormatting",

            "viewHtml",
            "createTable",
            "addRowAbove",
            "addRowBelow",
            "addColumnLeft",
            "addColumnRight",
            "deleteRow",
            "deleteColumn",
        ];
    }

    function imageEditor(container, options) {
        $("<textarea required name='image' id='uploadImageEditor' data-bind='value: " + options.field + "'></textarea>")
            .appendTo(container)
            .kendoEditor({
//                execute: onExecute,
                resizable: true,
                tools: [
                    "insertImage",
                    "viewHtml"
                ],
                imageBrowser: {
                    path: "/",
                    transport: {
                        read: {
                            url: serverUrl + "imageBrowser?type=read",
                            dataType: "json"
                        },
                        create: {
                            url: serverUrl + "imageBrowser?type=create",
                            dataType: "json"
                        },
                        destroy: {
                            url: serverUrl + "imageBrowser?type=destroy",
                            dataType: "json"
                        },
                        uploadUrl: serverUrl + "imageBrowser?type=upload",
                        thumbnailUrl: function(path, file) {
                            return imageUrl + path + file;
                        },
                        imageUrl: function(path) {
                            return imageUrl + path;
                        }
                    }
                }
            });
    }

    function categoryDropDownEditor(container, options) {
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
                            url: serverUrl + "categories",
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
        $('<span class="k-invalid-msg" data-for="category"></span>').appendTo(container);
    }

    function subcategoryDropDownEditor(container, options, categoryId) {
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
                            url: serverUrl + "subcategories?categoryId=" + categoryId,
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
        $('<span class="k-invalid-msg" data-for="subcategory"></span>').appendTo(container);
    }

    function descriptionEditor(container, options) {
        $("<textarea required name='description' id='descriptionEditor' data-bind='value: " + options.field + "'></textarea>")
            .appendTo(container)
            .kendoEditor({
                resizable: true,
                tools: getEditorToolsList(),
                imageBrowser: {
                    path: "/",
                    transport: {
                        read: {
                            url: serverUrl + "imageBrowser?type=read",
                            dataType: "json"
                        },
                        create: {
                            url: serverUrl + "imageBrowser?type=create",
                            dataType: "json"
                        },
                        destroy: {
                            url: serverUrl + "imageBrowser?type=destroy",
                            dataType: "json"
                        },
                        uploadUrl: serverUrl + "imageBrowser?type=upload",
                        thumbnailUrl: function(path, file) {
                            return imageUrl + path + file;
                        },
                        imageUrl: function(path) {
                            return imageUrl + path;
                        }
                    }
                }
            });
    }

    function shortDescriptionEditor(container, options) {
        $("<textarea required name='shortDescription' id='shortDescriptionEditor' data-bind='value: " + options.field + "'></textarea>")
            .appendTo(container);
    }

    function iconsCustomToolDropDown() {
        $("#icons").kendoDropDownList({
            template: "<span class='glyphicon #: data.value #'></span>",
            valueTemplate: "<span class='glyphicon #: data.value #'></span>",
            change: function(e) {
                var dropValue = $("#icons").data("kendoDropDownList").value();

                var val = "<span class='glyphicon " + dropValue + "'></span>";
                var editor = $("#descriptionEditor").data("kendoEditor");
                editor.exec("inserthtml", { value: val});
            }
        });
    }

    function injectBootstrapToEditors() {
        var bootstrapCdnStyle = "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' />";
        var bootstrapCdnScript = "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>";
        $('iframe').contents().find("head").append(bootstrapCdnStyle + bootstrapCdnScript);
    }


});
