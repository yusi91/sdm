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
<div class="portlet-title">
    <div class="portlet box green-jungle">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-user"></i>Ganti Password
			</div>
        </div>
        <div class="portlet-body " id="SearchForm">
            <form role="form" method="POST" class="row" id="form_input">
                <div class="col-md-3">
                    <div class="form-group form-md-line-input form-md-floating-label">
                        <input type="password" class="form-control" id="old_pass" name="old_pass" >
                        <label for="old_pass">Password Lama</label>
                    </div>
                    <div class="form-group form-md-line-input form-md-floating-label" id="div_new_pass">
                        <input type="password" class="form-control" id="new_pass" name="new_pass" aria-required="true" aria-describedby="new_pass-error">
                        <label for="new_pass">Password Baru</label>
                    </div>  
                    <div class="form-group form-md-line-input form-md-floating-label"  id="div_conf_pass">
                        <input type="password" class="form-control" id="conf_pass" name="conf_pass">
                        <label for="conf_pass">Konfirmasi Password</label>
                    </div>
                    <div class="form-actions noborder">
                        <input type="submit" name="btnSubmit" value="Submit" class="btn green-meadow">
                        <input type="hidden" name="flag_input" value="1" >
                    </div>
                </div>
        	</form>
	    </div>
	</div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#form_input").submit(function(e){
            if(!validateConfirmPassword()){
                alert("Password Baru dan Konfirmasi Password Tidak Cocok.");
                jQuery(".has-info").addClass("has-error");
                // jQuery(".has-info").removeClass("has-info  ");
                // jQuery("#new_pass").val("");
                // jQuery("#conf_pass").val("");
                e.preventDefault(e);
            }
        })
    })
</script>
<script type="text/javascript">
    function validateConfirmPassword(){
        var new_pass = jQuery("#new_pass").val();
        var conf_pass = jQuery("#conf_pass").val();
        var result = false;
        if(new_pass == conf_pass){
            result = true;
        }
        return result;
    }
</script>