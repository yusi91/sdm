<!-- BEGIN TITLE Release_JDE -->
<div class="portlet-title">
	<div class="caption">
		 <span class="caption-subject font-red bold uppercase"><?php 
            if(!empty($expeditur)){
                $disabled=NULL;
                    echo $expeditur['name']." || Payment Preview";
                    $dateFrom=date('d-F-Y',strtotime($from));
                    $dateTo=date('d-F-Y',strtotime($to));
                    $info="Payment Summary for ".$expeditur['name']." from ".$dateFrom ." to ".$dateTo."<br/> Payment Description : ".$description;
					if(!empty($invoice_info)){
                    	 if(empty($invoice_info['total_spj'])){
							 $disabled="disabled";
						 }else{
							 if($invoice_info['total_spj']==0){
								 $disabled="disabled";
						 	}
						 }
                	}else{
                        $disabled="disabled";
                    }
            }
			
        ?></span>
	</div>
</div>



<div class="portlet-body">
	 <?php if(empty ($disabled)){?>
								   
                                    <a class="btn green-jungle pull-right" id='btnGenerate' 
  href="<?php echo base_url()?>Tagihan/generatePayment/?id=<?php echo $expeditur["id"];?>&total_oa=<?php echo $invoice_info['total_oa']?>&total_uang_jalan=<?php echo $invoice_info['total_uang_jalan']?>&total_qty_ton=<?php echo $invoice_info['total_qty_ton']?>&total_spj=<?php echo $invoice_info['total_spj']?>&from=<?php echo $from;?>&to=<?php echo $to;?>&name=<?php echo $expeditur["name"];?>&description=<?php echo $description;?>&total_maintenance=<?php echo $invoice_info['total_maintenance'];?>
                                     
                                     ">    
                         								GENERATE PAYMENT                    
                         			</a>  
								   <?php }else{?>
								   	<span class='alert alert-danger pull-right'>Tidak Ada Transaksi</span><br/>
								   <?php 
								   }
								   ?>
	    <br/><br/>

        <div class="clearfix">
                                        
                                        <div class="panel panel-primary">
                                            <!-- Default panel contents -->
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Payment Summary</h3>
                                            </div>
                                            <div class="panel-body">
                                                <p> <?php echo $info;?> </p>

                                            </div>
                                            <!-- List group -->
                                            <ul class="list-group">
                                                <li class="list-group-item"> Total SPJ
                                                    <span class="badge badge-danger"> 
                                                          <?php 
                                                        if(!empty($invoice_info)){
                                                            echo $invoice_info['total_spj'];
                                                        }else{
                                                            echo "0";
                                                        }
                                                    
                                                    ?> 
                                                    </span>
                                                </li>
                                                <li class="list-group-item"> Total Quantity
                                                    <span class="badge badge-danger"> 
                                                         <?php 
                                                        if(!empty($invoice_info)){
                                                            echo $invoice_info['total_qty_ton'];
                                                        }else{
                                                            echo "0";
                                                        }
                                                    
                                                        ?> 
                                                     </span>
                                                </li>
                                                <li class="list-group-item"> Total OA
                                                    <span class="badge badge-danger"> 
                                                          <?php 
                                                        if(!empty($invoice_info)){
                                                            echo "Rp ".number_format($invoice_info['total_oa'],2);
                                                        }else{
                                                            echo "0";
                                                        }
                                                    
                                                        ?> 
                                                     </span>
                                                </li>
                                                <li class="list-group-item"> Total Uang Jalan
                                                    <span class="badge badge-danger"> 
                                                         <?php 
                                                        if(!empty($invoice_info)){
                                                            echo "Rp ".number_format($invoice_info['total_uang_jalan'],2);
                                                        }else{
                                                            echo "0";
                                                        }
                                                    
                                                        ?> 
                                                     </span>
                                                </li>

												   <li class="list-group-item"> Total Maintenance
                                                    <span class="badge badge-danger"> 
                                                         <?php 
                                                        if(!empty($invoice_info)){
                                                            echo "Rp ".number_format($invoice_info['total_maintenance'],2);
                                                        }else{
                                                            echo "0";
                                                        }
                                                    
                                                        ?> 
                                                     </span>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>
    
                                  
                                     
									  <div class="panel panel-primary">
                                            <!-- Default panel contents -->
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Transport Transaction</h3>
                                            </div>
											<br/><br/>

	         <table class="table table-striped table-bordered table-hover order-column datatable_basic" doco="data_list" id="sample_3">
	            <thead>
	                <tr>
						<th class="center">Owner Name</th>
						  <th class="center" >PLAT</th>
						    <th class="center">	DRIVER</th>
	                    <th class="center" >Tarif OA BMU</th>
	                    <th class="center">	OA BMU</th>
	                    <th class="center">Biaya Jalan</th>
						<th class="center" >Tarif OA Parent</th>
	                    <th class="center">	OA Parent</th>
						
	                    <th class="center">KCOO</th>
	                    <th class="center" >DCTO</th>
	                    <th class="center">	DOCO</th>
	                    <th class="center">TRDJ(Y-M-D)</th>
						 <th class="center" >CARS</th>
	                    <th class="center">	CARS_DESC</th>
						<th class="center">SRP1</th>
	                   
					    <th class="center" >OKCO</th>
	                    <th class="center">	ODCT</th>
	                    <th class="center">ODOC</th>

						<th class="center" >DOCO_MINUS</th>
	                    <th class="center">	KCOO_MINUS</th>
	                    <th class="center">DCTO_MINUS</th>

					
	                    <th class="center" >AN8</th>
	                    <th class="center">	AN8_DESC</th>
	                    <th class="center">SHAN</th>

						<th class="center">SHAN_DESC</th>
	                   
	                    <th class="center">AREA</th>

						
						<th class="center">AREA_DESC</th>
	                  
	                  
	                 

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
										<td style="white-space:nowrap !important"><?php echo $data->expeditur_name;?></td>
											<td><?php echo $data->vehi;?></td>
												<td style="white-space:nowrap !important"><?php echo $data->driver;?></td>
										<td><?php echo number_format($data->tarif_oa,2);?></td>
										<td><?php echo number_format($data->oa_bmu,2);?></td>
										<td style="white-space:nowrap !important"><?php echo number_format($data->uang_jalan,2);?>
										<td><?php echo number_format($data->tarif_oa_parent,2);?></td>
										<td><?php echo number_format($data->oa_parent,2);?></td>

										<td><?php echo $data->kcoo;?></td>
										<td><?php echo $data->dcto;?></td>
										<td><?php echo $data->doco;?></td>
										<td style="white-space:nowrap !important"><?php echo $data->trdj;?>
										<td><?php echo $data->cars;?></td>
										<td style="white-space:nowrap !important"><?php echo $data->cars_desc;?></td>
									
										
										
										<td><?php echo $data->srp1;?></td>
										
										<td><?php echo $data->okco;?></td>
										<td><?php echo $data->odct;?></td>
										<td><?php echo $data->odoc;?></td>
									
										<td><?php echo $data->doco_minus;?></td>
										<td><?php echo $data->kcoo_minus;?></td>
										<td><?php echo $data->dcto;?></td>
											
										<td><?php echo $data->an8;?></td>
										<td style="white-space:nowrap !important"><?php echo $data->an8_desc;?></td>
										<td><?php echo $data->shan;?></td>
										<td style="white-space:nowrap !important"><?php echo $data->shan_desc;?></td>
										<td><?php echo $data->an82;?></td>
										<td style="white-space:nowrap !important"><?php echo $data->an82_desc;?></td>
										
									
								
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
			<!--end released -->
			<!--maintance -->
			  <div class="panel panel-primary">
                                            <!-- Default panel contents -->
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Maintenance Transaction</h3>
                                            </div>
											<br/>
			   <table class="table table-striped table-bordered table-hover order-column datatable_basic" id="data_list">
	            <thead>
	                <tr>
	                   
	                    <th class="center">Vehicle Id</th>
	                    <th class="center">Type Maintenance</th>
						<th class="center">Date Transaction</th>
	                    <th class="center">Cost</th>
	                    <th class="center">Quantity</th>
	                    <th class="center">Total</th>
	                </tr>
	            </thead>
	            <tbody>
					<?php
						$rownum = 1;
						$list_currency = 0;
						if($maintenance != null && count($maintenance) > 0){
							foreach ($maintenance as $item) {
								?>
									<tr>
										<td class="center">
										<?php 
											echo $item->vehi;
											
										?>
										</td>
										<td class="center">
										<?php 
											echo $item->type_name;
											
										?>
										</td>
										
											<td class="center">
										<?php 
											echo $item->trdj;
											
										?>
										</td>
											<td class="center">
										<?php 
											echo "".number_format($item->unit_price,2);
											
										?>
										</td>
											<td class="center">
										<?php 
											echo $item->quantity;
											
										?>
										</td>
											<td class="center">
										<?php 
											echo "".number_format($item->total_price,2);
											
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

			<!-- end maintenance-->
	      
	    
	
</div>
<!-- END TABLE PORTLET-->

<!-- BEGIN JQUERY SECTION -->
<script>
	jQuery(document).ready(function(){
		jQuery("#btnGenerate").click(function(){if(!confirm("Are You Sure?")){return false;}})
		//jQuery("#btnCreate").click(function(){window.location.href = "<?php echo base_url()?>Release_JDE/import";})

	});
</script>
