adminApp.controller('adminController', function($scope) {
    $scope.title = "Редактор статей для клиентов"
});

$(document).ready(function () {
    var serverUrl =  "https://" + window.location.host + "/admin/";
    var imageUrl = "https://" + window.location.host + "/prokatit/content/images/";

    $("#grid").kendoGrid({
        dataSource: {
            type: "odata",
            transport: {
                read: {
                    url: serverUrl + "articles",
                    dataType: "json"
                },
                update: {
                    url: serverUrl + "articles",
                    dataType: "json"
                },
                destroy: {
                    url: serverUrl + "articles",
                    dataType: "json"
                },
                create: {
                    url: serverUrl + "articles",
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
                        description: { defaultValue: "Введите описание"},
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
        columns: [{
            field: "name",
            title: "Название"
        }, {
            field: "shortName",
            title: "Название для ссылки"
        }, {
            field: "description",
            title: "Описание",
            editor: descriptionEditor
        }, { command: ["edit", "destroy"],
            title: "&nbsp;",
            width: "250px"
        }]
    });

    function getEditorToolsList() {
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
                       //uploadUrl: serverUrl + "imageBrowser?type=upload",
                        thumbnailUrl: function(path, file) {
                            return imageUrl + path + file;
                        },
                        imageUrl: function(path) {
                            return imageUrl + path;
                        }
//                        imageUrl: 'http://localhost:8013/images/crew/{1}'
                    }
                }
            });
    }

});