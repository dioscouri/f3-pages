<div class="clearfix">

<div class="col-md-8">

    <h3>Current Links</h3>
    
    <?php foreach ((array) $flash->old('links') as $key=>$link) { ?>
        <div class="template well clearfix">
            <div class="row">
                <div class="col-md-12">
                <a class="remove-link btn btn-xs btn-danger pull-right" onclick="PagesRemoveRelatedLink(this);" href="javascript:void(0);">
                    <i class="fa fa-times"></i>
                </a>                       
                </div>
            </div> 
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="links[<?php echo $key; ?>][title]" class="form-control" value="<?php echo $flash->old( 'links.'.$key.'.title' ); ?>" placeholder="Title" />
                    </div>
                </div>            
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Url</label>
                        <input type="text" name="links[<?php echo $key; ?>][url]" class="form-control" value="<?php echo $flash->old( 'links.'.$key.'.url' ); ?>" placeholder="URL" />
                    </div>
                </div>
            </div>
            
        </div>                        
    <?php } ?>
</div>
<!-- /.col-md-8 -->

<div class="col-md-4 col-sidebar-right">

    <input type="hidden" name="links[]" value="" />

    <template type="text/template" id="add-link-template">
        <div class="template well clearfix">
            <a class="remove-link btn btn-xs btn-danger pull-right" onclick="PagesRemoveRelatedLink(this);" href="javascript:void(0);">
                <i class="fa fa-times"></i>
            </a>
                                    
            <label>New Link</label>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="links[{id}][title]" class="form-control" placeholder="Title" />
                    </div>
                </div>
            </div>                   
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Url</label>
                        <input type="text" name="links[{id}][url]" class="form-control" placeholder="URL" />
                    </div>
                </div>
            </div>            

        </div>
    </template>
    
    <div class="form-group">
        <a class="btn btn-warning" id="add-link">Add New Link</a>
    </div>
    
    <div id="new-links" class="form-group"></div>
    
    <script>
    jQuery(document).ready(function(){
        window.new_links = <?php echo count( $flash->old('links') ); ?>;
        jQuery('#add-link').click(function(){
            var container = jQuery('#new-links');
            var template = jQuery('#add-link-template').html();
            template = template.replace( new RegExp("{id}", 'g'), window.new_links);
            container.append(template);
            window.new_links = window.new_links + 1;
            Dsc.setupColorbox();                            
        });

        PagesRemoveRelatedLink = function(el) {
            jQuery(el).parents('.template').remove();                            
        }

    });
    </script>

</div>
<!-- /.col-md-4 -->

</div>