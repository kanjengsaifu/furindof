<div class="content-header">   
	<h1>Daftar PO Suport Material</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<button type="button" class="btn btn-sm btn-primary" onclick="Add_raw()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
        <button type="button" class="btn btn-sm btn-info" onclick="Add_liquid()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Liquid</button>
				<button type="button" class="btn btn-sm btn-success" onclick="Import_sm()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Import Liquid</button>		
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
		var dataKaryawan = selection[0];
		
		var idx	 = dataKaryawan.idx;
		var nama = dataKaryawan.kode;
		
	   	isDelete = confirm('Yakin PO '+ nama +' akan dihapus ?');
	  	if (isDelete) sendRequestForm('suport/HapusSm', {ID : idx}, 'box-body');
	  	kodeTipeKaryawan = ajaxFillGridJSON('suport/po_sm'); 
		$('.content-wrapper').html(kodeTipeKaryawan);
	}
    function Add_raw()

	  {     
	    //var htmlOut = ajaxFillGridJSON('admin/AddSales');
	    var loadhtml = "<?php echo site_url("suport/tambah_po_raw")?>"; 
	    
	    $('.content-wrapper').load(loadhtml);
	  } 

  function Add_liquid()

    {     
      //var htmlOut = ajaxFillGridJSON('admin/AddSales');
      var loadhtml = "<?php echo site_url("suport/tambah_po_liquid")?>"; 
      
      $('.content-wrapper').load(loadhtml);
    } 

  function Import_sm()

    {     
      //var htmlOut = ajaxFillGridJSON('admin/AddSales');
      var loadhtml = "<?php echo site_url("suport/import_po_liquid")?>"; 
      
      $('.content-wrapper').load(loadhtml);
    } 

	function dialogFormEditShow(idx, ids)
	{
		//var IDBidang = $(objSource).val();
		//kodeTipeKaryawan = ajaxFillGridJSON('admin/DetailSO', {IDBidang : idx});
		kodeTipeKaryawan = ajaxFillGridJSON('suport/edit_po_sm', {IDBidang : idx, SO : ids}); 
		$('.content-wrapper').html(kodeTipeKaryawan);

	}

	function detailShow(idx)
	{
		//var IDBidang = $(objSource).val();
		kodeTipeKaryawan = ajaxFillGridJSON('admin/DetailSO', {IDBidang : idx});
		//kodeTipeKaryawan = ajaxFillGridJSON('admin/editso', {IDBidang : idx}); 
		$('.content-wrapper').html(kodeTipeKaryawan);

	}

  function printShow(idx)
  {
    //var htmlOut = ajaxFillGridJSON('transaksi/printbkk', {idx : idx}); 

    var htmlOut = "<?php echo site_url("suport/printposm")?>/"+idx;
        
    window.open(htmlOut);   
             

  }  

	function loadGridData(){
	     var source =
         {		
             dataType: "json",
             dataFields: [
                  { name: "idx", 	type: "string" },
                  { name: "kode", 	type: "string" },
                  { name: "nama", 	type: "string" },
                  { name: "date", 	type: "string" },
                  { name: "address", 	type: "string" },
                  { name: "phone", 	type: "string" },
                  { name: "ref_no",  type: "string" },
                  { name: "action", 	type: "string" }
             ],
            url : "suport/GetDaftarPORaw",
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
            sortable: true,
            filterable: true,
            columnsResize: true,
            height: '600px',
            pageable : true,
            pageSize : 100,
            pagerPosition : 'bottom',
            filterMode: 'simple',
            theme: 'fresh',
            width: '100%',
            columns: [
              { text: 'PID', cellsAlign: 'center', align: 'center', dataField: 'idx', width : '5%'},
              { text: 'Kode', cellsAlign: 'left', align: 'center', dataField: 'kode', width : '10%'},
              { text: 'no SO', cellsAlign: 'left', align: 'center', dataField: 'ref_no', width : '9%'},
              // { text: 'Foto', cellsAlign: 'left', align: 'center', dataField: 'foto', width : '12%'},
              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '10%'},
              { text: 'Date', cellsAlign: 'left', align: 'center', dataField: 'date', width : '8%'},
              { text: 'Address', cellsAlign: 'left', align: 'center', dataField: 'address', width : '28%'},
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

 