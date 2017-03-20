<div class="portlet box GREEN-JUNGLE ">
	    <div class="portlet-title">
	        <div class="caption">
	            <i class="fa fa-list"></i>Tambah User</div>
	        <div class="tools"> </div>
	    </div>
	    <div class="portlet-body" >
	    <style type="text/css">
	    	table tr td{
	    		white-space: nowrap !important;
	    	}
	    </style>
</div>

<!-- <div class="portlet-title ">
    <div class="caption">
        <span class="caption-subject font-red bold uppercase">Tambah User</span>
    </div>
</div> -->
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
	        <div class="col-md-6 ">

	            <!-- <input type="hidden" value="<?php //echo $objData["id"] ?>" name="Id" id="Id"> -->
	            <div class="form-group form-md-line-input form-md-floating-label">
	                <input type="text" class="form-control"  name="nik" maxlength="8" value="<?php echo $objData["nik"] ?>">
	                <label for="form_control_1">Nik <span class="required"> *<span> </label>
	            </div>
	            <div class="form-group form-md-line-input form-md-floating-label">
	                <input type="text" class="form-control" name="nama" maxlength="50" value="<?php echo $objData["nama"] ?>">
	                <label for="form_control_1">Nama <span class="required"> *<span> </label>
	            </div>
	            <div class="form-group form-md-line-input form-md-floating-label">
	                <select class="form-control" id="d" name="level_jabatan" value="<?php echo $objData["level_jabatan"] ?>">
                        <option value="1">Departemen</option>
                        <option value="2">Biro</option>
                        <option value="3">Bagian</option>
                        <option value="4">Seksi</option>
                        <option value="5">Pelaksana</option>
                    </select>
	            </div>

	            <div class="form-group form-md-line-input form-md-floating-label">
	                <input type="text" class="form-control" name="nama_jabatan" maxlength="50" value="<?php echo $objData["nik_atl"] ?>">
	                <label for="form_control_1">Jabatan <span class="required"> *<span> </label>
	            </div>

	            <div class="form-group form-md-line-input form-md-floating-label">
	                <input type="text" class="form-control" name="nik_atl" maxlength="8" value="<?php echo $objData["nik_atl"] ?>">
	                <label for="form_control_1">Nik Atasan Langsung <span class="required"> *<span> </label>
	            </div>

	            <div class="form-group form-md-line-input form-md-floating-label">
	                <input type="text" class="form-control" name="nama_atl" maxlength="50" value="<?php echo $objData["nama_atl"] ?>">
	                <label for="form_control_1">Nama Atasan Langsung<span class="required"> *<span> </label>
	            </div>

	            <div class="form-group form-md-line-input form-md-floating-label">
	                <input type="text" class="form-control" name="nik_attl" maxlength="8" value="<?php echo $objData["nik_attl"] ?>">
	                <label for="form_control_1">Nik Atasan Tidak Langsung <span class="required"> *<span> </label>
	            </div>

	            <div class="form-group form-md-line-input form-md-floating-label">
	                <input type="text" class="form-control" name="nama_attl" maxlength="50" value="<?php echo $objData["nama_attl"] ?>">
	                <label for="form_control_1">Nama Atasan Tidak Langsung<span class="required"> *<span> </label>
	            </div>

	            <div class="form-group form-md-line-input form-md-floating-label">
	                <input type="text" class="form-control" name="unit_kerja" maxlength="50" value="<?php echo $objData["unit_kerja"] ?>">
	                <label for="form_control_1">Unit Kerja <span class="required"> *<span> </label>
	            </div>


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
		jQuery("#btnCancel").click(function(){window.location.href = "<?php echo base_url(); ?>User";})		
	})
</script>