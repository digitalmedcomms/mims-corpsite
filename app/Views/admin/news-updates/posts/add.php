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
            <form id="form_safe" action="<?php echo base_url('admin/news-updates/posts/insert/'); ?>" method="post">
                <?php echo $this->include('admin/includes/_messages') ?>
                <div class="row">
                    <div class="col-md-8 col-lg-8 col-xl-8">
                        <?php echo csrf_field() ?>
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">Title</label>
                                            <textarea name="title" id="title" rows="3" class="form-control"><?php echo set_value('title'); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">Slug</label>
                                            <div id="postSlug"></div>
                                            <input type="hidden" name="slug" id="slug">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="short_description" id="short_description" rows="3" class="form-control"><?php echo set_value('short_description'); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Content</label>
                                            <textarea name="content" id="content" class="form-control" ><?php echo set_value('content'); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Post Date</label>
                                            <input type="text" name="post_date" id="post_date" class="form-control datepicker" value="<?php echo set_value('post_date', date("m/d/Y")); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select name="status" id="status" class="form-control selectpicker" data-title="Select post status">
                                                <option value="20">Draft</option>
                                                <option value="10">Published</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Featured Image</label>
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <img data-toggle="modal" data-target="#file_manager_image" data-bs-field="#image_path" data-bs-image-type="input" data-bs-item-id="#featuredImg" data-bs-input-id="#image_id" id="featuredImg" src="<?php echo base_url('assets/admin/img/default-image.png'); ?>" alt="" class="img-fluid img-thumbnail" style="max-width: 100%;border: none; padding: 0;">
                                                    <input type="hidden" name="image_id" id="selected_img_file_id">
                                                    <input type="hidden" name="image_path" id="image_path">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label for="">Category</label>
                                            <select name="category_id" id="category_id" class="form-control selectpicker" data-title="Select post category">
                                                <?php 
                                                foreach($categories as $category){
                                                    echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-body">
                                <div class="text-right">
                                    <input type="submit" class="btn btn-primary" value="Save Post">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>

<script src="<?php echo base_url('assets/admin/plugins/tinymce/tinymce.min.js'); ?>" type="text/javascript"></script>


<script type="text/javascript">
    $(document).ready(function(){

        <?php if(set_value('title')){ ?>
            var title = '<?php echo set_value('title'); ?>';
            $("#postSlug").text(slugify(title));
            $("#slug").val(slugify(title));
        <?php } ?>
        $("#title").change(function(){
            var title = $(this).val();

            $("#postSlug").text(slugify(title));
            $("#slug").val(slugify(title));
        });

        tinymce.init({
            selector: '#content',
            plugins: 'media code lists',
            height: 600,
            promotion: false,
            license_key: 'gpl', // gpl for open source, T8LK:... for commercial
            plugins: 'searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | removeformat | pagebreak | charmap emoticons | media template link anchor | ltr rtl',
            file_picker_types: 'image',
            quickbars_insert_toolbar: '',
            content_style: 'img { max-width: 100%; height: auto; }',
            file_picker_callback: (callback, value, meta) => {
                $("#file_manager_image").modal('show');
            },
             style_formats: [
                { title: 'Image Left', selector: 'img', styles: { 'float': 'left', 'margin': '0 10px 10px 0' } },
                { title: 'Image Right', selector: 'img', styles: { 'float': 'right', 'margin': '0 0 10px 10px' } },
                { title: 'Blocks', items: [
                    { title: 'Paragraph', block: 'p' },
                    { title: 'Div', block: 'div' }, // Add this line
                    { title: 'Blockquote', block: 'blockquote' }
                ]}
            ],
            relative_urls : false,
            remove_script_host : false,
            convert_urls : true,
        });

    });

</script>

<?php echo $this->endSection() ?>

