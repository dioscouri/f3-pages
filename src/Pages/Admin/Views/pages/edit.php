<script src="./ckeditor/ckeditor.js"></script>
<script>
jQuery(document).ready(function(){
    CKEDITOR.replaceAll( 'wysiwyg' );    
});
</script>

<div class="well">

<form id="detail-form" class="form" method="post">

    <div class="clearfix">

        <div class="pull-right">
        	<?php if( $allow_preview ) { ?>
            <a class="btn btn-warning" href="./pages/<?php echo $flash->old('slug'); ?>?preview=1" target="_blank">Preview</a>
            &nbsp;
            <?php } ?>
        
        	<div class="btn-group">
                <button type="submit" class="btn btn-primary">Save</button>
                <input id="primarySubmit" type="hidden" value="save_edit" name="submitType" />
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a onclick="document.getElementById('primarySubmit').value='save_new'; document.getElementById('detail-form').submit();" href="javascript:void(0);">Save & Create Another</a>
                    </li>
                    <li>
                        <a onclick="document.getElementById('primarySubmit').value='save_as'; document.getElementById('detail-form').submit();" href="javascript:void(0);">Save As</a>
                    </li>
                    <li>
                        <a onclick="document.getElementById('primarySubmit').value='save_close'; document.getElementById('detail-form').submit();" href="javascript:void(0);">Save & Close</a>
                    </li>
                </ul>
            </div>                          
            &nbsp;
            <a class="btn btn-default" href="./admin/pages/pages">Cancel</a>
        </div>

    </div>
    
    <hr />
    <!-- /.form-actions -->
    
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab-basics" data-toggle="tab"> Basics </a>
        </li>
        <li>
            <a href="#tab-images" data-toggle="tab"> Images </a>
        </li>
        <li>
            <a href="#tab-video" data-toggle="tab"> Video </a>
        </li>
        <li>
            <a href="#tab-links" data-toggle="tab"> Links </a>
        </li>                
        <li>
            <a href="#tab-display" data-toggle="tab"> Display </a>
        </li>
        <li>
            <a href="#tab-translations" data-toggle="tab"> Translations </a>
        </li>
        <?php if (!empty($this->event)) { foreach ((array) $this->event->getArgument('tabs') as $key => $title ) { ?>
        <li>
            <a href="#tab-<?php echo $key; ?>" data-toggle="tab"> <?php echo $title; ?> </a>
        </li>
        <?php } } ?>                
    </ul>
    
    <div class="tab-content padding-10">
    
        <div class="tab-pane active" id="tab-basics">
        
            <?php echo $this->renderLayout('Pages/Admin/Views::pages/fields_basics.php'); ?>
        
        </div>
        <!-- /.tab-pane -->
        
        <div class="tab-pane" id="tab-images">

            <?php echo $this->renderLayout('Pages/Admin/Views::pages/fields_images.php'); ?>
                                
        </div>
        <!-- /.tab-pane -->
        
        <div class="tab-pane" id="tab-video">

            <?php echo $this->renderLayout('Pages/Admin/Views::pages/fields_video.php'); ?>
                                
        </div>
        <!-- /.tab-pane -->
        
        <div class="tab-pane" id="tab-links">

            <?php echo $this->renderLayout('Pages/Admin/Views::pages/fields_links.php'); ?>
                                
        </div>
        <!-- /.tab-pane -->
        
        <div class="tab-pane" id="tab-display">

            <?php echo $this->renderLayout('Pages/Admin/Views::pages/fields_display.php'); ?>
                                
        </div>
        <!-- /.tab-pane -->
        
        <div class="tab-pane" id="tab-translations">
            <?php echo $this->renderLayout('Pages/Admin/Views::pages/fields_translations.php'); ?>
        </div>
        <!-- /.tab-pane -->
        
        <?php if (!empty($this->event)) { foreach ((array) $this->event->getArgument('content') as $key => $content ) { ?>
        <div class="tab-pane" id="tab-<?php echo $key; ?>">
            <?php echo $content; ?>
        </div>
        <?php } } ?>
        <!-- /.tab-pane -->
    
    </div>
</form>

</div>