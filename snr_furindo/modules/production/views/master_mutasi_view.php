<div class="content-header">   
	<h1>Daftar Inventory Raw Material</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<!-- <button type="button" class="btn btn-sm btn-primary" onclick="Add_raw()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
				<button type="button" class="btn btn-sm btn-primary" id="btnCetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak PDF</button>	 -->	
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
		
	   	isDelete = confirm('Yakin LPB '+ nama +' akan dihapus ?');
	  	if (isDelete) sendRequestForm('lpb/HapusLpbRaw', {ID : idx}, 'box-body');
	  	kodeTipeKaryawan = ajaxFillGridJSON('lpb/lpb_raw'); 
		$('.content-wrapper').html(kodeTipeKaryawan);
	}
    function Add_raw()

	  {     
	    //var htmlOut = ajaxFillGridJSON('admin/AddSales');
	    var loadhtml = "<?php echo site_url("lpb/tambah_lpb_raw")?>"; 
	    
	    $('.content-wrapper').load(loadhtml);
	  } 
	function dialogFormEditShow(idx)
	{
		//var IDBidang = $(objSource).val();
		//kodeTipeKaryawan = ajaxFillGridJSON('admin/DetailSO', {IDBidang : idx});
		kodeTipeKaryawan = ajaxFillGridJSON('lpb/edit_lpb_raw', {IDBidang : idx}); 
		$('.content-wrapper').html(kodeTipeKaryawan);

	}

	function detailShow(idx)
	{
		//var IDBidang = $(objSource).val();
		kodeTipeKaryawan = ajaxFillGridJSON('admin/DetailSO', {IDBidang : idx});
		//kodeTipeKaryawan = ajaxFillGridJSON('admin/editso', {IDBidang : idx}); 
		$('.content-wrapper').html(kodeTipeKaryawan);

	}

  function getnumeric(elem)
  {
    
    var getelem = $(elem).attr("atm");
      getval = $("#"+getelem).val().replace(/,/ig, '');
      currancy = getval.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
      //console.log(getval);
      
      ilmen = getelem.replace(/nominal-/ig, 'qty-');
      price = getelem.replace(/nominal-/ig, 'ttl-');
      getilm = $("#"+ilmen).val().replace(/,/ig, '');
      jml = getval*getilm;
      $("#"+price).val(jml)
      //console.log(getilm);
      getval = $("#"+getelem).val(currancy);
      calculates();
  }

	function loadGridData(){
	     var source =
         {		
             dataType: "json",
             dataFields: [
                  { name: "idx", 	type: "string" },
                  { name: "kode", 	type: "string" },
                  { name: "nama", 	type: "string" },
                  { name: "ok", 	type: "string" },
                  { name: "no",   type: "number" },
                  { name: "qty", 	type: "string" },
                  { name: "sample", 	type: "string" },
                  { name: "action", 	type: "string" }
             ],
            url : "production/GetDaftarInv",
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
            pageSize : 1000,
            pagerPosition : 'bottom',
            filterMode: 'simple',
            theme: 'fresh',
            width: '100%',
            columns: [
              { text: 'PID', cellsAlign: 'center', align: 'center', dataField: 'idx', width : '5%'},
              { text: 'Kode', cellsAlign: 'left', align: 'center', dataField: 'kode', width : '13%'},
              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '27%'},
              { text: 'OK', cellsAlign: 'center', align: 'center', dataField: 'ok', width : '13%'},
              { text: 'NG', cellsAlign: 'center', align: 'center', dataField: 'qty', width : '10%'},
              { text: 'Sample', cellsAlign: 'center', align: 'center', dataField: 'sample', width : '12%'},
              { text: 'Total', cellsAlign: 'center', align: 'center', dataField: 'action', width: '20  %' }
            ]
        }).on('rowDoubleClick', function(event)
        {	  
        	//var idx = dataAdapter['no'];
          //alert();         	
        	edit();
	    });	
	}  

  function edit(no)
  {
    var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');
    var data      = selection[0];
    var idx       = data.no;
    //alert(idx);
    cari = $("#qty-"+idx).val();
    alert(cari);
    $("#qty-"+idx).val('5');
    //document.getElementById(cari).focus();
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

 