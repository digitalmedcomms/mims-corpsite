<?php echo $this->extend('admin/includes/_layout_view') ?>
 
<?php echo $this->section('content') ?>
<style>
    .bg-primary-gradient {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
    }
    .bg-success-gradient {
        background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
        color: white;
    }
    .bg-warning-gradient {
        background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);
        color: white;
    }
    .bg-danger-gradient {
        background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);
        color: white;
    }
    .metric-card {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        border-radius: 12px !important;
        overflow: hidden;
        border: none !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }
    .metric-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }
    .metric-card .info-box-icon {
        background-color: rgba(255, 255, 255, 0.2) !important;
        border-radius: 10px !important;
        margin: auto 15px;
        width: 50px;
        height: 50px;
        min-width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .metric-card .info-box-content {
        padding: 12px 15px 12px 0;
    }
    .filter-card-custom {
        border-radius: 12px !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03) !important;
        border: 1px solid rgba(0,0,0,0.08) !important;
        margin-bottom: 20px;
    }
    .filter-card-custom .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid rgba(0,0,0,0.08);
    }
    .table-card-custom {
        border-radius: 12px !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03) !important;
        border: 1px solid rgba(0,0,0,0.08) !important;
    }
    .table-card-custom .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid rgba(0,0,0,0.08);
    }
    .btn-custom {
        border-radius: 8px !important;
        padding: 6px 16px;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }
    .btn-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php echo $title ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-sm-right d-flex align-items-center">
                        <a href="<?php echo base_url('admin/page-visits'); ?>" class="btn btn-sm btn-outline-primary btn-custom mr-3"><i class="fas fa-arrow-left mr-1"></i> Back to Dashboard</a>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo admin_url() ?>"><?php echo trans('dashboard') ?></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/page-visits') ?>">Page Visits</a></li>
                            <li class="breadcrumb-item active">Logs</li>
                        </ol>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <!-- Metrics row (Optional summary info on logs page too) -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="info-box metric-card bg-primary-gradient">
                        <span class="info-box-icon"><i class="fas fa-eye text-white"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text text-uppercase text-xs font-weight-bold">Total Visits</span>
                            <span class="info-box-number h3 mb-0" id="stat-total-visits"><?php echo number_format($stats_total); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="info-box metric-card bg-success-gradient">
                        <span class="info-box-icon"><i class="fas fa-users text-white"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text text-uppercase text-xs font-weight-bold">Unique Visitors</span>
                            <span class="info-box-number h3 mb-0" id="stat-unique-visitors"><?php echo number_format($stats_unique); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="info-box metric-card bg-warning-gradient">
                        <span class="info-box-icon"><i class="fas fa-calendar-day text-white"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text text-uppercase text-xs font-weight-bold">Visits Today</span>
                            <span class="info-box-number h3 mb-0" id="stat-visits-today"><?php echo number_format($stats_today); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="info-box metric-card bg-danger-gradient">
                        <span class="info-box-icon"><i class="fas fa-file-alt text-white"></i></span>
                        <div class="info-box-content" style="max-width: 100%; overflow: hidden;">
                            <span class="info-box-text text-uppercase text-xs font-weight-bold">Top Visited Page</span>
                            <span class="info-box-number text-truncate d-block" style="font-size: 1.1rem; line-height: 1.2; font-weight: 700;" id="stat-top-page" title="<?php echo esc($stats_top_page); ?>"><?php echo esc($stats_top_page); ?></span>
                            <small class="text-white-50"><span id="stat-top-page-count"><?php echo number_format($stats_top_count); ?></span> visits</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters Card -->
            <div class="card filter-card-custom">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold text-dark"><i class="fas fa-filter text-primary mr-1"></i> Search Filters</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="visit-filter-form">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label class="text-xs font-weight-bold text-muted">IP Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-network-wired text-muted"></i></span>
                                        </div>
                                        <input type="text" name="filter_ip" id="filter_ip" class="form-control form-control-sm" placeholder="e.g. 192.168.1.1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label class="text-xs font-weight-bold text-muted">URL Route</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-link text-muted"></i></span>
                                        </div>
                                        <input type="text" name="filter_url" id="filter_url" class="form-control form-control-sm" placeholder="e.g. /news-updates">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label class="text-xs font-weight-bold text-muted">Start Date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt text-muted"></i></span>
                                        </div>
                                        <input type="text" name="filter_start_date" id="filter_start_date" class="form-control form-control-sm datepicker" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label class="text-xs font-weight-bold text-muted">End Date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt text-muted"></i></span>
                                        </div>
                                        <input type="text" name="filter_end_date" id="filter_end_date" class="form-control form-control-sm datepicker" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12 text-right">
                                <button type="button" id="btn-reset-filters" class="btn btn-sm btn-secondary btn-custom mr-2"><i class="fas fa-undo mr-1"></i> Reset</button>
                                <button type="button" id="btn-apply-filters" class="btn btn-sm btn-primary btn-custom"><i class="fas fa-search mr-1"></i> Apply Filters</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Table Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card table-card-custom">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h3 class="card-title font-weight-bold text-dark mb-0"><i class="fas fa-list text-primary mr-1"></i> Page Visit Logs</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="cs_datatable table table-bordered table-striped cell-border" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">ID</th>
                                            <th style="width: 150px;">IP Address</th>
                                            <th style="width: 250px;">URL</th>
                                            <th style="width: 200px;">Referrer</th>
                                            <th>User Agent</th>
                                            <th style="width: 150px;">Date</th>
                                            <th class="text-center" style="width: 100px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php 
