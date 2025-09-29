<?php echo $this->extend('admin/includes/_layout_view') ?>
 
<?php echo $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php echo $title; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <?php if ($title === 'Dashboard') : ?>
                            <li class="breadcrumb-item active"><a href="<?php echo admin_url() ?>">/</a></li>
                        <?php else :  ?>
                            <li class="breadcrumb-item"><a href="<?php echo admin_url() ?>"><?php echo trans('dashboard') ?></a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo trans('settings') ?></a></li>
                            <li class="breadcrumb-item active"><?php echo $title ?></li>
                        <?php endif  ?>

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
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            Carousel Details
                        </div>
                        <div class="card-body">
                            <div class="float-left">
                                <h2><?php echo $carousel['name'] ?></h2>
                                <p><?php echo $carousel['description']; ?></p>
                            </div>
                            <div class="float-right d-none d-md-block mb-4">
                                <a href="<?php echo base_url('admin/carousel/add_slide/'.$carousel['id']); ?>" class="btn btn-primary rounded btn-custom btn-block waves-effect waves-light">Add Slides</a>
                            </div>
                            <div class="table-responsive">
                                <table class="cs_datatable table table-bordered table-striped cell-border" >
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 150px;">Image</th>
                                            <th style="width: 250px;">Title</th>
                                            <th>Description</th>
                                            <th class="text-center" style="width: 50px;">Order</th>
                                            <th class="text-center" style="width: 100px;">Status</th>
                                            <th class="text-center" style="width: 150px;">Actions</th>
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
        DataTableListing.ajaxURL = '<?php echo base_url($uri->getSegment(1) . '/' . $uri->getSegment(2) . '/table-listing-details/' . $carousel['id']); ?>';
        DataTableListing.options.pageLength = 7;
        DataTableListing.options.columns = [
            { "data": "image" },
            { "data": "title" },
            { "data": "description" },
            { "data": "slide_order" },
            { "data": "status" },
            { "data": "action" },
        ];
        DataTableListing.options.aoColumnDefs = [
            { "aTargets": [ 0 ], "bSortable": false },
            { "aTargets": [ 1 ], "bSortable": false },
            { "aTargets": [ 2 ], "bSortable": false },
            { "aTargets": [ 4 ], "bSortable": false },
            { "aTargets": [ 5 ], "bSortable": false },
        ];
        DataTableListing.init();
    });
</script>
<?php echo $this->endSection() ?>