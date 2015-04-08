<script>
jQuery(document).ready(function(){
    CKEDITOR.replaceAll( 'wysiwyg' );    
});
</script>

<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i> 
            <a href="./admin/pages/pages">Pages</a>
            <span> > Create New </span>
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">

    </div>
</div>

<div class="well">

<form id="detail-form" class="form" method="post">

    <div class="clearfix">

        <div class="pull-right">
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
        
        <?php if (!empty($this->event)) { foreach ((array) $this->event->getArgument('content') as $key => $content ) { ?>
        <div class="tab-pane" id="tab-<?php echo $key; ?>">
            <?php echo $content; ?>
        </div>
        <?php } } ?>
        <!-- /.tab-pane -->
    
    </div>
</form>

</div>