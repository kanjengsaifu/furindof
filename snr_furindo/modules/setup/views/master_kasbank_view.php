<div class="content-header">   

	<h1>Daftar KasBank</h1>

</div>



<div class="content">

	<div class="box box-primary">

	  	<div class="box-body">

	  		<div class="box-header">

				<!-- <button type="button" class="btn btn-sm btn-primary" id="btnTambahBaru"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button> -->		

			</div>

	  		<div class="form-control" style="overflow:scroll;min-height:640px;">

				<div id="ajaxTreeGrid"></div>

			</div>

		</div>

	  </div>

	</div> 

</div>



 <div class="modal hide" id="dialogFormBaru" tabindex="1" role="dialog" aria-labelledby="FormTambahData" aria-hidden="true">

	 <div class="modal-dialog">

	    <div class="modal-content">

	      <div class="modal-header">

	        <h4 class="modal-title" id="FormTambahData">Tambah Data KasBank</h4>

	      </div>

	      <div class="modal-body">

	      	<div class="pesanBaru"></div>

	      		<form id="formBaru" class="form-horizontal" action="setup/TambahKasBank" method="post">

	      			
	      			<div class="form-group">

					    <label for="kode" class="col-sm-3 control-label">Kode</label>

					    <div class="col-sm-9">

					       	<input id="kode" name="kodebaru" value="" type="text" class="form-control"/>
					       	<input id="status" name="status" value="" type="hidden" class="form-control"/>
					       	<input id="induk" name="induk" value="0" type="hidden" class="form-control"/>

					    </div>

				    </div>

				    <div class="form-group">

					    <label for="nama" class="col-sm-3 control-label">Nama</label>

					    <div class="col-sm-9">

					       	<input id="nama" name="namabaru" value="" type="text" class="form-control"/>

					    </div>

				    </div>
				    

				    <div class="form-group">

					    <label for="deskripsi" class="col-sm-3 control-label">Deskripsi</label>

					    <div class="col-sm-9">

					       	<textarea id="deskripsi" name="deskripsibaru" class="form-control"></textarea>

					    </div>

				    </div>

		        </form>  

	      </div>

	      <div class="modal-footer">

	        <button type="button" class="btn btn-sm btn-primary" id="btnTambahKasBank">Tambah</button>

	        <button type="button" class="btn btn-sm btn-warning" id="btnBatalTambahKasBank">Batal</button>

	      </div>

	    </div>

	  </div>

	</div>

</div>

 <div class="modal hide" id="dialogFormUbah" tabindex="2" role="dialog" aria-labelledby="FormUbahData" aria-hidden="true">

	 <div class="modal-dialog">

	    <div class="modal-content">

	      <div class="modal-header">

	        <h4 class="modal-title" id="FormUbahData">Ubah Data KasBank</h4>

	      </div>

	      <div class="modal-body">

	      	<div class="pesanUbah"></div>

	      		<form id="formUbah" class="form-horizontal" action="setup/UbahKasBank" method="post">
	      			
	      			<div class="form-group">

					    <label for="kodeUbah" class="col-sm-3 control-label">Kode</label>

					    <div class="col-sm-9">

					       	<input id="kodeUbah" name="kodeUbah" value="" type="text" class="form-control"/>

					    </div>

				    </div>

				    <div class="form-group">

					    <label for="namaUbah" class="col-sm-3 control-label">Nama</label>

					    <div class="col-sm-9">

					       	<input id="namaUbah" name="namaUbah" value="" type="text" class="form-control"/>

					    </div>

				    </div>
				    
				    <div class="form-group">

					    <label for="deskripsiUbah" class="col-sm-3 control-label">Deskripsi</label>

					    <div class="col-sm-9">

					       	<textarea id="deskripsiUbah" name="deskripsiUbah" class="form-control"></textarea>

					    </div>

				    </div>

			          <div class='form-group'>

			            <label for='notAktifUbah' class='col-sm-3 control-label'>&nbsp;</label>

			            <div class='col-sm-9'>

							<div class="status">

							    <label>

							      <input type="checkbox" value="1" name="notAktifUbah" id="notAktifUbah"> Not Aktif

							    </label>

							</div>

			            </div>

			          </div>

				    <input type="hidden" name="ID" id="ID"/>

		        </form>  

	      </div>

	      <div class="modal-footer">

	        <button type="button" class="btn btn-sm btn-primary" id="btnUbahKasBank">Ubah</button>

	        <button type="button" class="btn btn-sm btn-warning" id="btnBatalUbahKasBank">Batal</button>

	      </div>

	    </div>

	  </div>

	</div>

</div>

<script src="assets/js/func.js" type="text/javascript"></script> 	

