<!-- BEGIN TITLE AREA -->
<div class="portlet-title">
	<div class="caption">
		<span class="caption-subject bold uppercase font-blue-steel">Index</span>
	</div>
</div>
<input type="text" name="">
 <a class="btn red btn-outline sbold" data-toggle="modal"  id='btnShowPopup' onclick="showPopUp('<?php echo base_url("Vehicle/popup")?>', 'Popup Hihiw', 1200, 800, null,'btnShowPopup')"> View Demo </a>
<!-- BEGIN JQUERY SECTION -->
<script>
	jQuery(document).ready(function(){
		jQuery(".btnDelete").click(function(){if(!confirm("Are You Sure?")){return false;}})
		jQuery("#btnCreate").click(function(){window.location.href = "<?php echo base_url()?>Area/create";})

	});
</script>
<script type="text/javascript">
    function showPopUp(url, title, width, height, responseFunction, this_id){
        jQuery("#"+this_id).prop("href","#myModal");
        var html = '<div class="modal fade" id="myModal" tabindex="-1" role="basic" aria-hidden="true"><div class="modal-dialog" style="width:' + width + ';"><div class="modal-content" ><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"  onclick="removePopup()" ></button><h4 class="modal-title">'+title+'</h4></div><div class="modal-body" style="height:' + height + ';"><iframe src="'+url+'"  frameborder="0" height="100%" width="100%" scrolling="auto"></iframe></div><div class="modal-footer"><button onclick="removePopup()" type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button></div></div></div></div>';
        jQuery('body').append(html);
    }

    function removePopup(responseFunction = null){
        jQuery(".modal").remove();
        jQuery(".modal-backdrop").remove(); 
        jQuery('body').removeClass('modal-open');
        jQuery("body").css({
            "overflow-y":"scroll", 
            "padding-right":"0px"
        });
    }
</script>