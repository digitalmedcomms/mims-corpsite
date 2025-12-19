<?php echo $this->extend('admin/includes/_layout_view') ?>
 
<?php echo $this->section('content') ?>
<style>
    .bootstrap-select .dropdown-menu{
        max-height: 420px !important;
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
                <div class="col-lg-4 col-xl-4">
                     <form id="form_safe" action="<?php echo base_url('admin/careers/insert/'); ?>" method="post">
                        <?php echo csrf_field() ?>
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header">
                                Add Career
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Job Title</label>
                                            <input type="text" value="" name="job_title" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Job Description</label>
                                            <textarea name="job_description" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Job Type</label>
                                            <select name="job_type" id="job_type" class="form-control selectpicker">
                                                <?php foreach($job_types as $job_type_id => $job_type){ ?>
                                                    <option value="<?php echo $job_type_id; ?>"><?php echo $job_type; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">&nbsp;</label>
                                            <select name="job_location" id="job_location" class="form-control selectpicker">
                                                <?php foreach($job_locations as $job_location_id => $job_location){ ?>
                                                    <option value="<?php echo $job_location_id; ?>"><?php echo $job_location; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Office</label>
                                            <select name="office_id" id="" class="form-control selectpicker" data-title="Select location.." data-live-search="true">
                                                <?php foreach($offices as $office){ ?>
                                                    <option value="<?php echo $office['id']; ?>"><?php echo $office['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Job Link</label>
                                            <input type="text" value="" name="link" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select name="status" id="status" class="form-control selectpicker">
                                                <option value="<?php echo ACTIVE_STATUS; ?>">Active</option>
                                                <option value="<?php echo INACTIVE_STATUS; ?>">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-body">
                                <div class="text-right">
                                    <input type="submit" class="btn btn-primary" value="Add Career">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-8 col-xl-8">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header">
                            Careers
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="cs_datatable table table-bordered table-striped cell-border" >
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="text-center" style="width: 120px;">Status</th>
                                            <th class="text-center" style="width: 120px;">Actions</th>
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
        DataTableListing.options.pageLength = 7;
        DataTableListing.options.columns = [
            { "data": "job_title" },
            { "data": "status" },
            { "data": "action" },
        ];
        DataTableListing.options.aoColumnDefs = [
            { "aTargets": [ 1 ], "bSortable": false },
            { "aTargets": [ 2 ], "bSortable": false },
        ];
        DataTableListing.init();
    });
</script>
<?php echo $this->endSection() ?>