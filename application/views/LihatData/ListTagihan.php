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
        <div class="portlet-body " id="SearchForm">
            <form role="form" method="POST">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group form-md-line-input has-success ">
                            <div class="">
                                <!-- <span class="input-group-addon">Dari</span> -->
                                <input class="form-control date-picker edited" size="16" type="text"  id="PDTRDJ_FROM" name="PDTRDJ_FROM"  value="<?php echo date("d-m-Y",strtotime($filter["PDTRDJ_FROM"]))?>" />
                                <label for="PDTRDJ_FROM">Tanggal</label>
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
                                <input class="form-control  date-picker edited" size="16" type="text"  id="PDTRDJ_TO" name="PDTRDJ_TO"  value="<?php echo date("d-m-Y",strtotime($filter["PDTRDJ_TO"]))?>" />
                                <label for="PDTRDJ_TO"></label>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="col-md-2 ">
                         <div class="form-actions noborder">
                            <input type="submit" name="btnSearch" value="Cari" class="btn blue">
                            <!-- <button type="submit" class="btn blue">Search</button> -->
                        </div>
                    </div>
                    <!-- <div class="form-actions noborder">
                        <input type="submit" name="btnSearch" value="Cari" class="btn blue">
                    </div> -->
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
	            <i class="fa fa-list"></i>Daftar Tagihan</div>
	        <div class="tools"> </div>
	    </div>
	    <div class="portlet-body">
	        <table class="table table-striped table-bordered table-hover order-column datatable_basic" id="data_list">
	            <thead>
	                <tr>
	                    <th class="center" width="5%">-</th>
	                    <th class="center" width="5%">No</th>
	                    <th class="center">Nomor Tagihan</th>
	                    <th class="center">Tanggal Tagihan</th>
	                    <th class="center">Jenis Semen</th>
	                    <th class="center">Quantity</th>
	                    <th class="center">Ongkos Angkut</th>
	                    <th class="center">Total</th>
	                    <th class="center">Status</th>
	                </tr>
	            </thead>
	            <tbody>
					<?php
						$rownum = 1;
						$row_input = 0;
						$format_currency_counter = 0;
						$list_currency = 0;
						$list_semen["C"] = "Curah / Big Bag";
						$list_semen["Z"] = "Zak";

						if($list_of_data != null && count($list_of_data) > 0){
							foreach ($list_of_data as $data) {
								$text_status = "<span class='font-red' >Tagihan Batal</span>";

								if($data["PDDOCO"] != null && $data["PDDOCO"] != "" && $data["PDDOCO"] != " "){
									if($data["PDNXTR"] != '999' && $data["PDLTTR"] != '980'){
										$text_status = "<span class='font-blue'>Menunggu BAST</span>";
									}
                                    if($data["PRDOCO"] != NULL && $data["PRDOCO"] != ""  && $data["PRDOCO"] != " "){
                                        $text_status = "<span class='font-yellow'>Proses Kelengkapan</span>";
                                    }
                                    if($data["PRDOCO"] != NULL && $data["PRDOCO"] != ""  && $data["PRDOCO"] != " "  && trim($data["PRMATC"]) == 2){
                                        $text_status = "<span class='font-green'>Tagihan Diverifikasi</span>";
                                    }
								}
								?>
									<tr>
										<td class="center" >
											<button class="btn green-jungle btn-xs btnModal" onclick="showDetailPopup('<?php echo ($data["PDDOCO"] != null && $data["PDDOCO"] != "" ? $data["PDKCOO"]."-".$data["PDDCTO"]."-".$data["PDDOCO"] : "&nbsp;")?>','<?php echo ($data["PDTRDJ"] != null && $data["PDTRDJ"] != "" ? $data["PDTRDJ_GREGORIAN"]: "&nbsp;")?>')">Detail</button>
										</td>
										<td class="center"> 
											<?php echo $rownum++ ?> 
										</td>
										<td><?php echo ($data["PDDOCO"] != null && $data["PDDOCO"] != "" ? $data["PDKCOO"]."-".$data["PDDCTO"]."-".$data["PDDOCO"] : "&nbsp;")?></td>
										<td><?php echo ($data["PDTRDJ"] != null && $data["PDTRDJ"] != "" ? $data["PDTRDJ_GREGORIAN"]: "&nbsp;")?></td>
										<td><?php echo ($data["DPFLAG02"] != null && trim($data["DPFLAG02"]) != "" ? $list_semen["".strtoupper(trim($data["DPFLAG02"]))] : "&nbsp;")?></td>
										<td style="text-align: right"><?php echo ($data["PDUORG"] != null && $data["PDUORG"] != "" ? $data["PDUORG"] : "&nbsp;")?></td>
										<td class="format_currency_label<?php echo $format_currency_counter++ ?> format_currency_list" style="text-align: right"><?php echo ($data["PDPRRC"] != null && $data["PDPRRC"] != "" ? $data["PDPRRC"] / 10000: "&nbsp;")?></td>
										<td class="format_currency_label<?php echo $format_currency_counter++ ?> format_currency_list" style="text-align: right"><?php echo ($data["PDAEXP"] != null && $data["PDAEXP"] != "" ? $data["PDAEXP"] / 10000: "&nbsp;")?></td>
										<td><?php echo $text_status ?></td>
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
	jQuery(document).ready(function(){
		//activator datatable
		TableDatatablesResponsive.init();
	})
</script>
<script type="text/javascript">
	function showDetailPopup(po_number, po_date){
		jQuery("#data_list_popupPreview tbody tr").remove();
		App.blockUI();
        $.ajax({
            type: "GET",
            url: '<?php echo base_url()?>LihatData/getJSONDObyPO?po_number='+po_number,
            dataType: 'json',
            success: function(json) {
            	var table_data = jQuery("#data_list_popupPreview tbody");
            	var row_template = "";
            	var row_index = 0;
            	var initial_currency_counter  = <?php echo $format_currency_counter ?>;
            	var curr_id_counter  = 0;
            	var grand_total = 0;
                var total_qty = 0;

                $.each(json, function(index, data_value){
                	var row_template = "<tr>"+
                    		"<td style='text-align:center'>"+(index + 1)+"</td>"+
                    		"<td>" +data_value.RSKCOO+"-"+data_value.RSDCTO+"-"+data_value.RSDOCO+"</td>"+
                    		"<td>"+data_value.RSTRDJ_GREGORIAN+"</td>"+
                            "<td>"+data_value.EMCU_DESC+"</td>"+
                            "<td>"+data_value.SHAN_DESC+"</td>"+
                            "<td>"+data_value.RSIR01+"</td>"+
                            "<td>"+data_value.RSIR02+"</td>"+
                    		"<td>"+data_value.RSLITM_DESC+"</td>"+
                    		"<td style='text-align: right'>"+data_value.RSUORG+"</td>"+
                    		"<td style='text-align: right' class='format_currency_label"+(initial_currency_counter++)+" format_currency_list' id='curr_"+ (curr_id_counter++) +"' >"+ (parseFloat(data_value.RSLPRC) / 10000) +"</td>"+
                    		"<td style='text-align: right' class='format_currency_label"+(initial_currency_counter++)+" format_currency_list' id='curr_"+ (curr_id_counter++) +"'>"+ (parseFloat(data_value.RSTCST) / 10000)+"</td>"+
                    	"</tr>";

                    table_data.append(row_template);
                    formatCurrencyByIdLabel("curr_"+(curr_id_counter-1));
                    formatCurrencyByIdLabel("curr_"+(curr_id_counter-2));
                    grand_total += (parseFloat(data_value.RSTCST) / 10000);
                    total_qty += (parseFloat(data_value.RSUORG));
                })
                jQuery("#grand_total_quantity").html(total_qty);
                jQuery("#grand_total").html(grand_total);

                formatCurrencyByIdLabel("grand_total");

                jQuery("#btnPrint").click(function(){
                	window.location.href = "<?php echo base_url()?>LihatData/PrintListDO?po_number="+po_number+"&po_date="+po_date;
                })

                jQuery("#po_numb_lbl").html(po_number);
                jQuery("#popupPreview").modal("show");
            },
            complete: function(){
                App.unblockUI();
            }
        });
	}
</script>

<!-- MODAL SECTION -->
<div class="modal fade" id="popupPreview" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog" style="width: 90%;"s>
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" >Detail</h4>
            </div>
            <div class="modal-body">                 
                <div class="portlet-body">
                    <div class="portlet box blue-steel">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-list"></i>Daftar Delivery Order || No Tagihan : <span id="po_numb_lbl"></span></div>
                            <div class="tools"> </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover order-column datatable_basic" id="data_list_popupPreview" width="100%"> 
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
                            <label class="bold">Total Quantity : <span id="grand_total_quantity">0</span></label><br>   
                            <label class="bold">Total : <span id="grand_total">0</span></label>
                        </div>
                    	<input type="hidden" name="grand_total" id="grand_total_input">
                    </div>
                </div>
             </div>
            <div class="modal-footer">
                <a class="btn blue btn-outline" id="btnPrint">Download</a>
                <button type="button" class="btn red btn-outline" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
