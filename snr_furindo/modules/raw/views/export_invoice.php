<?php
	$name = $list_history->row()->sales_order_ref_no;
	$provider_nm = $list_history->row()->provider_name;
	$provider_cp = $list_history->row()->provider_contact_person;
	$provider_adds = $list_history->row()->provider_address;
	$provider_ph = $list_history->row()->provider_phone;
	$provider_ph2 = $list_history->row()->provider_phone2;
	$provider_fx = $list_history->row()->provider_fax;
	$code_po = $list_history->row()->purchase_order_code;
	$tomorrow = mktime (0,0,0,date("m") ,date("d")+45,date("Y"));
	$this->load->library('phpexcel');
	$this->load->library('PHPExcel/iofactory');

	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setTitle("title")
	                 ->setDescription("description");
	//void Worksheet::setLandscape ();
	// Assign cell values
	$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
	$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
	$objPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
	$objPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
	$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(0);
	$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(1);
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'cell value here');

	// Save it as an excel 2003 file
	

	header("Content-Type: application/vnd.ms-excel");
	//header("Expires: 0");
	header('Content-Disposition: attachment;filename="po-sm-'.$name.'-'.$code_po.'.xls"');
	header("Pragma: no-cache");
	header("Expires: 0");
	
	
?>
<style type="text/css">
	tr{
		border-color: #012473 !important;
	}
	td{
		border-color: #012473 !important;
	}
	#buat_border{
		border-top-style: solid;  
	    border-right-style: solid;  
	    border-bottom-style: solid;  
	    border-left-style: solid;
	    border-color:#012473;
	    font-weight: bold;
	}
	#gambar{
		padding-top: 2px;
	}
</style>
<table style="color:#012473;">
	<tr>
		<td rowspan="4">
			<img style="width:30px;height:40px; padding-top:5px;" src="<?php echo base_url(); ?>/assets/images/logo1.png"/>
		</td>
		<td colspan="3" style="font-size: 18px ; font-weight: bold ">
			C.V. SNR EKSPOR FURINDO
		</td>
		<td colspan="4"></td>
		<td width="160"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	</tr>
		<td colspan="3">
			<label>KUDEN RT 05, SENDANGSARI, KEC.PAJANGAN</label><br>
		</td>
	</tr>
		<td colspan="3">
			<label>KAB. BANTUL, YOGYAKARTA  550571</label><br>
		</td>
	</tr>
		<td colspan="3">
			<label>TEL/FAX: +62-274 6464609</label>
		</td>			
</table>
<br>
<table style="color:#012473;">
	<tr style="font-size:20px;">
		<td><b>TO</b></td>
		<td colspan="2"><b><?php echo $provider_nm; ?></b></td>
		<td style="text-align:center;" colspan="7"><b>PO. NO : <?php echo $code_po ?></b></td>
	</tr>
	<tr>
		<td>Attn.</td>
		<td colspan="2"><?php echo $provider_cp; ?></td>
		<td style="text-align:center;" colspan="7">Delevery Date : <?php  $tgl=date('d F Y',$tomorrow); echo $tgl; ?></td>
		

	</tr>
	<tr>
		<td></td>
		<td colspan="3"><?php echo $provider_adds; ?></td>
			<td></td>
			<td></td>
			<td style="color:red; font:bold;" colspan="2">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp PERHATIKAN TANGGAL JATUH TEMPO !!! </td>
			
			
	</tr>
	<tr>
		<td>Ph./Fax</td>
		<td><?php echo $provider_ph ?></td>
		<td><?php echo $provider_ph2 ?></td>
		
	</tr>
</table>

