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
	<h1>Detail Pinjaman</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">			
			<div style="text-align:center; font-size:16px;">
				<label><b><?php echo strtoupper('RINCIAN PINJAMAN KSM '.$ksm->nama_ksm.' ('.$ksm->kode_ksm.')') ?></b></label><br>
				<label><b><?php $tgl = date('d F Y', strtotime($ksm->tgl_daftar)); echo strtoupper('TERDAFTAR TANGGAL '.$tgl);?></b></label><br>
				<label><b><?php echo strtoupper('JENIS USAHA '.$ksm->Jenis_usaha) ?></b></label>						
			</div>
			<hr>
			<?php $a=0; foreach ($nasabah->result() as $nasabah) { $a++;?>
			<div class="seperator">
			
			<div class="header1">
				<h4>RINCIAN NASABAH <?php echo $a; ?></h4>
			</div>

			<div class="form-horizontal">
				<div class="row">
					<div class="col-sm-3" style="padding-left:100px;">
						<img width="130" height="130" alt="User Image" class="user-image table-bordered" src="assets/images/icons/user.png">						
					</div>
					<div class="col-sm-9" style="padding-left:0px;">
						<div class="form-group">
							<label for="Nomor" class="col-sm-2">Nomor Nasabah</label>
							<label for="Nomor" class="col-sm-7">: <?php echo $nasabah->kode_nasabah; ?></label>
						</div>
						<div class="form-group">
							<label for="Nomor" class="col-sm-2">Nama Nasabah</label>
							<label for="Nomor" class="col-sm-7">: <?php echo $nasabah->nama; ?></label>
						</div>
						<div class="form-group">
							<label for="Nomor" class="col-sm-2">Alamat</label>
							<label for="Nomor" class="col-sm-7">: <?php echo $nasabah->alamat.' '; echo $nasabah->kodepos ?></label>
						</div>
						<div class="form-group">
							<label for="Nomor" class="col-sm-2">Pinjaman</label>
							<label for="Nomor" class="col-sm-7">: Rp <?php echo number_format($nasabah->nominal); ?>.00</label>
						</div>
						<div class="form-group">
							<label for="Nomor" class="col-sm-2">No Telp</label>
							<label for="Nomor" class="col-sm-7">: <?php echo $nasabah->notelp; ?></label>
						</div>
						
					</div>
					
					
				</div>
			</div>
			<hr>
			<form id="addkasmasuk">
				<div class="table-responsive" style="width:90%; margin:0px auto;">     
					<table id="tables"  width="100%" cellspacing="0" aria-describedby="tabel transaksi" role="grid" class="table table-striped table-bordered">
						<thead>
							<tr role="row">
								<th class="btn-primary" style="width:10%; text-align:center;">No</th>
								<th class="btn-primary" style="width:20%; text-align:center;">Angsuran</th>
								<th class="btn-primary" style="width:15%; text-align:center;">Jasa</th>
								<th class="btn-primary" style="width:15%; text-align:center;">Total Bayar</th>	
								<th class="btn-primary" style="width:15%; text-align:center;">Saldo</th>	
								<th class="btn-primary" style="width:25%; text-align:center;">Tanggal Bayar</th>								
							</tr>
						 </thead>
						<tbody name="tabelContent" id="tabelContent">
							<tr>
								<td style="text-align:center;">0</td>
								<td></td>
								<td></td>
								<td></td>
								<td style="text-align:right;">Rp <?php echo number_format($nasabah->nominal); ?>.00</td>
								<td></td>															
							</tr>
							<?php
								$saldo = $nasabah->nominal;
								$bunga = ($nasabah->nominal*$ksm->bunga);
								$angsuran = $nasabah->angsuran-$bunga;
								$sisa = $saldo-($angsuran*$ksm->lama);
								$no=0;
								$ttl_angsuran=0;
								$ttl_bunga=0;
								$ttl_pengembalian=0;
								$tgl_angsur = $this->db->query("SELECT tgl_kas from trx_kas inner join trx_kas_det on 
										trx_kas.id_kas=trx_kas_det.id_kas where kode = '1.1.3' AND id_nasabah = '".$nasabah->id_nasabah."'");
								$sudah_angsur = $tgl_angsur->num_rows();
								for ($i=$ksm->lama; $i > 0 ; $i--) {													
									$no = $no+1;											
									if($i==1){
										$angsuran = $angsuran+$sisa;
									}
									$total = $angsuran+$bunga;		
									$saldo = $saldo-$angsuran;
									$sisa_angsur = $ksm->lama-$i;
									
								?>
								<tr>
									<td style="text-align:center;"><?php echo $no; ?></td>
									<td style="text-align:right;">Rp <?php echo number_format($angsuran); ?>.00</td>
									<td style="text-align:right;">Rp <?php echo number_format($bunga); ?>.00</td>
									<td style="text-align:right;">Rp <?php echo number_format($total); ?>.00</td>
									<td style="text-align:right;">Rp <?php echo number_format($saldo); ?>.00</td>
									<td style="text-align:right;">
										<?php 
										if($sisa_angsur < $sudah_angsur){
											echo date("d F Y", strtotime($tgl_angsur->row($sisa_angsur)->tgl_kas));
										}
										?>
									</td>
								</tr>
								<?php 
									$ttl_angsuran += $angsuran;
									$ttl_bunga += $bunga;
									$ttl_pengembalian += $total;
								
								}
								?>
								<tr class="btn-info">
									<td style="text-align:center;"><b>TOTAL</b></td>
									<td style="text-align:right;">Rp <?php echo number_format($ttl_angsuran); ?>.00</td>
									<td style="text-align:right;">Rp <?php echo number_format($ttl_bunga); ?>.00</td>
									<td style="text-align:right;">Rp <?php echo number_format($ttl_pengembalian); ?>.00</td>
									<td colspan="2" style="text-align:right;"></td>									
								</tr>
						</tbody>						
					</table>					
			   </div>
			</form>				
			</div>	
			<?php } ?>	
		</div>
	</div>
</div>
<script src="<?php echo base_url()?>assets/js/func.js" type="text/javascript"></script>

<script type="text/javascript">	

	
</script>