<div class="content-header">   
	<h1>Daftar Karyawan</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<button type="button" class="btn btn-sm btn-primary" id="btnTambahBaru"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
				<!-- <button type="button" class="btn btn-sm btn-primary" id="btnCetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak PDF</button>	 -->	
			</div>
	  		<div class="form-control" style="min-height:450px;">
				<div id="ajaxTreeGrid"></div>
			</div>
		</div> 
	  </div>
	</div> 
</div>

 <div class="modal hide" id="dialogFormBaru" tabindex="1" role="dialog" aria-labelledby="FormTambahData" aria-hidden="true">
	 <div class="modal-dialog" style="min-width:70%">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title" id="FormTambahData">Tambah Data Karyawan</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="pesanBaru"></div>
	      		     		
				<div class="form-horizontal">
	      			<div class="row">
	      				<div class="col-sm-6">
	      				<?php echo form_open_multipart('admin/do_upload');?>	      					
	      					<div class="form-group">
				                <label for="email" class="control-label col-sm-2">Foto :</label>
				                <div class="col-sm-10">          
				                <input type="file" name="userfile" id="foto"></input> <br />
				                  <div style="padding:20px; line-height:10; text-align:center;border:1px dashed #000; min-height:100px;">
				                    <img id="blah" src="#" alt="Rekomendasi (215 x 215) px">
				                    <!-- <input type="hidden" name="kosong" id="kosong"></input> -->
				                  </div>
				                  <small>* format gambar : gif, jpg, png, jpeg, bmp</small>
				                </div> <!-- <div class="col-sm-9">  -->
				              </div>
				              <input type='submit' name='submit' value='upload' />
				            </form>
				              <form id="formBaru" enctype="multipart/form-data" action="admin/TambahKaryawan" method="post"> 
			      			<div class="form-group">
							    <label for="kodeKaryawan" class="col-sm-2 control-label">Kode</label>
							    <div class="col-sm-10">
						    	  	<input type="text" name="kodeKaryawan" id="kodeKaryawan" class="form-control"/> 	
							    </div>
						    </div>
						    
						    <div class="form-group">
							    <label for="namaKaryawan" class="col-sm-2 control-label">Nama</label>
							    <div class="col-sm-10">
							       	<input id="namaKaryawan" name="namaKaryawan" value="" type="text" class="form-control"/>
							    </div>
						    </div>
						</div>
						<div class="col-sm-6">
						    <div class="form-group">
							    <label for="jabatan" class="col-sm-2 control-label">Jabatan </label>
							    <div class="col-sm-10">
							       	<select name="jabatan" class="form-control">
							       		<option value=''>:: Pilih Jabatan ::</option>
							       		<?php  
							       			$CI = get_instance();
							       			$selectQuery =  $CI->db->query("select id_jabatan as IDJabatan, nama_jabatan as NamaJabatan   
							       											from ref_jabatan ");
							       			$arrTipeKaryawan = $selectQuery->result_array();
							       			foreach ($arrTipeKaryawan as $row) {
							       				echo "<option value='".$row['IDJabatan']."'>".$row['NamaJabatan']."</option>";
							       			}
							       		?>
							       	</select>
							    </div>
						    </div>

						    <div class="form-group">
							    <label for="alamatKaryawan" class="col-sm-2 control-label">Alamat</label>
							    <div class="col-sm-10">
							       	<input id="alamatKaryawan" name="alamatKaryawan" value="" type="text" class="form-control"/>
							    </div>
						    </div>
						
						    <div class="form-group">
							    <label for="telpKaryawan" class="col-sm-2 control-label">Telp</label>
							    <div class="col-sm-10">
							       	<input id="telpKaryawan" name="telpKaryawan" value="" type="text" class="form-control"/>
							    </div>
						    </div>

						    <div class="form-group">
							    <label for="emailKaryawan" class="col-sm-2 control-label">Email</label>
							    <div class="col-sm-10">
							       	<input id="emailKaryawan" name="emailKaryawan" value="" type="text" class="form-control"/>
							    </div>
						    </div>

						    <div class="form-group">
							    <label for="kataSandiKaryawan" class="col-sm-2 control-label">Kata Sandi</label>
							    <div class="col-sm-10">
							       	<input id="kataSandiKaryawan" name="kataSandiKaryawan" value="" type="password" class="form-control"/>
							    </div>
						    </div>
						
						     <div class="form-group">
							    <label for="group" class="col-sm-2 control-label">Group Pengguna </label>
							    <div class="col-sm-10">
							       	<select name="group" id="group" class="form-control">
							       		<option value=''>:: Pilih Group ::</option>
							       		<?php  
							       			$CI = get_instance();
							       			$selectQuery =  $CI->db->query("select id_group as IDGroup, nama_group as NamaGroup     
							       											from sys_group where id_group not in (select id_group from sys_group where id_group = 1) ");
							       			$arrTipeKaryawan = $selectQuery->result_array();
							       			foreach ($arrTipeKaryawan as $row) {
							       				echo "<option value='".$row['IDGroup']."'>".$row['NamaGroup']."</option>";
							       			}
							       		?>
							       	</select>
							    </div>
						    </div>

						    <div class="form-group">
							    <label for="deskripsi" class="col-sm-2 control-label">Deskripsi</label>
							    <div class="col-sm-10">
							       	<textarea id="deskripsi" name="deskripsi" class="form-control"></textarea>
							    </div>
						    </div>
						</div>
					</div>
				</div>
		        </form>  
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" id="btnTambahKaryawan">Tambah</button>
	        <button type="button" class="btn btn-warning" id="btnBatalTambahKaryawan">Batal</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>

 <div class="modal hide" id="dialogFormUbah" tabindex="2" role="dialog" aria-labelledby="FormUbahData" aria-hidden="true">
	 <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title" id="FormUbahData">Ubah Data Karyawan</h4>
	      </div>
	      <div class="modal-body">
	      	<div class="pesanUbah"></div>
	      		<form id="formUbah" class="form-horizontal" action="admin/UbahKaryawan" method="post">
	      			<div class="form-group">
					    <label for="kodeKaryawanUbah" class="col-sm-2 control-label">Kode</label>
					    <div class="col-sm-10">
				    	  	<input type="text" name="kodeKaryawanUbah" id="kodeKaryawanUbah" class="form-control"/> 	
					    </div>
				    </div>
				    
				    <div class="form-group">
					    <label for="namaKaryawanUbah" class="col-sm-2 control-label">Nama</label>
					    <div class="col-sm-10">
					       	<input id="namaKaryawanUbah" name="namaKaryawanUbah" value="" type="text" class="form-control"/>
					    </div>
				    </div>
				    
				    
				    <div class="form-group">
					    <label for="jabatanUbah" class="col-sm-2 control-label">Jabatan </label>
					    <div class="col-sm-10">
					       	<select name="jabatanUbah" id="jabatanUbah" class="form-control">
					       		<option value=''>:: Pilih Jabatan ::</option>
					       		<?php  
					       			$CI = get_instance();
					       			$selectQuery =  $CI->db->query("select id_jabatan as IDJabatan, nama_jabatan as NamaJabatan   
					       											from ref_jabatan ");
					       			$arrTipeKaryawan = $selectQuery->result_array();
					       			foreach ($arrTipeKaryawan as $row) {
					       				echo "<option value='".$row['IDJabatan']."'>".$row['NamaJabatan']."</option>";
					       			}
					       		?>
					       	</select>
					    </div>
				    </div>

				    <div class="form-group">
					    <label for="alamatKaryawanUbah" class="col-sm-2 control-label">Alamat</label>
					    <div class="col-sm-10">
					       	<input id="alamatKaryawanUbah" name="alamatKaryawanUbah" value="" type="text" class="form-control"/>
					    </div>
				    </div>

				    <div class="form-group">
					    <label for="telpKaryawan" class="col-sm-2 control-label">Telp</label>
					    <div class="col-sm-10">
					       	<input id="telpKaryawanUbah" name="telpKaryawanUbah" value="" type="text" class="form-control"/>
					    </div>
				    </div>

				    <div class="form-group">
					    <label for="emailKaryawan" class="col-sm-2 control-label">Email</label>
					    <div class="col-sm-10">
					       	<input id="emailKaryawanUbah" name="emailKaryawanUbah" value="" type="text" class="form-control"/>
					    </div>
				    </div>

				    <div class="form-group">
					    <label for="kataSandiKaryawan" class="col-sm-2 control-label">Kata Sandi</label>
					    <div class="col-sm-10">
					       	<input id="kataSandiKaryawanUbah" placeholder="Abaikan jika tidak ada perubahan kata sandi" name="kataSandiKaryawanUbah" value="" type="password" class="form-control"/>
					    </div>
				    </div>
				    
				    <div class="form-group">
					    <label for="groupUbah" class="col-sm-2 control-label">Group Pengguna </label>
					    <div class="col-sm-10">
					       	<select name="groupUbah" id="groupUbah" class="form-control">
					       		<option value=''>:: Pilih Group ::</option>
					       		<?php  
					       			$CI = get_instance();
					       			$selectQuery =  $CI->db->query("select id_group as IDGroup, nama_group as NamaGroup     
					       											from sys_group ");
					       			$arrTipeKaryawan = $selectQuery->result_array();
					       			foreach ($arrTipeKaryawan as $row) {
					       				echo "<option value='".$row['IDGroup']."'>".$row['NamaGroup']."</option>";
					       			}
					       		?>
					       	</select>
					    </div>
				    </div>

				    <div class="form-group">
					    <label for="deskripsi" class="col-sm-2 control-label">Deskripsi</label>
					    <div class="col-sm-10">
					       	<textarea id="deskripsiUbah" name="deskripsiUbah" class="form-control"></textarea>
					    </div>
				    </div>
				    <input type="hidden" name="IDKaryawan" id="IDKaryawan"/>
		        </form>  
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" id="btnUbahKaryawan">Ubah</button>
	        <button type="button" class="btn btn-warning" id="btnBatalUbahKaryawan">Batal</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>
	
<script>
	$(document).ready(function () {

		$('#btnTambahBaru').click(function(e)
        {
			var loadhtml = "<?php echo site_url("admin/addkaryawan")?>";
			$(".content-wrapper").load(loadhtml);              
        });
                     
   //  	$('#btnTambahBaru').click(function(e)
   //      {
			// e.preventDefault(); 
			// resetForm();
	  //   	$('#alertMessage').remove();
	  //   	$('#dialogFormBaru').attr('class', 'modal show');               
   //      });

        $('#btnBatalTambahKaryawan').click( function(e){
    		e.preventDefault(); 
    		$('#dialogFormBaru').attr('class', 'modal hide');
   		});        

   		$('#btnBatalUbahKaryawan').click( function(e){
	    	e.preventDefault(); 
	    	$('#alertMessage').remove();
	    	$('#dialogFormUbah').attr('class', 'modal hide');
	    });

   		$('#btnTambahKaryawan').click( function(e){
 			e.preventDefault();
	       	sendRequestForm($('#formBaru').attr('action'), $('#formBaru').serialize(), 'pesanBaru');
	    });
 	
	    $('#btnUbahKaryawan').click( function(e){
 			e.preventDefault(); 
	       	sendRequestForm($('#formUbah').attr('action'), $('#formUbah').serialize(), 'pesanUbah'); 
	    });

	    $('#btnCari').click( function(e){
 			e.preventDefault(); 
	       	ajaxDataGrid($('#formCari').attr('action'),  $('#formCari').serialize(), 'ajaxTreeGrid'); 
	    });

	    $('#btnCetak').click(function(e)
	      {   
	        var loadhtml = "<?php echo site_url("admin/CetakKaryawan")?>";
	        window.open(loadhtml);

	      });

	    
        loadGridData();

    });

    function resetForm()
	{
		$('#kodeBidang, #kodeKaryawan, #kodeBidangUbah, #kodeKaryawanUbah').html('');
		$('input[type="text"], input[type="password"], select').val('');
		$('textarea').val('');
		$('input:first').focus();

		loadGridData();
	}

	function loadGridData(){
	     var source =
         {		
             dataType: "json",
             dataFields: [
                  { name: "idx", 	type: "string" },
                  { name: "IDJabatan", 	type: "string" },
                  { name: "IDDivisi", 	type: "string" },
                  { name: "IDGroup", 	type: "string" },
                  { name: "kode", 	type: "string" },
                  { name: "nama", 	type: "string" },
                  { name: "namaDivisi", 	type: "string" },
                  { name: "NamaJabatan", 	type: "string" },
                  { name: "alamat", 	type: "string" },
                  { name: "telp", 	type: "string" },
                  { name: "email", 	type: "string" },
                  { name: "deskripsi", 	type: "string" },
                  { name: "action", 	type: "string" }
             ],
            url : "admin/GetDaftarKaryawan",
            id  : "idx"
         };

        var dataAdapter = new $.jqx.dataAdapter(source, {
            loadComplete: function () {		
            }
        });

        // create jqxDataTable.
        $("#ajaxTreeGrid").jqxDataTable(
        {
            source: dataAdapter,
            pagerButtonsCount: 10,
            altRows: true,
            filterable: true,
            height: '440px',
            pageable : true,
            pageSize : 10,
            pagerPosition : 'bottom',
            filterMode: 'simple',
            theme: 'fresh',
            width: '100%',
            columns: [
              { text: 'Kode', cellsAlign: 'center', align: 'center', dataField: 'kode', width : '8%'},
              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '15%'},
              { text: 'Alamat', cellsAlign: 'left', align: 'center', dataField: 'alamat', width : '37%'},
              { text: 'Telp', cellsAlign: 'left', align: 'center', dataField: 'telp', width : '10%'},
              { text: 'Email', cellsAlign: 'left', align: 'center', dataField: 'email', width : '22%'},
              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '8%' }
            ]
        }).on('rowDoubleClick', function(event)
        {	          	
        	dialogFormEditShow();
	    });	
	}

	function dialogFormEditShow()
	{ 
		
		var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');

		var dataKaryawan = selection[0];

		var	idx      		= dataKaryawan.idx,			
			IDJabatan 		= dataKaryawan.IDJabatan,
			IDGroup 		= dataKaryawan.IDGroup,
	 		kode 			= dataKaryawan.kode,	
	 		nama    		= dataKaryawan.nama,
	 		alamat 			= dataKaryawan.alamat,
	 		telp 			= dataKaryawan.telp,
	 		email 			= dataKaryawan.email,
	 		deskripsi 		= dataKaryawan.deskripsi;

	 	var htmlOut = ajaxFillGridJSON('admin/editkaryawan', {ID : idx});
		$(".content-wrapper").html(htmlOut);  
		return false;

			$('#alertMessage').remove();

		 	$('#kodeKaryawanUbah').val(kode);
		 	$('#namaKaryawanUbah').val(nama);
		 	$('#alamatKaryawanUbah').val(alamat);
		 	$('#telpKaryawanUbah').val(telp);
		 	$('#emailKaryawanUbah').val(email);
	 		$('#deskripsiUbah').val(deskripsi);
	 		$('#IDKaryawan').val(idx);	 		
	 		$('#jabatanUbah').val(IDJabatan);
			$('#groupUbah').val(IDGroup);

			$('#dialogFormUbah').attr('class', 'modal show');

	}

	function dialogFormUbahClose()
	{
		 $('#dialogFormUbah').attr('class', 'modal close');	
	}

	function dialogFormBaruClose()
	{
		 $('#dialogFormBaru').attr('class', 'modal close');	
	}

	function deleteConfirmShow()
	{ 

	 	var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');
		var dataKaryawan = selection[0];
		
		var idx	 = dataKaryawan.idx;
		var nama = dataKaryawan.nama;
		
	   	isDelete = confirm('Yakin Karyawan '+ nama +' akan dihapus ?');
	  	if (isDelete) sendRequestForm('admin/HapusKaryawan', {IDKaryawan : idx}, 'box-body');
	}


	function fillKodeDivisi(objSource, objReference)
	{
		
		var IDBidang = $(objSource).val();
		kodeTipeKaryawan = ajaxFillGridJSON('admin/GetKodeBidangAJax', {IDBidang : IDBidang}); 
		$(objReference).html(kodeTipeKaryawan);
	}

	function fillKodeDivisi(objSource, objReference)
	{
		
		var IDDivisi = $(objSource).val();
		kodeTipeKaryawan = ajaxFillGridJSON('admin/GetKodeDivisiAJax', {IDDivisi : IDDivisi}); 
		$(objReference).html(kodeTipeKaryawan);
	}

	function readURL(input){
      if(input.files&&input.files[0]){
        var reader = new FileReader();

        reader.onload = function (e){
          $('#blah').attr('src',e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
 
    $("#foto").change(function(){
        readURL(this);
         $('#kosong').val('isi');
    });
            		
</script>

 