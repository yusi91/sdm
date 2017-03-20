
<div class="portlet-title ">
    <div class="caption">
        <span class="caption-subject font-red bold uppercase"><?php 
            if(!empty($expeditur)){
                
                    echo $expeditur['name'];
                
            }
        ?></span>
			
    </div>
	<a class="btn green-jungle pull-right" href="<?php echo base_url()?>Tagihan/create_payment/?id=<?php echo $expeditur["id"];?>">    
                         								PAYMENT                    
                         						</a>  
</div>
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

<div class="portlet-body">
	<div class="portlet light bordered">
	  
	    <div class="portlet-body table-both-scroll">
		     <div class="tabbable-custom nav-justified">
                                        <ul class="nav nav-tabs nav-justified">
                                            <li class="active">
                                                <a href="#tab_1_1_1" data-toggle="tab">PAYMENT</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_1_2" data-toggle="tab">SPJ NOT PROCEED</a>
                                            </li>
											<li>
                                                <a href="#tab_1_1_3" data-toggle="tab">SPJ PROCEED</a>
                                            </li>
                                           
                                        </ul>
                                        <div class="tab-content">
                                          <div class="tab-pane" id="tab_1_1_3">
											  <!--	<div class="col-md-4">
                                                    <div class="input-group input-large date-picker input-daterange" data-date-format="mm/dd/yyyy">
                                                        <input type="text" class="form-control" name="from" value='<?php echo date('d/m/Y')?>'>
                                                        <span class="input-group-addon"> to </span>
                                                        <input type="text" class="form-control" name="to" value='<?php echo date('d/m/Y')?>'> 
													</div>
                                                    
                                                </div>
											   -->
												<br/>
												<br/>
										
												  <table class="table table-striped table-bordered table-hover order-column datatable_basic" doco="data_list" id="sample_3">
														<thead>
															<tr>
															<!--<th>
																<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
																	<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
																	<span></span>
																</label>
															</th>
                                                            -->
																<th class="center">Invoice Number</th>
																<th class="center">Owner Name</th>
																<th class="center" >PLAT</th>
																	<th class="center">	DRIVER</th>
																<th class="center" >Tarif OA</th>
																<th class="center">	OA</th>
																<th class="center">Biaya Jalan</th>
																
																<th class="center">KCOO</th>
																<th class="center" >DCTO</th>
																<th class="center">	DOCO</th>
																<th class="center">TRDJ(Y-M-D)</th>
																<th class="center" >AN82</th>
																<th class="center">	AN82_DESC</th>
																<th class="center">SRP1</th>
																<th class="center" >OKCO</th>
																<th class="center">	ODCT</th>
																<th class="center">ODOC</th>

																<th class="center">OORN</th>
																<th class="center" >TUJUAN</th>
																<th class="center">	TUJUAN_DESC</th>
																<th class="center">SHAN</th>

																<th class="center">SHAN_DESC</th>
															
																<th class="center">CARS</th>

																
																<th class="center">CARS_DESC</th>
															
															
																<th class="center">SPP_NMBR</th>

																<th class="center">LITM</th>
																<th class="center" >UM</th>
																<th class="center">SRP4</th>
																<th class="center">SRP4_DESC</th>

																
																
																<th class="center">UORG</th>
																<th class="center" >UORG_TON</th>
																<th class="center">DOC</th>
																<th class="center">SRP3</th>

																<th class="center">SRP3_DESC</th>
																<th class="center" >SHIP_ADDRESS_1</th>
																<th class="center">SHIP_ADDRESS_2</th>
																<th class="center">RYIN</th>

																<th class="center">MOT</th>
																<th class="center" >PC1</th>
																<th class="center">PRGP</th>
																<th class="center">UPRC</th>

																<th class="center">AEXP</th>
																<th class="center" >LPRC</th>
																<th class="center">PTC</th>
																<th class="center">TCST</th>

																
																<th class="center">AN01</th>
																<th class="center" >SPJ_RETURN_FLAG</th>
																<th class="center">SPJ_RETURN_DATE</th>
																<th class="center">SPJ_RETURN_TIME</th>

																<th class="center">DESCRIPTION</th>
																<th class="center" >DESCRIPTION_1</th>
																<th class="center">ENTER_FACTO_TIME</th>
																<th class="center">OUT_FACTO_TIME</th>

															</tr>
														</thead>
														<tbody>
																<?php
																$rownum = 1;
																if(!empty($list_of_data_proceed)){
																	foreach ($list_of_data_proceed as $data) {
																		?>
																			<tr>
                                                                            <!--
																				<td>
																					<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
																						<input type="checkbox" class="checkboxes" value="1" />
																						<span></span>
																					</label>
																				</td>
                                                                                -->
																				<td class="center">
																				<a href="<?php echo base_url().'Payment/view_payment/'.$data->invoice_number;?>">
																					<?php echo $data->invoice_number;?></a>
																				</td>
																				<td style="white-space:nowrap !important"><?php echo $data->expeditur_name;?></td>
																					<td><?php echo $data->vehi;?></td>
																						<td style="white-space:nowrap !important"><?php echo $data->driver;?></td>
																				<td><?php echo number_format($data->tarif_oa,2);?></td>
																				<td><?php echo number_format($data->oa_bmu,2);?></td>
																				<td style="white-space:nowrap !important"><?php echo number_format($data->uang_jalan,2);?>
																				

																				<td><?php echo $data->kcoo;?></td>
																				<td><?php echo $data->dcto;?></td>
																				<td><?php echo $data->doco;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->trdj;?>
																				<td style="white-space:nowrap !important"><?php echo $data->an82_desc;?></td>
																				<td><?php echo $data->cars;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->cars_desc;?></td>
																				<td><?php echo $data->srp1;?></td>
																				<td><?php echo $data->okco;?></td>
																				<td><?php echo $data->odct;?></td>
																				<td><?php echo $data->odoc;?></td>
																				<td><?php echo $data->oorn;?></td>
																				<td><?php echo $data->an8;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->an8_desc;?></td>
																				<td><?php echo $data->shan;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->shan_desc;?></td>
																				<td><?php echo $data->an82;?></td>
																				
																			
																			
																				<td><?php echo $data->spp_nmbr;?></td>
																				<td><?php echo $data->litm;?></td>
																				<td><?php echo $data->um;?></td>
																				<td><?php echo $data->srp4;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->srp4_desc;?></td>
																				<td><?php echo $data->uorg;?></td>
																				<td><?php echo $data->uorg_ton;?></td>
																				<td><?php echo $data->doc;?></td>
																				<td><?php echo $data->srp3;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->srp3_desc;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->ship_address_1;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->ship_address_2;?></td>
																				<td><?php echo $data->ryin;?></td>
																				<td><?php echo $data->mot;?></td>
																				<td><?php echo $data->pc1;?></td>
																				<td><?php echo $data->prgp;?></td>
																				<td><?php echo $data->uprc;?></td>
																				<td><?php echo $data->aexp;?></td>
																				<td><?php echo $data->lprc;?></td>
																				<td><?php echo $data->ptc;?></td>
																				<td><?php echo $data->tcst;?></td>
																				<td><?php echo $data->an01;?></td>
																				<td><?php echo $data->spj_return_flag;?></td>
																				<td><?php echo $data->spj_return_date;?></td>
																				<td><?php echo $data->spj_return_time;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->description;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->description_1;?></td>
																				<td><?php echo $data->enter_facto_time;?></td>
																				<td><?php echo $data->out_facto_time;?></td>

																			

																			</tr>
																		<?php
																	}
																}
															?>

														</tbody>
													</table>
																					</div>
																					<!-- NOT PROCEED-->
                                          <div class="tab-pane" id="tab_1_1_2">
                                                <table class="table table-striped table-bordered table-hover order-column datatable_basic" doco="data_list" id="sample_3">
														<thead>
															<tr>
															<!--<th>
																<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
																	<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
																	<span></span>
																</label>
															</th>
                                                            -->
																<th class="center">Invoice Number</th>
																<th class="center">Owner Name</th>
																<th class="center" >PLAT</th>
																	<th class="center">	DRIVER</th>
																<th class="center" >Tarif OA</th>
																<th class="center">	OA</th>
																<th class="center">Biaya Jalan</th>
																
																<th class="center">KCOO</th>
																<th class="center" >DCTO</th>
																<th class="center">	DOCO</th>
																<th class="center">TRDJ(Y-M-D)</th>
																<th class="center" >AN82</th>
																<th class="center">	AN82_DESC</th>
																<th class="center">SRP1</th>
																<th class="center" >OKCO</th>
																<th class="center">	ODCT</th>
																<th class="center">ODOC</th>

																<th class="center">OORN</th>
																<th class="center" >TUJUAN</th>
																<th class="center">	TUJUAN_DESC</th>
																<th class="center">SHAN</th>

																<th class="center">SHAN_DESC</th>
															
																<th class="center">CARS</th>

																
																<th class="center">CARS_DESC</th>
															
															
																<th class="center">SPP_NMBR</th>

																<th class="center">LITM</th>
																<th class="center" >UM</th>
																<th class="center">SRP4</th>
																<th class="center">SRP4_DESC</th>

																
																
																<th class="center">UORG</th>
																<th class="center" >UORG_TON</th>
																<th class="center">DOC</th>
																<th class="center">SRP3</th>

																<th class="center">SRP3_DESC</th>
																<th class="center" >SHIP_ADDRESS_1</th>
																<th class="center">SHIP_ADDRESS_2</th>
																<th class="center">RYIN</th>

																<th class="center">MOT</th>
																<th class="center" >PC1</th>
																<th class="center">PRGP</th>
																<th class="center">UPRC</th>

																<th class="center">AEXP</th>
																<th class="center" >LPRC</th>
																<th class="center">PTC</th>
																<th class="center">TCST</th>

																
																<th class="center">AN01</th>
																<th class="center" >SPJ_RETURN_FLAG</th>
																<th class="center">SPJ_RETURN_DATE</th>
																<th class="center">SPJ_RETURN_TIME</th>

																<th class="center">DESCRIPTION</th>
																<th class="center" >DESCRIPTION_1</th>
																<th class="center">ENTER_FACTO_TIME</th>
																<th class="center">OUT_FACTO_TIME</th>

															</tr>
														</thead>
														<tbody>
																<?php
																$rownum = 1;
																if(!empty($list_of_data_not_proceed)){
																	foreach ($list_of_data_not_proceed as $data) {
																		?>
																			<tr>
                                                                            <!--
																				<td>
																					<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
																						<input type="checkbox" class="checkboxes" value="1" />
																						<span></span>
																					</label>
																				</td>
                                                                                -->
																				<td class="center">
																				--
																				</td>
																				<td style="white-space:nowrap !important"><?php echo $data->expeditur_name;?></td>
																					<td><?php echo $data->vehi;?></td>
																						<td style="white-space:nowrap !important"><?php echo $data->driver;?></td>
																				<td><?php echo number_format($data->tarif_oa,2);?></td>
																				<td><?php echo number_format($data->oa_bmu,2);?></td>
																				<td style="white-space:nowrap !important"><?php echo number_format($data->uang_jalan,2);?>
																				

																				<td><?php echo $data->kcoo;?></td>
																				<td><?php echo $data->dcto;?></td>
																				<td><?php echo $data->doco;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->trdj;?>
																				<td style="white-space:nowrap !important"><?php echo $data->an82_desc;?></td>
																				<td><?php echo $data->cars;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->cars_desc;?></td>
																				<td><?php echo $data->srp1;?></td>
																				<td><?php echo $data->okco;?></td>
																				<td><?php echo $data->odct;?></td>
																				<td><?php echo $data->odoc;?></td>
																				<td><?php echo $data->oorn;?></td>
																				<td><?php echo $data->an8;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->an8_desc;?></td>
																				<td><?php echo $data->shan;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->shan_desc;?></td>
																				<td><?php echo $data->an82;?></td>
																				
																			
																			
																				<td><?php echo $data->spp_nmbr;?></td>
																				<td><?php echo $data->litm;?></td>
																				<td><?php echo $data->um;?></td>
																				<td><?php echo $data->srp4;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->srp4_desc;?></td>
																				<td><?php echo $data->uorg;?></td>
																				<td><?php echo $data->uorg_ton;?></td>
																				<td><?php echo $data->doc;?></td>
																				<td><?php echo $data->srp3;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->srp3_desc;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->ship_address_1;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->ship_address_2;?></td>
																				<td><?php echo $data->ryin;?></td>
																				<td><?php echo $data->mot;?></td>
																				<td><?php echo $data->pc1;?></td>
																				<td><?php echo $data->prgp;?></td>
																				<td><?php echo $data->uprc;?></td>
																				<td><?php echo $data->aexp;?></td>
																				<td><?php echo $data->lprc;?></td>
																				<td><?php echo $data->ptc;?></td>
																				<td><?php echo $data->tcst;?></td>
																				<td><?php echo $data->an01;?></td>
																				<td><?php echo $data->spj_return_flag;?></td>
																				<td><?php echo $data->spj_return_date;?></td>
																				<td><?php echo $data->spj_return_time;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->description;?></td>
																				<td style="white-space:nowrap !important"><?php echo $data->description_1;?></td>
																				<td><?php echo $data->enter_facto_time;?></td>
																				<td><?php echo $data->out_facto_time;?></td>

																			

																			</tr>
																		<?php
																	}
																}
															?>

														</tbody>
													</table>
                                          </div>
										  <!-- start payment-->
										  <div class="tab-pane active" id="tab_1_1_1">
                                              
                                            <!-- Default panel contents -->
													
													<br/>
													<table class="table table-striped table-bordered table-hover order-column datatable_basic" id="data_list">
														<thead>
															<tr>
																
																<th class="center">Payment Number</th>
																<th class="center">Owner</th>
																<th class="center">Grand Total</th>
																<th class="center">Total OA</th>
																<th class="center">Total Uang Jalan</th>
																<th class="center">Total Maintenance</th>
																<th class="center">Quantity</th>
																<th class="center">Date Transaction</th>
																<th class="center">Period</th>
																<th class="center">Status</th>
																<th class="center">Submit Payment</th>
															</tr>
														</thead>
														<tbody>
															<?php
																$rownum = 1;
																$list_currency = 0;
																if($list_of_payment != null && count($list_of_payment) > 0){
																	
																	foreach ($list_of_payment as $item) {
																		$grand_total=$item->total_ongkos_angkut-$item->total_uang_jalan-$item->total_maintenance;
																		?>
																			<tr>
																				<td class="center">
																				<a href="<?php echo base_url().'Payment/view_payment/'.$item->invoice_number;?>">
																					<?php echo $item->invoice_number;?></a>
																				</td>
																				<td class="center">
																				<?php echo $item->owner_name;?>
																				</td>
																				<td class="center">
																				<?php echo "".number_format($grand_total,2);?>
																				</td>
																				<td class="center">
																				<?php echo "".number_format($item->total_ongkos_angkut,2);?>
																				</td>
																				<td class="center">
																				<?php echo "".number_format($item->total_uang_jalan,2);?>
																				</td>
																				<td class="center">
																				<?php echo "".number_format($item->total_maintenance,2);?>
																				</td>
																				<td class="center">
																				<?php echo $item->total_qty_ton;?>
																				</td>
																				<td class="center">
																				<?php echo $item->invoice_date;?>
																				</td>
																				<td class="center" style="white-space:nowrap !important">
																				<?php echo $item->from." to ".$item->to;?>
																				</td>
																				<td class="center">
																				<?php echo $item->is_paid;?>
																				</td>
																				<td class="center">
																				<?php if($item->is_paid=="Unpaid"){?>
																				  
																					<a class="btn green-jungle pull-right" id='btnUpdateStatusPayment'
																					 href="<?php echo base_url().'Payment/setToPaid/?pn='.$item->invoice_number
																					 .'&o='.$item->owner_id?>" onclick="return confirm('Are you sure?');">
																					Set To Paid</a>
																					<?php }else{?>
																					<a class="btn red pull-right" id='btnUpdateStatusPayment'>Its Paid</a>
																					<?php  }
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
										   <!-- end payment-->
                                           
                                        </div>
                                    </div>
	       
	    </div>
	</div>
</div>

<script>
	jQuery(document).ready(function(){
		
		//jQuery("#btnCreate").click(function(){window.location.href = "<?php echo base_url()?>Release_JDE/import";})

	});
</script>