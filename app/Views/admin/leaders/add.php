<?php echo $this->extend('admin/includes/_layout_view') ?>
<?php echo $this->section('content') ?>
<style>
    #countries-field, #area-of-practice-field{
        display: none;
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
                <div class="col-lg-12 col-xl-12">
                    
                    <?php echo $this->include('admin/includes/_messages') ?>
                    <form id="form_safe" action="<?php echo base_url('admin/leaders/insert'); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field() ?>
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <img data-toggle="modal" data-target="#file_manager_image" data-bs-field="#image_path" data-bs-image-type="input" data-bs-item-id="#leaderimg" data-bs-input-id="#image_id" id="leaderimg" src="<?php echo base_url('assets/admin/img/user.png'); ?>" alt="" class="img-fluid img-thumbnail" style="max-width: 80%;">
                                        <input type="hidden" name="image_id" id="selected_img_file_id">
                                        <input type="hidden" name="image_path" id="image_path">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="">Leader Type</label>
                                                    <select name="leader_type_id" id="leader_type_id" class="form-control">
                                                        <option value="">Select leader type</option>
                                                        <?php foreach($leaderTypes as $leaderType){ ?>
                                                            <option value="<?php echo $leaderType['id']; ?>"><?php echo $leaderType['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="countries-field">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Countries</label>
                                                    <select name="countries" id="" class="selectpicker form-control" multiple title="Choose country">
                                                        <?php foreach($countries as $country){ ?>
                                                            <option title="<?php echo $country['code']; ?>" value="<?php echo $country['code'];?>"><?php echo $country['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="area-of-practice-field">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Area of Practice</label>
                                                    <select name="practice" id="" class="selectpicker form-control" title="Choose area of practice">
                                                        <?php foreach($practices as $practice){ ?>
                                                            <option  value="<?php echo $practice['id'];?>"><?php echo $practice['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="">Leader Name</label>
                                                    <input type="text" value="" name="name" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Designation</label>
                                                    <textarea name="designation" class="form-control" rows="4"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Bio</label>
                                                    <textarea name="biography" id="biography"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Order</label>
                                                    <input type="number" name="order" id="order" min="1" steps="1" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="<?php echo ACTIVE_STATUS; ?>">Active</option>
                                                        <option value="<?php echo INACTIVE_STATUS; ?>" >Inactive</option>
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
                                    <input type="submit" class="btn btn-primary" value="Save Leader Types">
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
<script src="<?php echo base_url('assets/admin/plugins/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#leader_type_id").change(function(){
            if($(this).val() == 2){
                $("#countries-field").show();
                $("#area-of-practice-field").hide();
            }else if($(this).val() == 3){
                $("#countries-field").hide();
                $("#area-of-practice-field").show();
            }else{
                $("#countries-field").hide();
                $("#area-of-practice-field").hide();
            }
        });
        CKEDITOR.replace( 'biography', {
            height: 500,
            toolbar: [
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
                { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                { name: 'styles', items: [ 'Styles', 'Format' ] },
                // { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] }
            ],
            // placeholder_select: {
                // placeholders: ['member_name', 'alias', 'date_joined', 'email', 'contact_number'],
                // format: '{{%placeholder%}}'
            // },
            // extraPlugins: 'placeholder_select'
        } );
    });
</script>
<?php echo $this->endSection() ?>