<!-- BEGIN TITLE Tagihan -->
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
    <div class="portlet box GREEN-JUNGLE">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-search"></i>Pencarian
			</div>
        </div>
        <div class="portlet-body " id="SearchForm">
            <form role="form" method="POST">
	            <div class="row">
	                <div class="col-md-2">
	                    <div class="form-group form-md-line-input form-md-label has-success ">
			                <select class="form-control edited " id="site" name="site">
			                    <?php 
			                        if($ComboSite != null && count($ComboSite) > 0){
			                            foreach ($ComboSite as $combo_value) {
			                                $selected = "";
			                                if($filter["site"] != null && $filter["site"] != ""){
			                                    if($filter["site"] == $combo_value["id"]){
			                                        $selected = "selected";
			                                    }
			                                }
			                            ?>
			                                <option value="<?php echo $combo_value["id"]?>" <?php echo $selected ?>><?php echo $combo_value["name"]?></option>
			                            <?php 
			                            }
			                        }
			                    ?>
			                </select>
			                <label for="site">Site </label>
		            	</div>
	                </div>
	                <br>
	                <div class="col-md-2 ">
	                     <div class="form-actions noborder">
			            	<input type="submit" name="btnSearch" value="Cari" class="btn yellow-gold">
			            </div>
	                </div>
	            </div>
        	</form>
	    </div>
	</div>
</div>
<!-- END FILTER Tagihan -->

<!-- BEGIN TABLE PORTLET-->
 <div class="portlet-body">
 <?php 
 	if($list_of_data != null && count($list_of_data) > 0){
 		?>
		    <form action="<?php echo base_url()?>Saldo/ExportExcel" method="POST">
		    	<input type="hidden" value="<?php echo $filter["site"]?>" name="site">
		    	<button type="submit"  class="btn yellow-gold"> <i class="fa fa-file-excel-o "></i> Export Excel</button>
		    </form>
 		<?php 
 	}
 ?>

	<div class="portlet box GREEN-JUNGLE ">
	    <div class="portlet-title">
	        <div class="caption">
	            <i class="fa fa-list"></i>Daftar Saldo</div>
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
	                    <th class="center">Site</th>
	                    <th class="center">Distributor</th>
	                    <th class="center">Jenis Bayar</th>
	                    <th class="center">Plafon</th>
	                    <th class="center">Deposit</th>
	                    <th class="center">Faktur Open</th>
	                    <th class="center">Order Open</th>
	                    <th class="center">Sisa Saldo</th>
	                </tr>
	            </thead>
	            <tbody>
					<?php
						$rownum = 1;
						$row_input = 0;
						$format_currency_counter = 0;
						$list_currency = 0;

						$list_site[10201] = "[10201] Palembang";
						$list_site[10202] = "[10202] Baturaja";
						$list_site[10203] = "[10203] Panjang";

						if($list_of_data != null && count($list_of_data) > 0){
							foreach ($list_of_data as $data) {
								$plafon = $data["plafon"];
								$deposit = $data["deposit"];
								$faktur_open = $data["faktur_open"];
								$order_open = $data["order_open"];
								$sisa_saldo = $data["sisa_saldo"];
								?>
									<tr id="_row_<?php echo $rownum ?>" class='row_table_data_list'>
										<td class="center"> <?php echo $rownum++; ?></td>
										<td><?php echo ($data["site"] != null && $data["site"] != "" ? $list_site[$data["site"]] : "&nbsp;")?></td>
										<td><?php echo ($data["sdan8"] != null && $data["sdan8"] != "" ? "[".$data["sdan8"]."] ".$data["nama_dist"]: "&nbsp;")?></td>
										<td><?php echo ($data["ryin"] != null && $data["ryin"] != "" ? "[".$data["ryin"]."] ".$data["jenis_bayar"]: "&nbsp;")?></td>
										<td class="format_currency_label<?php echo $format_currency_counter++ ?> format_currency_list" style="text-align: right"><?php echo $plafon;?></td>
										<td class="format_currency_label<?php echo $format_currency_counter++ ?> format_currency_list" style="text-align: right"><?php echo $deposit;?></td>
										<td class="format_currency_label<?php echo $format_currency_counter++ ?> format_currency_list" style="text-align: right"><?php echo $faktur_open;?></td>
										<td class="format_currency_label<?php echo $format_currency_counter++ ?> format_currency_list" style="text-align: right"><?php echo $order_open;?></td>
										<td class="format_currency_label<?php echo $format_currency_counter++ ?> format_currency_list" style="text-align: right"><?php echo $sisa_saldo;?></td>
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
<script type="text/javascript">
	jQuery(document).ready(function() {
	    TableDatatablesResponsive.init();
	});
</script>

<style type="text/css">
	.form-group{
		margin-bottom: 5px !important;
	}
</style>
