<style>
	
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
		background:#3C8DBC;
		color:#ffffff;
		cursor:pointer;
	}
</style>

<div class="content-header">   
	<h1>Register Kelompok Swadaya Masyarakat</h1>
</div>
<div class="content">
	<div style="background:#ECF0F5;" class="box box-warning">
	  	<div class="box-body" style="min-height:800px;">
		<form id="form-regksm" onsubmit="simpanreg(); return false;">
			<input type="hidden" name="lab" value="1"/>
			<div class="content" style="min-height:350px;">
				<div class="col-md-6">
					<div class="form-horizontal">
						<div class="row">
							<div class="col-sm-12">    
								  <div class="form-group">
									  <label for="kasbank" class="control-label col-sm-3">Kode KSM :</label>
									  <div class="col-sm-8">          
										<input type="text" readonly="true" value="" id="noreg" class="form-control" name="noreg"/>
									  </div>
								  </div>
							  </div>
						</div>
						<div class="row">
							<div class="col-sm-12">    
								  <div class="form-group">
									  <label for="kasbank" class="control-label col-sm-3">Nama KSM :</label>
									  <div class="col-sm-8">
										<input type="text"  id="namaksm" class="form-control pull-right" name="namaksm" required/>
									  </div>								  
								  </div>
							  </div>
						</div>
						<div class="row">
							<div class="col-sm-12">    
								  <div class="form-group">
									  <label for="rangetanggal" class="control-label col-sm-3">Tanggal Reg:</label>
									  <div class="col-sm-8">          
										<div class="input-group">
										  <input type="text" name="tglreg" id="tglreg" readonly="readonyl" class="form-control pull-right date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										</div>
									  </div>
								  </div>
							  </div>
						</div>	
						<div class="row">
							<div class="col-sm-12">    
								  <div class="form-group">
									  <label for="kasbank" class="control-label col-sm-3">Bidang Usaha :</label>
									  <div class="col-sm-8">
										<input type="text"  id="bidangusaha" class="form-control pull-right" name="bidangusaha" required/>
									  </div>								  
								  </div>
							  </div>
						</div>
						<div  class="row">
								<div class="col-sm-12">    
									  <div class="form-group">
										  <label class="control-label col-sm-3">Diskripsi :</label>
										  <div class="col-sm-8">          
											<textarea type="text"  id="diskripsi" class="form-control" name="diskripsi"/></textarea>
										  </div>
									  </div>				

								  </div>
							</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-horizontal">
						<div class="row">
							<div class="col-sm-12">    
								  <div class="form-group">
									  <div class="col-sm-12 ">          
										<table border="0" class="table table-bordered">
											<tr>
												<th>No</th>
												<th>Unsur Kelengkapan Proposal</th>
												<th>Sesuai / Tidak Sesuai</th>
											</tr>
											<tr>
												<td>1</td>
												<td>Proposal</td>
												<td><input type="radio" checked="checked" value="1" name="proposal2" />Sesuai <input type="radio" value="0" name="proposal2" />Tidak Sesuai</td>
											</tr>
											<tr>
												<td>2</td>
												<td>Susunan Pengurus</td>
												<td><input type="radio" checked="checked" value="1" name="pengurus" />Sesuai <input type="radio" value="0" name="pengurus" />Tidak Sesuai</td>
											</tr>
											<tr>
												<td>3</td>
												<td>KTP Anggota</td>
												<td><input type="radio" checked="checked" value="1" name="keanggotaan" />Sesuai <input type="radio" value="0" name="keanggotaan" />Tidak Sesuai</td>
											</tr>
											<tr>
												<td>4</td>
												<td>Modal Usaha</td>
												<td><input type="radio" checked="checked" value="1" name="modalusaha" />Sesuai <input type="radio" value="0" name="modalusaha" />Tidak Sesuai</td>
											</tr>
											<tr>
												<td>5</td>
												<td>Rencana Anggaran</td>
												<td><input type="radio" checked="checked" value="1" name="rab" />Sesuai <input type="radio" value="0" name="rab" />Tidak Sesuai</td>
											</tr>
											<tr>
												<td>6</td>
												<td>Tujuan Penggunaan Dana</td>
												<td><input type="radio" checked="checked" value="1" name="tujuan"/>Sesuai <input type="radio" value="0" name="tujuan"/>Tidak Sesuai</td>
											</tr>
											<tr>
												<td>7</td>
												<td>Pengesahan</td>
												<td><input value="1" checked="checked" type="radio" name="pengesahan" />Sesuai <input value="0" type="radio" name="pengesahan" />Tidak Sesuai</td>
											</tr>
										</table>
									  </div> 
								  </div> 
								</div>  
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="content" id="contentAnggota"  style="margin-top:-60px; border-top:0px solid #3C8DBC; cursor:pointer;">
				<div  type="button" onclick="ujiback(1)" style="background-color: #605ca8; color: white; margin: 60px -5px 10px -5px; padding: 10px; text-align: center; font-size: 24px;">
					Form Anggota 1
				</div>
				<div class="row" style="margin-bottom:10px;">
					<div class="col-md-12">
					<input type="hidden" id="seqcode" />
						<button style="margin:1px;" type="button" onclick="ujinext(0)" class="btn btn-primary btn-sm pull-right">						
						Next
						<span class="glyphicon glyphicon-forward" aria-hidden="true"></span>
						</button>
						<button style="margin:1px;" type="button" onclick="tambahBaruAnggota()" class="btn btn-success btn-sm pull-right">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						Tambah Anggota
						</button>
						<!-- <button style="margin:1px;" type="button" onclick="tambahRowUji(0)" class="btn btn-success btn-sm pull-right">
						<span class="glyphicon glyphicon-copy" aria-hidden="true"></span>
						Tambah & Copy
						</button> -->
						<button style="margin:1px;" type="button" onclick="homeuji()" class="btn btn-primary btn-sm pull-right">
						<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
						Home
						</button>
					</div>
				</div>
				
				
				<div class="row info-input" id="info-input" style="border-bottom:1px dashed #000; margin:10px 0px 10px 0px; padding:10px 0px 10px 0px;">
					<div class="col-md-6">
						<div class="form-horizontal">
							
							<input type="hidden" id="seqdiklat" />
							<div style="margin-bottom:5px;" class="row">
								<div class="col-sm-12">    
									  <div class="form-group">
										  <label class="control-label col-sm-3">No Anggota :</label>
										  <div class="col-sm-8">          
											<input type="text" readonly id="noanggota-0" class="form-control" name="noanggota[]"/>
										  </div> 
									  </div> 
								  </div> 
							</div>
							<div style="margin-bottom:5px;" class="row">
								<div class="col-sm-12"> 
									<div class="form-group">
									    <label for="kataKunci" class="col-sm-3 control-label">Kode Kontak</label>
									    <div class="col-sm-8">
									    	<div class="input-group">
									    		<input id="idkontak-0"  name="idkontak[]" type="hidden" class="form-control" required/>
									       		<input id="kodekontak-0" readonly name="kodekontak[]" type="text" class="form-control" required/>
										       	<span class="input-group-btn">
									       			<button type="button" class="btn btn-primary" onclick="btnkontak(0)"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
									       		</span>
								       		</div>
									    </div>
									</div>  
								</div> 
							</div> 
							
							
							<div style="margin-bottom:5px;" class="row">
								<div class="col-sm-12">    
									  <div class="form-group">
										  <label class="control-label col-sm-3">Nama Anggota :</label>
										  <div class="col-sm-8">          
											<input type="text" readonly  id="namaanggota-0" class="form-control" name="namaanggota[]" required/>
										  </div> 
									  </div>
								  </div>
							</div>
							<div style="margin-bottom:5px;" class="row">
								<div class="col-sm-12">    
									  <div class="form-group">
										  <label class="control-label col-sm-3">No KTP :</label>
										  <div class="col-sm-8">          
											<input type="text" id="noktp-0" class="form-control" name="noktp[]" required/>
										  </div>
									  </div>
								  </div>
							</div>								
							<div style="margin-bottom:5px;" class="row">
								<div class="col-sm-12">    
									  <div class="form-group">
										  <label class="control-label col-sm-3">Jenis Kelamin:</label>
										  <div style="margin-top:5px;" class="col-sm-8">          
											<select id="jeniskelamin-0" name="jeniskelamin[]" class="form-control">
												<option value="">--PILIH Jenis Kelamin--</option>
												<option value="L">Laki-laki</option>
												<option value="P">Perempuan</option>
											</select>
										  </div>
									  </div>
								  </div>
							</div>							
						</div>
					</div>							
						
					<div class="col-md-6">
						<div class="form-horizontal">
							<div style="margin-bottom:5px;" class="row">
								<div class="col-sm-12">    
									  <div class="form-group">
										  <label class="control-label col-sm-3">Alamat :</label>
										  <div class="col-sm-8">          
											<input type="text" readonly id="alamat-0" class="form-control" name="alamat[]"/>
										  </div>
									  </div>
								  </div>
							</div>
							<div style="margin-bottom:5px;" class="row">
								<div class="col-sm-12">    
									  <div class="form-group">
										  <label class="control-label col-sm-3">Kode Pos :</label>
										  <div class="col-sm-8">          
											<input type="text" readonly id="pos-0" class="form-control" name="pos[]"/>
										  </div>
									  </div>
								  </div>
							</div>
							<div style="margin-bottom:5px;" class="row">
								<div class="col-sm-12">    
									  <div class="form-group">
										  <label class="control-label col-sm-3">Email :</label>
										  <div class="col-sm-8">          
											<input type="text" readonly id="email-0" class="form-control" name="email[]"/>
										  </div>
									  </div>
								  </div>
							</div>
							<div style="margin-bottom:5px;" class="row">
								<div class="col-sm-12">    
									  <div class="form-group">
										  <label class="control-label col-sm-3">Deskripsi :</label>
										  <div class="col-sm-8">          
											<textarea type="text" id="diskripsi-0" class="form-control" name="diskripsi[]"/></textarea>
										  </div>
									  </div>
								  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-primary btn-sm">
			<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
			Simpan Data</button>
		</div> <!-- <div class="box-body"> -->
		</form>
	  </div>
	</div> <!-- <div class="box box-primary"> -->
