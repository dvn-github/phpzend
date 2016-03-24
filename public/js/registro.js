
tabla = null;
configuration = null;
$(document).ready(function() {
    /*
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });*/

    configuration = {
        "processing": false,
        "serverSide": false,
        "sAjaxSource": "/index/reload",
        "sServerMethod": "POST",
        "fnServerData": function(sSource, aoData, fnCallback, oSettings) {
            oSettings.jqXHR = $.ajax({
                "dataType": 'json',
                "type": "POST",
                "url": sSource,
                "data": aoData,
                "success" : function(json) {
                    fnCallback(json);
                }
            });
        },
        "columns":[
            {"data":"registro"},
            {"data":"fecha"},
            
        ],
        "columnDefs": [
            {
                "targets": [0,1],
                "searchable": true
            }
        ],
        "language":{
            "sSearch":"Buscar",
            "searchPlaceholder": "",
            "sProcessing": ""
        },
        "bLengthChange": false,
        "iDisplayLength": 10,
        "order":[[1,'desc']],
        "iDeferLoading": 0
    };

    tabla = $('#registros').dataTable(configuration);

    $('#add').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: '/index/add',
            method: "POST",
            data: {"valor": $("#nuevo_regsitro").val()},
            dataType: 'json',
            beforeSubmit: function() {
                $("#add").html("<img src='/images/loading.gif' style='width:17px; display:block;'>").attr("disabled", "true");
            },
            success: function(response) {
                if (response.success) {
                    tabla.api().ajax.reload(function(){
                    });
                } else {
                    bootbox.alert(response.message);
                }
                $("#add").html("Guardar").removeAttr("disabled");
            },
            error: function(err) {
                bootbox.alert('Se produjo un error al procesar la información.');
                $("#add").html("Guardar").removeAttr("disabled");
            }
        });
        
    });
});

jQuery.extend({
    handleError: function(s, xhr, status, e) {
    },
    httpData: function(J, H) {
        return J.responseText;
    }
});
