<div class="content-header">   
	<h1>Daftar PO Raw Material</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<button type="button" class="btn btn-sm btn-primary" onclick="Add_raw()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
        <button type="button" class="btn btn-sm btn-info" onclick="Add_buf()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Pakai Buffer</button>
        <button type="button" class="btn btn-sm btn-success" onclick="Import()"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Import</button>
				<!-- <button type="button" class="btn btn-sm btn-primary" id="btnCetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak PDF</button> -->		
			</div>
	  		<div class="form-control" style="min-height:610px;">
				<div id="ajaxTreeGrid"></div>
			</div>
		</div> 
	  </div>
	</div> 
</div>

 
	
<script>
	$(document).ready(function () {
                     
    	    
        loadGridData();

    });
    
	
	function deleteConfirmShow(ids)
	{ 

	 	var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');
		
		
	   	isDelete = confirm('Yakin PO akan dihapus ?');
	  	if (isDelete) sendRequestForm('raw/HapusRaw', {ID : ids}, 'box-body');
	  	kodeTipeKaryawan = ajaxFillGridJSON('raw/po_raw'); 
		$('.content-wrapper').html(kodeTipeKaryawan);
	}
    function Add_raw()

	  {     
	    //var htmlOut = ajaxFillGridJSON('admin/AddSales');
	    var loadhtml = "<?php echo site_url("raw/tambah_po_raw")?>"; 
	    
	    $('.content-wrapper').load(loadhtml);
	  }

    function Add_buf()

    {     
      //var htmlOut = ajaxFillGridJSON('admin/AddSales');
      var loadhtml = "<?php echo site_url("raw/tambah_buffer_raw")?>"; 
      
      $('.content-wrapper').load(loadhtml);
    } 

    function Import()

    {     
      //var htmlOut = ajaxFillGridJSON('admin/AddSales');
      var loadhtml = "<?php echo site_url("raw/ImportPoRaw")?>"; 
      
      $('.content-wrapper').load(loadhtml);
    } 
	function dialogFormEditShow(idx)
	{
		//var IDBidang = $(objSource).val();
		//kodeTipeKaryawan = ajaxFillGridJSON('admin/DetailSO', {IDBidang : idx});
		kodeTipeKaryawan = ajaxFillGridJSON('raw/edit_po_raw', {IDBidang : idx}); 
		$('.content-wrapper').html(kodeTipeKaryawan);

	}

	function detailShow(idx)
	{
		//var IDBidang = $(objSource).val();
		kodeTipeKaryawan = ajaxFillGridJSON('raw/detailPoRaw', {IDBidang : idx});
		//kodeTipeKaryawan = ajaxFillGridJSON('admin/editso', {IDBidang : idx}); 
		$('.content-wrapper').html(kodeTipeKaryawan);

	}

  function printShow(idx)
  {
    //var htmlOut = ajaxFillGridJSON('transaksi/printbkk', {idx : idx}); 

    var htmlOut = "<?php echo site_url("raw/printporaw")?>/"+idx;
        
    window.open(htmlOut);   
             

  }  

	function loadGridData(){
	     var source =
         {		
             dataType: "json",
             dataFields: [
                  { name: "idx", 	type: "string" },
                  { name: "kode", 	type: "string" },
                  { name: "ref",   type: "string" },
                  { name: "nama", 	type: "string" },
                  { name: "date", 	type: "date" },
                  { name: "address", 	type: "string" },
                  { name: "phone", 	type: "string" },
                  { name: "no",   type: "string" },
                  { name: "action", 	type: "string" }
             ],
            url : "raw/GetDaftarPORaw",
            id  : "idx"
         };

        var dataAdapter = new $.jqx.dataAdapter(source, {
            loadComplete: function () {		
            }
        });

        // create jqxDataTable.
        $("#ajaxTreeGrid").jqxGrid(
        {
            source: dataAdapter,
            pagerButtonsCount: 10,
            altRows: true,
            sortable: true,
            filterable: true,
            columnsResize: true,
            height: '600px',
            pageable : true,
            pageSize : 1000,
            showfilterrow: true,
            //pagerPosition : 'bottom',
            filterMode: 'simple',
            theme: 'fresh',
            width: '100%',
            columns: [
              { text: 'PID', cellsAlign: 'center', align: 'center', dataField: 'no', width : '6%'},
              { text: 'SO Ref', cellsAlign: 'center', align: 'center', dataField: 'ref', width : '8%'},
              { text: 'Kode', cellsAlign: 'center',  align: 'center', dataField: 'kode', width : '8%'},              
              // { text: 'Foto', cellsAlign: 'left', align: 'center', dataField: 'foto', width : '12%'},
              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '16%'},
              { text: 'Date', cellsAlign: 'center', align: 'center', dataField: 'date', filtertype: 'range', cellsformat: 'd', width : '8%'},
              { text: 'Address', cellsAlign: 'left', align: 'center', dataField: 'address', width : '26%'},
              { text: 'Phone', cellsAlign: 'left', align: 'center', dataField: 'phone', width : '10%'},
              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '20  %' }
            ]
        }).on('rowDoubleClick', function(event)
        {	  
        	//var idx = dataAdapter['idx'];         	
        	dialogFormEditShow(idx);
	    });	
	}  
            		
</script>

<script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": false,
          "bAutoWidth": false
        });
      });
    </script>

 