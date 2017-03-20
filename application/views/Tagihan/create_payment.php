<!-- BEGIN TITLE Release_JDE -->

<?php 
if(empty($from)){
	$from=date('d/m/Y');
}
if(empty($to)){
	$to=date('d/m/Y');
}


?>
<div class="portlet-title">
	<div class="caption">
	  <span class="caption-subject font-red bold uppercase"><?php 
            if(!empty($expeditur)){
                
                    echo $expeditur['name']." || Create Payment";
                
            }
			
        ?></span>
	</div>
</div>



<div class="portlet-body">
<div class="portlet light bordered">
	    <div class="portlet-title">
	        <div class="caption">
	            <i class="fa fa-list"></i>Form Entry</div>
	        <div class="tools"> </div>
	    </div>
	    <div class="portlet-body table-both-scroll">
			<form method="post" action="<?php echo base_url()?>Tagihan/do_create_payment">
				<div class="form-body">
					<input type="hidden"  name="Id" id="Id" value="<?php echo $expeditur['id']?>">
					<div class="form-group form-md-line-input form-md-floating-label has-success">
						<input type="text" class="form-control" id="Owner" name="Owner" value="<?php echo $expeditur['name']?>" disabled >
						<label for="form_control_1">Owner <span class="required"> <span> </label>
					</div>
					<div class="form-group form-md-line-input form-md-floating-label has-success">
						<input type="text" class="form-control" id="description" name="description" maxlength="80" >
						<label for="Description">Description <span class="required"> *<span> </label>
					</div>
					<div class="form-group form-md-line-input form-md-floating-label has-success" id='date_range'>	
					<label for="date_range">Date Range<span class="required"> *<span> </label>				
						<div class="input-group input-large date-picker input-daterange" data-date-format="mm/dd/yyyy">
							<input type="text" class="form-control" name="from" id='from' value='<?php echo $from?>'>
							<span class="input-group-addon"> to </span>
							<input type="text" class="form-control" name="to" value='<?php echo $to?>'> 
						</div>					
						
					</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-12">
							<input type="Submit" class="btn blue-steel" value="Create" name="btnSubmit" id="btnSubmit">
							&nbsp;&nbsp;
							
						</div>
					</div>
				</div>
			</form>
    <!-- END FORM-->
			
			<br/><br/>
	         
	      
	    </div>
	</div>
</div>
<!-- END TABLE PORTLET-->

<!-- BEGIN JQUERY SECTION -->
<script>
	jQuery(document).ready(function(){
		jQuery(".btnDelete").click(function(){if(!confirm("Are You Sure?")){return false;}})
		//jQuery("#btnCreate").click(function(){window.location.href = "<?php echo base_url()?>Release_JDE/import";})

	});
</script>
