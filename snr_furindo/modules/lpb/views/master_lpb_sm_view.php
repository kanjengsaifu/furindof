<div class="content-header">   
	<h1>Daftar LPB Suport Material</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<button type="button" class="btn btn-sm btn-primary" onclick="Add_raw()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
				<button type="button" class="btn btn-sm btn-warning" onclick="Add_bebas()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah LPB Cast</button>		
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
      
      var idx  = dataKaryawan.idx;
      var nama = dataKaryawan.kode;
      
        isDelete = confirm('Yakin LPB '+ nama +' akan dihapus ?');
        if (isDelete) sendRequestForm('lpb/HapusLpbSm', {ID : idx}, 'box-body');
        kodeTipeKaryawan = ajaxFillGridJSON('lpb/lpb_sm'); 
      $('.content-wrapper').html(kodeTipeKaryawan);
    }
  function Add_raw()

    {     
      //var htmlOut = ajaxFillGridJSON('admin/AddSales');
      var loadhtml = "<?php echo site_url("lpb/tambah_lpb_sm")?>"; 
      
      $('.content-wrapper').load(loadhtml);
    } 
  function Add_bebas()

    {     
      //var htmlOut = ajaxFillGridJSON('admin/AddSales');
      var loadhtml = "<?php echo site_url("lpb/tambah_lpb_bebas")?>"; 
      
      $('.content-wrapper').load(loadhtml);
    } 
  function dialogFormEditShow(idx)
    {
      //var IDBidang = $(objSource).val();
      //kodeTipeKaryawan = ajaxFillGridJSON('admin/DetailSO', {IDBidang : idx});
      kodeTipeKaryawan = ajaxFillGridJSON('lpb/edit_lpb_sm', {IDBidang : idx}); 
      $('.content-wrapper').html(kodeTipeKaryawan);

    }

  function dialogFormEditShow2(idx)
    {
      //var IDBidang = $(objSource).val();
      //kodeTipeKaryawan = ajaxFillGridJSON('admin/DetailSO', {IDBidang : idx});
      kodeTipeKaryawan = ajaxFillGridJSON('lpb/edit_lpb_bebas', {IDBidang : idx}); 
      $('.content-wrapper').html(kodeTipeKaryawan);

    }

  function detailShow(idx)
    {
      //var IDBidang = $(objSource).val();
      kodeTipeKaryawan = ajaxFillGridJSON('admin/DetailSO', {IDBidang : idx});
      //kodeTipeKaryawan = ajaxFillGridJSON('admin/editso', {IDBidang : idx}); 
      $('.content-wrapper').html(kodeTipeKaryawan);

    }

  function loadGridData(){
       var source =
         {    
             dataType: "json",
             dataFields: [
                  { name: "idx",  type: "string" },
                  { name: "kode",   type: "string" },
                  { name: "po",   type: "string" },
                  { name: "nama",   type: "string" },
                  { name: "date",   type: "string" },
                  { name: "address",  type: "string" },
                  { name: "phone",  type: "string" },
                  { name: "action",   type: "string" }
             ],
            url : "lpb/GetDaftarLpbSm",
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
            pageSize : 14,
            pagerPosition : 'bottom',
            filterMode: 'simple',
            theme: 'fresh',
            width: '100%',
            columns: [
              { text: 'PID', cellsAlign: 'center', align: 'center', dataField: 'idx', width : '4%'},
              { text: 'PO NO', cellsAlign: 'left', align: 'center', dataField: 'po', width : '10%'},
              { text: 'Kode', cellsAlign: 'left', align: 'center', dataField: 'kode', width : '20%'},
              // { text: 'Foto', cellsAlign: 'left', align: 'center', dataField: 'foto', width : '12%'},
              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '15%'},
              { text: 'Date', cellsAlign: 'center', align: 'center', dataField: 'date', width : '8%'},
              { text: 'NO Nota', cellsAlign: 'left', align: 'center', dataField: 'address', width : '15%'},
              { text: 'Phone', cellsAlign: 'left', align: 'center', dataField: 'phone', width : '10%'},
              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '18  %' }
            ]
        }).on('rowDoubleClick', function(event)
        {   
          //var idx = dataAdapter['idx'];           
          dialogFormEditShow(idx);
      }); 
  }

  function printLPB(idx)

    {
      //var htmlOut = ajaxFillGridJSON('transaksi/printbkm', {idx : idx}); 

      var htmlOut = "<?php echo site_url("lpb/printLPBSm")?>/"+idx;
          
          window.open(htmlOut);   
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

 