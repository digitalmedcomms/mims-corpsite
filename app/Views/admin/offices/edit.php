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
                    
                    <?php echo $this->include('admin/includes/_messages') ?>
                    <form id="form_safe" action="<?php echo base_url('admin/offices/update/'.$office['id']); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field() ?>
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Countries</label>
                                                    <select name="country_id" id="" class="selectpicker form-control" title="Choose country">
                                                        <?php foreach($countries as $country){ ?>
                                                            <option value="<?php echo $country['id'];?>" <?php echo ($country['id'] == $office['country_id'] ? 'selected' : ''); ?>><?php echo $country['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input type="text" value="<?php echo $office['name']; ?>" name="name" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Address</label>
                                                    <textarea name="address" class="form-control" rows="4"><?php echo $office['address']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" name="email" class="form-control" value="<?php echo $office['email']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Contact Number</label>
                                                    <input type="text" name="contact_number" class="form-control" value="<?php echo $office['contact_number']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="<?php echo ACTIVE_STATUS; ?>" <?php echo $office['status'] == ACTIVE_STATUS ? 'selected' : ''; ?>>Active</option>
                                                        <option value="<?php echo INACTIVE_STATUS; ?>" <?php echo $office['status'] == INACTIVE_STATUS ? 'selected' : ''; ?>>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-body">
                                <div class="text-">
                                    <input type="submit" class="btn btn-primary" value="Save Office">
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