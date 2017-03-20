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
	                    <div class="form-group form-md-line-input has-success ">
	                        <div class="">
	                            <input class="form-control date-picker edited" size="16" type="text"  id="rzdmtj_from" name="rzdmtj_from"  value="<?php echo date("d-m-Y",strtotime($filter["rzdmtj_from"]))?>" />
	                            <label for="rzdmtj_from">Tanggal Setoran</label>
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
	                            <input class="form-control  date-picker edited" size="16" type="text"  id="rzdmtj_to" name="rzdmtj_to"  value="<?php echo date("d-m-Y",strtotime($filter["rzdmtj_to"]))?>" />
	                            <label for="rzdmtj_to"></label>
	                        </div>
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
        	<label class="font-red">
        		*Data yang dapat diakses hanya data 3 bulan ke belakang.
        	</label>
	    </div>
	</div>
</div>
<!-- END FILTER Tagihan -->

<!-- BEGIN TABLE PORTLET-->
 <div class="portlet-body">
 <?php 
 	if($list_of_data != null && count($list_of_data) > 0){
 		?>
		    <form action="<?php echo base_url()?>PembayaranFaktur/ExportExcel" method="POST">
		    	<input type="hidden" value="<?php echo $filter["rzdmtj_from"]?>" name="rzdmtj_from">
		    	<input type="hidden" value="<?php echo $filter["rzdmtj_to"]?>" name="rzdmtj_to">
		    	<button type="submit"  class="btn yellow-gold"> <i class="fa fa-file-excel-o "></i> Export Excel</button>
		    </form>
 		<?php 
 	}
 ?>

	<div class="portlet box GREEN-JUNGLE ">
	    <div class="portlet-title">
	        <div class="caption">
	            <i class="fa fa-list"></i>Daftar Pembayaran Faktur</div>
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
	                    <th class="center">Distributor</th>
	                    <th class="center">Pay ID</th>
	                    <th class="center">No Setoran</th>
	                    <th class="center">Line ID</th>
	                    <th class="center">Tanggal Setoran</th>
	                    <th class="center">Pembayaran</th>
	                    <th class="center">No Faktur</th>
	                    <th class="center">Line No</th>
	                    <th class="center">Tanggal Faktur</th>
	                    <th class="center">Jatuh Tempo</th>
	                    <th class="center">-</th>
	                </tr>
	            </thead>
	            <tbody>
					<?php
						$rownum = 1;
						$row_input = 0;
						$format_currency_counter = 0;
						$list_currency = 0;

						if($list_of_data != null && count($list_of_data) > 0){
							//list di CDS lama cuma 3,5,9
							$list_jenis_bayar["3"] = "Tunai";
							$list_jenis_bayar["5"] = "DF";
							$list_jenis_bayar["9"] = "Kredit";
							//list jenis bayar di cds yang baru
							$list_jenis_bayar["1"] = "Transfer";
							$list_jenis_bayar["2"] = "Tunai Berjangka";
							$list_jenis_bayar["6"] = "Askredag";

							foreach ($list_of_data as $data) {

								?>
									<tr id="_row_<?php echo $rownum ?>" class='row_table_data_list'>
										<td class="center"> <?php echo $rownum++; ?></td>
										<td><?php echo ($data["rzan8_kode"] != null && $data["rzan8_kode"] != "" ?"[".$data["rzan8_kode"]."] ".$data["rzan8_nama"] : "&nbsp;")?></td>
										<td><?php echo ($data["rzpyid"] != null && $data["rzpyid"] != "" ? $data["rzpyid"]: "&nbsp;")?></td>
										<td><?php echo ($data["rzcknu"] != null && $data["rzcknu"] != "" ? $data["rzcknu"]: "&nbsp;")?></td>
										<td><?php echo ($data["rzrc5"] != null && $data["rzrc5"] != "" ? $data["rzrc5"]: "&nbsp;")?></td>
										<td><?php echo ($data["rzdmtj"] != null && $data["rzdmtj"] != "" ? date("d-m-Y", strtotime($data["rzdmtj"])): "&nbsp;")?></td>
										<td class="format_currency_label<?php echo $format_currency_counter++ ?> format_currency_list" style="text-align: right"><?php echo ($data["rzpaap"] != null && $data["rzpaap"] != "" ? $data["rzpaap"]: "&nbsp;")?></td>
										<td><?php echo ($data["rzdoc"] != null && $data["rzdoc"] != "" ?  $data["rzkco"]."-". $data["rzdct"]."-".$data["rzdoc"]: "&nbsp;")?></td>
										<td><?php echo ($data["rzsfx"] != null && $data["rzsfx"] != "" ? $data["rzsfx"]: "&nbsp;")?></td>
										<td><?php echo ($data["rzidgj"] != null && $data["rzidgj"] != "" ? date("d-m-Y", strtotime($data["rzidgj"])): "&nbsp;")?></td>
										<td><?php echo ($data["rzddj"] != null && $data["rzddj"] != "" ? date("d-m-Y", strtotime($data["rzddj"])): "&nbsp;")?></td>
										<td class="center">
											<a class="btn btn-xs green" href="#" onclick="showPopupDetailFaktur('<?php echo $data["rzkco"] ?>','<?php echo $data["rzdct"] ?>','<?php echo $data["rzdoc"] ?>')">Detail Faktur</a>
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

<!-- BEGIN JQUERY SECTION -->
<script type="text/javascript">
	jQuery(document).ready(function() {
	    TableDatatablesResponsive.init();
	});
</script>

<script type="text/javascript">
	function showPopupDetailFaktur(kco, dct, doc){
		setButtonExportExcel(kco, dct, doc);
    	jQuery("#btnExportExcelSPJ").hide();
    	jQuery("#btnExportExcelInvoice").hide();
    	jQuery("#btnPrintInvoice").hide();
		App.blockUI();
		var dt = $('#list_data_spj').DataTable();
		dt.clear().draw();

        $.ajax({
            type: "GET",
            url: '<?php echo base_url()?>PembayaranFaktur/getJSONDetailFaktur?doc='+doc+'&dct='+dct+'&kco='+kco ,
            dataType: 'json',
            success: function(json) {
                jQuery("#lbl_no_faktur").text(json.no_faktur);
                jQuery("#lbl_line_no").text(json.line_no);
                jQuery("#lbl_jenis_bayar").text(json.jenis_bayar);
                jQuery("#lbl_tanggal_faktur").text(json.tanggal_faktur);
                jQuery("#lbl_jenis_tempo").text(json.jatuh_tempo);
                jQuery("#lbl_nilai_faktur").text(json.nilai_faktur);
                jQuery("#lbl_nilai_open").text(json.nilai_open);

                formatCurrencyByIdLabel("lbl_nilai_faktur");
                formatCurrencyByIdLabel("lbl_nilai_open");
                //get list data DO ===============================================================================================
                $.ajax({
		            type: "GET",
		            url: '<?php echo base_url()?>PembayaranFaktur/getJSONDetailDObyFaktur?doc='+doc+'&dct='+dct+'&kco='+kco ,
		            dataType: 'json',
		            success: function(json_do) {
		            	jQuery("#btnExportExcelSPJ").show();
		            	jQuery("#btnExportExcelInvoice").show();
		            	jQuery("#btnPrintInvoice").show();

		            	$.each(json_do,function(index,val){
		            		var arr = [];
		            		$.each(val,function(index_, val_){
		            			arr.push(val_);
		            		})
		                	dt.row.add(arr).draw().nodes();
		            	})
		            	
		            }
		        });
                //================================================================================================================
                jQuery("#PopupDetailFaktur").modal("show");
            },
            complete: function(){
                App.unblockUI();
            }
        });
	}

	function setButtonExportExcel(kco, dct, doc){
		jQuery("#btnExportExcelSPJ").click(function(){
			window.location.href = "<?php echo base_url()?>PembayaranFaktur/exportExcelSPJ?kco="+kco+"&dct="+dct+"&doc="+doc;
		})
		jQuery("#btnExportExcelInvoice").click(function(){
			window.location.href = "<?php echo base_url()?>PembayaranFaktur/exportExcelInvoice?kco="+kco+"&dct="+dct+"&doc="+doc;
		})
		jQuery("#btnPrintInvoice").click(function(){
			window.location.href = "<?php echo base_url()?>PembayaranFaktur/printInvoice?kco="+kco+"&dct="+dct+"&doc="+doc;
		})

	}
</script>
<style type="text/css">
	.form-group{
		margin-bottom: 5px !important;
	}
</style>

<!-- MODAL SECTION -->
<div class="modal fade" id="PopupDetailFaktur" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog" style="width: 90%;"s>
        <div class="modal-content" >
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" >Detail Faktur</h4>
            </div>
            <div class="modal-body">                 
                <div class="portlet-body">
                	<div class="form form-group">
                		<div class="row">
                			<div class="col-md-4">
                				<label class="bold">No Faktur : </label> <span id="lbl_no_faktur"></span>		
                			</div>
                			<div class="col-md-4">
                				<label class="bold">Line No : </label> <span id="lbl_line_no"></span>		
                			</div>
                			<div class="col-md-4">
                				<label class="bold">Jenis Bayar : </label> <span id="lbl_jenis_bayar"></span>		
                			</div>
                		</div>
                		<div class="row">
                			<div class="col-md-4">
                				<label class="bold">Tanggal Faktur : </label> <span id="lbl_tanggal_faktur"></span>		
                			</div>
                			<div class="col-md-4">
                				<label class="bold">Jatuh Tempo : </label> <span id="lbl_jenis_tempo"></span>		
                			</div>
                		</div>
                		<div class="row">
                			<div class="col-md-4">
                				<label class="bold">Nilai Faktur : </label> <span id="lbl_nilai_faktur"></span>		
                			</div>
                			<div class="col-md-4">
                				<label class="bold">Nilai Open : </label> <span id="lbl_nilai_open"></span>		
                			</div>
                		</div>
                	</div>
                	<div class="row">
            			<div class="col-md-12">
		                	<a class="btn green-meadow btn-outline" id="btnExportExcelSPJ" href="#">Excel SPJ</a>
		                	<a class="btn green-meadow btn-outline" id="btnExportExcelInvoice" href="#">Excel Invoice</a>
            			</div>
            		</div>
                	<br>
                    <div class="portlet box green-dark">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-list"></i>Daftar DO</div>
                            <div class="tools"> </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover order-column datatable_colReorder" id="list_data_spj" width="100%"> 
                                <thead>
                                    <tr>
                                    	<th class="center" width="5%">No SPJ</th>
										<th class="center">Tujuan</th>
										<th class="center">Tgl SPJ</th>
										<th class="center">Kota Tujuan</th>
										<th class="center">Bayar</th>
										<th class="center">Kuantiti</th>
										<th class="center">Satuan</th>
										<th class="center">Harga Satuan</th>
										<th class="center">Harga Tebus</th>
										<th class="center">Angkut</th>
										<th class="center">Nopol</th>
										<th class="center">Ekspeditur</th>
										<th class="center">Ket</th>		
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
             </div>
            <div class="modal-footer">
                <a class="btn yellow-gold btn-outline" id="btnPrintInvoice" href="#">Print Invoice</a>
                <button type="button" class="btn red btn-outline" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
