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
                <input type="text" class="form-control" id="Code" name="Code" value="<?php echo $objData["cars"]; ?>" disabled="">
                <label for="form_control_1">Expeditur Code</label>
            </div>
            <div class="form-group form-md-line-input form-md-floating-label has-success">
                <input type="text" class="form-control" id="Name" name="Name" value="<?php echo $objData["name"]; ?>" disabled="">
                <label for="form_control_2">Name </label>
            </div>
            <div class="form-group form-md-line-input form-md-floating-label has-success">
                <input type="text" class="form-control" id="Name" name="Name" value="<?php echo $objData["owner"]; ?>" disabled="">
                <label for="form_control_2">Owner </label>
            </div>
            <div class="form-group form-md-line-input form-md-floating-label has-success">
                <input type="text" class="form-control" id="Name" name="Name" value="<?php echo date("d-m-Y",strtotime($objData["date_established"])) ; ?>" disabled="">
                <label for="form_control_2">Date Established </label>
            </div>
            <div class="form-group form-md-line-input form-md-floating-label has-success">
                <div class="row">
                <?php 
                    $own_cost = "glyphicon glyphicon-ok font-green";
                    if($objData["own_cost"] != "1"){
                        $own_cost = "glyphicon glyphicon-remove font-red";
                    }
                ?>
                    <div class="col-md-1"><label for="form_control_2">Own Cost  </label></div>
                    <div class="col-md-1"><i class="<?php echo $own_cost?>"></i></div>
                </div>
            </div>
            <div class="form-group form-md-line-input form-md-floating-label has-success">
                <div class="row">
                <?php 
                    $is_active = "glyphicon glyphicon-ok font-green";
                    if($objData["is_active"] != "1"){
                        $is_active = "glyphicon glyphicon-remove font-red";
                    }
                ?>
                    <div class="col-md-1"><label for="form_control_2">Is Active  </label></div>
                    <div class="col-md-1"><i class="<?php echo $is_active;?>"></i></div>
                </div>
            </div>
            <div class="form-group form-md-line-input form-md-floating-label has-success">
                <textarea  class="form-control" disabled="" rows="5"><?php echo $objData["description"]; ?></textarea>
                <label for="form_control_2">Description </label>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?php echo base_url()?>Expeditur/edit?id=<?php echo $objData["id"]?>" class="btn blue-steel">Edit</a>
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
		jQuery("#btnCancel").click(function(){window.location.href = "<?php echo base_url(); ?>Expeditur";})		
	})
</script>