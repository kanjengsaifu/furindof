<div class="content-header">   

	<h1>Daftar Angsuran KSM</h1>

</div>



<div class="content">

	<div class="box box-primary">

	  	<div class="box-body">

	  		<div class="box-header">
<!-- 
				<button type="button" class="btn btn-sm btn-primary" id="btnTambahBaru"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>		
 -->
				<button type="button" class="btn btn-sm btn-primary" id="btnCetakExcel"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak Excel</button>		

			</div>

	  		<div class="form-control" style="overflow:scroll;min-height:430px;">

				<div id="ajaxTreeGrid"></div>

			</div>

		</div> <!-- <div class="box-body"> -->

	  </div>

	</div> <!-- <div class="box box-primary"> -->

</div>



 <div class="modal hide" id="dialogFormBaru" tabindex="1" role="dialog" aria-labelledby="FormTambahData" aria-hidden="true">

	 <div class="modal-dialog">

	    <div class="modal-content">

	      <div class="modal-header">

	        <h4 class="modal-title" id="FormTambahData">Tambah Data Pemasukan</h4>

	      </div>

	      <div class="modal-body">

	      	<div class="pesanBaru"></div>

	      		<form id="formBaru" class="form-horizontal" action="admin/TambahPemasukan" method="POST">

	      			<div class="form-group">

					    <label for="kode" class="col-sm-2 control-label">Kode</label>

					    <div class="col-sm-10">

					       	<input id="kode" name="kodebaru" value="" type="text" class="form-control"/>

					    </div>

				    </div>

				    <div class="form-group">

					    <label for="nama" class="col-sm-2 control-label">Nama</label>

					    <div class="col-sm-10">

					       	<input id="nama" name="namabaru" value="" type="text" class="form-control"/>

					    </div>

				    </div>

		        </form>  

	      </div>

	      <div class="modal-footer">

	        <button type="button" class="btn btn-sm btn-primary" id="btnTambahPemasukan">Tambah</button>

	        <button type="button" class="btn btn-sm btn-primary" id="btnBatalTambahPemasukan">Batal</button>

	      </div>

	    </div>

	  </div>

	</div>

</div>



 <div class="modal hide" id="dialogFormUbah" tabindex="2" role="dialog" aria-labelledby="FormUbahData" aria-hidden="true">

	 <div class="modal-dialog">

	    <div class="modal-content">

	      <div class="modal-header">

	        <h4 class="modal-title" id="FormUbahData">Ubah Data Pemasukan</h4>

	      </div>

	      <div class="modal-body">

	      	<div class="pesanUbah"></div>

	      		<form id="formUbah" class="form-horizontal" action="admin/UbahPemasukan" method="post">

	      			<div class="form-group">

					    <label for="kodeUbah" class="col-sm-2 control-label">Kode</label>

					    <div class="col-sm-10">

					       	<input id="kodeUbah" name="kodeUbah" value="" type="text" class="form-control"/>

					    </div>

				    </div>

				    <div class="form-group">

					    <label for="namaUbah" class="col-sm-2 control-label">Nama</label>

					    <div class="col-sm-10">

					       	<input id="namaUbah" name="namaUbah" value="" type="text" class="form-control"/>

					    </div>

				    </div>

				    <input type="hidden" name="ID" id="ID"/>

		        </form>  

	      </div>

	      <div class="modal-footer">

	        <button type="button" class="btn btn-sm btn-primary" id="btnUbahPemasukan">Ubah</button>

	        <button type="button" class="btn btn-sm btn-primary" id="btnBatalUbahPemasukan">Batal</button>

	      </div>

	    </div>

	  </div>

	</div>

</div>

	

<script>

	$(document).ready(function () {

                     

    	$('#btnTambahBaru').click(function(e)

        {

			e.preventDefault(); 

			var html = "<?php echo site_url("transaksi/tambahangsuran")?>";
		
			$(".content-wrapper").load(html);              

	    	//$('body').attr('class', 'skin-yellow layout-boxed sidebar-collapse modal-open');

        });



        $('#btnBatalTambahPemasukan').click( function(e){

    		e.preventDefault(); 

    		$('#dialogFormBaru').attr('class', 'modal close');

    		//$('body').attr('class', 'skin-yellow layout-boxed sidebar-collapse');

   		});        



   		$('#btnBatalUbahPemasukan').click( function(e){

	    	e.preventDefault(); 

	    	$('#alertMessage').remove();

	    	$('#dialogFormUbah').attr('class', 'modal close');

	    	//$('body').attr('class', 'skin-yellow layout-boxed sidebar-collapse');

	    });



   		$('#btnTambahPemasukan').click( function(e){

 			e.preventDefault();

	       	sendRequestForm($('#formBaru').attr('action'), $('#formBaru').serialize(), 'pesanBaru');

	    });

 	

	    $('#btnUbahPemasukan').click( function(e){

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



	     var source =

         {		

             dataType: "json",

             dataFields: [

                  { name: "idx", 	type: "string" },

                  { name: "kode", 	type: "string" },

                  { name: "nama", 	type: "string" },

                  { name: "lama", 	type: "string" },

                  { name: "bunga", 	type: "string" },

                  { name: "nominal", 	type: "string" },

                  { name: "action", 	type: "string" }

             ],

            url : "transaksi/GetDaftarAngsuran",

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

            height: '400px',

            pageable : true,

            pageSize : 10,

            pagerPosition : 'bottom',

            filterMode: 'simple',

            theme: 'fresh',

            width: '100%',

            columnsResize: true,

            columns: [

              { text: 'Kode', cellsAlign: 'center', align: 'center', dataField: 'kode', width : '10%'},

              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '35%'},

              { text: 'Lama', cellsAlign: 'center', align: 'center', dataField: 'lama', width : '10%'},

              { text: 'Bunga', cellsAlign: 'center', align: 'center', dataField: 'bunga', width : '10%'},

              { text: 'Nominal', cellsAlign: 'right', align: 'center', dataField: 'nominal', width : '15%'},

              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '20%' }

            ]

        }).on('rowDoubleClick', function(event)

        {	          	

        	dialogFormEditShow();

	    });	

	}



	function dialogFormEditShow()

	{ 

		var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');



		var dataPemasukan = selection[0];

			

		var	idx      		 = dataPemasukan.idx,

	 		kode    		 = dataPemasukan.kode,

	 		nama    		 = dataPemasukan.nama;

			

			$('#alertMessage').remove();



		 	$('#kodeUbah').val(kode);

		 	$('#namaUbah').val(nama);

	 		$('#ID').val(idx);

	 		

			$('#dialogFormUbah').attr('class', 'modal show');

			//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');



	}



	function dialogFormBayar(idx)

	{
		var htmlOut = ajaxFillGridJSON('transaksi/tambahangsuran', {idx : idx}); 
    
    	$('.content-wrapper').html(htmlOut);		   

	}



	function dialogFormBaruClose()

	{

		 $('#dialogFormBaru').attr('class', 'modal close');	

		 //$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse');

	}



	function deleteConfirmShow()

	{ 



	 	var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');

		var dataPemasukan = selection[0];

		

		var idx	 = dataPemasukan.idx;

		var kode = dataPemasukan.kode;

		var nama = dataPemasukan.nama;

		

	   	isDelete = confirm('Yakin Pemasukan '+ nama +' akan dihapus ?');

	  	if (isDelete) sendRequestForm('admin/HapusPemasukan', {Kode : idx}, 'box-body:first');

	}



            		

</script>



 