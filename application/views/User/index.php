<!-- BEGIN TABLE PORTLET-->
<div class="portlet-body">

			<form action="<?php echo base_url()?>user/form_input" method="POST">
		    	<button type="submit"  class="btn yellow-gold"> <i class="fa fa-file-excel-o "></i> Tambah User</button>
		    </form>
		    

 <!-- <?php 
 	if($list_of_data != null && count($list_of_data) > 0){
 		?>
		    <form action="<?php echo base_url()?>UserLog/ExportExcel" method="POST">
		    	<button type="submit"  class="btn yellow-gold"> <i class="fa fa-file-excel-o "></i> Export Excel</button>
		    </form>
 		<?php 
 	}
 ?> -->

	<div class="portlet box GREEN-JUNGLE ">
	    <div class="portlet-title">
	        <div class="caption">
	            <i class="fa fa-list"></i>User</div>
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
	                    <th class="center">NIK</th>
	                    <th class="center">Nama Karyawan</th>
						<th class="center">Level</th>
						<th class="center">Jabatan</th>
						<th class="center">NIK ATL</th>
						<th class="center">Nama ATL</th>
						<th class="center">NIK ATTL</th>
						<th class="center">Nama ATTL</th>
						<th class="center">Unit Kerja</th>
						<th class="center">Status</th>
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
									<td><?php echo ($data["nik"] != null && $data["nik"] != "" ? $data["nik"] : "&nbsp;")?></td>
									<td><?php echo ($data["nama"] != null  && $data["nama"] != ""? $data["nama"] : "&nbsp;")?></td>
									<td><?php echo ($data["level_jabatan"] != null && $data["level_jabatan"] != "" ? $data["level_jabatan"] : "&nbsp;")?></td>
									<td><?php echo ($data["nama_jabatan"] != null && $data["nama_jabatan"] != "" ? $data["nama_jabatan"] : "&nbsp;")?></td>
									<td><?php echo ($data["nik_atl"] != null && $data["nik_atl"] != "" ? $data["nik_atl"] : "&nbsp;")?></td>
									<td><?php echo ($data["nama_atl"] != null && $data["nama_atl"] != "" ? $data["nama_atl"] : "&nbsp;")?></td>
									<td><?php echo ($data["nik_attl"] != null && $data["nik_attl"] != "" ? $data["nik_attl"] : "&nbsp;")?></td>
									<td><?php echo ($data["nama_attl"] != null && $data["nama_attl"] != "" ? $data["nama_attl"] : "&nbsp;")?></td>
									<td><?php echo ($data["unit_kerja"] != null && $data["unit_kerja"] != "" ? $data["unit_kerja"] : "&nbsp;")?></td>
									<td>
										<?php 
											// echo ($data["status"] != null && $data["status"] != "" ? $data["status"] : "&nbsp;")
											if(!empty($data["status"]))
											{
												if($data["status"]=='1')
												{
													echo "Aktif";
												}else {
													echo "Nonaktif";
												} 
											}else{
												echo "-";
											}
										?>
										
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