</div>

<div class="modal fade" id="modalkontak">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close batal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Kontak</h4>
        <input type="hidden" id="buatkontak" name="buatkontak"/>
      </div>
      <div class="modal-body">
        <div class="form-horizontal">
		
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-md-12">
						<form id="cari-rekanan">
						<div class="col-sm-3">
							<button type="button" class="btn btn-primary btn-sm" id="tmbkontak">
								<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
								Tambah Kontak
							</button>
						</div>
						<div class="form-horizontal">	
							<div class="form-group">								
								<label class="control-label col-sm-3">Cari :</label>
								<div class="col-sm-5">          
									<input type="text" oninput="caridatakontak()"  id="kode_search" class="form-control" name="kode"/>
								</div> 
							</div>
						</div>
						</form>
					</div>
					<div class="col-sm-12" style="max-height:280px;overflow-y:auto; margin:20px 0px 20px 0px;">
					<table class="table table-bordered">
						<tr>
							
							<th width="15%">No</th>
							<th width="45%">Kode</th>
							<th width="15%">Nama</th>
							<th width="15%">Aksi</th>
							
						</tr>
						<tbody id="caridatakontak"></tbody>
					</table>
					</div>
					
				</div>
			</div>
		</div>
		
		</div>
      </div>
      <div class="modal-footer">
        *Klik tombol "Pilih" untuk memilih kontak yang diinginkan.
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal hide" id="dialogFormBaru" tabindex="1" role="dialog" aria-labelledby="FormTambahData" aria-hidden="true">

	 <div class="modal-dialog" style="min-width:70%">

	    <div class="modal-content">

	      <div class="modal-header">

	        <h4 class="modal-title" id="FormTambahData">Tambah Data Rekanan</h4>

	      </div>

	      <div class="modal-body">

	      	<div class="pesanBaru"></div>

	      		<form id="formBaru" class="form-horizontal" action="admin/TambahKontak" method="post">

	      			<div class="row">

	      				<div class="col-sm-6">

							<!-- <div class="form-group">

							    <label for="kode" class="col-sm-3 control-label">Tipe</label>

							    <div class="col-sm-9">

							    	<label class="control-label" id="lblTipe"></label>

							    	<input type="hidden" id="tipe" name="tipe" value="3"/>

							    </div>

						    </div> -->
						    <input type="hidden" id="tipe" name="tipe" value="3"/>
						    <input type="hidden" id="jenis" name="jenis" value="1"/>
						    <!-- <div class="form-group">

							    <label for="kode" class="col-sm-3 control-label">Jenis</label>

							    <div class="col-sm-9">

							       <input type="hidden" id="jenis" name="jenis" value="1"/>							       

							    </div>

						    </div> -->

			      			<div class="form-group">

							    <label for="kode" class="col-sm-3 control-label">Kode</label>

							    <div class="col-sm-9">

							       	<input id="kode" name="kode" readonly value="" type="text" class="form-control"/>

							    </div>

						    </div>

						    <div class="form-group">

							    <label for="nama" class="col-sm-3 control-label">Nama</label>

							    <div class="col-sm-9">

							       	<input id="nama" name="nama" value="" type="text" class="form-control" required/>

							    </div>

						    </div>

						     <div class="form-group">

							    <label for="alamat" class="col-sm-3 control-label">Alamat</label>

							    <div class="col-sm-9">

							       	<div class="input-group">
							       		<input id="alamat" readonly name="alamat" type="text" class="form-control"/>
								       	<span class="input-group-btn">
							       			<button type="button" class="btn btn-primary" id="btnCarialamat"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
							       		</span>
						       		</div>

							    </div>

						    </div>

						    <div class="form-group">

							    <label for="kodepos" class="col-sm-3 control-label">Kode Pos</label>

							    <div class="col-sm-9">

							       	<input id="kodepos" name="kodepos" value="" type="text" class="form-control" required/>

							    </div>

						    </div>

	      				</div> <!-- <div class="col-sm-6"> -->



	      				<div class="col-sm-6">

	      					 <div class="form-group">

							    <label for="notelp" class="col-sm-3 control-label">No Telp</label>

							    <div class="col-sm-9">

							       	<input id="notelp" name="notelp" value="" type="text" class="form-control" required/>

							    </div>

						    </div>
						    

	      					  <div class="form-group">

							    <label for="email" class="col-sm-3 control-label">Email</label>

							    <div class="col-sm-9">

							       	<input id="email" name="email" value="" type="text" class="form-control"/>

							    </div>

						    </div>
						    

						    <div class="form-group">

							    <label for="pic" class="col-sm-3 control-label">PIC</label>

							    <div class="col-sm-9">

							       	<input id="pic" name="pic" value="" type="text" class="form-control" required/>

							    </div>

						    </div>

						    <div class="form-group">

							    <label for="deskripsi" class="col-sm-3 control-label">Deskripsi</label>

							    <div class="col-sm-9">

							       	<textarea id="deskripsi" name="deskripsi" class="form-control"></textarea>

							    </div>

						    </div>

	      				</div><!-- <div class="col-sm-6"> -->

	      			</div>

		        </form>  

	      </div>

	      <div class="modal-footer">

	        <button type="button" class="btn btn-sm btn-primary" id="btnTambahKontak">Tambah</button>

	        <button type="button" class="btn btn-sm btn-primary" id="btnBatalTambahKontak">Batal</button>

	      </div>

	    </div>

	  </div>

	</div> <!-- end modal -->


	<div class="modal fade" id="modalalamat">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Data Alamat</h4>
	      </div>
	      <div class="modal-body">
	        <div class="form-horizontal">
			<form id="add-rekanan">
				<input type="hidden" id="obj" value=""/>
				<div class="row">
					<div class="col-sm-12">
					<div class="row">
						<div class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-sm-3">Kecamatan :</label>
								<div class="col-sm-8">          
									<select id="kecamatan" class="form-control">
										<?php 
										$kecamatan = $this->db->query("SELECT * from ref_kecamatan");
										foreach($kecamatan->result() as $row) { ?>
											<option value="<?php echo $row->id_kecamatan?>"><?php echo $row->nama_kecamatan?></option>
										<?php } ?>
									</select>
								</div> 
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Kelurahan :</label>
								<div class="col-sm-8">          
									<select id="kelurahan" class="form-control" onclick="getdatakecamatan()">
										<?php 
										$kelurahan = $this->db->query("SELECT * from ref_kelurahan");
										foreach($kelurahan->result() as $row) { ?>
											<option value="<?php echo $row->id_kelurahan?>"><?php echo $row->nama_kelurahan?></option>
										<?php } ?>
									</select>
								</div> 
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Pedukuhan :</label>
								<div class="col-sm-8">          
									<select id="pedukuhan" class="form-control" onclick="getdatakelurahan()">
										<?php 
										$pedukuhan = $this->db->query("SELECT * from ref_pedukuhan");
										foreach($pedukuhan->result() as $row) { ?>
											<option value="<?php echo $row->id_pedukuhan?>"><?php echo $row->nama_pedukuhan?></option>
										<?php } ?>
									</select>
								</div> 
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3"></label>
								<div class="col-sm-8">          
									<button type="button" onclick="getdataalamat()" class="btn btn-sm btn-primary">
									<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
									Cari data
									</button>
									<button type="button" class="btn btn-sm btn-primary" id="btnBatalAlamat">Batal</button>
								</div> 
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<table class="table table-stripped table-bordered">
							<tr>
								<th>Kode</th>
								<th>Nama RT / RW</th>
								<th>Aksi</th>
							</tr>
							<tbody id="tablealamat"></tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
			</form>
			</div>
	      </div>
	      <div class="modal-footer">
	        *Klik tombol "Pilih" untuk memilih kelurahan yang diinginkan.
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->