$request = \Config\Services::request();
$uri = $request->uri;
?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        // Set AJAX URL endpoint (pointing to table-listing route)
        DataTableListing.ajaxURL = '<?php echo base_url($uri->getSegment(1) . '/' . $uri->getSegment(2) . '/table-listing'); ?>';
        DataTableListing.options.pageLength = 25;
        DataTableListing.options.columns = [
            { "data": "id" },
            { "data": "ip_address" },
            { "data": "url" },
            { "data": "referrer" },
            { "data": "user_agent" },
            { "data": "created_at" },
            { "data": "action" },
        ];
        DataTableListing.options.aoColumnDefs = [
            { "aTargets": [ 0 ], "bSortable": true },
            { "aTargets": [ 1 ], "bSortable": true },
            { "aTargets": [ 2 ], "bSortable": true },
            { "aTargets": [ 3 ], "bSortable": true },
            { "aTargets": [ 4 ], "bSortable": false },
            { "aTargets": [ 5 ], "bSortable": true },
            { "aTargets": [ 6 ], "bSortable": false },
        ];

        // Override default DataTableListing drawCallback to support updating stats cards
        DataTableListing.options.drawCallback = function(settings) {
            // Default datatable behavior
            if (jQuery('table#datatable td').hasClass('dataTables_empty')){
                jQuery('#datatable_paginate').hide();
            } else {
                jQuery('#datatable_paginate').show();
            }
            jQuery("#datatable_overlay").hide();

            // Dynamic Stats Updating
            var api = this.api();
            var json = api.ajax.json();
            if (json && json.stats) {
                jQuery('#stat-total-visits').text(json.stats.total);
                jQuery('#stat-unique-visitors').text(json.stats.unique);
                jQuery('#stat-visits-today').text(json.stats.today);
                jQuery('#stat-top-page').text(json.stats.top_page).attr('title', json.stats.top_page);
                jQuery('#stat-top-page-count').text(json.stats.top_page_count);
            }
        };

        // Override custom DataTableListing init to pass filter values in AJAX request
        DataTableListing.init = function() {
            if (DataTableListing.ajaxURL != '') {
                DataTableListing.options['ajax'] = jQuery.fn.dataTable.pipeline({
                    "url": DataTableListing.ajaxURL,
                    'pages': 5, // Use 5 pages buffer for speed
                    "method": "POST",
                    "headers": {
                        'X-CSRF-TOKEN': jQuery.cookie(csrfCookie)
                    },
                    "data": function(d){
                        d['csrf_token'] = jQuery.cookie(csrfCookie);
                        d['filter_ip'] = jQuery('#filter_ip').val();
                        d['filter_url'] = jQuery('#filter_url').val();
                        d['filter_start_date'] = jQuery('#filter_start_date').val();
                        d['filter_end_date'] = jQuery('#filter_end_date').val();
                    }
                });
            }
            
            DataTableListing.dataTable = jQuery(DataTableListing.selector).DataTable(DataTableListing.options);
            jQuery('.dataTables_length').addClass('bs-select');
        };

        // Initialize DataTableListing
        DataTableListing.init();

        // Apply filters button click handler
        jQuery('#btn-apply-filters').click(function(){
            DataTableListing.dataTable.clearPipeline();
            DataTableListing.dataTable.ajax.reload();
        });

        // Reset filters button click handler
        jQuery('#btn-reset-filters').click(function(){
            jQuery('#visit-filter-form')[0].reset();
            DataTableListing.dataTable.clearPipeline();
            DataTableListing.dataTable.ajax.reload();
        });

        // Add keypress handler for enter key on filter inputs
        jQuery('#visit-filter-form input').keypress(function(e) {
            if (e.which == 13) {
                e.preventDefault();
                jQuery('#btn-apply-filters').trigger('click');
            }
        });
    });
</script>
<?php echo $this->endSection() ?>
