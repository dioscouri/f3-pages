<div class="row">
    <div class="col-md-2">
    
        <h3>Options</h3>
        <p class="help-block">Define how the item should appear.</p>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">

        <div class="form-group">
            <label>Hide the Title?</label>
            <select name="display[title_disabled]" class="form-control">
                <option value="0" <?php if (!$flash->old('display.title_disabled')) { echo "selected"; } ?>>No</option>
                <option value="1" <?php if ($flash->old('display.title_disabled')) { echo "selected"; } ?>>Yes, hide it</option>
            </select>
        </div>
        <!-- /.form-group -->
        
        <div class="form-group">
            <label>Where to put the Featured Image?</label>
            <select name="display[image_position]" class="form-control">
                <option value="banner" <?php if ($flash->old('display.image_position') == 'banner') { echo "selected"; } ?>>A banner, above the page</option>
                <option value="top" <?php if ($flash->old('display.image_position') == 'top') { echo "selected"; } ?>>Within the page, at the top</option>
                <option value="below-title" <?php if ($flash->old('display.image_position') == 'below-title') { echo "selected"; } ?>>Within the page, below the title</option>
            </select>
        </div>
        <!-- /.form-group -->
    
    </div>
    <!-- /.col-md-10 -->
</div>
<!-- /.row -->

<hr/>

<div class="row">
    <div class="col-md-2">
    
        <h3>Template</h3>
        <p class="help-block">Which template should be used to display this page?</p>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">

        <div class="form-group">
            <label>Select a Template</label>
            <select name="display[view]" class="form-control">
                <option value="" <?php if (!$flash->old('display.view')) { echo "selected"; } ?>>-- Default --</option>
                <?php $variants = \Dsc\System::instance()->get('theme')->variants( 'Pages/Site/Views::pages/view.php' ); ?>
                <?php foreach ($variants as $group=>$views) { ?>
                    <optgroup label="<?php echo $group; ?>">
                        <?php foreach ($views as $view) { ?>
                        <option value="<?php echo $view; ?>" <?php if ($flash->old('display.view') == $view) { echo "selected"; } ?>><?php echo $view; ?></option>
                        <?php } ?>
                    </optgroup>
                <?php } ?>
            </select>
        </div>
        <!-- /.form-group -->
    
    </div>
    <!-- /.col-md-10 -->
</div>
<!-- /.row -->

<hr/>