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
                    <form id="form_safe" action="<?php echo base_url('admin/carousel/insert_slide/'.$carousel['id']); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field() ?>
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Slide Image</label>
                                            <div>
                                                <img data-toggle="modal" data-target="#file_manager_image" data-bs-field="#image_path" data-bs-image-type="input" data-bs-item-id="#leaderimg" data-bs-input-id="#image_id" id="leaderimg" src="<?php echo set_value('image_path') ? base_url(set_value('image_path')): base_url('assets/admin/img/default-image.png') ; ?>" alt="" class="img-fluid img-thumbnail" style="max-width: 100%;">
                                                <input type="hidden" name="image_id" id="selected_img_file_id" value="<?php echo set_value('image_id'); ?>">
                                                <input type="hidden" name="image_path" id="image_path" value="<?php echo set_value('image_path'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="">Title</label>
                                                    <textarea name="title" id="title" class="form-control" rows="2"><?php echo set_value('title'); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Slide Order</label>
                                                    <input type="number" name="order" id="order" min="1" steps="1" class="form-control" value="<?php echo set_value('order'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Description</label>
                                                    <textarea name="description" id="description"><?php echo set_value('description'); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="with_button" id="with_button" value="1" class="form-check-input" <?php echo set_value('with_button') ? 'checked': ''; ?>>
                                                        <label for="with_button" class="">With Button</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Button Label</label>
                                                    <input type="text" name="button_label" id="button_label" class="form-control" value="<?php echo set_value('button_label'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="">Button Link</label>
                                                    <input type="text" name="button_link" id="button_link" class="form-control" value="<?php echo set_value('button_link'); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="<?php echo ACTIVE_STATUS; ?>" <?php echo set_value('status') == ACTIVE_STATUS ? 'selected' : ''; ?>>Active</option>
                                                        <option value="<?php echo INACTIVE_STATUS; ?>" <?php echo set_value('status') == INACTIVE_STATUS ? 'selected' : ''; ?>>Inactive</option>
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
                                    <input type="submit" class="btn btn-primary" value="Save Carousel Slide">
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
        CKEDITOR.replace( 'description', {
            height: 300,
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