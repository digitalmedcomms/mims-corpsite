<?php echo $this->extend('admin/includes/_layout_view') ?>

<?php echo $this->section('content') ?>
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
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
                            <li class="breadcrumb-item active"><?php echo $title ?></li>
                        <?php endif  ?>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php echo view('admin/includes/_messages'); ?>
            <!-- Main row -->
            <?php echo form_open_multipart('admin/forms/update/' . $form['id'], ['id' => 'form_edit_form']); ?>
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-body">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Fields</button>
                                    <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Form Confirmation</button>
                                    <button class="nav-link" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Email Notification</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" style="padding: 50px;"  id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Form Name</label>
                                                <input type="text" name="form_name" class="form-control" required placeholder="Enter form name" value="<?php echo htmlspecialchars($form['name']); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="form_status" class="form-control">
                                                    <option value="1" <?php echo ($form['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                                                    <option value="0" <?php echo ($form['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Form Description</label>
                                                <textarea name="form_description" class="form-control" placeholder="Enter form description"><?php echo htmlspecialchars($form['description']); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Form Fields</label>
                                                <div id="fb-editor"></div>
                                                <input type="hidden" name="fields" id="form_fields_json" value='<?php echo $form['fields']; ?>'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" style="padding: 50px;"  id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch mb-3">
                                                    <input type="checkbox" name="enable_confirmation" class="custom-control-input toggle-section" id="enable_confirmation" <?php echo ($form['enable_confirmation'] == 1) ? 'checked' : ''; ?>>
                                                    <label class="custom-control-label" for="enable_confirmation">Enable Confirmation Message</label>
                                                </div>
                                            </div>
                                            <div id="section-confirmation" style="<?php echo ($form['enable_confirmation'] == 1) ? '' : 'display:none;'; ?>">
                                                <div class="form-group">
                                                    <label for="">Confirmation Message</label>
                                                    <textarea name="confirmation_message" id="confirmation"><?php echo $form['confirmation_message']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" style="padding: 50px;" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch mb-3">
                                                    <input type="checkbox" name="enable_notification" class="custom-control-input toggle-section" id="enable_notification" <?php echo ($form['enable_notification'] == 1) ? 'checked' : ''; ?>>
                                                    <label class="custom-control-label" for="enable_notification">Enable Email Notification</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="section-notification" style="<?php echo ($form['enable_notification'] == 1) ? '' : 'display:none;'; ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Send to Email Address</label>
                                                    <input type="text" name="notification_email" class="form-control" value="<?php echo htmlspecialchars($form['notification_email']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">CC</label>
                                                    <input type="text" name="notification_cc" class="form-control" value="<?php echo htmlspecialchars($form['notification_cc']); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">From Name</label>
                                                    <input type="text" name="notification_from_name" class="form-control" value="<?php echo htmlspecialchars($form['notification_from_name']); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">From Email</label>
                                                    <input type="text" name="notification_from_email" class="form-control" value="<?php echo htmlspecialchars($form['notification_from_email']); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Email Subject Line</label>
                                                    <input type="text" name="notification_subject" class="form-control" value="<?php echo htmlspecialchars($form['notification_subject']); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="">Email Message</label>
                                                    <textarea name="notification_message" id="notification"><?php echo $form['notification_message']; ?></textarea>
                                                </div>
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
                                <input type="submit" class="btn btn-primary" id="btn-save-form" value="Update Form">
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </section>
</div>

<script src="<?php echo base_url('assets/admin/plugins/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var formData = $('#form_fields_json').val();
        var fbEditor = $('#fb-editor').formBuilder({
            disabledActionButtons: ['data', 'clear', 'save'],
            formData: formData
        });

        $('#btn-save-form').on('click', function(e){
            var formData = fbEditor.actions.getData('json');
            $('#form_fields_json').val(formData);
        });

        $('.toggle-section').on('change', function() {
            var target = $(this).attr('id');
            if ($(this).is(':checked')) {
                $('#section-' + target.replace('enable_', '')).slideDown();
            } else {
                $('#section-' + target.replace('enable_', '')).slideUp();
            }
        });

        CKEDITOR.replace( 'confirmation', {
            height: 500,
            toolbar: [
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
                { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                { name: 'styles', items: [ 'Styles', 'Format' ] },
            ]
        });

        CKEDITOR.replace( 'notification', {
            height: 500,
            toolbar: [
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
                { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                { name: 'styles', items: [ 'Styles', 'Format' ] },
            ]
        });

    });
  </script>


<?php echo $this->endSection() ?>
