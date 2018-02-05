<?php
	$name = $sales_order->shipment_code;
	header("Content-Type: application/vnd.ms-excel");
	header('Content-Disposition: attachment;filename="Packing-'.$name.'.xls"');
	header("Pragma: no-cache");
	header("Expires: 0");
?>	
		<table>
			<tr>
				<td rowspan="4" width="30px"></td>
				<td rowspan="4" width="30px">
					<img style="width:30px;height:40px; padding-top:5px;" src="<?php echo base_url(); ?>/assets/images/logo2.png"/>
				</td>
				<td colspan="4" style="font-size: 18px ; font-weight: bold ">
					C.V. SNR EKSPOR FURINDO
				</td>				
				<td style="font-size:30px;" colspan="3">PACKING LIST</td>
			</tr>
			<tr>
				<td colspan="4">
					<label>MANUFACTURE AND EXPORT FUNITURE</label><br>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<label>JL. RING ROAD SELATAN, TLAJUK/WOJO RT004/RW.11</label><br>
				</td>
				<td>DATE  </td>
				<td>: <?php echo $sales_order->shipment_date ?></td>
			</tr>
			<tr>
				<td colspan="4">
					<label>BANGUN HARJO, SEWON, BANTUL 55187</label><br>
				</td>			
				<td>CODE  </td>
				<td>: <?php echo $sales_order->shipment_code ?></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td colspan="4">
					<label>YOGYAKARTA--INDONESIA</label><br>
				</td>			
				
			</tr>
			<tr>
				<td colspan="2"></td>
				<td colspan="4">
					<label>TEL/FAX: +62-274-445449</label>
				</td>	
				<td>SHIPPING LINE  </td>				
			</tr>
			<tr>
				<td colspan="2"></td>
				<td colspan="4">
					<label>E-MAIL   : frankieorah@yahoo.com</label><br>
				</td>			
				<td>CONTAINER  </td>
				<td>: <?php echo $sales_order->shipment_container_code ?></td>
			</tr>	
		</table>
		<table>
			
			<tr>
				<td colspan="2"></td>
				<td colspan="4"></td>
				<!-- <td rowspan="5" colspan="5"></td> -->	
				<td>TRUCK #  </td>
				<td>: <?php echo $sales_order->shipment_truck_code ?></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td colspan="4">CONSIGNEE : </td>
				<td>DRIVER </td>
				<td>: <?php echo $sales_order->shipment_driver ?></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td colspan="4">NOIR TRADING INC</td>
				<td>SEAL #  </td>
				<td>: <?php echo $sales_order->shipment_seal_code ?></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td colspan="4">14500 S. BROADWAY ST. GARDENA, CA 90248</td>
				<td>LOADING DATE  </td>
				<td>: <?php echo $sales_order->shipment_loading_date ?></td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td colspan="4">P: 310 527 5501    F: 310 527 5583</td>				
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
			<th rowspan="2">BDL/ITEM</th>
			<th rowspan="2">BDL</th>
			<th>N.W</th>
			<th>G.W</th>
			<th  style="width:150px;text-align: right">VOL. UNIT</th>
			<th  style="width:150px;text-align: right">TOTAL</th>
		</tr>
		<tr>			
			<th>(KG)</th>
			<th>(KG)</th>
			<th  style="width:150px;text-align: right">CBM</th>
			<th  style="width:150px;text-align: right">VOL.</th>
		</tr>
	</thead>
		
	<?php 

	$i= 1 ;
	$total_qty = 0 ; 
	$Volume = 0;   
	$cmb = 0;
	$ttl_wieght=0;   
	foreach ( $sales_order_detail->result() as $row ) { ?>
	<tr>
		<td><?php echo $i++; ?></td>
		<td><?php echo $row->sales_order_ref_no; ?></td>
		<td><?php echo $row->product_code; ?></td>
		<td><?php echo $row->product_name; ?></td>
		<td align="right"><?php echo $row->shipment_detail_qty; ?></td>
		<td><?php echo $row->product_bundle; ?></td>
		<td><?php $bdl = $row->product_bundle*$row->shipment_detail_qty; echo $bdl; ?></td>
		<td><?php echo $row->product_weight; ?></td>
		<td><?php $weight = $row->product_weight*$row->shipment_detail_qty; echo $weight;?></td>
		<td align="right"><?php echo $row->product_cbm; ?></td>
		<td align="right"><?php $ttl_cbm = $row->product_cbm*$row->shipment_detail_qty; echo $ttl_cbm; ?></td>
		
	</tr>

	<?php 

		$Volume 	+= $ttl_cbm; 
		$total_qty 	+= $row->shipment_detail_qty; 
		$cmb 		+= $row->product_cbm;
		$ttl_wieght += $weight; 
	?>
	<?php } ?>

	<tfoot>
		<th colspan="4">Total</th>
		<td style="text-align: right"><?php echo $total_qty; ?></td>
		<th colspan="3"></th>
		<td style="text-align: right"><?php echo $ttl_wieght; ?></td>
		<td style="text-align: right"><?php //echo $cmb; ?></td>
		<td style="text-align: right"><?php echo $Volume; ?></td>
	</tfoot>

</table>