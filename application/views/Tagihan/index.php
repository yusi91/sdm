<!-- BEGIN TITLE Expeditur -->
<div class="portlet-title">
	<div class="caption">
		<span class="caption-subject bold uppercase font-blue-steel">Transaksi Angkutan</span>
	</div>
</div>
<!-- END FILTER Expeditur -->

<!-- BEGIN TABLE PORTLET-->


<div class="portlet-body">
	<div class="portlet box blue-steel">
	    <div class="portlet-title">
	        <div class="caption">
	            <i class="fa fa-list"></i>List of Expeditur</div>
	        <div class="tools"> </div>
	    </div>
	    <div class="portlet-body">
	        <table class="table table-striped table-bordered table-hover order-column datatable_basic" id="data_list">
	            <thead>
	                <tr>
	                    <th class="center" width="7%">Payment</th>
	                    <th class="center" width="5%">No</th>
	                    <th class="center">Name</th>
	                    <th class="center">Owner</th>
	                    <th class="center">Own Cost</th>
	                    <th class="center">Is Active</th>
	                    <th class="center">Date Estabilished</th>
	                </tr>
	            </thead>
	            <tbody>
					<?php
						$rownum = 1;
						if($list_of_data != null && count($list_of_data) > 0){
							foreach ($list_of_data as $data) {
								?>
									<tr>
										<td class="center">
										
											<a class="tooltips " href="<?php echo base_url()?>Tagihan/payment/?id=<?php echo $data["id"];?>" data-placement="bottom" data-original-title="Payment"><i class="fa fa-usd" ></i></a>
										
											
										</td>
										<td class="center"> <?php echo $rownum++ ?> </td>
									
										<td> <?php echo ($data["name"] != null && $data["name"] != "" ? $data["name"]: "&nbsp;")?> </td>
										<td> <?php echo ($data["owner"] != null && $data["owner"] != "" ? $data["owner"]: "&nbsp;")?> </td>
										<?php 
						                    $own_cost = "glyphicon glyphicon-ok font-green";
						                    if($data["own_cost"] != "1"){
						                        $own_cost = "glyphicon glyphicon-remove font-red";
						                    }
						                ?>
										<td class="center"> <i class="<?php echo $own_cost?>"></i> </td>
										<?php 
						                    $is_active = "glyphicon glyphicon-ok font-green";
						                    if($data["is_active"] != "1"){
						                        $is_active = "glyphicon glyphicon-remove font-red";
						                    }
						                ?>
										<td class="center"> <i class="<?php echo $is_active?>"></i> </td>
										<td> <?php echo ($data["date_established"] != null && $data["date_established"] != "" ? date("d-m-Y",strtotime($data["date_established"])): "&nbsp;")?> </td>
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

<!-- BEGIN JQUERY SECTION -->
<script>
	jQuery(document).ready(function(){
		jQuery(".btnDelete").click(function(){if(!confirm("Are You Sure?")){return false;}})
		jQuery("#btnCreate").click(function(){window.location.href = "<?php echo base_url()?>Tagihan/create";})

	});
</script>