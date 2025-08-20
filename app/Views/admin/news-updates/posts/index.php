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
                            Posts
                        </div>
                        <div class="card-body">
                            <div class="text-right mb-3">
                                <a href="<?php echo base_url('admin/news-updates/posts/add'); ?>" class="btn btn-primary">Add Post</a>
                            </div>
                            <div class="table-responsive">
                                <table class="cs_datatable table table-bordered table-striped cell-border" >
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th style="width: 180px;">Post Date</th>
                                            <th style="width: 150px;">Category</th>
                                            <th class="text-center" style="width: 8%;">Status</th>
                                            <th class="text-center" style="width: 8%;">Actions</th>
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
        DataTableListing.ajaxURL = '<?php echo base_url($uri->getSegment(1) . '/' . $uri->getSegment(2) . '/posts/table-listing'); ?>';
        DataTableListing.options.pageLength = 20;
        DataTableListing.options.columns = [
            { "data": "title" },
            { "data": "date" },
            { "data": "category_name" },
            { "data": "status" },
            { "data": "action" },
        ];
        DataTableListing.options.aoColumnDefs = [
            { "aTargets": [ 2 ], "bSortable": false },
            { "aTargets": [ 3 ], "bSortable": false },
            { "aTargets": [ 4 ], "bSortable": false },
        ];
        DataTableListing.init();
    });
</script>
<?php echo $this->endSection() ?>