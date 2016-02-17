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
	<h1>Laporan Laba Rugi</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">			
			<div class="box-header">					

				<button type="button" class="btn btn-sm btn-primary" onclick="dialogFormPrint()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak Laporan</button>		

			</div>
						
			<div class="seperator">
			
			<div class="header1">
				<label><b><?php echo strtoupper('LAPORAN LABA RUGI') ?></b></label><br>
				<label><b><?php $tgl = date('d F Y'); echo strtoupper('tanggal '.$tgl);?></b></label><br>				
			</div>			
			
			<form id="addkasmasuk">
				<div class="table-responsive" style="width:90%; font-size:16px; margin:0px auto;">     
					<table id="tables"  width="100%" cellspacing="0" aria-describedby="tabel transaksi" role="grid" class="table table-bordered">
						
						<tr role="row">
							<td colspan="3" style="text-align:left; background: #999;">PENDAPATAN</td>																					
						</tr>						 
						<tbody name="tabelContent" id="tabelContent">
							<?php 
								//if ($kas->row()->jenis == 'um') {
								$ttl_masuk=0;
								$ttl_keluar=0;
								$labarugi=0;
								$a=0; foreach ($kas->result() as $kas1) { 
								$a++;
								if ($kas1->jenis == 'um') {								
								?>
							<tr>
								<td style="text-align:center;"><?php echo $kas1->kode; ?></td>
								<td><?php echo $kas1->uraian; ?></td>
								<td style="text-align:right;"><?php $ttl_masuk += $kas1->nominal; echo rp($kas1->nominal); ?></td>								
							</tr>
							<?php } } ?>
							<tr>
								<td></td>
								<td colspan="1" style="text-align:left;"><b>Total Pemasukan</b></td>
								<td style="text-align:right;"><b><?php echo rp($ttl_masuk); ?></b></td>
							</tr>
							<tr>
								<td colspan="3" style="text-align:left; background: #999;">PENGELUARAN</td>								
							</tr>
							<?php 
								//} else { 
								$a=0; foreach ($kas->result_array() as $kas) { 
								$a++;
								if ($kas['jenis'] == 'uk') {
							?>
							<tr>
								<td style="text-align:center;"><?php echo $kas['kode']; ?></td>
								<td><?php echo $kas['uraian']; ?></td>
								<td style="text-align:right;"><?php $ttl_keluar += $kas['nominal']; echo rp($kas['nominal']); ?></td>								
							</tr>
							<?php } } ?>
							<tr>
								<td></td>
								<td colspan="1" style="text-align:left;"><b>Total Pengeluaran</b></td>
								<td style="text-align:right;"><b><?php echo rp($ttl_keluar); ?></b></td>
							</tr>
							<tr>
								<td colspan="3"></td>
							</tr>
							<tr style="background: #AAA;">
								<td></td>								
								<?php 
									if ($ttl_keluar > $ttl_masuk) {
									$labarugi = $ttl_keluar-$ttl_masuk;
								?>
								<td colspan="1" style="text-align:left;"><b>LABA-RUGI</b></td>
								<td style="text-align:right;"><b><?php echo minus($labarugi); ?></b></td>
								<?php 
									}else{
									$labarugi = $ttl_masuk-$ttl_keluar;
								?>
								<td colspan="1" style="text-align:left;"><b>LABA-RUGI</b></td>
								<td style="text-align:right;"><b><?php echo rp($labarugi); ?></b></td>
								<?php } ?>
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

		var htmlOut = "<?php echo site_url("laporan/printlabarugi")?>";
        
        window.open(htmlOut);   
    			   

	}

</script>