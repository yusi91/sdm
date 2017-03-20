<!-- BEGIN TABLE PORTLET-->
<div class="portlet-body">
 <?php 
 	if($list_of_data != null && count($list_of_data) > 0){
 		?>
		    <form action="<?php echo base_url()?>UserLog/exportExcelUserRating" method="POST">
		    	<button type="submit"  class="btn yellow-gold"> <i class="fa fa-file-excel-o "></i> Export Excel</button>
		    </form>
 		<?php 
 	}
 ?>

	<div class="portlet box GREEN-JUNGLE ">
	    <div class="portlet-title">
	        <div class="caption">
	            <i class="fa fa-list"></i>User Log</div>
	        <div class="tools"> </div>
	    </div>
	    <div class="portlet-body" >
	    <style type="text/css">
	    	table tr td{
	    		white-space: nowrap !important;
	    	}
	    </style>
	    
	        <table class="table table-striped table-bordered table-hover order-column datatable_colReorder" id="data_list" width="100%">
	            <thead>
	                <tr>
	                    <th class="center" width="5%">No</th>
	                    <th class="center">Username</th>
						<th class="center">Total Login</th>
						<th class="center">Average Login Per Day</th>
						<th class="center">-</th>
	                </tr>
	            </thead>
	            <tbody>
					<?php
						$rownum = 1;
						$row_input = 0;
						$format_currency_counter = 0;
						$list_currency = 0;

						$cds_release=strtotime("2014/05/01");
						$today=time();
						$selisih=abs($cds_release-$today);
						$selisih=(intval($selisih))/86400;

						if($list_of_data != null && count($list_of_data) > 0){
							foreach ($list_of_data as $data) {
								?>
								<tr id="_row_<?php echo $rownum ?>" class='row_table_data_list'>
									<td class="center"> <?php echo $rownum++; ?></td>
									<td><?php echo ($data["username"] != null && $data["username"] != "" ? $data["username"] : "&nbsp;")?></td>
									<td  style="text-align: right">
										<?php echo ($data["count_login"] != null && $data["count_login"] != "" ? number_format($data["count_login"], 0) : "0")?>
									</td>
									<td style="text-align: right">
										<?php echo ($data["count_login"] != null && $data["count_login"] != "" ? number_format($data["count_login"] / $selisih, 3): "0")?>
									</td>
									<td class="center">
										<a href="#" class="btn btn-xs green" onclick="showDetailUser('<?php echo ($data["username"] != null && $data["username"] != "" ? $data["username"] : "")?>')">Detail</a>
									</td>
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
<!-- END TABLE PORTLET-->
<script type="text/javascript">
	jQuery(document).ready(function() {
	    TableDatatablesResponsive.init();
	});
</script>

<script type="text/javascript">
	function showDetailUser(username){
		setButtonExportExcel(username);
    	jQuery("#btnExportExcel").hide();
		App.blockUI();
		var dt = $('#list_data_userlog').DataTable();
		dt.clear().draw();

        $.ajax({
            type: "GET",
            url: '<?php echo base_url()?>UserLog/getJSONUserLogByUsername?username='+username,
            dataType: 'json',
            success: function(json) {
            	jQuery("#btnExportExcel").show();
            	$.each(json,function(index,val){
            		var arr = [];
            		$.each(val,function(index_, val_){
            			arr.push(val_);
            		})
                	dt.row.add(arr).draw().nodes();
            	})
                jQuery("#PopupDetailUserLog").modal("show");
            },
            complete: function(){
                App.unblockUI();
            }
        });
	}

	function setButtonExportExcel(username){
		jQuery("#btnExportExcel").click(function(){
			window.location.href = "<?php echo base_url()?>UserLog/exportExcel?username="+username;
		})
	}
</script>


<!-- MODAL SECTION -->
<div class="modal fade" id="PopupDetailUserLog" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog" style="width: 90%;"s>
        <div class="modal-content" >
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" >Detail</h4>
            </div>
            <div class="modal-body">                 
                <div class="portlet-body">
                    <div class="portlet box green-dark">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-list"></i>Daftar User Log</div>
                            <div class="tools"> </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover order-column datatable_colReorder" id="list_data_userlog" width="100%"> 
                                <thead>
                                    <tr>
                                    	<th class="center" width="5%">No</th>
					                    <th class="center">Username</th>
					                    <th class="center">Nama Distributor</th>
										<th class="center">Site</th>
										<th class="center">Tanggal Login</th>
										<th class="center">Waktu Login</th>
										<th class="center">Tanggal Logout</th>
										<th class="center">Waktu Logout</th>	
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
             </div>
            <div class="modal-footer">
                <a class="btn yellow-gold btn-outline" id="btnExportExcel" href="#">Export Excel</a>
                <button type="button" class="btn red btn-outline" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>