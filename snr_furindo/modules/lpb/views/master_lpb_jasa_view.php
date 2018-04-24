<div class="content-header">   
	<h1>Daftar LPB Jasa Pengiriman</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<button type="button" class="btn btn-sm btn-primary" onclick="Add_raw()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
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
        if (isDelete) sendRequestForm('lpb/HapusLpbJasa', {ID : idx}, 'box-body');
        kodeTipeKaryawan = ajaxFillGridJSON('lpb/lpb_jasa'); 
      $('.content-wrapper').html(kodeTipeKaryawan);
    }
  function Add_raw()

    {     
      //var htmlOut = ajaxFillGridJSON('admin/AddSales');
      var loadhtml = "<?php echo site_url("lpb/tambah_lpb_jasa")?>"; 
      
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
      kodeTipeKaryawan = ajaxFillGridJSON('lpb/edit_lpb_jasa', {IDBidang : idx}); 
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
                  { name: "nama",   type: "string" },
                  { name: "date",   type: "string" },
                  { name: "note",  type: "string" },
                  { name: "action",   type: "string" }
             ],
            url : "lpb/GetDaftarLpbJasa",
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
              { text: 'PID', cellsAlign: 'center', align: 'center', dataField: 'idx', width : '5%'},
              { text: 'Kode', cellsAlign: 'left', align: 'center', dataField: 'kode', width : '20%'},
              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '25%'},
              { text: 'Date', cellsAlign: 'center', align: 'center', dataField: 'date', width : '8%'},
              { text: 'Keterangan', cellsAlign: 'left', align: 'center', dataField: 'note', width : '25%'},
              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '17%' }
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

 