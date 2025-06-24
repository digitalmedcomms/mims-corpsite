<!-- Modal -->
<div id="modal-category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-modalLabel"><?php echo trans('add'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_safe" action="" method="post">
                <?php echo csrf_field() ?>
                <input type="hidden" id="modal_id" name="id" class="form-control form-input">

                <div class="modal-body">
                    <div class="form-group">
                        <label><?php echo trans('menu_category') ?><span class="required"> *</span></label>
                        <input type="text" id="modal_name" name="menu_category" class="form-control form-input" placeholder="<?php echo trans("name"); ?>" required>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label><?php echo trans('menu_order') ?></label>
                    <input type="number" class="form-control" id="menu_category_order" name="menu_category_order" placeholder="1" value="<?php echo old('menu_order'); ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><?php echo trans('save'); ?></button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->