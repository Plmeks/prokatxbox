adminApp.controller('adminController', function($scope) {
    $scope.title = "Редактор конкурсов"
});


$(document).ready(function () {
    var serverUrl =  "https://" + window.location.host + "/admin/competition";

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
                    url: serverUrl ,
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
                        id: { editable: false, nullable: true},
                        link: {
                            validation: { required: true }
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
            field: "link",
            title: "Ссылка на кокурс вк"
        }, { command: ["edit", "destroy"],
            title: "&nbsp;",
            width: "250px"
        }]
    });

});