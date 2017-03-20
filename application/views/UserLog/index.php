<!-- BEGIN TABLE PORTLET-->
<div class="portlet-body">
 <?php 
 	if($list_of_data != null && count($list_of_data) > 0){
 		?>
		    <form action="<?php echo base_url()?>UserLog/ExportExcel" method="POST">
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
	                    <!-- <th class="center">id</th> -->
	                    <th class="center">Username</th>
	                    <th class="center">Nama Distributor</th>
						<th class="center">Site</th>
						<th class="center">Tanggal Login</th>
						<th class="center">Waktu Login</th>
						<th class="center">Tanggal Logout</th>
						<th class="center">Waktu Logout</th>
	                </tr>
	            </thead>
	            <tbody>
					<?php
						$rownum = 1;
						$row_input = 0;
						$format_currency_counter = 0;
						$list_currency = 0;

						if($list_of_data != null && count($list_of_data) > 0){
							foreach ($list_of_data as $data) {
								?>
								<tr id="_row_<?php echo $rownum ?>" class='row_table_data_list'>
									<td class="center"> <?php echo $rownum++; ?></td>
									<!-- <td><?php echo ($data["Id"] != null && $data["Id"] != "" ? $data["Id"] : "&nbsp;")?></td> -->
									<td><?php echo ($data["username"] != null && $data["username"] != "" ? $data["username"] : "&nbsp;")?></td>
									<td><?php echo ($data["ab"] != null? $data["ab"]["nama"] : "&nbsp;")?></td>
									<td><?php echo ($data["site"] != null && $data["site"] != "" ? $data["site"] : "&nbsp;")?></td>
									<td><?php echo ($data["login_date"] != null && $data["login_date"] != "" ? date("d-m-Y", strtotime($data["login_date"])) : "&nbsp;")?></td>
									<td><?php echo ($data["login_time"] != null && $data["login_time"] != "" ? date("H:i:s", strtotime($data["login_time"])) : "&nbsp;")?></td>
									<td><?php echo ($data["logout_date"] != null && $data["logout_date"] != "" ? date("d-m-Y", strtotime($data["logout_date"])) : "&nbsp;")?></td>
									<td><?php echo ($data["logout_time"] != null && $data["logout_time"] != "" ? date("H:i:s", strtotime($data["logout_time"])) : "&nbsp;")?></td>
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