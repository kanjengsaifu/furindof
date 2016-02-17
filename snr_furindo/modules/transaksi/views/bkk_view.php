<div class="content-header">   

	<h1>Daftar Bukti Kas Keluar</h1>

</div>



<div class="content">

	<div class="box box-primary">

	  	<div class="box-body">

	  		<div class="box-header">

				<button type="button" class="btn btn-sm btn-primary" id="btnTambahBaru"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>		

				<button type="button" class="btn btn-sm btn-primary" onclick="dialogFormPrintkas()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak Kas Harian</button>

        <button type="button" class="btn btn-sm btn-primary" onclick="dialogFormPrintbank()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak Buku Bank</button>		

			</div>

	  		<div class="form-control" style="overflow:scroll;min-height:430px;">

				<div id="ajaxTreeGrid"></div>

			</div>

		</div> <!-- <div class="box-body"> -->

	  </div>

	</div> <!-- <div class="box box-primary"> -->

</div>

<script>

	$(document).ready(function () {

               

    	$('#btnTambahBaru').click(function(e)

        {

			e.preventDefault(); 

			var html = "<?php echo site_url("transaksi/InputBkk")?>";
		
			$(".content-wrapper").load(html);              

	    	//$('body').attr('class', 'skin-yellow layout-boxed sidebar-collapse modal-open');

        });

	    $('#btnCetakExcel').click( function(e){

 			e.preventDefault();

 			$("#ajaxTreeGrid").jqxDataTable('exportData', 'xls');

 		});  

	    

        loadGridData();



    });


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

            url : "transaksi/GetDaftarBkk",

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
		//var htmlOut = ajaxFillGridJSON('transaksi/printbkk', {idx : idx}); 

		var htmlOut = "<?php echo site_url("transaksi/printbkk")?>/"+idx;
        
        window.open(htmlOut);   
    			   

	}

  function dialogFormPrintkas()

  {
    //var htmlOut = ajaxFillGridJSON('transaksi/printbkk', {idx : idx}); 

    var htmlOut = "<?php echo site_url("transaksi/printbuktikas")?>";
        
        window.open(htmlOut);   
             

  }

  function dialogFormPrintbank()

  {
    //var htmlOut = ajaxFillGridJSON('transaksi/printbkk', {idx : idx}); 

    var htmlOut = "<?php echo site_url("transaksi/printbuktibank")?>";
        
        window.open(htmlOut);   
             

  }


</script>



 