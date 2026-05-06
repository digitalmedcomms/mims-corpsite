<?php echo $this->extend('admin/includes/_layout_view') ?>
 
<?php echo $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php echo $title ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo admin_url() ?>"><?php echo trans('dashboard') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo $title ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="cs_datatable table table-bordered table-striped cell-border" >
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">ID</th>
                                            <th style="width: 150px;">IP Address</th>
                                            <th style="width: 250px;">URL</th>
                                            <th style="width: 250px;">Referrer</th>
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
    <!-- /.content -->
</div>
<?php 
$request = \Config\Services::request();
$uri = $request->uri;
?>
<script type="text/javascript">
    jQuery(document).ready(function(){
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
        DataTableListing.init();
    });
</script>
<?php echo $this->endSection() ?>
