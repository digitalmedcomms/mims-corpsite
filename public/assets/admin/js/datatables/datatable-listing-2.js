var DataTableListing2 = {
    selector: '.datatable',
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
                if(typeof DataTableListing2.options.columns[i].width != 'undefined'){
                    $(elem).css('width', DataTableListing2.options.columns[i].width);
                }
            });
            return nRow;
        }
    },
    ajaxURL: '',
    
    init: function(){
        
        if(DataTableListing2.ajaxURL != ''){

            DataTableListing2.options['ajax'] = $.fn.dataTable.pipeline( {
                "url": DataTableListing2.ajaxURL,
                'pages': 10,
                "method": "POST",
                // "headers": {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                "data": function(d){
                    if($("#table-filter-search").find(":selected").length > 0){
                        d['col_search'] = $("#table-filter-search").find(":selected").val();
                        d['col_value'] = $("#table-filter-value").val();
                    }else{
                        d['col_search'] = '';
                        d['col_value'] = '';
                    }
                }
            } );
        }
        // console.info(DataTableListing2.params);
        
        DataTableListing2.dataTable = $(DataTableListing2.selector).DataTable(DataTableListing2.options);
        $('.dataTables_length').addClass('bs-select');

        $("#table-search").click(function(){
            if( typeof $("#table-filter-search").find(":selected").val() != 'undefined' && $("#table-filter-search").find(":selected").val() != '' && $("#table-filter-value").val() != ''){
                DataTableListing2.dataTable.clearPipeline();
                DataTableListing2.dataTable.ajax.reload();
            }

        });
    },




}