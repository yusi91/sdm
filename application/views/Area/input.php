
<div class="portlet-title ">
    <div class="caption">
        <span class="caption-subject font-red bold uppercase">Input</span>
    </div>
</div>
<?php 
	if(isset($err_msg) && $err_msg != null && count($err_msg) > 0){
        ?>
        <div class="portlet-body">
            <div class="alert alert-danger">
                <ul>
                    <?php 
                        foreach ($err_msg as $err) {
                            echo "<li>".$err."</li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
        <?php 
	}
?>

<div class="portlet-body">
    <!-- BEGIN FORM-->
    <form method="post">
        <div class="form-body">
            <input type="hidden" value="<?php echo $objData["id"] ?>" name="Id" id="Id">
            <div class="form-group form-md-line-input form-md-floating-label has-success">
                <input type="text" class="form-control" id="Code" name="Code" maxlength="10" value="<?php echo $objData["code"] ?>">
                <label for="form_control_1">Code <span class="required"> *<span> </label>
            </div>
            <div class="form-group form-md-line-input form-md-floating-label has-success">
                <input type="text" class="form-control" id="Name" name="Name" maxlength="50" value="<?php echo $objData["name"] ?>">
                <label for="form_control_1">Name <span class="required"> *<span> </label>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-12">
                	<input type="Submit" class="btn blue-steel" value="Submit" name="btnSubmit" id="btnSubmit">
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
		jQuery('input[maxlength]').maxlength();
		jQuery("#btnCancel").click(function(){window.location.href = "<?php echo base_url(); ?>Area";})		
	})
</script>