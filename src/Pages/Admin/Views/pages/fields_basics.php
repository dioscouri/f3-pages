<div class="row">
    <div class="col-md-2">
    
        <h3>Details</h3>
        <p class="help-block">Some helpful text</p>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">

        <div class="form-group">
            <input type="text" name="title" placeholder="Title" value="<?php echo $flash->old('title'); ?>" class="form-control" />
            <?php if ($flash->old('slug')) { ?>
                <p class="help-block">
                <label>Slug:</label>
                <input type="text" name="slug" value="<?php echo $flash->old('slug'); ?>" class="form-control" />
                </p>
            <?php } ?>
        </div>
        <!-- /.form-group -->
        
        <div class="form-group">
            <textarea name="copy" class="form-control wysiwyg"><?php echo $flash->old('copy'); ?></textarea>
        </div>
        <!-- /.form-group -->
    
    </div>
    <!-- /.col-md-10 -->
</div>
<!-- /.row -->

<hr />

<?php echo $this->renderLayout('Pages/Admin/Views::pages/fields_basics_publication.php'); ?>

<hr />

<?php echo $this->renderLayout('Pages/Admin/Views::pages/fields_basics_categories.php'); ?>

<hr />

<?php echo $this->renderLayout('Pages/Admin/Views::pages/fields_basics_tags.php'); ?>

<hr />

<?php echo $this->renderLayout('Pages/Admin/Views::pages/fields_basics_featuredimage.php'); ?>