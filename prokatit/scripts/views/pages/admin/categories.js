adminApp.controller('adminController', function($scope) {
    $scope.title = "Редактор категорий и подкатегорий"
});

$(document).ready(function () {
    var serverUrl =  "https://" + window.location.host + "/admin/";
    var imageUrl = "https://" + window.location.host + "/prokatit/content/images/";

    $("#grid").kendoGrid({
        dataSource: {
            type: "odata",
            transport: {
                read: {
                    url: serverUrl + "categories",
                    dataType: "json"
                },
                update: {
                    url: serverUrl + "categories",
                    dataType: "json"
                },
                destroy: {
                    url: serverUrl + "categories",
                    dataType: "json"
                },
                create: {
                    url: serverUrl + "categories",
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
                        name: { validation: { required: true }}
                    }
                }
            },
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
            title: "Название"
        }, {
            field: "shortName",
            title: "Название для ссылки"
        }, {
            field: "description",
            title: "Описание",
            hidden: true
        }, {
            field: "image",
            title: "Изображение",
            hidden: true,
            editor: imageEditor
        }, { 
        	command: ["edit", "destroy"],
            title: "&nbsp;",
            width: "200px"
        }]
    });

    function subcategoriesDetailGrid(e) {
        console.log(e);
        $("<div/>")
            .appendTo(e.detailCell)
            .kendoGrid({
                dataSource: {
                    type: "odata",
                    transport: {
                        read: {
                            url: serverUrl + "subcategories?categoryId=" + e.data.id,
                            dataType: "json"
                        },
                        update: {
                            url: serverUrl + "subcategories?categoryId=" + e.data.id,
                            dataType: "json"
                        },
                        create: {
                            url: serverUrl + "subcategories?categoryId=" + e.data.id,
                            dataType: "json"
                        },
                        destroy: {
                            url: serverUrl + "subcategories",
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
                                name: {validation: {required: true}},
                                shortName: {validation: {required: true}},
                                description: {}
                            }
                        }
                    },
                    batch: true
                },
                scrollable: false,
                sortable: true,
                pageable: true,
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
                columns: [{
                    field: "name",
                    title: "Название"
                }, {
                    field: "shortName",
                    title: "Название для ссылки"
                }, {
                    field: "description",
                    title: "Описание",
                    hidden: true
                }, {
		            field: "image",
		            title: "Изображение",
		            editor: imageEditor,
		            hidden: true
		        }, {
                    command: ["edit", "destroy"],
                    title: "&nbsp;",
                    width: 200
                }]
            });
    }
    
    function imageEditor(container, options) {
        $("<textarea name='image' id='uploadImageEditor' data-bind='value: " + options.field + "'></textarea>")
            .appendTo(container)
            .kendoEditor({
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
});