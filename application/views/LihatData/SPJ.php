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
<!-- BEGIN FILTER Tagihan -->
<div class="portlet-title">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-search"></i>Pencarian
			</div>
            <div class="tools">
                <a href="javascript:;" class="collapse" id="btnCollapseExpand"> </a>
            </div>
        </div>
        <div class="portlet-body" id="SearchForm">
            <form role="form" method="POST">
	            <div class="row">
	            <div class="col-md-2">
                        <div class="form-group form-md-line-input has-success ">
                            <div class="">
                                <!-- <span class="input-group-addon">Dari</span> -->
                                <input class="form-control date-picker edited" size="16" type="text"  id="RSTRDJ_FROM" name="RSTRDJ_FROM"  value="<?php echo date("d-m-Y",strtotime($filter["RSTRDJ_FROM"]))?>" />
                                <label for="RSTRDJ_FROM">Tanggal</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group form-md-line-input has-success center">
                            <label ><br>s/d</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group form-md-line-input has-success ">
                            <div class="">
                                <!-- <span class="input-group-addon">Sampai</span> -->
                                <input class="form-control  date-picker edited" size="16" type="text"  id="RSTRDJ_TO" name="RSTRDJ_TO"  value="<?php echo date("d-m-Y",strtotime($filter["RSTRDJ_TO"]))?>" />
                                <label for="RSTRDJ_TO"></label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- <div class="form-actions noborder">
                        <input type="submit" name="btnSearch" value="Cari" class="btn blue">
                    </div> -->
                    <div class="col-md-2 ">
	                     <div class="form-actions noborder">
			            	<input type="submit" name="btnSearch" value="Cari" class="btn blue">
			                <!-- <button type="submit" class="btn blue">Search</button> -->
			            </div>
	                </div>
	            </div>
        	</form>
        	<label class="font-red">
        		*Data yang Dapat Diakses Dimulai dari Tanggal 1 Februari 2017 dan Pada Periode yang Sama Untuk Filter Tanggalnya.
        	</label>
	    </div>
	</div>
</div>
<!-- END FILTER Tagihan -->

<!-- BEGIN TABLE PORTLET-->
 <div class="portlet-body">
	<div class="portlet box blue">
	    <div class="portlet-title">
	        <div class="caption">
	            <i class="fa fa-list"></i>Daftar Delivery Order</div>
	        <div class="tools"> </div>
	    </div>
	    <div class="portlet-body">
	        <table class="table table-striped table-bordered table-hover order-column datatable_basic" id="data_list">
	            <thead>
	                <tr>
	                    <th class="center" width="5%">No</th>
	                    <th class="center">Nomor DO</th>
	                    <th class="center">Tanggal</th>
	                    <th class="center">Wilayah</th>
	                    <th class="center">Toko</th>
	                    <th class="center">Plat Nomor</th>
	                    <th class="center">Supir</th>
	                    <th class="center">Jenis Semen</th>
	                    <th class="center">Quantity</th>
	                    <th class="center">Tarif OA</th>
	                    <th class="center">Sub Total</th>
	                    
	                </tr>
	            </thead>
	            <tbody>
					<?php
						$rownum = 1;
						$row_input = 0;
						$format_currency_counter = 0;
						$list_currency = 0;
						$list_semen["550"] = "Zak OPC 50 Kg";
						$list_semen["551"] = "Zak PCC 50 Kg";
						$list_semen["540"] = "Zak PCC 40 Kg";
						$list_semen["580"] = "Big Bag OPC";
						$list_semen["581"] = "Big Bag PCC";
						$list_semen["530"] = "Curah OPC";
						$list_semen["531"] = "Curah PCC";

						$jenis_angkutan["S4"]="Franco";
						$jenis_angkutan["ST"]="Intransit";

						if($list_of_data != null && count($list_of_data) > 0){
							foreach ($list_of_data as $data) {
								?>
									<tr>
										<td class="center"> 
											<?php echo $rownum++ ?> 
										</td>
										<td><?php echo ($data["RSDOCO"] != null && $data["RSDOCO"] != "" ? $data["RSKCOO"]."-".$data["RSDCTO"]."-".$data["RSDOCO"] : "&nbsp;")?></td>
										<td><?php echo ($data["RSTRDJ"] != null && $data["RSTRDJ"] != "" ? $data["RSTRDJ_GREGORIAN"]: "&nbsp;")?></td>
										<td><?php echo ($data["EMCU_DESC"] != null && $data["EMCU_DESC"] != "" ? $data["EMCU_DESC"]: "&nbsp;")?></td>
										<td><?php echo ($data["SHAN_DESC"] != null && $data["SHAN_DESC"] != "" ? $data["SHAN_DESC"]: "&nbsp;")?></td>
										<td><?php echo ($data["RSIR01"] != null && $data["RSIR01"] != "" ? $data["RSIR01"]: "&nbsp;")?></td>
										<td><?php echo ($data["RSIR02"] != null && $data["RSIR02"] != "" ? $data["RSIR02"]: "&nbsp;")?></td>
										<td><?php echo ($data["RSLITM"] != null && $data["RSLITM"] != "" ? $list_semen["".trim($data["RSLITM"])] : "&nbsp;")?></td>
										<td style="text-align: right"><?php echo ($data["RSUORG"] != null && $data["RSUORG"] != "" ? $data["RSUORG"] : "&nbsp;")?></td>
										<td class="format_currency_label<?php echo $format_currency_counter++ ?> format_currency_list" style="text-align: right"><?php echo ($data["RSLPRC"] != null && $data["RSLPRC"] != "" ? $data["RSLPRC"] / 10000 : "&nbsp;")?></td>
										<td class="format_currency_label<?php echo $format_currency_counter++ ?> format_currency_list" style="text-align: right"><?php echo ($data["RSTCST"] != null && $data["RSTCST"] != "" ? $data["RSTCST"] / 10000 : "&nbsp;")?></td>

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
	jQuery(document).ready(function(){
		//activator datatable
		TableDatatablesResponsive.init();
	})
</script>