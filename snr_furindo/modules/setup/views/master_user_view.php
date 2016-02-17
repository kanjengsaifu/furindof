<section class="content-header">   
	<h1>Daftar Pengguna</h1>
</section>

<section class="content">

	<div class="box box-primary">
	 
	  	<div class="box-header">
	  		<div class="pesanCari"></div>
	  		<form id="formCari" class="form-horizontal" action="setup/CariUser" method="post">
	  		<div class="row">
	  			<div class="col-xs-12">
	  				<div class="form-horizontal">
				  		<div class="form-group">
						    <label for="kategori" class="col-xs-2 control-label">Kategori</label>
						    <div class="col-sm-7 col-xs-12">
						       	<select id="kategori" name="kategori" class="form-control">
						       		<option value="namaUser">Nama User</option>
						       		<option value="namaLengkap">Nama Lengkap</option>
						       	</select>
						    </div>
						</div>  
	  				</div> 
	  			</div>
		  	</div>
		  	<div class="row">
	  			<div class="col-xs-12">
	  				<div class="form-horizontal">
				  		<div class="form-group">
						    <label for="kataKunci" class="col-xs-2 control-label">Kata Kunci</label>
						    <div class="col-sm-7 col-xs-12">
						    	<div class="input-group">
						       	<input id="kataKunci" name="kataKunci" type="text" class="form-control"/>
							       	<span class="input-group-btn">
						       			<button type="submit" class="btn btn-primary" id="btnCari"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
						       		</span>
					       		</div>
						    </div>
						</div>  
	  				</div> 
	  			</div>
	  		</div>
	  		</form>
	  	</div>
	  	
	  	<div class="box-body">	

	  		<table width="100%" cellspacing="0" class="table table-striped table-bordered no-footer table-responsive" id="example" role="grid" aria-describedby="example_info" style="width: 100%;">
	  			<thead>
	  				<tr role="row">
	  					<th class="sorting" tabindex="0" aria-controls="example" aria-sort="ascending" aria-label="Nama Pengguna: activate to sort column descending">Nama Pengguna</th>
	  					<th class="sorting" tabindex="1" aria-controls="example" aria-label="Nama Lengkap : activate to sort column ascending">Nama Lengkap</th>
	  					<th class="sorting" tabindex="2" aria-controls="example" aria-label="Email: activate to sort column ascending">Email</th>
	  					<th class="sorting" tabindex="3" aria-controls="example" aria-label="Group : activate to sort column ascending">Group</th>
	  					<th class="sorting" tabindex="4" aria-controls="example" aria-label="Aktif : activate to sort column ascending">Aktif</th>
	  					<th style="width:10%" tabindex="5" aria-controls="example" aria-label="Tindakan: activate to sort column ascending"></th>
	  				</tr>
	  			</thead>
	  			<tbody id="ajaxFormData">
				</tbody>
			</table>

			<div class="modal hide" id="dialogFormUbah" tabindex="2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h4 class="modal-title" id="exampleModalLabel">Ubah Data Pengguna</h4>
			      </div>
			      <div class="modal-body">
			      	<div class="pesanUbah"></div>
				       <form id="formUbah" class="form-horizontal" action="setup/UbahUser" method="post">
				 
			  			<div class="form-group">
						    <label for="namaLengkapUbah" class="col-sm-3 control-label">Nama Lengkap</label>
						    <div class="col-sm-9">
						       	<input id="namaLengkapUbah" name="namaLengkapUbah" type="text" class="form-control"/>
						    </div>
						</div>    

					    <div class="form-group">
						    <label for="namaUserUbah" class="col-sm-3 control-label">Nama Pengguna</label>
						    <div class="col-sm-9">
						       	<input id="namaUserUbah" name="namaUserUbah" type="text" class="form-control"/>
						    </div>
					    </div>

					    <div class="form-group">
						    <label for="kataSandiUbah" class="col-sm-3 control-label">Kata Sandi</label>
						    <div class="col-sm-9">
						       	<input id="kataSandiUbah" name="kataSandiUbah" type="password" class="form-control" placeholder="*Abaikan jika tidak ada perubaha kata sandi *"/>
						    </div>
						</div>

					    <div class="form-group">
						    <label for="kataSandiKonfirmasiUbah" class="col-sm-3 control-label">Kata Sandi Lagi</label>
						    <div class="col-sm-9">
						       	<input id="kataSandiKonfirmasiUbah" name="kataSandiKonfirmasiUbah" type="password" class="form-control" placeholder="*Abaikan jika tidak ada perubaha kata sandi *"/>
						    </div>
						</div>

						<div class="form-group">
						    <label for="userGroupUbah" class="col-sm-3 control-label">Group Pengguna</label>
						    <div class="col-sm-9">
						       <select id="userGroupUbah" name="userGroupUbah" class="form-control">
						       		<option value=""> ::Pilih Group Pengguna :: </option>
							      <?php
							        foreach ($daftarGroupUser as $row) {
							          echo "<option value='". $row['IDUserGroup']."'>".$row['NamaUserGroup']."</option>";
							        }
							      ?>
							    </select>
							</div>
					  	</div>

					  	 <div class="form-group">
					  		<label for="level" class="col-sm-3 control-label">Instansi</label>
					  		<div class="col-sm-9">
					  		<select id="levelUbah" name="leveUbah" class="form-control">
					  			<option value="dinas">Dinas Kesehatan</option>
					  			<option value="uptd">UPTD/Puskesmas</option>
					  		</select>
					  		</div>
					  	</div>

					  	<div id="ajaxDataComplementUbah">
					  	</div>

					  	<div class="form-group">
						    <label for="emailUbah" class="col-sm-3 control-label">Email</label>
						    <div class="col-sm-9">
						       	<input id="emailUbah" name="emailUbah" type="text" class="form-control"/>
						    </div>
						</div> 

					    <input type="hidden" id="IDUserUbah" name="IDUserUbah"/>

					    <div class="form-group">
						    <label for="aktif" class="col-sm-3 control-label">Aktif</label>
						    <div class="col-sm-9">
								<div class="checkbox">
								<label>
								  <input type="checkbox" name="aktif" id="aktif" value="1"/>
								</label>
							  </div>
						    </div>
						</div> 

					</form>  

			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-primary" id="btnUbahUser">Ubah</button>
			        <button type="button" class="btn btn-warning" id="btnBatalUbahUser">Batal</button>
			      </div>
			    </div>
			  </div>
			</div>
	  </div>

	  <div class="modal hide" id="dialogFormBaru" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h4 class="modal-title" id="exampleModalLabel">Tambah Data Pengguna</h4>
			      </div>
			      <div class="modal-body">
			      	<div class="pesanBaru"></div>
				       <form id="formBaru" class="form-horizontal" action="setup/TambahUser" method="post">
				 
			  			<div class="form-group">
						    <label for="namaLengkap" class="col-sm-3 control-label">Nama Lengkap</label>
						    <div class="col-sm-9">
						       	<input id="namaLengkap" name="namaLengkap" type="text" class="form-control"/>
						    </div>
						</div>    

					    <div class="form-group">
						    <label for="namaUser" class="col-sm-3 control-label">Nama Pengguna</label>
						    <div class="col-sm-9">
						       	<input id="namaUser" name="namaUser" type="text" class="form-control"/>
						    </div>
					    </div>

					    <div class="form-group">
						    <label for="kataSandi" class="col-sm-3 control-label">Kata Sandi</label>
						    <div class="col-sm-9">
						       	<input id="kataSandi" name="kataSandi" type="password" class="form-control" placeholder="Kata sandi minimal 5 digit"/>
						    </div>
						</div>

					    <div class="form-group">
						    <label for="kataSandiKonfirmasi" class="col-sm-3 control-label">Kata Sandi Lagi</label>
						    <div class="col-sm-9">
						       	<input id="kataSandiKonfirmasi" name="kataSandiKonfirmasi" type="password" class="form-control" placeholder="Kata sandi konfirmasi minimal 5 digit"/>
						    </div>
						</div>

						<div class="form-group">
						    <label for="userGroup" class="col-sm-3 control-label">Group Pengguna</label>
						    <div class="col-sm-9">
						       <select id="userGroup" name="userGroup" class="form-control">
						       		<option value="">:: Pilih Group Pengguna ::</option>
							      <?php
							        foreach ($daftarGroupUser as $row) {
							          echo "<option value='". $row['IDUserGroup']."'>".$row['NamaUserGroup']."</option>";
							        }
							      ?>
							    </select>
							</div>
					  	</div>

					  	<div class="form-group">
					  		<label for="level" class="col-sm-3 control-label">Instansi</label>
					  		<div class="col-sm-9">
					  		<select id="level" name="level" class="form-control">
					  			<option value="dinas">Dinas Kesehatan</option>
					  			<option value="uptd">UPTD/Puskesmas</option>
					  		</select>
					  		</div>
					  	</div>

					  	<div id="ajaxDataComplement">
					  	</div>

					  	<div class="form-group">
						    <label for="email" class="col-sm-3 control-label">Email</label>
						    <div class="col-sm-9">
						       	<input id="email" name="email" type="text" class="form-control"/>
						    </div>
						</div> 

					</form>  

			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-primary" id="btnTambahUser">Tambah</button>
			        <button type="button" class="btn btn-warning" id="btnBatalTambahUser">Batal</button>
			      </div>
			    </div>
			  </div>
			</div>

			<div class="box-footer">		   
		       	<button type="button" class="btn btn-primary" id="btnBaru"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>		   
		    </div>   	
	  </div>
	  

	  </div>
	</div>  
