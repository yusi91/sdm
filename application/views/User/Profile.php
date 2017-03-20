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

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet ">
                <!-- SIDEBAR USERPIC -->
                <div class="">
                    <?php
                        $img_location = base_url()."assets/img/user.jpg";
                        $base_location = base_url()."upload_path/Avatar/";
                        // var_dump(file_exists($base_location.trim($userinfo["photo"])));die();

                        if($userinfo["photo"] != null && trim($userinfo["photo"]) != "" ){
                            $img_location = ($base_location.trim($userinfo["photo"]));
                        }
                    ?>
                    <img src="<?php echo $img_location?>" class="img-responsive" alt=""> 
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> <?php echo $userinfo["username"]?> </div>
                    <div class="profile-usertitle-job" style="padding-bottom: 10px"> <?php echo $userinfo["type"]?> </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
            </div>
            <!-- END PORTLET MAIN -->
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                </li>
                                <li>
                                    <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="tab_1_1">
                                    <form role="form" action="<?php echo base_url()?>User/ChangeProfile" method="POST" id="form_change_profile">
                                        <div class="form-group">
                                            <label class="control-label">Username</label>
                                            <input type="text" placeholder="<?php echo $userinfo["username"] ?>" class="form-control" disabled="" /> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Distributor</label>
                                            <input type="text" placeholder="<?php echo $userinfo["an8_nama"] ?>" class="form-control"  disabled="" /> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">No Hp</label>
                                            <input type="text" placeholder="<?php echo $userinfo["no_hp"] ?>" class="form-control"  name="no_hp" /> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" placeholder="<?php echo $userinfo["email"] ?>" class="form-control"  name="email"  /> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Site</label>
                                            <input type="text" placeholder="<?php echo $userinfo["site"] ?>" class="form-control"  disabled="" /> 
                                        </div>
                                        <div class="margiv-top-10">
                                            <input type="Submit" name="btnSave" class="btn green" value="Save"> 
                                        </div>
                                    </form>
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- CHANGE AVATAR TAB -->
                                <div class="tab-pane" id="tab_1_2">
                                    <form action="<?php echo base_url()?>User/ChangeAvatar" method="POST" role="form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 200px;"> </div>
                                                    <div>
                                                        <span class="btn red btn-outline btn-file">
                                                            <span class="fileinput-new"> Select image </span>
                                                            <span class="fileinput-exists"> Change </span>
                                                            <input type="file" name="photo_location"> 
                                                        </span>
                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                    </div>
                                                </div>
                                                <div class="clearfix margin-top-10">
                                                    <span class="label label-danger">NOTE!</span> 
                                                    Tipe File Harus Berformat JPEG/JPG/PNG. Ukuran maksimal file adalah 2 Mb. Resolusi Maksimal 1920 x 1080.
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                        <div class="margin-top-10">
                                            <input type="submit" name="btnChangeAvatar" value="Change Avatar" id="btnChangeAvatar" class="btn green">
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE AVATAR TAB -->
                                <!-- CHANGE PASSWORD TAB -->
                                <div class="tab-pane" id="tab_1_3">
                                    <form role="form" method="POST" class="row" id="form_change_Password" action="<?php echo base_url()?>User/ChangePassword">
                                        <div class="form-group">
                                            <label class="control-label">Current Password</label>
                                            <input type="password" class="form-control" id="old_pass" name="old_pass"/> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">New Password</label>
                                            <input type="password" class="form-control" id="new_pass" name="new_pass"/> 
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Re-type New Password</label>
                                            <input type="password" class="form-control" id="conf_pass" name="conf_pass"/> 
                                        </div>
                                        <div class="margin-top-10">
                                            <input type="submit"  class="btn green" Value="Change Password" name="btnChangePassword" />
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE PASSWORD TAB -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>


<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#form_input").submit(function(e){
            if(!validateConfirmPassword()){
                alert("Password Baru dan Konfirmasi Password Tidak Cocok.");
                jQuery(".has-info").addClass("has-error");
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
