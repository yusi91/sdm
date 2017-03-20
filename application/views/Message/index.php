<div class="inbox">
    <div class="row">
        <div class="col-md-2">
            <div class="inbox-sidebar">
                <a href="<?php echo base_url()?>Message/composeMessage" data-title="Compose" class="btn red compose-btn btn-block">
                    <i class="fa fa-edit"></i> Compose 
                </a>
                <ul class="inbox-nav">
                    <?php 
                    $inbox = "";
                    $sent = "";
                    $trash = "";

                    if($title_mode == "SENT"){$sent = "active";}
                    else if($title_mode == "TRASH"){$trash = "active";}
                    else{$inbox = "active";}
                    ?>
                    <li class="<?php echo $inbox?>">
                        <a id="btn_inbox" href="<?php echo base_url()?>Message/index">Inbox <span class="badge badge-danger"> <?php echo $count_inbox?> </span></a> 
                    </li>
                    <li class="<?php echo $sent?>">
                        <a  id="btn_sent" href="<?php echo base_url()?>Message/index?type_inbox=SENT">Sent <span class="badge badge-success"> <?php echo $count_sent?> </span></a>
                    </li>
                    <li class="<?php echo $trash?>">
                        <a  id="btn_trash" href="<?php echo base_url()?>Message/index?type_inbox=TRASH">Trash</a>
                    </li>     
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            <div class="inbox-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1_1">
                        <h3><?php echo $title_mode ?></h3>
                        <table class="table table-striped table-advance table-hover datatable_managed" id="data_list">
                        <thead>
                            <tr>
                                <th class="bold center">
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="group-checkable" data-set="#data_list .checkboxes" />
                                        <span></span>
                                    </label>
                                </th>
                                <th class="bold center"> Username </th>
                                <th class="bold center"> Title </th>
                                <th class="bold center"> Message </th>
                                <th class="bold center"> Status </th>
                                <th class="bold center"> Date </th>
                                <th class="bold center"> Time </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if($list_of_data != null && count($list_of_data) > 0){
                                    foreach ($list_of_data as $key => $value) {
                                        ?>               
                                            <tr class="unread" data-messageid="1">
                                                <td class="inbox-small-cells  center">
                                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="checkboxes" value="1" />
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td class="view-message"><?php echo substr($value["sender"], 0) ?></td>
                                                <td class="view-message"><?php echo substr($value["title"], 0) ?></td>
                                                <td class="view-message"><?php echo substr($value["message"], 0) ?> </td>
                                                <td class="view-message"><?php echo $value["readstate"]?></td>
                                                <td class="view-message"><?php echo date("d-m-Y",strtotime($value["date"]))  ?>  </td>
                                                <td class="view-message"><?php echo date("H:i:s",strtotime($value["time"]))  ?> </td>
                                            </tr>
                                        <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    jQuery(document).ready(function() {
        TableDatatablesResponsive.init()
    });
</script>