<h4 class="bold font-green">Tagihan Berhasil Dibuat Dengan Nomor <span class="font-red"><?php echo $po_number?></span> </h4>
<h4 class="bold font-green">Untuk Mengunduh Dokumen Tagihan, Silahkan Klik <a href="<?php echo base_url()?>LihatData/PrintListDO?po_number=<?php echo $po_number?>&po_date=<?php echo date("d-m-Y")?>" class="font-blue">Disini</span></h4>

<script type="text/javascript">
	// jQuery(document).ready(function(){
	// 	window.setTimeout(function(){
 //        	window.location.href = "<?php echo base_url()?>Tagihan/<?php echo $from?>";
 //    	}, 2000);
	// })
</script>