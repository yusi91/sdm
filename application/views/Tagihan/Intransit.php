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
        </div>
        <div class="portlet-body " id="SearchForm">
            <form role="form" method="POST">
	            <div class="row">
	                <div class="col-md-2">
	                    <div class="form-group form-md-line-input has-success ">
	                        <div class="">
	                            <input class="form-control date-picker edited" size="16" type="text"  id="RSTRDJ_FROM" name="RSTRDJ_FROM"  value="<?php echo date("d-m-Y",strtotime($filter["RSTRDJ_FROM"]))?>" />
	                            <label for="RSTRDJ_FROM">Tanggal</label>
	                        </div>
	                    </div>

	                </div>
	                
					<div class="col-md-1">
	                    <div class="form-group sd_label form-md-line-input has-success center">
	                        <label ><br>s/d</label>
	                    </div>
	                </div>

	                <div class="col-md-2">
	                    <div class="form-group form-md-line-input has-success ">
	                        <div class="">
	                            <input class="form-control  date-picker edited" size="16" type="text"  id="RSTRDJ_TO" name="RSTRDJ_TO"  value="<?php echo date("d-m-Y",strtotime($filter["RSTRDJ_TO"]))?>" />
	                            <label for="RSTRDJ_TO"></label>
	                        </div>
	                    </div>
	                </div>
	                <div class="col-md-2">
	                    <div class="form-group form-md-line-input form-md-floating-label has-success">
			                <select class="form-control edited " id="RSKCOO" name="RSKCOO">
			                    <?php 
			                        if($ComboRSKCOO != null && count($ComboRSKCOO) > 0){
			                            foreach ($ComboRSKCOO as $combo_value) {
			                                $selected = "";
			                                if($filter["RSKCOO"] != null && $filter["RSKCOO"] != ""){
			                                    if($filter["RSKCOO"] == $combo_value["id"]){
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
			                <label for="RSKCOO">Site </label>
		            	</div>
	                </div>
	                
	                <div class="col-md-2">
	                    <div class="form-group form-md-line-input form-md-floating-label has-success">
			                <select class="form-control edited " id="JenisSemen" name="JenisSemen">
			                    <?php 
			                        if($ComboJenisSemen != null && count($ComboJenisSemen) > 0){
			                            foreach ($ComboJenisSemen as $combo_value) {
			                                $selected = "";
			                                if($filter["JenisSemen"] != null && $filter["JenisSemen"] != ""){
			                                    if($filter["JenisSemen"] == $combo_value["id"]){
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
			                <label for="JenisSemen">Jenis Semen </label>
		            	</div>
	                </div>
	                <br>
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
 	<label class="bold">Nomor Tagihan Sebelumnya : <?php echo $prev_number?></label>
</div>
<!-- END FILTER Tagihan -->

<!-- BEGIN BUTTON -->
<?php 
	if($list_of_data != null && count($list_of_data) > 0){
		?>			
			<div class="">
				<div class="md-checkbox form pull-left ">
					<input type="checkbox" id="cb_all"  class="md-check">
                    <label for="cb_all">
                        <span></span>
                        <span class="check"></span>
                        <span class="box"></span>Pilih Semua</label>
                </div>
				<div class="form pull-right hidden_type_1" id="btnCreate" style="margin: 5px"><a href="javascript:;" class="btn green-jungle">Proses</a></div>
			</div>
		<?php
	}
?>
<!-- END BUTTON -->

<!-- BEGIN TABLE PORTLET-->
 <div class="portlet-body">
	<div class="portlet box blue">
	    <div class="portlet-title">
	        <div class="caption">
	            <i class="fa fa-list"></i>Daftar Tagihan</div>
	        <div class="tools"> </div>
	    </div>
	    <div class="portlet-body" >
	    <style type="text/css">
	    	table tr td{
	    		white-space: nowrap !important;
	    	}
	    </style>
	        <table class="table table-striped table-bordered table-hover order-column datatable_scroll_2" id="data_list" width="100%">
	            <thead>
	                <tr>
	                    <th class="center" width="5%">-</th>
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

						//NOTES:
						//rule data yang ditampilkan adalah data yang:
						//1. jika SRP3 dari W55RS05 = LS maka EMCU dari W55RS05 harus palembang (500400) dan lampung (510000)
						//2. jika DO telah dibuat PO (NXTR = 400 && LTTR = 280) maka data tidak ditampilkan, tapi jika PO telah dibatalkan (NXTR = 999 && LTTR = 980) maka data DO akan ditampilkan

						if($list_of_data != null && count($list_of_data) > 0){
							foreach ($list_of_data as $data) {
								if(trim($data["RSSRP3"]) == "LS"){
									if(!(trim($data["RSEMCU"]) == "500400" || trim($data["RSEMCU"]) == "510000")){
										continue;
									}
								}
								if($data["PDDOCO"] != null && $data["PDDOCO"] != "" && $data["PDDOCO"] != " "){
									if(trim( $data["PDLTTR"]) != '980'){
										continue;
									}
								}
								?>
									<tr id="_row_<?php echo $rownum ?>" class='row_table_data_list'>
										<td class="center">
											<?php
												if($data["RSLPRC"] > 0 && $data["RSTCST"] > 0){
													?>
														<input type="checkbox" name="do_numb[]" value="<?php echo $row_input?>" id="do_numb_<?php echo $rownum ?>" class="cb_do_numb cb_selected_flag"  >
													<?php 
												}
												else if($data["RSUORG"] < 0){
													?>
														<input type="checkbox" name="do_numb[]" value="<?php echo $row_input?>" id="do_numb_<?php echo $rownum ?>" class="cb_do_minus cb_selected_flag" onclick="return false;" checked>
													<?php 
												}
											?>
										</td>
										<td class="center"> 
											<?php echo $rownum++; ?> 
											<input type="hidden" id="_col_1_<?php echo $row_input?>" value="<?php echo ($data["RSDOCO"] != null && $data["RSDOCO"] != "" ? $data["RSKCOO"]."-".$data["RSDCTO"]."-".$data["RSDOCO"] : "&nbsp;")?>">
											<input type="hidden" id="_col_2_<?php echo $row_input?>" value="<?php echo ($data["PDDOCO"] != null && $data["PDDOCO"] != "" ? $data["PDKCOO"]."-".$data["PDDCTO"]."-".$data["PDDOCO"] : "&nbsp;")?>">
											<input type="hidden" id="_col_3_<?php echo $row_input?>" value="<?php echo ($data["RSTRDJ"] != null && $data["RSTRDJ"] != "" ? $data["RSTRDJ_GREGORIAN"]: "&nbsp;")?>">
											<input type="hidden" id="_col_4_<?php echo $row_input?>" value="<?php echo ($data["RSLITM"] != null && $data["RSLITM"] != "" ? $list_semen["".trim($data["RSLITM"])] : "&nbsp;")?>">
											<input type="hidden" id="_col_5_<?php echo $row_input?>" value="<?php echo ($data["RSUORG"] != null && $data["RSUORG"] != "" ? $data["RSUORG"] : "&nbsp;")?>">
											<input type="hidden" id="_col_6_<?php echo $row_input?>" value="<?php echo ($data["RSLPRC"] != null && $data["RSLPRC"] != "" ? $data["RSLPRC"] / 10000: "&nbsp;")?>">
											<input type="hidden" id="_col_7_<?php echo $row_input?>" value="<?php echo ($data["RSTCST"] != null && $data["RSTCST"] != "" ? $data["RSTCST"] / 10000: "&nbsp;")?>">
											<input type="hidden" id="_col_8_<?php echo $row_input?>" value="<?php echo ($data["RSTRDJ"] != null && $data["RSTRDJ"] != "" ? $data["RSTRDJ"] : "&nbsp;")?>">
											<input type="hidden" id="_col_9_<?php echo $row_input?>" value="<?php echo ($data["RSLITM"] != null && $data["RSLITM"] != "" ? $data["RSLITM"] : "&nbsp;")?>">
											<input type="hidden" id="_col_10_<?php echo $row_input?>" value="<?php echo ($data["EMCU_DESC"] != null && $data["EMCU_DESC"] != "" ? $data["EMCU_DESC"] : "&nbsp;")?>">
											<input type="hidden" id="_col_11_<?php echo $row_input?>" value="<?php echo ($data["SHAN_DESC"] != null && $data["SHAN_DESC"] != "" ? $data["SHAN_DESC"] : "&nbsp;")?>">
											<input type="hidden" id="_col_12_<?php echo $row_input?>" value="<?php echo ($data["RSIR02"] != null && $data["RSIR02"] != "" ? $data["RSIR02"] : "&nbsp;")?>">
											<input type="hidden" id="_col_13_<?php echo $row_input?>" value="<?php echo ($data["RSIR01"] != null && $data["RSIR01"] != "" ? $data["RSIR01"] : "&nbsp;")?>"> 
											<?php $row_input++ ?>
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
										<td class="format_currency_label<?php echo $format_currency_counter++ ?> format_currency_list" style="text-align: right"><?php echo ($data["RSTCST"] != null && $data["RSTCST"] != "" ? $data["RSTCST"] / 10000: "&nbsp;")?></td>

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

<!-- TEMPORARY TABLE -->
<table class="table table-striped table-bordered table-hover order-column " id="data_list_temporary" width="100%" style="display: none;">
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

						//NOTES:
						//rule data yang ditampilkan adalah data yang:
						//1. jika SRP3 dari W55RS05 = LS maka EMCU dari W55RS05 harus palembang (500400) dan lampung (510000)
						//2. jika DO telah dibuat PO (NXTR = 400 && LTTR = 280) maka data tidak ditampilkan, tapi jika PO telah dibatalkan (NXTR = 999 && LTTR = 980) maka data DO akan ditampilkan

						if($list_of_data != null && count($list_of_data) > 0){
							foreach ($list_of_data as $data) {
								if(trim($data["RSSRP3"]) == "LS"){
									if(!(trim($data["RSEMCU"]) == "500400" || trim($data["RSEMCU"]) == "510000")){
										continue;
									}
								}

								if($data["PDDOCO"] != null && $data["PDDOCO"] != "" && $data["PDDOCO"] != " "){
									if(trim( $data["PDLTTR"]) != '980'){
										continue;
									}
								}

								?>
									<tr id="_row_temporary_<?php echo $rownum ?>" class='row_table_data_list_temp'>
										<td class="center"> 
											<?php echo $rownum++ ?> 
											<input type="hidden" id="col_1_<?php echo $row_input?>" value="<?php echo ($data["RSDOCO"] != null && $data["RSDOCO"] != "" ? $data["RSKCOO"]."-".$data["RSDCTO"]."-".$data["RSDOCO"] : "&nbsp;")?>">
											<input type="hidden" id="col_2_<?php echo $row_input?>" value="<?php echo ($data["PDDOCO"] != null && $data["PDDOCO"] != "" ? $data["PDKCOO"]."-".$data["PDDCTO"]."-".$data["PDDOCO"] : "&nbsp;")?>">
											<input type="hidden" id="col_3_<?php echo $row_input?>" value="<?php echo ($data["RSTRDJ"] != null && $data["RSTRDJ"] != "" ? $data["RSTRDJ_GREGORIAN"]: "&nbsp;")?>">
											<input type="hidden" id="col_4_<?php echo $row_input?>" value="<?php echo ($data["RSLITM"] != null && $data["RSLITM"] != "" ? $list_semen["".trim($data["RSLITM"])] : "&nbsp;")?>">
											<input type="hidden" id="col_5_<?php echo $row_input?>" value="<?php echo ($data["RSUORG"] != null && $data["RSUORG"] != "" ? $data["RSUORG"] : "&nbsp;")?>">
											<input type="hidden" id="col_6_<?php echo $row_input?>" value="<?php echo ($data["RSLPRC"] != null && $data["RSLPRC"] != "" ? $data["RSLPRC"] / 10000: "&nbsp;")?>">
											<input type="hidden" id="col_7_<?php echo $row_input?>" value="<?php echo ($data["RSTCST"] != null && $data["RSTCST"] != "" ? $data["RSTCST"] / 10000: "&nbsp;")?>">
											<input type="hidden" id="col_8_<?php echo $row_input?>" value="<?php echo ($data["RSTRDJ"] != null && $data["RSTRDJ"] != "" ? $data["RSTRDJ"] : "&nbsp;")?>">
											<input type="hidden" id="col_9_<?php echo $row_input?>" value="<?php echo ($data["RSLITM"] != null && $data["RSLITM"] != "" ? $data["RSLITM"] : "&nbsp;")?>">
											<input type="hidden" id="col_10_<?php echo $row_input?>" value="<?php echo ($data["EMCU_DESC"] != null && $data["EMCU_DESC"] != "" ? $data["EMCU_DESC"] : "&nbsp;")?>">
											<input type="hidden" id="col_11_<?php echo $row_input?>" value="<?php echo ($data["SHAN_DESC"] != null && $data["SHAN_DESC"] != "" ? $data["SHAN_DESC"] : "&nbsp;")?>">
											<input type="hidden" id="col_12_<?php echo $row_input?>" value="<?php echo ($data["RSIR02"] != null && $data["RSIR02"] != "" ? $data["RSIR02"] : "&nbsp;")?>">
											<input type="hidden" id="col_13_<?php echo $row_input?>" value="<?php echo ($data["RSIR01"] != null && $data["RSIR01"] != "" ? $data["RSIR01"] : "&nbsp;")?>">

											<?php $row_input++ ?>
										</td>
										<!-- <td><?php echo ($data["RSDOCO"] != null && $data["RSDOCO"] != "" ? $data["RSKCOO"]."-".$data["RSDCTO"]."-".$data["RSDOCO"] : "&nbsp;")?></td>
										<td><?php echo ($data["RSTRDJ"] != null && $data["RSTRDJ"] != "" ? $data["RSTRDJ_GREGORIAN"]: "&nbsp;")?></td>
										<td><?php echo ($data["EMCU_DESC"] != null && $data["EMCU_DESC"] != "" ? $data["EMCU_DESC"]: "&nbsp;")?></td>
										<td><?php echo ($data["SHAN_DESC"] != null && $data["SHAN_DESC"] != "" ? $data["SHAN_DESC"]: "&nbsp;")?></td>
										<td><?php echo ($data["RSIR01"] != null && $data["RSIR01"] != "" ? $data["RSIR01"]: "&nbsp;")?></td>
										<td><?php echo ($data["RSIR02"] != null && $data["RSIR02"] != "" ? $data["RSIR02"]: "&nbsp;")?></td>
										<td><?php echo ($data["RSLITM"] != null && $data["RSLITM"] != "" ? $list_semen["".trim($data["RSLITM"])] : "&nbsp;")?></td>
										<td style="text-align: right"><?php echo ($data["RSUORG"] != null && $data["RSUORG"] != "" ? $data["RSUORG"] : "&nbsp;")?></td>
										<td class="format_currency_label<?php echo $format_currency_counter++ ?> format_currency_list" style="text-align: right"><?php echo ($data["RSLPRC"] != null && $data["RSLPRC"] != "" ? $data["RSLPRC"] / 10000 : "&nbsp;")?></td>
										<td class="format_currency_label<?php echo $format_currency_counter++ ?> format_currency_list" style="text-align: right"><?php echo ($data["RSTCST"] != null && $data["RSTCST"] != "" ? $data["RSTCST"] / 10000: "&nbsp;")?></td> -->

									</tr>
								<?php
							}
						}
					?>
		        </tbody>
	        </table>
<!-- END TEMPORARY TABLE -->
<!-- END TABLE PORTLET-->

<!-- BEGIN JQUERY SECTION -->
<script>
	var initial_currency_counter = <?php echo $format_currency_counter?>;
	var curr_id_counter = 0;

	jQuery(document).ready(function(){
		//checkbox check all
		jQuery("#cb_all").click(function(){
			var table = jQuery("#data_list").dataTable();

			table.$('.cb_do_numb').each(function(index, data){
				if(jQuery("#cb_all").filter(':checked').length > 0){
					jQuery(this).prop('checked', true);
				}
				else{
					jQuery(this).prop('checked', false);
				}
			})
		})

		//activator datatables
		TableDatatablesResponsive.init();

		//validate required deskripsi field on popup
		jQuery("#btnSubmitOK").click(function(){
			if(jQuery("#deskripsi").val().trim() == "" ){
				alert("Silahkan Mengisi Field Deskripsi");
				return event.preventDefault();
			}
		});

		jQuery("#btnCreate").click(function(){
			var table = jQuery("#data_list").dataTable();	
			//validate required min 1 checked DO to show popup
			if(!(table.$(".cb_do_numb ").filter(':checked').length) > 0 && !(table.$(".cb_do_minus ").filter(':checked').length) > 0){
				alert("Silahkan Pilih Nomor DO");
				return false;
			}

			//append table on popup with template on variable row_template
			if(confirm("Proses DO yang Terpilih Untuk Dijadikan Tagihan?")){
				jQuery("#grand_total").text(0);
				jQuery("#grand_total_input").val(0);
				jQuery("#grand_total_quantity").text(0);

				// console.log(table.$(".cb_selected_flag "));
				var list_do = table.$(".cb_selected_flag ").filter(':checked');
				jQuery("#data_list_popupPreview tbody tr").remove();
				//process the selected DO data
				list_do.each(function(index,data){
					// console.log(data);
					var row_index = data.value;
					var row_template = "<tr>"+
                    		"<td style='text-align:center'>"+(index + 1)+"</td>"+
                    		"<td>" +jQuery("#col_1_"+row_index).val() +"</td>"+
                    		"<td>"+jQuery("#col_3_"+row_index).val()+"</td>"+
                    		"<td>"+jQuery("#col_10_"+row_index).val()+"</td>"+
                    		"<td>"+jQuery("#col_11_"+row_index).val()+"</td>"+
                    		"<td>"+jQuery("#col_12_"+row_index).val()+"</td>"+
                    		"<td>"+jQuery("#col_13_"+row_index).val()+"</td>"+
                    		"<td>"+jQuery("#col_4_"+row_index).val()+"</td>"+
                    		"<td style='text-align: right'>"+jQuery("#col_5_"+row_index).val()+"</td>"+
                    		"<td style='text-align: right' class='format_currency_label"+(initial_currency_counter)+" format_currency_list' id='curr_"+ (curr_id_counter) +"' >"+jQuery("#col_6_"+row_index).val()+"</td>"+
                    		"<td style='text-align: right' class='format_currency_label"+(initial_currency_counter + 1)+" format_currency_list' id='curr_"+ (curr_id_counter + 1) +"'>"+jQuery("#col_7_"+row_index).val()+"</td>"+
                    	"</tr>";

                    var input_template = '<input type="hidden" value="'+jQuery("#col_1_"+row_index).val()+'" name="do_numb[]">';
                    input_template += '<input type="hidden" value="'+jQuery("#col_8_"+row_index).val()+'" name="RSTRDJ[]">';
                    input_template += '<input type="hidden" value="'+jQuery("#col_9_"+row_index).val()+'" name="RSLITM[]">';
                    input_template += '<input type="hidden" value="'+jQuery("#col_5_"+row_index).val()+'" name="RSUORG[]">';
                    input_template += '<input type="hidden" value="'+jQuery("#col_6_"+row_index).val()+'" name="RSLPRC[]">';
                    input_template += '<input type="hidden" value="'+jQuery("#col_7_"+row_index).val()+'" name="sub_total[]">';

                    row_template += input_template;

                    jQuery("#data_list_popupPreview  tbody:last-child ").append(row_template);
                    jQuery("#grand_total").text(parseFloat( jQuery("#grand_total").text()) + parseFloat(jQuery("#col_7_"+ row_index ).val())) ;
                    jQuery("#grand_total_quantity").text(parseFloat( jQuery("#grand_total_quantity").text()) + parseFloat(jQuery("#col_5_"+ row_index ).val())) ;
                    jQuery("#grand_total_input").val(jQuery("#grand_total").text()) ;

                	formatCurrencyByIdLabel("curr_"+ (curr_id_counter++));
                	formatCurrencyByIdLabel("curr_"+ (curr_id_counter++));
				})
				
                formatCurrencyByIdLabel("grand_total");
                jQuery("#deskripsi").val("Intransit <?php echo date("d/m/y",strtotime($filter["RSTRDJ_FROM"]))?> - <?php echo date("d/m/y",strtotime($filter["RSTRDJ_TO"]))?>") ;
				jQuery('#popupPreview ').modal('show');
			}
		}) ;
	});
</script>
<script type="text/javascript">
	function formatCurrencyByIdLabel(id){
		var element = document.getElementById(id);
	    if (!$.isNumeric($(element).text())) $(element).text('0');
	    $(element).text("Rp. "+parseFloat($(element).text(), 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
	}
</script>
<style type="text/css">
	.form-group{
		margin-bottom: 5px !important;
	}
</style>

<!-- MODAL SECTION -->
<form method="POST" action="<?php echo base_url()?>Tagihan/inputTagihan">
	<div class="modal fade" id="popupPreview" tabindex="-1" role="basic" aria-hidden="true">
	    <div class="modal-dialog" style="width: 90%;">
	        <div class="modal-content" >
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	                <h4 class="modal-title" >Preview</h4>
	            </div>
	            <div class="modal-body">                 
	                <div class="portlet-body">
	                    <div class="portlet box blue-steel">
	                        <div class="portlet-title">
	                            <div class="caption">
	                                <i class="fa fa-list"></i>Daftar Delivery Order</div>
	                            <div class="tools"> </div>
	                        </div>
	                        <div class="portlet-body" style="height: 300px !important; overflow-x: scroll !important; overflow-y: scroll !important; ">
	                        	<table class="table table-striped table-bordered table-hover order-column " id="data_list_popupPreview" width="100%" style="overflow-x: scroll !important; overflow-y: scroll !important; " >
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
	                                    
	                                </tbody>
	                            </table>
	                        </div>
	                    </div>
                        <div>
                        	<div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Deskripsi" maxlength="30" name="deskripsi" id="deskripsi"> 
                                <input type="hidden" class="form-control" placeholder="Deskripsi" maxlength="30" name="url_from" id="url_from" value="Intransit"> 
                            </div>
                            <br>
							<div class="input-group">
								<label class="bold">Total Quantity : <span id="grand_total_quantity">0</span></label><br>
                                <label class="bold">Total Harga &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <span id="grand_total">0</span></label>
                            </div>
                        	<input type="hidden" name="grand_total" id="grand_total_input">
                        </div>
	                </div>
	             </div>
	            <div class="modal-footer">
	                <input type="submit" class="btn blue btn-outline"  value="Ok" id="btnSubmitOK">
	                <button type="button" class="btn red btn-outline" data-dismiss="modal">Batal</button>
	            </div>
	        </div>
	    </div>
	</div>
</form>
