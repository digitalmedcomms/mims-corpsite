$.fn.enterKey = function (fnc) {
    return this.each(function () {
        $(this).keypress(function (ev) {
            var keycode = (ev.keyCode ? ev.keyCode : ev.which);
            if (keycode == '13') {
                fnc.call(this, ev);
            }
        })
    })
}

var DataTableListing = {
    selector: '.cs_datatable',
    dataTable:{},
    params: {},
    options: {
        retrieve: true,
        "pageLength": 30,
        "searching": false,
        "lengthChange": false,
        conditionalPaging: true,
        "serverSide": true,
        // "ordering": true,
        "order": [],
        "drawCallback": function(settings) {
    
            if($('table#datatable td').hasClass('dataTables_empty')){
                $('#datatable_paginate').hide();
            }else{
                $('#datatable_paginate').show();
            }
            $("#datatable_overlay").hide();
    
        },
        "preDrawCallback": function(settings){
            $("#datatable_overlay").show();
        },
        "fnRowCallback": function ( nRow, aData, iDisplayIndex ) {
            // nRow.setAttribute('data-link', aData['link']);

            $.each($(nRow).find('td'), function(i, elem){
                if(typeof DataTableListing.options.columns[i].width != 'undefined'){
                    $(elem).css('width', DataTableListing.options.columns[i].width);
                }
            });
            return nRow;
        }
    },
    ajaxURL: '',
    
    init: function(){
        
        if(DataTableListing.ajaxURL != ''){

            DataTableListing.options['ajax'] = $.fn.dataTable.pipeline( {
                "url": DataTableListing.ajaxURL,
                'pages': 10,
                "method": "POST",
                "headers": {
                    'X-CSRF-TOKEN': $.cookie(csrfCookie)
                },
                "data": function(d){
                    if($("#table-filter-search").find(":selected").length > 0){
                        d['col_search'] = $("#table-filter-search").find(":selected").val();
                        d['col_value'] = $("#table-filter-value").val();
                    }else{
                        d['col_search'] = '';
                        d['col_value'] = '';
                    }
                    d['csrf_token'] = $.cookie(csrfCookie);
                }
            } );
        }
        // console.info(DataTableListing.params);
        
        DataTableListing.dataTable = $(DataTableListing.selector).DataTable(DataTableListing.options);
        $('.dataTables_length').addClass('bs-select');

        $(document).on("keydown", "#table-filter-value", function(event) {
            if(event.which == 13){
                $("#table-search").trigger('click');
            }
        });

        $("#table-search").click(function(){
            if( typeof $("#table-filter-search").find(":selected").val() != 'undefined' && $("#table-filter-search").find(":selected").val() != '' && $("#table-filter-value").val() != ''){
                DataTableListing.dataTable.clearPipeline();
                DataTableListing.dataTable.ajax.reload();
            }

        });

    },




}