<html>
<!-- BEGIN HEAD -->

  <head>
      <meta charset="utf-8" />
      <title>Transportation Dashboard System (TDS)</title>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="width=device-width, initial-scale=1" name="viewport" />
      <meta content="" name="description" />
      <meta content="" name="author" />

      <!-- _____BEGIN CSS SECTION_____ -->
      <!-- BEGIN GLOBAL MANDATORY STYLES -->
      <link href="<?php echo base_url(); ?>assets/fonts/font.css" rel="stylesheet" type="text/css" />
      <!-- <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" /> -->
      <!-- END GLOBAL MANDATORY STYLES -->
      <!-- BEGIN THEME GLOBAL STYLES -->
      <!-- <link href="<?php echo base_url(); ?>assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" /> -->
      <!-- END THEME GLOBAL STYLES -->
      <!-- BEGIN THEME LAYOUT STYLES -->
      <!-- <link href="<?php echo base_url(); ?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
      <link href="<?php echo base_url(); ?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" /> -->
      <!-- END THEME LAYOUT STYLES -->

      <!-- BEGIN CUSTOM CSS -->
      <link href="<?php echo base_url(); ?>assets/custom/css/custom.css" rel="stylesheet" type="text/css" />
      <!-- END CUSTOM CSS -->
      <link rel="shortcut icon" href="favicon.ico" />
      <!-- _____END CSS SECTION_____ -->

      <!-- _____BEGIN JQUERY SECTION_____ -->
      <!--[if lt IE 9]>
      <script src="../assets/global/plugins/respond.min.js"></script>
      <script src="../assets/global/plugins/excanvas.min.js"></script>
      <![endif]-->
      <!-- BEGIN CORE PLUGINS -->
      <script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
      <!-- END CORE PLUGINS -->
      <!-- BEGIN UPLOAD PLUGINS -->
      <script src="<?php echo base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
        <!-- END UPLOAD PLUGINS -->
      <!-- BEGIN PAGE LEVEL PLUGINS -->
      <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js" type="text/javascript"></script>
      <!-- END PAGE LEVEL PLUGINS -->
      <!-- BEGIN THEME GLOBAL SCRIPTS -->
      <script src="<?php echo base_url();?>assets/global/scripts/app.min.js" type="text/javascript"></script>
      <!-- END THEME GLOBAL SCRIPTS -->
      <!-- BEGIN THEME LAYOUT SCRIPTS -->
      <script src="<?php echo base_url();?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url();?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
      <!-- END THEME LAYOUT SCRIPTS -->
      <!-- BEGIN CUSTOM JS -->
      <script src="<?php echo base_url();?>assets/custom/js/format_text.js" type="text/javascript"></script>
      <!-- END CUSTOM JS -->
      <!-- _____END JQUERY SECTION_____ -->

    </head>
  <!-- END HEAD -->

  <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
  	<style type="text/css">
  		table tr td, table tr th{
  			padding: 10,10,10,10 !important;
  		}
  	</style>
  	<div style="width: 100%; text-align: center">
  		<H2>DAFTAR DO EXPEDITUR  DARI PO <span style="color: #4B77BE" >  </span> </H2>
  	</div>
    <div>
      <table style="font-weight: bold">
        <tr>
          <td>Nama Ekspeditur</td>
          <td>:</td>
          <td><?php echo $_SESSION["userinfo"]["TKALPH"]?></td>
        </tr>
        <tr>
          <td>Nomor Tagihan</td>
          <td>:</td>
          <td><?php echo $po_number?></td>
        </tr>
        <tr>
          <td>Tanggal Tagihan</td>
          <td>:</td>
          <td><?php echo date("d-m-Y", strtotime($po_date)) ?></td>
        </tr>
        <tr>
          <td>Deskripsi</td>
          <td>:</td>
          <td><?php echo (isset($po_data) && $po_data != null ?$po_data["PDDSC1"]:"" ) ?></td>
        </tr>

      </table>
    </div>
  	<br><br>
	<table class="table table-striped table-bordered table-hover order-column " id="data_list" cellpadding="30"  >
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

				$tot_qty = 0;
				$tot_price = 0;

				if($list_of_data != null && count($list_of_data) > 0){
					foreach ($list_of_data as $data) {
            $tot_qty += $data["RSUORG"];
            $tot_price += $data["RSTCST"] / 10000;
            ?>
              <tr>
                <td class="center"  width="5%"> <?php echo $rownum++ ?></td>
                <td class="center"><?php echo ($data["RSDOCO"] != null && $data["RSDOCO"] != "" ? $data["RSKCOO"]."-".$data["RSDCTO"]."-".$data["RSDOCO"] : "&nbsp;")?></td>
                <td class="center"><?php echo ($data["RSTRDJ"] != null && $data["RSTRDJ"] != "" ? $data["RSTRDJ_GREGORIAN"]: "&nbsp;")?></td>
                <td class="center"><?php echo ($data["EMCU_DESC"] != null && $data["EMCU_DESC"] != "" ? $data["EMCU_DESC"]: "&nbsp;")?></td>
                <td class="center"><?php echo ($data["SHAN_DESC"] != null && $data["SHAN_DESC"] != "" ? $data["SHAN_DESC"]: "&nbsp;")?></td>
                <td class="center"><?php echo ($data["RSIR01"] != null && $data["RSIR01"] != "" ? $data["RSIR01"]: "&nbsp;")?></td>
                <td class="center"><?php echo ($data["RSIR02"] != null && $data["RSIR02"] != "" ? $data["RSIR02"]: "&nbsp;")?></td>
                <td class="center"><?php echo ($data["RSLITM"] != null && $data["RSLITM"] != "" ? $list_semen["".trim($data["RSLITM"])] : "&nbsp;")?></td>
                <td style="text-align: center"><?php echo ($data["RSUORG"] != null && $data["RSUORG"] != "" ? $data["RSUORG"] : "&nbsp;")?></td>
                <td class="" style="text-align: center;">Rp.<?php echo ($data["RSLPRC"] != null && $data["RSLPRC"] != "" ?  number_format( $data["RSLPRC"] / 10000,2)  : "&nbsp;")?></td>
                <td class="" style="text-align: center">Rp.<?php echo ($data["RSTCST"] != null && $data["RSTCST"] != "" ?  number_format( $data["RSTCST"] / 10000,2) : "&nbsp;")?></td>
              </tr>
            <?php  
					}
				}
			?>
      <tr>
        <td colspan="11" style="border-bottom: dashed 0.5 !important;  " ></td>
      </tr>
			<tr >
				<td colspan="8"  style="text-align: right;"><span style="font-weight: bold;">Total :</span> </td>
				<td class="center"><span style="font-weight: bold;white-space: nowrap !important;"><?php echo $tot_qty?></span></td>
				<td class="center"><span style="font-weight: bold;white-space: nowrap !important;">Rp.<?php echo number_format(($tot_price / $tot_qty), 2) ?></span></td>
				<td class="center"><span style="font-weight: bold;white-space: nowrap !important;">Rp.<?php echo number_format($tot_price, 2)?></span></td>
			</tr>
	    </tbody>
	</table>

  <br><br>

  <table style="width: 100%">
    <tr style="width: 100%">
      <td style="text-align: center">Pihak ke-1<br><br><br><br></td>
      <td style="text-align: center">Pihak ke-2<br><br><br><br></td>
    </tr>
    <tr style="width: 100%">
      <td style="text-align: center">(..................................)</td>
      <td style="text-align: center">(..................................)</td>
    </tr>
  </table>

  </body>
</html>
