<div class="portlet-title ">
    <div class="caption">
        <span class="caption-subject font-purple-studio bold uppercase">Detail</span>
    </div>
</div>
<div class="portlet-body">
    <!-- BEGIN FORM-->
    <form action="#">
        <div class="form-body">
            <div class="form-group form-md-line-input form-md-floating-label has-success">
                <input type="text" class="form-control" id="Code" name="Code" value="<?php echo $objData["code"]; ?>" disabled="">
                <label for="form_control_1">Code</label>
            </div>
            <div class="form-group form-md-line-input form-md-floating-label has-success">
                <input type="text" class="form-control" id="Name" name="Name" value="<?php echo $objData["name"]; ?>" disabled="">
                <label for="form_control_2">Name </label>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?php echo base_url()?>Area/edit?id=<?php echo $objData["id"]?>" class="btn blue-steel">Edit</a>
                    &nbsp;&nbsp;
                    <a href="javascript:;" class="btn default" id="btnCancel">Cancel</a>
                </div>
            </div>
        </div>
    </form>
    <!-- END FORM-->
</div>

<script>
	jQuery(document).ready(function(){
		jQuery("#btnCancel").click(function(){window.location.href = "<?php echo base_url(); ?>Area";})		
	})
</script>