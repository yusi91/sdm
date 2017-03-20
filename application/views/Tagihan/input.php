
<div class="portlet-title ">
    <div class="caption">
        <span class="caption-subject font-red bold uppercase">Tagihan</span>
    </div>
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
                                                <a href="#tab_1_1_1" data-toggle="tab"> SPJ NOT PROCEED</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_1_2" data-toggle="tab"> SPJ PROCEED </a>
                                            </li>
											<li>
                                                <a href="#tab_1_1_3" data-toggle="tab">INVOICE </a>
                                            </li>
                                           
                                        </ul>
                                        <div class="tab-content">
                                          <div class="tab-pane active" id="tab_1_1_1">
											  
											   	<a class="pull-left" href="<?php echo base_url()?>Tagihan/prosesInvoice?>">    
                         								 <button class="btn blue pull-right"/>PROSES INVOICE</button> &nbsp;&nbsp;&nbsp;                     
                         							</a>  
												<br/>
												<br/>
										
												  <table class="table table-striped table-bordered table-hover order-column datatable_basic" doco="data_list" id="sample_3">
														<thead>
															<tr>
															<th>
																<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
																	<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
																	<span></span>
																</label>
															</th>
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
																if(!empty($list_of_data)){
																	foreach ($list_of_data as $data) {
																		?>
																			<tr>
																				<td>
																					<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
																						<input type="checkbox" class="checkboxes" value="1" />
																						<span></span>
																					</label>
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
                                          <div class="tab-pane" id="tab_1_1_2">
                                                <p> Howdy, I'm in Section 2. </p>
                                                <p> Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie
                                                    consequat. Ut wisi enim ad minim veniam, quis nostrud exerci tation. </p>
                                                <p>
                                                    <a class="btn green" href="ui_tabs_accordions_navs.html#tab_1_1_2" target="_blank"> Activate this tab via URL </a>
                                                </p>
                                          </div>
										  <div class="tab-pane" id="tab_1_1_3">
                                                <p> INVOICE</p>
                                              
                                                    <a class="btn green" href="ui_tabs_accordions_navs.html#tab_1_1_2" target="_blank"> Activate this tab via URL </a>
                                                </p>
                                           </div>
                                           
                                        </div>
                                    </div>
	       
	    </div>
	</div>
</div>