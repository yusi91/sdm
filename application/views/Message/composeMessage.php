

<div class="inbox">
    <div class="row">
        <div class="col-md-2">
            <div class="inbox-sidebar">
                <a href="<?php echo base_url()?>Message/composeMessage" data-title="Compose" class="btn red compose-btn btn-block">
                    <i class="fa fa-edit"></i> Compose 
                </a>
                <ul class="inbox-nav">
                    <li class="">
                        <a id="btn_inbox" href="<?php echo base_url()?>Message/index">Inbox <span class="badge badge-danger"> <?php echo $count_inbox?> </span></a> 
                    </li>
                    <li class="">
                        <a  id="btn_sent" href="<?php echo base_url()?>Message/index?type_inbox=SENT">Sent <span class="badge badge-success"> <?php echo $count_sent?> </span></a>
                    </li>
                    <li class="">
                        <a  id="btn_trash" href="<?php echo base_url()?>Message/index?type_inbox=TRASH">Trash</a>
                    </li>     
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            <div class="inbox-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1_1">
                        <h3>Compose</h3>             
                        <form class="inbox-compose form-horizontal" id="input_form"  method="POST" >
                            <div class="inbox-compose-btn">
                                <input type="submit" name="btnSend" class="btn green" id="btnSend" />
                                <button class="btn default inbox-discard-btn" id="btnReset">Reset</button>
                            </div>
                            <div class="inbox-form-group mail-to">
                                <label class="control-label">To :</label>
                                <div class="controls controls-to">
                                    <input type="text" class="form-control" name="to" id="to">
                                </div>
                            </div>
                            <div class="inbox-form-group">
                                <label class="control-label">Subject :</label>
                                <div class="controls">
                                    <input type="text" class="form-control" name="subject" id="subject"> 
                                </div>
                            </div>

                            <div class="inbox-form-group">
                                <label class="control-label">Priority :</label>
                                <div class="controls">
                                    <select class=" form-control" id="priority" name="priority">
                                        <option value="Standard">Standard</option>
                                        <option value="Importance">Importance</option>
                                    </select>
                                </div>
                            </div>
                            <div class="inbox-form-group">
                                <br>
                                <textarea class="inbox-editor inbox-wysihtml5 form-control" name="message" rows="12" id="message"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    jQuery(document).ready(function() {
        TableDatatablesResponsive.init()
        jQuery("#btnReset").click(function(){
            jQuery("#to").value("");
            jQuery("#subject").value("");
            jQuery("#message").html("");
            jQuery("#priority").value("");
        })
    });
</script>