</section>	

 <script>
 	
	$(document).ready(function(e){    	

		$('#level, #levelUbah').change( function(e){
			e.preventDefault(); 
			$('.ajaxUPTD').remove();
			var strUbah = 	$(this).attr('id') == 'levelUbah' ? 'Ubah' : '';
	  	 	ajaxDataGrid('setup/TampilkanDataComplement', { levelKerja : $(this).val() }, 'ajaxDataComplement'+strUbah);
		});

		$('#btnTambahUser').click( function(e){
 			e.preventDefault(); 
	       	sendRequestForm($('#formBaru').attr('action'), $('#formBaru').serialize(), 'pesanBaru');
	    });
 
	    $('#btnUbahUser').click( function(e){
 			e.preventDefault(); 
	       	sendRequestForm($('#formUbah').attr('action'), $('#formUbah').serialize(), 'pesanUbah'); 
	    });

	    $('#btnCari').click( function(e){
 			e.preventDefault(); 
	       	ajaxDataGrid($('#formCari').attr('action'),  $('#formCari').serialize(), 'ajaxFormData'); 
	    });

	    $('#btnBaru').click( function(e){
	    	 e.preventDefault(); 
	    	 $('#alertMessage').remove();
	    	 $('#dialogFormBaru').attr('class', 'modal show');
	    });

	    $('#btnBatalTambahUser').click( function(e){
	    	e.preventDefault(); 
	    	$('#dialogFormBaru').attr('class', 'modal hide');
	    });    

	    $('#btnBatalUbahUser').click( function(e){
	    	e.preventDefault(); 
	    	$('#alertMessage').remove();
	    	$('#dialogFormUbah').attr('class', 'modal hide');
	    });

	    $('#kategori').change(function (e)
	    {
	    	e.preventDefault(); 
	    	$('#btnCari').click();
	    });
	    	    
	    loadGridData();

	});

	function resetForm()
	{
		$('input[type="text"], input[type="password"], select').val('');
		$('textarea').val('');
		$('input:first').focus();
		loadGridData();
	}

	function loadGridData(){	
	    ajaxDataGrid('<?php echo base_url()?>setup/GetDaftarUser', '', 'ajaxFormData'); 	    
	}

	function dialogFormEditShow(objReference)
	{
		var NamaUser 	= $(objReference).parent().parent().find('td:eq(0)').find('span:last').html();
		var NamaLengkap = $(objReference).parent().parent().find('td:eq(1)').html();
		var Email       = $(objReference).parent().parent().find('td:eq(2)').html();
		var NotAktif 	= $(objReference).parent().parent().find('td:eq(4)').html().trim() !== 'Ya';
		var IdxGroup 	= $(objReference).parent().parent().find('td:eq(3)').find('span:first').html();
		var NamaGroup 	= $(objReference).parent().parent().find('td:eq(3)').find('span:last').html();
		var IDx			= $(objReference).parent().parent().find('td:eq(0)').find('span:first').html();
		var IdxUPTD 	= $(objReference).parent().parent().find('td:eq(3)').find('span').eq(1).html();
		var IdxLevel 	= $(objReference).parent().parent().find('td:eq(3)').find('span').eq(2).html();

		document.getElementById('aktif').checked = $(objReference).parent().parent().find('td:eq(4)').html().trim() == 'Ya';
		
		$('#alertMessage').remove();
		$('#namaUserUbah').val(NamaUser);
		$('#namaLengkapUbah').val(NamaLengkap);
		$('#emailUbah').val(Email);
		$('#userGroupUbah').val(IdxGroup);
		$('#levelUbah').val(IdxLevel);
		$('#IDUserUbah').val(IDx);

		$('.ajaxUPTD').remove();

		if (IdxUPTD > 0){
	  	 	ajaxDataGrid('setup/TampilkanDataComplement', { levelKerja : IdxLevel }, 'ajaxDataComplementUbah');
	  	 	$('#uptd').val(IdxUPTD);
		}
		
	    $('#dialogFormUbah').attr('class', 'modal show');
	}

	function dialogFormUbahClose()
	{
		 $('#dialogFormUbah').attr('class', 'modal close');	
	}

	function dialogFormTambahClose()
	{
		 $('#dialogFormTambah').attr('class', 'modal close');	
	}

	function deleteConfirmShow(objReference)
	{ 
	
		var NamaGroup = $(objReference).parent().parent().find('td:first').find('span:last').html();
		var IDx		  = $(objReference).parent().parent().find('td:first').find('span:first').html();
	   	isDelete = confirm('Yakin user '+ NamaGroup +' akan dihapus ?');
	  	if (isDelete) sendRequestForm('setup/HapusUser', {IDUser: IDx}, 'content');
	}

	</script>  

