<div class="content-header">   

	<h1>Daftar Bukti Kas Masuk</h1>

</div>



<div class="content">

	<div class="box box-primary">

	  	<div class="box-body">

	  		<div class="box-header">

				<button type="button" class="btn btn-sm btn-primary" id="btnTambahBaru"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>		

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

			var html = "<?php echo site_url("transaksi/InputBkm")?>";
		
			$(".content-wrapper").load(html);              

	    	//$('body').attr('class', 'skin-yellow layout-boxed sidebar-collapse modal-open');

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

                  { name: "tgl", 	type: "string" },

                  { name: "nomor", 	type: "string" },

                  { name: "uraian", 	type: "string" },

                  { name: "nominal", 	type: "string" },

                  { name: "action", 	type: "string" }

             ],

            url : "transaksi/GetDaftarBkm",

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

              { text: 'Tanggal', cellsAlign: 'center', align: 'center', dataField: 'tgl', width : '15%'},

              { text: 'Nomor', cellsAlign: 'center', align: 'center', dataField: 'nomor', width : '15%'},

              { text: 'Uraian', cellsAlign: 'left', align: 'center', dataField: 'uraian', width : '35%'},

              { text: 'Nominal', cellsAlign: 'right', align: 'center', dataField: 'nominal', width : '15%'},

              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '20%' }

            ]

        }).on('rowDoubleClick', function(event)

        {	          	

        	dialogFormEditShow();

	    });	

	}


	function dialogFormPrint(idx)

	{
		//var htmlOut = ajaxFillGridJSON('transaksi/printbkm', {idx : idx}); 

		var htmlOut = "<?php echo site_url("transaksi/printbkm")?>/"+idx;
        
        window.open(htmlOut);   
    			   

	}
	
            		

</script>



 