<script src="assets/js/func.js" type="text/javascript"></script>
	
<script type="text/javascript">
	$(document).ready(function(){
		var tglreg = "<?php echo date("d-m-Y")?>";
		$("#tglreg").val(tglreg);
		getnokontak("<?php echo $mohon2?>");

		$(".date").datepicker({
			format : "dd-mm-yyyy",
			autoclose : true
		});	

		$('.btnKontak').click( function(e){

 			e.preventDefault(); 
			//$('#dialogFormBaru').attr('class', 'modal close');
			$('#modalkontak').attr('class', 'modal show');

	    });

	    $('#btnBatalTambahKontak').click( function(e){

    		e.preventDefault(); 

    		$('#dialogFormBaru').attr('class', 'modal close');

    		$('#modalkontak').attr('class', 'modal show');

   		}); 

	    $('#btnTambahKontak').click( function(e){

 			e.preventDefault();

	       	sendRequestForm($('#formBaru').attr('action'), $('#formBaru').serialize(), 'pesanBaru');
	       	$('#dialogFormBaru').attr('class', 'modal close');
    		$('#modalkontak').attr('class', 'modal show');
    		caridatakontak();

	    });

	    $('#btnCarialamat').click( function(e){

 			e.preventDefault(); 
			$('#dialogFormBaru').attr('class', 'modal close');
			$('#modalalamat').attr('class', 'modal show');

	    });

	    $('#btnBatalAlamat').click( function(e){

 			e.preventDefault(); 

	       	//sendRequestForm($('#formUbah').attr('action'), $('#formUbah').serialize(), 'pesanUbah'); 
	       	$('#modalalamat').attr('class', 'modal close');
	       	$('#dialogFormBaru').attr('class', 'modal show');


	    });

	    $('#tmbkontak').click( function(e){

 			e.preventDefault(); 
			$('#modalkontak').attr('class', 'modal close');
			$('#dialogFormBaru').attr('class', 'modal show');

	    });

	    $('.batal').click( function(e){

 			e.preventDefault(); 
			$('#modalkontak').attr('class', 'modal close');
			//$('#modalkontak').attr('class', 'modal show');

	    });
		defaultForm();
		var nbs = getnoksm('<?php echo $nasabah->kode_nasabah; ?>');
			mks = getnoregksm('<?php echo $ksm->kode_ksm; ?>');
		$('#noanggota-0').val(nbs);
		$('#noreg').val(mks);
		
	});

	function hapushtml(hps) {
		ojs = hps-1;
		isDelete = confirm("Apakah Yakin menghapus data ini ?");
			if(isDelete)
			{
				$('#tmbinput-'+hps).remove();
				$("#seqcode").val($("#noanggota-"+ojs).val());				
				if (hps==1) {
					document.getElementById("contentBakuMutu").scrollIntoView();
				}else{
					document.getElementById("tmbinput-"+ojs).scrollIntoView();
					$("#hapushtml-"+ojs).removeAttr("disabled");
				}
			}
		
	}
	function getnoksm(param)
	{
		
		getNum = param.split("B");
		Nums = parseInt(getNum[1]);
		Num  = eval(Nums) + 1;
		
		
		if(Num <= 9)
		{
			code = getNum[0]+"B"+"000"+Num;
		}
		else if(Num > 9 && Num <= 99)
		{
			code = getNum[0]+"B"+"00"+Num;
		}
		else if(Num > 99 && Num <= 999)
		{
			code = getNum[0]+"B"+"0"+Num;
		}
		else
		{
			code = getNum[0]+"B"+Num;
		}
		$("#seqcode").val(code);
		return code;
	}

	function getnoregksm(param)
	{
		
		getNum = param.split("-");
		Nums = parseInt(getNum[1]);
		Num  = eval(Nums) + 1;
		
		
		if(Num <= 9)
		{
			code = getNum[0]+"-"+"000"+Num;
		}
		else if(Num > 9 && Num <= 99)
		{
			code = getNum[0]+"-"+"00"+Num;
		}
		else if(Num > 99 && Num <= 999)
		{
			code = getNum[0]+"-"+"0"+Num;
		}
		else
		{
			code = getNum[0]+"-"+Num;
		}		
		return code;
	}

	function defaultForm()
	{
		
		$("#seqcode").val('<?php echo $nasabah->kode_nasabah; ?>');
		
	}
	function tambahRowUji(ast){
	
	var obj = $(".info-input").length;
				nouji = $("#seqcode").val();
					autoNum = getnoksm(nouji);
					noform = obj+1;
					obk = obj-1;
					
				var 
					mst = '<div class="content" id="tmbinput-'+obj+'"  style="margin-top:-60px; border-top:0px solid #3C8DBC; cursor:pointer; min-height:550px;">';
						mst += '<div type="button" style="background-color: #605ca8; color: white; margin: 60px -5px 10px -5px; padding: 10px; text-align: center; font-size: 24px;">';
							mst += 'Form Anggota '+noform;
						mst += '</div>';
						mst += '<div class="row" style="margin-bottom:10px;">';
							mst += '<div class="col-md-12">';
								mst += '<button style="margin:1px;" type="button" onclick="ujinext('+obj+')" class="btn btn-primary btn-sm pull-right">';							
								mst += 'Next ';
								mst += '<span class="glyphicon glyphicon-forward" aria-hidden="true"></span>';
								mst += '</button>';	
								mst += '<button style="margin:1px;" type="button" onclick="hapushtml('+obj+')" id="hapushtml-'+obj+'" class="btn btn-danger btn-sm pull-right">';
								mst += '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>';
								mst += 'Hapus Contoh Uji';
								mst += '</button>';								
								mst += '<button style="margin:1px;" type="button" onclick="tambahBaruRowUji()" class="btn btn-success btn-sm pull-right">';
								mst += '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>';
								mst += 'Tambah Contoh Uji';
								mst += '</button>';
								mst += '<button style="margin:1px;" type="button" onclick="tambahRowUji('+obj+')" class="btn btn-success btn-sm pull-right">';
								mst += '<span class="glyphicon glyphicon-copy" aria-hidden="true"></span>';
								mst += 'Tambah & Copy';
								mst += '</button>';
								mst += '<button style="margin:1px;" type="button" onclick="ujiback('+obj+')" class="btn btn-primary btn-sm pull-right">';
								mst += '<span class="glyphicon glyphicon-backward" aria-hidden="true"></span>';
								mst += ' Back';
								mst += '</button>';
							mst += '</div>';
						mst += '</div>';
						
						
						mst += '<div class="row info-input" id="info-input" style="border-bottom:1px dashed #000; margin:10px 0px 10px 0px; padding:10px 0px 10px 0px;">';
							mst += '<div class="col-md-6">';
								mst += '<div class="form-horizontal">';
									
									mst += '<input type="hidden" id="seqdiklat" />';
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';    
											  mst += '<div class="form-group">';
												  mst += '<label class="control-label col-sm-3">No Anggota :</label>';
												  mst += '<div class="col-sm-8">';          
													mst += '<input type="text" readonly id="noanggota-'+obj+'" class="form-control" name="noanggota[]"/>';
												  mst += '</div>'; 
											  mst += '</div>';
										  mst += '</div>'; 
									mst += '</div>';
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';  
											mst += '<div class="form-group">';
											    mst += '<label for="kataKunci" class="col-sm-3 control-label">Kode Kontak</label>';
											    mst += '<div class="col-sm-8">';
											    	mst += '<div class="input-group">';
											       		mst += '<input id="idkontak-0" name="idkontak[]" type="hidden" class="form-control"/>';
											       		mst += '<input id="kodekontak-'+obj+'" readonly name="kodekontak[]" type="text" class="form-control"/>';
												       	mst += '<span class="input-group-btn">';
											       			mst += '<button type="button" class="btn btn-primary btnKontak" onclick="btnkontak('+obj+')"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>';
											       		mst += '</span>';
										       		mst += '</div>';
											    mst += '</div>';
											mst += '</div>';
										mst += '</div>';
									mst += '</div>';
									
									
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';
											  mst += '<div class="form-group">';
												  mst += '<label class="control-label col-sm-3">Nama Anggota :</label>';
												  mst += '<div class="col-sm-8">';
													mst += '<input type="text" readonly  id="namaanggota-'+obj+'" class="form-control" name="namaanggota[]"/>';
												  mst += '</div>';
											  mst += '</div>';
										  mst += '</div>';
									mst += '</div>';
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';   
											  mst += '<div class="form-group">';
												  mst += '<label class="control-label col-sm-3">No KTP :</label>';
												  mst += '<div class="col-sm-8">';  
													mst += '<input type="text" id="noktp-'+obj+'" class="form-control" name="noktp[]"/>';
												  mst += '</div>';
											  mst += '</div>';
										  mst += '</div>';
									mst += '</div>';								
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';  
											  mst += '<div class="form-group">';
												  mst += '<label class="control-label col-sm-3">Jenis Kelamin:</label>';
												  mst += '<div style="margin-top:5px;" class="col-sm-8">';          
													mst += '<select id="jeniskelamin-0" name="jeniskelamin[]" class="form-control">';
														mst += '<option value="">--PILIH Jenis Kelamin--</option>';
														mst += '<option value="L">Laki-laki</option>';
														mst += '<option value="P">Perempuan</option>';
													mst += '</select>';
												  mst += '</div>';
											  mst += '</div>';
										  mst += '</div>';
									mst += '</div>';
								mst += '</div>';
							mst += '</div>';				
								
							mst += '<div class="col-md-6">';
								mst += '<div class="form-horizontal">';
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';
											  mst += '<div class="form-group">';
												  mst += '<label class="control-label col-sm-3">Alamat :</label>';
												  mst += '<div class="col-sm-8">';        
													mst += '<input type="text" readonly id="alamat-'+obj+'" class="form-control" name="alamat[]"/>';
												  mst += '</div>';
											  mst += '</div>';
										  mst += '</div>';
									mst += '</div>';
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';  
											  mst += '<div class="form-group">';
												  mst += '<label class="control-label col-sm-3">Kode Pos :</label>';
												  mst += '<div class="col-sm-8">'; 
													mst += '<input type="text" readonly id="pos-'+obj+'" class="form-control" name="pos[]"/>';
												  mst += '</div>';
											  mst += '</div>';
										  mst += '</div>';
									mst += '</div>';
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';
											  mst += '<div class="form-group">';
												  mst += '<label class="control-label col-sm-3">Email :</label>';
												  mst += '<div class="col-sm-8">';       
													mst += '<input type="text" readonly id="email-'+obj+'" class="form-control" name="email[]"/>';
												  mst += '</div>';
											  mst += '</div>';
										  mst += '</div>';
									mst += '</div>';
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';
											  mst += '<div class="form-group">';
												  mst += '<label class="control-label col-sm-3">Deskripsi :</label>';
												  mst += '<div class="col-sm-8">';      
													mst += '<textarea type="text" id="diskripsi-'+obj+'" class="form-control" name="diskripsi[]"/></textarea>';
												  mst += '</div>';
											  mst += '</div>';
										  mst += '</div>';
									mst += '</div>';
								mst += '</div>';
							mst += '</div>';
				
				$("#contentAnggota").append(mst);
				$("#hapushtml-"+obk).attr("disabled","disabled");
				
				$("#noanggota-"+obj).val(autoNum);
			//copyddddata(ast);
			document.getElementById("tmbinput-"+obj).scrollIntoView();
			//cariParameterlanjut(obj);
	
}

