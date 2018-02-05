<?php
	$name = $sales_order->shipment_code;
	header("Content-Type: application/vnd.ms-excel");
	header('Content-Disposition: attachment;filename="INV-'.$name.'.xls"');
	header("Pragma: no-cache");
	header("Expires: 0");
?>	
		<table>
			<tr>
				<td rowspan="4" width="30px"></td>
				<td rowspan="4" width="30px">
					<img style="width:30px;height:40px; padding-top:5px;" src="<?php echo base_url(); ?>/assets/images/logo2.png"/>
				</td>
				<td colspan="3" style="font-size: 18px ; font-weight: bold ">
					C.V. SNR EKSPOR FURINDO
				</td>				
				<td style="font-size:30px;" colspan="3">INVOICE</td>
			</tr>
			<tr>
				<td colspan="3">
					<label>MANUFACTURE AND EXPORT FUNITURE</label><br>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<label>JL. RING ROAD SELATAN, TLAJUK/WOJO RT004/RW.11</label><br>
				</td>
				<td>INVOICE #  </td>
				<td>:</td>
			</tr>
			<tr>
				<td colspan="3">
					<label>BANGUN HARJO, SEWON, BANTUL 55187</label><br>
				</td>	
				<td>DATE  </td>
				<td>: <?php echo $sales_order->shipment_date ?></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td colspan="3">
					<label>YOGYAKARTA--INDONESIA</label><br>
				</td>			
				
			</tr>
			<tr>
				<td colspan="2"></td>
				<td colspan="3">
					<label>TEL/FAX: +62-274-445449</label>
								
			</tr>
			<tr>
				<td colspan="2"></td>
				<td colspan="3">
					<label>E-MAIL   : frankieorah@yahoo.com</label><br>
				</td>		
				
			</tr>	
		</table>
		<table>
			
			<tr>
				<td colspan="2"></td>
				<td colspan="3"></td>
				<!-- <td rowspan="5" colspan="5"></td> -->		
				
			</tr>
			<tr>
				<td colspan="2"></td>
				<td colspan="3">TO : </td>
				
			</tr>
			<tr>
				<td colspan="2"></td>
				<td colspan="3">NOIR TRADING INC</td>
				
			</tr>
			<tr>
				<td colspan="2"></td>
				<td colspan="3">14500 S. BROADWAY ST. GARDENA, CA 90248</td>
				
			</tr>
			<tr>
				<td colspan="2"></td>
				<td colspan="3">P: 310 527 5501    F: 310 527 5583</td>
				
			</tr>	

		</table>	
		
<table border="1" id="item-list" width="100%">
	<thead>
		<tr>
			<th rowspan="2" style="width:21px;text-align: right">no</th>
			<th rowspan="2">PO NO</th>
			<th rowspan="2">CODE</th>
			<th rowspan="2">DISCRIPTION</th>
			<th rowspan="2" style="width:50px;text-align: right">QTY</th>			
			<th  style="width:150px;text-align: center">UNIT</th>
			<th  style="width:150px;text-align: center">UNIT</th>
		</tr>
		<tr>			
			<th  style="width:150px;text-align: center">PRICE</th>
			<th  style="width:150px;text-align: center">TOTAL</th>
		</tr>
	</thead>
		
	<?php 

	$i= 1 ;
	$total_qty = 0; 
	$Volume = 0;   
	$cmb = 0;   
	foreach ( $sales_order_detail->result() as $row ) { ?>
	<tr>
		<td><?php echo $i++; ?></td>
		<td><?php echo $row->sales_order_ref_no; ?></td>
		<td><?php echo $row->product_code; ?></td>
		<td><?php echo $row->product_name; ?></td>
		<td align="right"><?php echo $row->shipment_detail_qty; ?></td>		
		<td align="right"><?php echo rp($row->product_price_usd*$curency); ?></td>
		<td align="right"><?php $ttl_usd = $row->shipment_detail_qty*$row->product_price_usd; echo rp($ttl_usd*$curency); ?></td>
		
	</tr>

	<?php 

		$Volume 	+= $ttl_usd*$curency; 
		$total_qty 	+= $row->shipment_detail_qty; 
		$cmb 		+= $row->product_price_usd*$curency; 
	?>
	<?php } ?>

	<tfoot>
		<th colspan="4">Total</th>
		<td style="text-align: right"><?php echo $total_qty; ?></td>		
		<td style="text-align: right"><?php echo rp($cmb); ?></td>
		<td style="text-align: right"><?php echo rp($Volume); ?></td>
	</tfoot>

</table>