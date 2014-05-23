<div class="well">

    <form id="detail-form" class="form" method="post">
        <div class="row">
            <div class="col-md-12">
            
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
                                    <a onclick="document.getElementById('primarySubmit').value='save_as'; document.getElementById('detail-form').submit();" href="javascript:void(0);">Save As</a>
                                </li>
                                <li>
                                    <a onclick="document.getElementById('primarySubmit').value='save_close'; document.getElementById('detail-form').submit();" href="javascript:void(0);">Save & Close</a>
                                </li>
                            </ul>
                        </div>
                            
                        &nbsp;
                        <a class="btn btn-default" href="./admin/pages/categories">Cancel</a>
                    </div>
    
                </div>
                <!-- /.form-actions -->
                
                <hr/>
                
                <div class="alert alert-info">
                    <p><b>URL:</b> <a href="./pages/category<?php echo $flash->old('path'); ?>" target="_blank">./pages/category<?php echo $flash->old('path'); ?></a></p>
                </div>
                
                <div class="form-group">
                <label>Title</label>
                     <input type="text" name="title" placeholder="Title" value="<?php echo $flash->old('title'); ?>" class="form-control" />
                </div>
                
                <div class="form-group">
                <label>Slug</label>
                     <input type="text" name="slug" placeholder="Slug" value="<?php echo $flash->old('slug'); ?>" class="form-control" />
                </div>
                <!-- /.form-group -->
                
                <div class="form-group">
                    <?php echo $this->renderLayout('Pages/Admin/Views::categories/list_parents.php'); ?>
                </div>
                <!-- /.form-group -->     
        
            </div>
            
        </div>
    </form>

</div>