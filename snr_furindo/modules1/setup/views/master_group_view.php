<section class="content-header">  
	<h1>Daftar Group Pengguna</h1>
</section>

<section class="content">	

	<div class="box box-primary">
	
	  	<div class="box-header">
	  		<div class="pesanCari"></div>
	  		<form id="formCari" class="form-horizontal" action="setup/CariGroup" method="post">
	  			<div class="row">	  		
		  			<div class="col-xs-12">
				  		<div class="form-group">
						    <label for="kategori" class="col-sm-2 control-label">Kategori</label>
						    <div class="col-sm-7">
						       	<select id="kategori" name="kategori" class="form-control">
						       		<option value="namaGroup">Nama</option>
						       		<option value="deskripsi">Deskripsi</option>
						       	</select>
						    </div>
						</div>  
		  			</div>
		  		</div>
		  		<div class="row">
		  			<div class="col-xs-12">
				  		<div class="form-group">
						    <label for="kataKunci" class="col-sm-2 control-label">Kata Kunci</label>
						    <div class="col-sm-7">
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
		  	</form>	
	  	</div>
	  	
	  	<div class="box-body">	

	  		<table width="100%" cellspacing="0" class="table table-striped table-bordered no-footer table-responsive" id="example" role="grid" aria-describedby="example_info" style="width: 100%;">
	  			<thead>
	  				<tr role="row">
	  					<th class="sorting" tabindex="0" aria-controls="example" aria-sort="ascending" aria-label="nama Group: activate to sort column descending">Nama Group</th>
	  					<th class="sorting" tabindex="1" aria-controls="example" aria-label="Deskripsi: activate to sort column ascending">Deskripsi</th>
	  					<th style="width:10%" tabindex="2" aria-controls="example" aria-label="Tindakan: activate to sort column ascending"></th>
	  				</tr>
	  			</thead>
	  			<tbody id="ajaxFormData">
				</tbody>
			</table>

			<div class="modal" id="dialogFormUbah" tabindex="2" role="dialog" aria-labelledby="FormUbahGroupUser" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h4 class="modal-title" id="exampleModalLabel">Ubah Data Group Pengguna</h4>
			      </div>
			      <div class="modal-body">
			      	<div class="pesanUbah"></div>
			       	<form class="form-horizontal" action="setup/UbahGroup" method="post" id="formUbah">
			  			<div class="form-group">
						    <label for="namaGroupUbah" class="col-sm-3 control-label">Nama Group</label>
						    <div class="col-sm-9">
						       	<input id="namaGroupUbah" name="namaGroupUbah" type="text" class="form-control"/>
						    </div>
						</div>    

					    <div class="form-group">
						    <label for="deskripsiUbah" class="col-sm-3 control-label">Deskripsi</label>
						    <div class="col-sm-9">
						       	<textarea id="deskripsiUbah" name="deskripsiUbah" class="form-control"></textarea>
						    </div>
					    </div>

					    <input type="hidden" name="IDGroupUbah" value="" id="IDGroupUbah">
					</form>  
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-primary" id="btnUbahGroup">Ubah</button>
			        <button type="button" class="btn btn-warning" id="btnBatalUbahGroup">Batal</button>
			      </div>
			    </div>
			  </div>
			</div>

			<div class="modal" id="dialogFormBaru" tabindex="1" role="dialog" aria-labelledby="FormTambahGroupUser" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h4 class="modal-title" id="exampleModalLabel">Tambah Data Group Pengguna</h4>
			      </div>
			      <div class="modal-body">
			      	<div class="pesanTambahBaru"></div>
			       	<form class="form-horizontal" action="setup/TambahGroup" method="post" id="formBaru">
			  			<div class="form-group">
						    <label for="namaGroup" class="col-sm-3 control-label">Nama</label>
						    <div class="col-sm-9">
						       	<input id="namaGroup" name="namaGroup" type="text" class="form-control"/>
						    </div>
						</div>    

					    <div class="form-group">
						    <label for="deskripsi" class="col-sm-3 control-label">Deskripsi</label>
						    <div class="col-sm-9">
						       	<textarea id="deskripsi" name="deskripsi" class="form-control"></textarea>
						    </div>
					    </div>
					</form>  
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-primary" id="btnTambahGroup">Tambah</button>
			        <button type="button" class="btn btn-warning" id="btnBatalTambahGroup">Batal</button>
			      </div>
			    </div>
			  </div>
			</div>
	  </div>

	  <div class="box-footer">		 
		       	<button type="button" class="btn btn-primary" id="btnBaru"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>		   
		</div>

	</div>  
</section>	

<script>
	$(document).ready(function(e){       

	    $('#btnTambahGroup').click( function(e){
 			e.preventDefault();   
	       	sendRequestForm($('#formBaru').attr('action'), $('#formBaru').serialize(), 'pesanTambahBaru'); 
	    });

	    $('#btnUbahGroup').click( function(e){
 			e.preventDefault(); 
	       	sendRequestForm($('#formUbah').attr('action'), $('#formUbah').serialize(), 'pesanUbah'); 
	    });

	    $('#btnBaru').click( function(e){
	    	 e.preventDefault(); 
	    	 $('#alertMessage').remove();
	    	 $('#dialogFormBaru').attr('class', 'modal show');
	    });

	     $('#btnCari').click( function(e){
 			e.preventDefault(); 
	       	ajaxDataGrid($('#formCari').attr('action'),  $('#formCari').serialize(), 'ajaxFormData'); 
	    });

	    $('#btnBatalTambahGroup').click( function(e){
	    	e.preventDefault(); 
	    	$('#dialogFormBaru').attr('class', 'modal hide');
	    });    

	    $('#btnBatalUbahGroup').click( function(e){
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
		$('input[type="text"]').val('');
		$('textarea').val('');
		$('input:first').focus();
		loadGridData();
	}

	function loadGridData(){
	    ajaxDataGrid('<?php echo base_url()?>setup/GetDaftarGroupUser', '', 'ajaxFormData'); 	    
	}

	function dialogFormEditShow(objReference)
	{
		var NamaGroup = $(objReference).parent().parent().find('td:eq(0)').find('span:last').html();
		var Deskripsi = $(objReference).parent().parent().find('td:eq(1)').html();
		var IDx	= $(objReference).parent().parent().find('td:eq(0)').find('span:first').html();
	
		$('#alertMessage').remove();
		$('#namaGroupUbah').val(NamaGroup);
		$('#deskripsiUbah').val(Deskripsi);
		$('#IDGroupUbah').val(IDx);
	    $('#dialogFormUbah').attr('class', 'modal show');
	}

	function deleteConfirmShow(objReference)
	{ 
	
		var NamaGroup  = $(objReference).parent().parent().find('td:first').find('span:last').html();
		var IDx		   = $(objReference).parent().parent().find('td:first').find('span:first').html();
	   	isDelete 	   = confirm('Yakin group '+ NamaGroup +' akan dihapus ?');
	  	if (isDelete) sendRequestForm('setup/HapusGroup', {IDGroup: IDx}, 'content');
	}
</script>  