function tambahBaruAnggota(){
	
	var obj = $(".info-input").length;
				nouji = $("#seqcode").val();
					autoNum = getnoksm(nouji);
					noform = obj+1;
					obk = obj-1;
					
				var 
					mst = '<div class="content" id="tmbinput-'+obj+'"  style="margin-top:-60px; border-top:0px solid #3C8DBC; cursor:pointer; min-height:550px;">';
						mst += '<div type="button" style="background-color: #605ca8; color: white; margin: 60px -5px 10px -5px; padding: 10px; text-align: center; font-size: 24px;">';
							mst += 'Form Anggota '+noform;
						mst += '</div>';
						mst += '<div class="row" style="margin-bottom:10px;">';
							mst += '<div class="col-md-12">';
								mst += '<button style="margin:1px;" type="button" onclick="ujinext('+obj+')" class="btn btn-primary btn-sm pull-right">';							
								mst += 'Next ';
								mst += '<span class="glyphicon glyphicon-forward" aria-hidden="true"></span>';
								mst += '</button>';	
								mst += '<button style="margin:1px;" type="button" onclick="hapushtml('+obj+')" id="hapushtml-'+obj+'" class="btn btn-danger btn-sm pull-right">';
								mst += '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>';
								mst += 'Hapus Anggota';
								mst += '</button>';								
								mst += '<button style="margin:1px;" type="button" onclick="tambahBaruAnggota()" class="btn btn-success btn-sm pull-right">';
								mst += '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>';
								mst += 'Tambah Anggota';
								// mst += '</button>';
								// mst += '<button style="margin:1px;" type="button" onclick="tambahRowUji('+obj+')" class="btn btn-success btn-sm pull-right">';
								// mst += '<span class="glyphicon glyphicon-copy" aria-hidden="true"></span>';
								// mst += 'Tambah & Copy';
								// mst += '</button>';
								mst += '<button style="margin:1px;" type="button" onclick="ujiback('+obj+')" class="btn btn-primary btn-sm pull-right">';
								mst += '<span class="glyphicon glyphicon-backward" aria-hidden="true"></span>';
								mst += ' Back';
								mst += '</button>';
							mst += '</div>';
						mst += '</div>';
						
						
						mst += '<div class="row info-input" id="info-input" style="border-bottom:1px dashed #000; margin:10px 0px 10px 0px; padding:10px 0px 10px 0px;">';
							mst += '<div class="col-md-6">';
								mst += '<div class="form-horizontal">';
									
									mst += '<input type="hidden" id="seqdiklat" />';
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';    
											  mst += '<div class="form-group">';
												  mst += '<label class="control-label col-sm-4">No Anggota :</label>';
												  mst += '<div class="col-sm-8">';          
													mst += '<input type="text" readonly id="noanggota-'+obj+'" class="form-control" name="noanggota[]"/>';
												  mst += '</div>'; 
											  mst += '</div>';
										  mst += '</div>'; 
									mst += '</div>';
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';  
											mst += '<div class="form-group">';
											    mst += '<label for="kataKunci" class="col-sm-4 control-label">Kode Kontak</label>';
											    mst += '<div class="col-sm-8">';
											    	mst += '<div class="input-group">';
											    		mst += '<input id="idkontak-'+obj+'" name="idkontak[]" type="hidden" class="form-control"/>';
											       		mst += '<input id="kodekontak-'+obj+'" readonly name="kodekontak[]" type="text" class="form-control"/>';
												       	mst += '<span class="input-group-btn">';
											       			mst += '<button type="button" class="btn btn-primary btnKontak" onclick="btnkontak('+obj+')"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>';
											       		mst += '</span>';
										       		mst += '</div>';
											    mst += '</div>';
											mst += '</div>';
										mst += '</div>';
									mst += '</div>';
									
									
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';
											  mst += '<div class="form-group">';
												  mst += '<label class="control-label col-sm-4">Nama Anggota :</label>';
												  mst += '<div class="col-sm-8">';
													mst += '<input type="text" readonly  id="namaanggota-'+obj+'" class="form-control" name="namaanggota[]"/>';
												  mst += '</div>';
											  mst += '</div>';
										  mst += '</div>';
									mst += '</div>';
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';   
											  mst += '<div class="form-group">';
												  mst += '<label class="control-label col-sm-4">No KTP :</label>';
												  mst += '<div class="col-sm-8">';  
													mst += '<input type="text" id="noktp-'+obj+'" class="form-control" name="noktp[]" required/>';
												  mst += '</div>';
											  mst += '</div>';
										  mst += '</div>';
									mst += '</div>';								
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';  
											  mst += '<div class="form-group">';
												  mst += '<label class="control-label col-sm-4">Jenis Kelamin:</label>';
												  mst += '<div style="margin-top:5px;" class="col-sm-8">';          
													mst += '<select id="jeniskelamin-0" name="jeniskelamin[]" class="form-control">';
														mst += '<option value="">--PILIH Jenis Kelamin--</option>';
														mst += '<option value="L">Laki-laki</option>';
														mst += '<option value="P">Perempuan</option>';
													mst += '</select>';
												  mst += '</div>';
											  mst += '</div>';
										  mst += '</div>';
									mst += '</div>';
								mst += '</div>';
							mst += '</div>';				
								
							mst += '<div class="col-md-6">';
								mst += '<div class="form-horizontal">';
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';
											  mst += '<div class="form-group">';
												  mst += '<label class="control-label col-sm-3">Alamat :</label>';
												  mst += '<div class="col-sm-8">';        
													mst += '<input type="text" readonly id="alamat-'+obj+'" class="form-control" name="alamat[]"/>';
												  mst += '</div>';
											  mst += '</div>';
										  mst += '</div>';
									mst += '</div>';
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';  
											  mst += '<div class="form-group">';
												  mst += '<label class="control-label col-sm-3">Kode Pos :</label>';
												  mst += '<div class="col-sm-8">'; 
													mst += '<input type="text" readonly id="pos-'+obj+'" class="form-control" name="pos[]"/>';
												  mst += '</div>';
											  mst += '</div>';
										  mst += '</div>';
									mst += '</div>';
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';
											  mst += '<div class="form-group">';
												  mst += '<label class="control-label col-sm-3">Email :</label>';
												  mst += '<div class="col-sm-8">';       
													mst += '<input type="text" readonly id="email-'+obj+'" class="form-control" name="email[]"/>';
												  mst += '</div>';
											  mst += '</div>';
										  mst += '</div>';
									mst += '</div>';
									mst += '<div style="margin-bottom:5px;" class="row">';
										mst += '<div class="col-sm-12">';
											  mst += '<div class="form-group">';
												  mst += '<label class="control-label col-sm-3">Deskripsi :</label>';
												  mst += '<div class="col-sm-8">';      
													mst += '<textarea type="text" id="diskripsi-'+obj+'" class="form-control" name="diskripsi[]"/></textarea>';
												  mst += '</div>';
											  mst += '</div>';
										  mst += '</div>';
									mst += '</div>';
								mst += '</div>';
							mst += '</div>';
				if(obk < 9){
				$("#contentAnggota").append(mst);
				$("#hapushtml-"+obk).attr("disabled","disabled");
				} else {
				alert("Maksimal anggota 10 orang.");
				}
				
				
				$("#noanggota-"+obj).val(autoNum);				
				//document.getElementById("contentAnggota").scrollIntoView();
			//copyddddata(obj);
			document.getElementById("tmbinput-"+obj).scrollIntoView();
			//cariParameterlanjut(obj);
	
}
	
	function anggota(){
		document.getElementById("contentAnggota").scrollIntoView();
			
	}

	function ujiback(obj){
	//var obj = $(".info-input").length;
			ojk = obj-1;
			
		if (obj==1) {
			document.getElementById("contentAnggota").scrollIntoView();
		}else{
			document.getElementById("tmbinput-"+ojk).scrollIntoView();
		}
	}
	function ujinext(obj){
		//var obj = $(".info-input").length;
			ojk = obj+1;
		document.getElementById("tmbinput-"+ojk).scrollIntoView();

	}

	function homeuji(){
		//var obj = $(".info-input").length;
			//ojk = obj+1;
		document.getElementById("mainMenu").scrollIntoView();

	}
	
	function simpanreg()
	{
		var target = "<?php echo site_url("admin/saveksm")?>";
			data = $("#form-regksm").serialize();
		$.post(target, data, function(e){
			//console.log(e);
			//return false;
			//tinymce.triggerSave();
			
			//alert("Kode barang sudah digunakan , silahkan ganti yang lain !!!");
			
			loadhtml = "<?php echo site_url("admin/Ksm")?>";
			alert("Data berhasil disimpan.");
			$(".content-wrapper").load(loadhtml);
		
		});
	}

	function btnkontak(obj) { 			 
			$('#buatkontak').val(obj);
			$('#modalkontak').attr('class', 'modal show');
			caridatakontak();
	    }

	function caridatakontak()
	{
		var target = "<?php echo site_url("admin/caridatakontak")?>";
		
		data = {
				kode : $("#kode_search").val()
			}
		//console.log(data);
		//return false;
		$.post(target, data, function(e){
		
		//$.post(target,'', function(e){
			//console.log(e);
			
			
			dataJson = $.parseJSON(e);
			fillGridDistData(dataJson);
			
			
		});
	}

	function fillGridDistData(record)
    {
        var table = document.getElementById('caridatakontak');
        NO = $('#buatkontak').val();        
        table.innerHTML = '';
        if (record.status==true){
	        for(i = 0; i<record.kontak.length; i++)
	        {
	            var KodeKontak = record.kontak[i].Kode;
	                NamaKontak = record.kontak[i].Nama;
	                NoKontak = record.kontak[i].NO;
	                ID = record.kontak[i].ID;
	                
	            var row = table.insertRow();
	            
	            var ColNoKontak = row.insertCell(0);
	            var ColKodeKontak = row.insertCell(1);
	            var ColNamaKontak = row.insertCell(2);	           
	            var ColAksi = row.insertCell(3);
	            
	            ColNoKontak.innerHTML = NoKontak;
	            ColKodeKontak.innerHTML = KodeKontak;
	            ColNamaKontak.innerHTML = NamaKontak;	            
	            ColAksi.innerHTML = "<button onclick=tambahdatanasabah("+ID+","+NO+") class='btn btn-xs btn-warning'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Pilih</button>";
	            
	        }
	    }
    }

    function tambahdatanasabah(ID, obj)
	{		
		//tambahkontak(ID);
		var target = "<?php echo site_url("admin/changenasabah")?>";
		$('#modalkontak').attr('class', 'modal close');
			data = {
				kode : ID
			}
			
		$.post(target, data, function(e){
		//console.log(e);
		//return false;
		dataJson = $.parseJSON(e);
		var NamaKontak = dataJson.Nama;
	        IdKontak = dataJson.ID;
	        KodeKontak = dataJson.Kode;
	        AlamatKontak = dataJson.Alamat;
	        NotelpKontak = dataJson.Notelp;
	        EmailKontak = dataJson.Email;
	        KodeposKontak = dataJson.Kodepos;

		$("#kodekontak-"+obj).val(KodeKontak);
		$("#namaanggota-"+obj).val(NamaKontak);
		$("#pos-"+obj).val(KodeposKontak);
		$("#alamat-"+obj).val(AlamatKontak);
		$("#email-"+obj).val(EmailKontak);
		$("#idkontak-"+obj).val(IdKontak);

			
		});
		
	}

	function getkodert(IdKelurahan, obj)
	{
		var target = "<?php echo site_url("transaksi/get_alamat")?>";
			data = {
				idkelurahan : IdKelurahan
			}
		$.post(target, data, function(e){
			//console.log(e);
			dataJson = $.parseJSON(e);
			$("#idkelurahan-"+obj).val(dataJson.id_kelurahan);
			$("#kelurahan-"+obj).val(dataJson.nama_kelurahan);
		});
		
		$("#modalkelurahan").modal("hide");
	}


	function getdataalamat()
	{
		var target = "<?php echo site_url("admin/getalamat")?>";
			obj = $("#obj").val();
			data = {
				kecamatan : $("#kecamatan").val(),
				kelurahan : $("#kelurahan").val(),
				pedukuhan : $("#pedukuhan").val()
			}
		$.post(target, data, function(e){
			//console.log(e);
			var dataJson = $.parseJSON(e);
			fillgridtablekelurahan(dataJson, obj);
		});
	}

	function fillgridtablekelurahan(record, obj)
	{
		var table = document.getElementById('tablealamat');
		table.innerHTML = '';
		
		for(i=0; i<record.alamat.length;i++)
		{
			var Idrt = record.alamat[i].id_rt;
				Kodekelurahan = record.alamat[i].kode_rt;
				Namakelurahan = record.alamat[i].nama_rt;
					
				var row = table.insertRow();
				
				//var ColIdBakumutu = row.insertCell(0);
				var ColKodekelurahan = row.insertCell(0);
				var ColNamakelurahan = row.insertCell(1);
				var ColAksi = row.insertCell(2);
				
				//ColIdBakumutu.innerHTML = IdBakumutu;
				ColKodekelurahan.innerHTML = Kodekelurahan;
				ColNamakelurahan.innerHTML = Namakelurahan;
				ColAksi.innerHTML			= "<button type='button' onclick=getkodert('"+Idrt+"','"+obj+"') class='btn btn-xs btn-warning'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Pilih</button>";
		}
	}

	function getkodert(Idrt, obj)
	{
		var target = "<?php echo site_url("admin/get_refrt")?>";
			data = {
				idrt : Idrt
			}
		$.post(target, data, function(e){
			//console.log(e);
			dataJson = $.parseJSON(e);
			$("#kodepos").val(dataJson.kode_pos);
			$("#alamat").val(dataJson.nama_pedukuhan+' '+dataJson.nama_rt+' '+dataJson.nama_kelurahan+' '+dataJson.nama_kecamatan+' Sleman Yogyakarta');
		});
		
			$('#modalalamat').attr('class', 'modal close');
	       	$('#dialogFormBaru').attr('class', 'modal show');
	}

	function getnokontak(param)
	{
		
		getNum = param.split("S");
		Nums = parseInt(getNum[1]);
		Num  = eval(Nums) + 1;
		
		
		if(Num <= 9)
		{
			code = getNum[0]+"S"+"000"+Num;
		}
		else if(Num > 9 && Num <= 99)
		{
			code = getNum[0]+"S"+"00"+Num;
		}
		else if(Num > 99 && Num <= 999)
		{
			code = getNum[0]+"S"+"0"+Num;
		}
		else
		{
			code = getNum[0]+"S"+Num;
		}
		$("#kode").val(code);
		return code;
	}	
</script>

 