<script>

	$(document).ready(function () {

         loadGridData();

        //$('select').select2();



    	$('#btnTambahBaru').click(function(e)

        {

			e.preventDefault(); 

			resetForm();

	    	$('#alertMessage').remove();

	    	$('#dialogFormBaru').attr('class', 'modal show');  

	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              

        });



        $('#btnBatalTambahKasBank').click( function(e){

    		e.preventDefault(); 

    		$('#dialogFormBaru').attr('class', 'modal hide');

    		//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse');

   		});        



   		$('#btnBatalUbahKasBank').click( function(e){

	    	e.preventDefault(); 

	    	$('#alertMessage').remove();

	    	$('#dialogFormUbah').attr('class', 'modal hide');

	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse');

	    });



   		$('#btnTambahKasBank').click( function(e){

 			e.preventDefault();

	       	sendRequestForm($('#formBaru').attr('action'), $('#formBaru').serialize(), 'pesanBaru');

	    });

 	

	    $('#btnUbahKasBank').click( function(e){

 			e.preventDefault(); 

	       	sendRequestForm($('#formUbah').attr('action'), $('#formUbah').serialize(), 'pesanUbah'); 

	    });



	    $('#btnCari').click( function(e){

 			e.preventDefault(); 

	       	ajaxDataGrid($('#formCari').attr('action'),  $('#formCari').serialize(), 'ajaxTreeGrid'); 

	    });



	    $('#btnCetakExcel').click( function(e){

 			e.preventDefault();

 			$("#ajaxTreeGrid").jqxDataTable('exportData', 'xls');

 		});  

	    

      



    });



    function resetForm()

	{

		$('input[type="text"], input[type="password"], select, textarea').val('');

		$('input:first').focus();



		loadGridData();

	}



	function loadGridData(){



	     var source =

         {		

             dataType: "json",

             dataFields: [

                  { name: "idx", 			type: "string" },
                  
                  { name: "kode", 			type: "string" },

                  { name: "kode2", 			type: "string" },

                  { name: "nama", 			type: "string" },

                  { name: "notaktif", 		type: "string" },

                  { name: "deskripsi", 		type: "string" },

                  { name: "action", 		type: "string" }

             ],

            url : "setup/GetDaftarKasBank",

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

            height: '600px',

            pageable : true,

            pageSize : 1000,

            pagerPosition : 'bottom',

            filterMode: 'simple',

            theme: 'fresh',

            width: '100%',

            columnsResize: true,

            columns: [

              { text: 'Kode', cellsAlign: 'left', align: 'center', dataField: 'kode', width : '15%'},

              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '35%'},

              { text: 'Deskripsi', cellsAlign: 'left', align: 'center', dataField: 'deskripsi', width : '40%'},

              { text: '', cellsAlign: 'right', align: 'center', dataField: 'action', width: '10%' }

            ]

        }).on('rowDoubleClick', function(event)

        {	          	

        	dialogFormEditShow();

	    });	

	}



	function dialogFormEditShow()

	{ 

		var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');



		var dataKasBank = selection[0];



		var	idx      		 = dataKasBank.idx,

			IDMataUang 		 = dataKasBank.IDMataUang,

			mataUang 		 = dataKasBank.mataUang,

	 		kode    		 = dataKasBank.kode2,

	 		nama    		 = dataKasBank.nama,

	 		norekbank 		 = dataKasBank.norekbank,

	 		namabank 		 = dataKasBank.namabank,

	 		notaktif 		 = dataKasBank.notaktif,

	 		deskripsi 		 = dataKasBank.deskripsi;

			

			$('#alertMessage').remove();



		 	$('#kodeUbah').val(kode);

		 	$('#namaUbah').val(nama);

		 	$('#deskripsiUbah').val(deskripsi);

	 		$('#ID').val(idx);



	 		document.getElementById('notAktifUbah').checked = (notaktif == '1');

	 		

			$('#dialogFormUbah').attr('class', 'modal show');

			//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');



	}

	function dialogFormTambahShow()

	{ 

		var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');



		var dataKasBank = selection[0];



		var	idx      		 = dataKasBank.idx,

			IDMataUang 		 = dataKasBank.IDMataUang,

			mataUang 		 = dataKasBank.mataUang,

	 		kode    		 = dataKasBank.kode2,

	 		nama    		 = dataKasBank.nama,

	 		norekbank 		 = dataKasBank.norekbank,

	 		namabank 		 = dataKasBank.namabank,

	 		notaktif 		 = dataKasBank.notaktif,

	 		deskripsi 		 = dataKasBank.deskripsi;

			

			$('#alertMessage').remove();

		 	$('#status').val(notaktif);

		 	$('#induk').val(idx);

			$('#dialogFormBaru').attr('class', 'modal show');

			//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');



	}



	function dialogFormUbahClose()

	{

		 $('#dialogFormUbah').attr('class', 'modal close');	

		 //$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse');

	}



	function dialogFormBaruClose()

	{

		 $('#dialogFormBaru').attr('class', 'modal close');	

		 //$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse');

	}



	function deleteConfirmShow()

	{ 



	 	var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');

		var dataKasBank = selection[0];

		

		var idx	 = dataKasBank.idx;

		var nama = dataKasBank.nama;

		

	   	isDelete = confirm('Yakin KasBank '+ nama +' akan dihapus ?');

	  	if (isDelete) sendRequestForm('setup/HapusKasBank', {ID : idx}, 'box-body:first');

	}



            		

</script>



 