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
        editable: "inline",
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
            title: "Описание"
        }, { command: ["edit", "destroy"],
            title: "&nbsp;",
            width: "250px"
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
                editable: "inline",
                toolbar: ["create"],
                columns: [{
                    field: "name",
                    title: "Название"
                }, {
                    field: "shortName",
                    title: "Название для ссылки"
                }, {
                    field: "description",
                    title: "Описание"
                }, {
                    command: ["edit", "destroy"],
                    title: "&nbsp;",
                    width: 250
                }]
            });
    }
});