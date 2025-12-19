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

                    <form id="form_safe" action="<?php echo base_url('admin/careers/update/' . $career['id']); ?>" method="post">
                        <?php echo csrf_field() ?>
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                            </div>
                            <div class="card-body">
                                <input type="hidden" id="id" name="id" class="form-control form-input" value="<?php echo $career['id']; ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Job Title</label>
                                            <input type="text" value="<?php echo $career['job_title']; ?>" name="job_title" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Job Description</label>
                                            <textarea name="job_description" class="form-control" rows="3"><?php echo $career['job_description']; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Job Type</label>
                                            <select name="job_type" id="job_type" class="form-control selectpicker">
                                                <?php foreach($job_types as $job_type_id => $job_type){ ?>
                                                    <option value="<?php echo $job_type_id; ?>" <?php echo ($job_type_id == $career['job_type'] ? 'selected' : '');?>><?php echo $job_type; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">&nbsp;</label>
                                            <select name="job_location" id="job_location" class="form-control selectpicker">
                                                <?php foreach($job_locations as $job_location_id => $job_location){ ?>
                                                    <option value="<?php echo $job_location_id; ?>" <?php echo ($job_location_id == $career['job_location'] ? 'selected' : '');?>><?php echo $job_location; ?></option>
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
                                                    <option value="<?php echo $office['id']; ?>" <?php echo ($office['id'] == $career['office_id'] ? 'selected' : '');?>><?php echo $office['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Job Link</label>
                                            <input type="text" value="<?php echo $career['link']; ?>" name="link" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="<?php echo ACTIVE_STATUS; ?>" <?php echo ($career['status'] == ACTIVE_STATUS ? 'selected' : ''); ?>>Active</option>
                                                <option value="<?php echo INACTIVE_STATUS; ?>" <?php echo ($career['status'] == INACTIVE_STATUS ? 'selected' : ''); ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-body">
                                <div class="text-">
                                    <input type="submit" class="btn btn-primary" value="Save Career">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<?php echo $this->endSection() ?>