<br>
<table id="item-list" width="100%" border="0 #012473  !important;" style="color:#012473; border-color:#012473;">
	<thead style="color:#012473; border-color:#012473;">
		<th style="width:75px border-color:#012473;">SO Ref No</th>
		<th style="width:75px border-color:#012473;">Material Code</th>
		<th style="width:130px border-color:#012473;">Description</th>
		<th style="width:30px border-color:#012473;">Qty</th>
		<th style="width:100px border-color:#012473;">Unit</th>
		<th style="width:65px border-color:#012473;">UP (Rp)</th>
		<th style="width:65px border-color:#012473;">Amount (Rp)</th>
		<th style="width:100px border-color:#012473;">Material</th>
		<th style="width:165px border-color:#012473;"> Picture </th>
		<th style="width:65px border-color:#012473;">Remark</th>
	</thead>
	<?php 

	$i           = 1 ;
	$total_qty   = 0  ; 
	$total_price = 0 ;   
	foreach ( $list_history->result() as $row ) { ?>
	<tr height="150px" style="color:#012473; border-color:#012473; vertical-align:middle;">
		<td style="color:#012473; border-color:#012473; vertical-align:middle;"><?php echo $row->sales_order_ref_no; ?></td>
		<td style="color:#012473; border-color:#012473; vertical-align:middle;"><?php echo $row->product_code ?></td>
		<td style="color:#012473; border-color:#012473; vertical-align:middle;"><?php echo $row->product_name ?></td>
		<td style="text-align: right, vertical-align:middle; vertical-align:middle;"><?php echo $d_qty = $row->purchase_order_detail_qty;?></td>
		<!-- <td style="text-align: right, vertical-align:middle;"><?php //echo $d_qty = $row->total_qty;?></td>	 -->
		<td style="color:#012473; border-color:#012473; vertical-align:middle;"><?php echo $row->unit_name ?></td>
		<td style="text-align: right; border-color:#012473; vertical-align:middle;" ><?php $price = $row->purchase_order_detail_price; echo 'Rp '.number_format($price); ?></td>
		<td style="text-align: right; border-color:#012473; vertical-align:middle;" ><?php $ttl_price = $d_qty*$price; echo 'Rp '.number_format($ttl_price); ?></td>
		<td><?php echo $row->purchase_order_detail_desc ?></td>
		<?php if ($row->product_photo == '') { ?>
			<td></td>
		<?php } else { ?>
		<td height="85" width="62"><p><img id="gambar" src="<?php echo base_url(); ?>/upload/product/<?php echo $row->product_photo ?>" height="60" width="68" style="color:#012473; border-color:#012473;"/><p></td>
		<?php } ?>
		<td><?php echo $row->purchase_order_detail_remax ?></td>
	</tr>
	<?php
		$total_qty   = $total_qty + $row->purchase_order_detail_qty;
		$total_price = $total_price + $ttl_price;

	 } ?>

	<tfoot style="color:#012473; border-color:#012473;">
		<th style="color:#012473; border-color:#012473;" colspan="3"><b>Total</b></th>
		<td style="text-align: right; border-color:#012473; font:weight;"><b><?php echo $total_qty; ?></b></td>
		<th style="color:#012473; border-color:#012473;" colspan="2"></th>
		<td style="text-align: right; border-color:#012473; font:weight;"><b><?php if( $total_price> 0 ) { echo 'Rp '.number_format($total_price); } ?></b></td>

	</tfoot>

</table>
<br>
<table id="buat_border" style="color:#012473; font:weight;">
	<tr border-top="1">
		<td colspan="1">Note :</td>
	
		<td colspan="3">- Kadar air MAKSIMAL 10% KD</td>
		<td colspan="4">- Bebas Pin Hole/Kutu/Teter/Bubuk</td>
		
	</tr>
	<tr>
		<td colspan="1"></td>
		<td colspan="3">- Bebas GLUE LINE dan CUTTER MARK</td>
		<td colspan="4">- Kayu harus sudah diobat anti kutu</td>
		
	</tr>
	<tr>
		<td colspan="1"></td>
		<td colspan="3">- Barang harap dibersihkan terlebih dahulu dari serbuk kayu</td>
		
		
	</tr>
</table>
<br>
	<p style="color:#012473;">BANTUL, <?php  $tgl=date('d F Y'); echo $tgl; ?></p>
	<p style="color:#012473;"> C.V. SNR EKSPOR FURINDO &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		Vendor </p>
	<br><br><br>
	<p style="color:#012473;"> (FRANKIE JD ORAH) 		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		(_____________________) </p> 

