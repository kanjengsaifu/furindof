<style>
	.seperator{
		border: 1px solid #ccc;
		padding: 10px 0px 10px 0px;
		margin:20px 0px 20px 0px;
		border-radius:3px;
	}
	.header1{
		text-align:center;
		border-bottom:1px solid #ccc;
		margin:0px 0px 10px 0px;
		font-size: 18px;
	}
	
	li.ui-menu-item{
		background:#fff;
		list-style-type:none;
		width:210px !important;
		margin:0px !important;
		left:0px !important;
		padding:5px;
		border-bottom:1px dashed #ccc;
	}
	
	li.ui-menu-item:hover{
		background:#ccc;
		cursor:pointer;
	}
</style>
<div class="content-header">        
	<h1>Laporan Rugi Laba</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">			
			<div class="box-header">					

				<button type="button" class="btn btn-sm btn-primary" onclick="dialogFormPrint()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak Laporan</button>		

			</div>
						
			<div class="seperator">
			
			<div class="header1">
				<label><b><?php echo strtoupper('NERACA') ?></b></label><br>
				<label><b><?php $tgl = date('d F Y'); echo strtoupper('PERIODE : '.$tgl);?></b></label><br>				
			</div>			
			
			<form id="addkasmasuk">
				<div class="table-responsive" style="width:90%; font-size:16px; margin:0px auto;">     
					<table id="tables"  width="100%" cellspacing="0" aria-describedby="tabel transaksi" role="grid" class="table table-bordered">
						
						<tr role="row">
							<td colspan="3" style="text-align:left; background: #999;">AKTIVA</td>																					
						</tr>						 
						<tbody name="tabelContent" id="tabelContent">
						<?php 
							$jml = 0;		
								
							$a=0; 
							foreach ($aktiva->result() as $kas) { 
							$a++;
								$jml += $kas->total; ?>
								
							<tr>
								<td style="text-align:center;"><?php echo $kas->kode_kasbank; ?></td>
								<td><?php echo $kas->nama_kasbank; ?></td>
								<td style="text-align:right;"><?php echo rp($kas->total); ?></td>								
							</tr>
						<?php } ?>											
							
							<tr>
								<td></td>
								<td colspan="1" style="text-align:left;"><b>Jumlah</b></td>
								<td style="text-align:right;"><b><?php echo rp($jml); ?></b></td>
							</tr>
							<tr>
								<td colspan="3" style="text-align:left; background: #999;">PASSIVA</td>								
							</tr>
						<?php 
							$jml_pasiva = 0;		
								
							$a=0; 
							foreach ($pasiva->result() as $kas1) { 
							$a++;
								if($kas1->total < 0){
									$kas1->total = $kas1->total*-1;
								}
								
								$jml_pasiva += $kas1->total; ?>
								
							<tr>
								<td style="text-align:center;"><?php echo $kas1->kode_kasbank; ?></td>
								<td><?php echo $kas1->nama_kasbank; ?></td>
								<td style="text-align:right;"><?php echo rp($kas1->total); ?></td>								
							</tr>
						<?php } ?>		
							
							<tr>
								<td style="text-align:center;"></td>
								<td>Laba tahun berjalan</td>
								<td style="text-align:right;"><?php $laba = $debet->nominal-$kredit->nominal+32476377+11558920; echo rp($laba); ?></td>								
							</tr>				
							
							<tr>
								<td></td>
								<td colspan="1" style="text-align:left;"><b>Jumlah</b></td>
								<td style="text-align:right;"><b><?php echo rp($jml_pasiva+$laba); ?></b></td>
							</tr>
							<tr>
								<td colspan="3"></td>
							</tr>							
						</tbody>						
					</table>					
			   </div>
			</form>				
			</div>			
		</div>
	</div>
</div>
<script src="<?php echo base_url()?>assets/js/func.js" type="text/javascript"></script>

<script type="text/javascript">	
function dialogFormPrint()

	{
		//var htmlOut = ajaxFillGridJSON('transaksi/printbkk', {idx : idx}); 

		var htmlOut = "<?php echo site_url("laporan/printneraca")?>";
        
        window.open(htmlOut);   
    			   

	}
	
</script>