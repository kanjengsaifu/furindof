<style> 
#red {
    
    background-color: red;
    position: relative;
    -webkit-animation-name: example; /* Chrome, Safari, Opera */
    -webkit-animation-duration: 4s; /* Chrome, Safari, Opera */
    -webkit-animation-iteration-count: 3; /* Chrome, Safari, Opera */
    animation-name: example;
    animation-duration: 2s;
    animation-iteration-count: 300;
}

/* Chrome, Safari, Opera */
@-webkit-keyframes example {
    0%   {background-color: red;}
    25%  {background-color: yellow;}
    50%  {background-color: red;}
    75%  {background-color: yellow;}
    100% {background-color: red;}
}

/* Standard syntax */
@keyframes example {
    0%   {background-color: red;}
    25%  {background-color: yellow;}
    50%  {background-color: red;}
    75%  {background-color: yellow;}
    100% {background-color: red;}
}
</style>
<div class="content-header">   
	<h1>Balance Packing</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<!-- <button type="button" class="btn btn-sm btn-primary" onclick="Add_raw()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
        <button type="button" class="btn btn-sm btn-info" onclick="Add_buf()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Pakai Buffer</button>
        <button type="button" class="btn btn-sm btn-success" onclick="Import()"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Import</button>
				 -->
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
		var dataKaryawan = selection[0];
		
		var idx	 = dataKaryawan.idx;
		var nama = dataKaryawan.kode;
		
	   	isDelete = confirm('Yakin PO '+ nama +' akan dihapus ?');
	  	if (isDelete) sendRequestForm('raw/HapusRaw', {ID : idx}, 'box-body');
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

	function detailShow(idx, ids)
	{
    //var IDBidang = $(objSource).val();
		kodeTipeKaryawan = ajaxFillGridJSON('production/DetailBalancePacking', {IDBidang : idx, IDX : ids});
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
                  { name: "idx",	type: "string" },
                  { name: "ref", type: "string" },
                  { name: "prd", type: "string" },
                  { name: "date",	type: "date" },
                  { name: "qty",	type: "string" },
                  { name: "datang", type: "string" },
                  { name: "sisa", type: "string" },
                  { name: "no", type: "string" },
                  { name: "product",  type: "string" },
                  { name: "action",	type: "string" }
             ],

            
            url : "production/GetBalancePacking",

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
            groupable: true,
            showstatusbar: true,
            statusbarheight: 30,
            showaggregates: true,
            filterMode: 'simple',
            theme: 'fresh',
            width: '100%',
            // groups: ['nama'],                
            //     groupsRenderer: function(value, rowData, level)
            //     {
            //         return "Vendor Name: " + value;
            //     },
            columns: [
              { text: 'PID', cellsAlign: 'center', align: 'center', dataField: 'no', width : '5%'},
              { text: 'SO Ref', cellsAlign: 'center', align: 'center', dataField: 'ref', width : '8%'},
              { text: 'Kode PRD', cellsAlign: 'left', align: 'center', dataField: 'prd', width : '12%'},
              { text: 'Product', cellsAlign: 'left', align: 'center', dataField: 'product', width : '25%'},
              { text: 'Date', cellsAlign: 'center', align: 'center', dataField: 'date', filtertype: 'range', cellsformat: 'd', width : '10%'},
              { text: 'Order', cellsAlign: 'center', align: 'center', dataField: 'qty', cellsformat: 'f', aggregates: ['sum'], width : '10%'},
              { text: 'Sisa', cellsAlign: 'center', align: 'center', dataField: 'sisa', cellsformat: 'f', aggregates: ['sum'], width : '10%'},
              { text: 'Packing', cellsAlign: 'center', align: 'center', dataField: 'datang', cellsformat: 'f', aggregates: ['sum'], width : '10%'},
              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '10%' }
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

 