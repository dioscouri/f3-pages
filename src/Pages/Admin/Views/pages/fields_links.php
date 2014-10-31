<div class="clearfix">

<div class="col-md-8">

    <h3>Current Links</h3>
    
    <?php foreach ((array) $flash->old('links') as $key=>$link) { ?>
        <fieldset class="template well clearfix">
            <a class="remove-link btn btn-xs btn-danger pull-right" onclick="PagesRemoveRelatedLink(this);" href="javascript:void(0);">
                <i class="fa fa-times"></i>
            </a>                        
            <label>Link</label>
            <div class="form-group clearfix">
                <div class="col-md-12">
                    <input type="text" name="links[<?php echo $key; ?>]" class="form-control" value="<?php echo $flash->old( 'links.'.$key ); ?>" />
                </div>
            </div>
        </fieldset>                        
    <?php } ?>
</div>
<!-- /.col-md-8 -->

<div class="col-md-4 col-sidebar-right">

    <input type="hidden" name="links[]" value="" />

    <template type="text/template" id="add-link-template">
        <fieldset class="template well clearfix">
            <a class="remove-link btn btn-xs btn-danger pull-right" onclick="PagesRemoveRelatedLink(this);" href="javascript:void(0);">
                <i class="fa fa-times"></i>
            </a>                        
            <label>New Link</label>
            <div class="form-group clearfix">
                <div class="col-md-12">
                    <input type="text" name="links[{id}]" class="form-control" value="" />
                </div>
            </div>
        </fieldset>
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