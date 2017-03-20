
<div class="portlet-title">
	<div class="caption">
		<span class="caption-subject bold uppercase font-blue-steel">Index</span>
	</div>
</div>
<!-- END TITLE AREA -->
<!-- BEGIN FILTER AREA -->
<!-- 
<div class="portlet-title">
    <div class="portlet box blue-steel">
	        <div class="portlet-title">
	            <div class="caption">
	                <i class="fa fa-search"></i>Search
							</div>
	            <div class="tools">
	                <a href="javascript:;" class="collapse" id="btnCollapseExpand"> </a>
	            </div>
	        </div>
	        <div class="portlet-body " id="SearchForm">
	            <form method="post">
	                <div class="form-body">
	                    <div class="form-group">
	                        <label class="control-label">Code</label>
	                        <input type="text" class="form-control" placeholder="Code" name="Code" id="Code" value="<?php echo $Filter["Code_Like"]?>">
	                    </div>
	                    <div class="form-group">
	                        <label class="control-label">Name</label>
													<input type="text" class="form-control" placeholder="Name" name="Name" id="Name" value="<?php echo $Filter["Name_Like"]?>">
	                    </div>
	                <div class="form-actions">
	                    <button type="submit" class="btn green">Submit</button>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>
</div> -->
<!-- END FILTER AREA -->

<!-- BEGIN TABLE PORTLET-->

<div class="">
	<div class="form pull-right hidden_type_1" id="btnCreate" style="margin: 5px"><a href="javascript:;" class="btn green-jungle">Create<i class="fa fa-plus"></i></a></div>
	<div class="form pull-right hidden_type_1" id="btnMultiDelete" style="margin: 5px"><a href="javascript:;" class="btn red">Multi Delete<i class="fa fa-trash"></i></a></div>
	<div class="form pull-right hidden_type_2" id="btnDoDelete" style="margin: 5px; display: none;"><a href="javascript:;" class="btn red">Delete</a></div>
	<div class="form pull-right hidden_type_2" id="btnCancelDelete" style="margin: 5px; display: none;"><a href="javascript:;" class="btn blue-steel">Cancel</a></div>
</div>

<div class="portlet-body">
	<div class="portlet box blue-steel">
	    <div class="portlet-title">
	        <div class="caption">
	            <i class="fa fa-list"></i>List of Area</div>
	        <div class="tools"> </div>
	    </div>
	    <div class="portlet-body">
	        <table class="table table-striped table-bordered table-hover order-column datatable_basic" id="data_list">
	            <thead>
	                <tr>
	                    <th class="center" width="5%">Act</th>
	                    <th class="center" width="5%">No</th>
	                    <th class="center">Code</th>
	                    <th class="center">Name</th>
	                </tr>
	            </thead>
	            <tbody>
					<?php
						$rownum = 1;
						$counter_cb_delete = 0;
						if($list_of_data != null && count($list_of_data) > 0){
							foreach ($list_of_data as $data) {
								?>
									<tr>
										<td class="center" style="white-space:nowrap !important">
											<a class="tooltips hidden_type_1" href="<?php echo base_url()?>SubArea/index/?parent_code=<?php echo $data["code"];?>" data-placement="bottom" data-original-title="Look Sub Area <?php echo ($data["name"] != null && $data["name"] != "" ? $data["name"]: "&nbsp;")?>">
												<i class="glyphicon glyphicon-eye-open" ></i>
											</a>

											<a class="tooltips hidden_type_1" href="<?php echo base_url()?>Area/edit/?id=<?php echo $data["id"];?>" data-placement="bottom" data-original-title="Edit"><i class="fa fa-edit" ></i></a>

											<input type="checkbox" value="<?php echo $data["id"];?>" name="delete_id" style="display: none;" class="hidden_type_2">
											

											 <a class="tooltips btnDelete" href="<?php echo base_url()?>Area/delete/?id=<?php echo $data["id"];?>" data-placement="bottom" data-original-title="Delete" onclick='if(!confirm("Are You Sure?")){return false;}'>
											<i class="icon-trash"></i>
											</a>
										</td>
										<td class="center"> <?php echo $rownum++ ?> </td>
										<td><a href="<?php echo base_url()?>Area/detail?id=<?php echo $data["id"];  ?>"><?php echo ($data["code"] != null && $data["code"] != "" ? $data["code"]: "&nbsp;")?></a></td>
										<td> <?php echo ($data["name"] != null && $data["name"] != "" ? $data["name"]: "&nbsp;")?> </td>
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
<!-- <?php echo base_url()?>Area/delete/?id=<?php echo $data["id"];?> -->
<!-- END TABLE PORTLET-->

<!-- BEGIN JQUERY SECTION -->
<script>
	jQuery(document).ready(function(){
		// jQuery(".btnDelete").click(function(){if(!confirm("Are You Sure?")){return false;}})
		jQuery("#btnCreate").click(function(){window.location.href = "<?php echo base_url()?>Area/create";})
		jQuery("#btnMultiDelete").click(function(){
			jQuery(".hidden_type_2").show();
			jQuery(".hidden_type_1").hide();
		})
		jQuery("#btnCancelDelete").click(function(){
			jQuery(".hidden_type_2").hide();
			jQuery(".hidden_type_1").show();
		})
	});
</script>
<script>
	// jQuery(document).ready(function(){
	// 	setColapseExpand();
		
	// });
	// function setColapseExpand(){
	// 	var code = jQuery("#Code").val();
	// 	var name = jQuery("#Name").val();
	// 	var colapseExpand = document.getElementById("btnCollapseExpand");

	// 	if(code == "" && name == ""){
	// 		colapseExpand.className = "expand";
	// 		jQuery("#SearchForm").css("display","none");
	// 	}
	// 	else{
	// 		colapseExpand.className = "collapse";
	// 		jQuery("#SearchForm").css("display","block");
	// 	}
	// };
</script> 
<!-- END JQUERY SECTION-->