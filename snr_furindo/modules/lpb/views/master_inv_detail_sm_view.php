<div class="content-header">   
	<h1>Daftar History Inventory Suport Material</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				  <button type="button" class="btn btn-sm btn-primary" id="btnTambahBaru"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
				<!-- <button type="button" class="btn btn-sm btn-primary" id="btnCetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak PDF</button>		 -->
			  </div>
	  		<div class="form-control" style="min-height:610px;">
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
          <h4 class="modal-title" id="FormTambahData">Tambah Data Material</h4>
        </div>
        <form id="formBaru" class="form-horizontal" onsubmit="simpanreg(); return false;">
        <div class="modal-body">
          <div class="pesanBaru"></div>
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Material/Product Name</label>
          <div class="col-sm-8">
            <div class="input-group">
              <input id="idmaterial"  name="idmaterial" type="hidden" class="form-control" required/>
                <input id="namamaterial" readonly type="text" class="form-control" required/>
                <span class="input-group-btn">
                  <button type="button" class="btn btn-info" onclick="btnmaterial()"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
                </span>
              </div> 
          </div>
        </div>
        <div class="form-group">
          <label for="jabatan" class="col-sm-4 control-label">Warehouse </label>
          <div class="col-sm-8">
              <select name="whs" class="form-control">
                <option value=''>:: Pilih Warehouse::</option>
                <?php  
                  $CI = get_instance();
                  $selectQuery =  $CI->db->query("SELECT * from mst_warehouse ");
                  $arrTipeKaryawan = $selectQuery->result_array();
                  foreach ($arrTipeKaryawan as $row) {
                    echo "<option id='unit-".$row['warehouse_id']."' value='".$row['warehouse_id']."'>".$row['warehouse_name']."</option>";
                  }
                ?>
              </select>
          </div>
        </div>
        <div class="form-group">
          <label for="jabatan" class="col-sm-4 control-label">Categories </label>
          <div class="col-sm-8">
              <select name="categories" class="form-control">
                <option value=''>:: Pilih INVENTORY CATEGORIES::</option>
                <option value='stock'>Stock</option>
                <option value='buffer'>Buffer</option>
                <option value='wip'>Wip</option>
                <option value='sample'>Sample</option>
                <option value='pinjam'>Pinjam</option>
              </select>
          </div>
        </div>
        <div class="form-group">
          <label for="jabatan" class="col-sm-4 control-label">Item Categories </label>
          <div class="col-sm-8">
              <select name="item" class="form-control">
                <option value=''>:: Pilih ITEM INVENTORY CATEGORIES::</option>
                <option value='material'>Material</option>
                <option value='product'>Product</option>
              </select>
          </div>
        </div>
        <div class="form-group">
          <label for="jabatan" class="col-sm-4 control-label">Jenis </label>
          <div class="col-sm-8">
              <select name="jenis" class="form-control">
                <option value='in'>Masuk</option>
                <option value='out'>Keluar</option>
              </select>
          </div>
        </div>        
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Nominal</label>
          <div class="col-sm-8">
              <input type="number" placeholder="Price USD" name="price" id="" class="form-control"/>  
          </div>
        </div>
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Qty</label>
          <div class="col-sm-8">
              <input type="number" placeholder="Qty" name="qty" id="" class="form-control"/>   
          </div>
        </div>       
        </div>
        <div class="modal-footer">
          <button type="submit" id="tbh" class="btn btn-primary">Tambah</button>
          <button type="button" class="btn btn-warning" id="btnBatalTambah">Batal</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

 <div class="modal fade" id="myModalLiquid">
  <div class="modal-dialog">
    <div class="modal-content" style="width:750px">
      <div class="modal-header">
        <button type="button" class="close Liquid" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Product</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="caridataliquid" placeholder="Cari data product" value="" class="form-control" autofocus>        
        <table id="example7" class="table table-bordered table-striped">
            <thead style="">
                <tr>            
                    <th class="hidden" tabindex='0' style="text-align:center; width:7%"> No</th>
                    <th class="sorting" tabindex='1' style="text-align:center; width:15%"> Kode </th>
                    <th class="sorting" tabindex='2' style="text-align:center; width:53%"> Nama </th>
                    <th class="sorting" tabindex='3' style="text-align:center; width:10%"> Stock </th>
                    <th class="sorting" tabindex='4' style="text-align:center; width:13%"> Terbeli </th>
                    <th class="sorting" tabindex='5' style="text-align:center; width:14%"> Kebutuhan </th> 
                    <th class="hidden" tabindex='6' style="text-align:center; width:10%"> Qty </th>
                    <th class="hidden" tabindex='7' style="text-align:center; width:10%"> Qty </th> 
                    <th class="hidden" tabindex='8' style="text-align:center; width:10%"> Qty </th> 
                    <th class="sorting" tabindex='9' style="text-align:center; width:10%"> Action </th>
                </tr>
            </thead>
              <tbody id="tableGridDataLiquid">                   
            </tbody>
        </table>    
      </div>      
    </div>
  </div>
</div>
	
<script>
	$(document).ready(function () {
      loadGridDataLiquid();  
    	  $('#btnTambahBaru').click(function(e)
          {
        e.preventDefault(); 
        //resetForm();
          $('#alertMessage').remove();
          $('#dialogFormBaru').attr('class', 'modal show');               
          });

        $('#btnBatalTambah').click(function(e)
          {
        e.preventDefault();         
          $('#dialogFormBaru').attr('class', 'modal hide');               
          });
        $('.Liquid').click(function(e)
        {
          //$('#example7').dataTable().fnDestroy();
          $('#myModalLiquid').attr('class', 'modal hide'); 
          $('#dialogFormBaru').attr('class', 'modal show');
        });
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
    function btnmaterial()

	  {     
	    $('#myModalLiquid').attr('class', 'modal show');  
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

	function loadGridData(){
	     var source =
         {		
             dataType: "json",
             dataFields: [
                  { name: "idx",      type: "string" },
                  { name: "kode",     type: "string" },
                  { name: "nama",     type: "string" },
                  { name: "date",     type: "string" },
                  { name: "qty",      type: "string" },
                  { name: "ttl_qty",  type: "string" },
                  { name: "awal",     type: "string" },
                  { name: "status",   type: "string" },
                  { name: "action",   type: "string" }
             ],
            url : "lpb/GetDaftarInvDetSm",
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
              { text: 'Kode', cellsAlign: 'left', align: 'center', dataField: 'kode', width : '9%'},
              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '27%'},
              { text: 'Date', cellsAlign: 'center', align: 'center', dataField: 'date', width : '8%'},
              { text: 'Stock Awal', cellsAlign: 'center', align: 'center', dataField: 'awal', width : '9%'},
              { text: 'Qty', cellsAlign: 'center', align: 'center', dataField: 'qty', width : '8%'},
              { text: 'Total Stock', cellsAlign: 'center', align: 'center', dataField: 'ttl_qty', width : '9%'},
              { text: 'Status', cellsAlign: 'center', align: 'center', dataField: 'status', width : '7%'},
              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '18%' }
            ]
        }).on('rowDoubleClick', function(event)
        {	  
        	//var idx = dataAdapter['idx'];         	
        	dialogFormEditShow(idx);
	    });	
	}  


  function loadGridDataLiquid(){ 
    var produk_id = $('#caridataliquid').val();
    var idso = $('#id_sales').val();     
        ajaxDataGrid('<?php echo base_url()?>suport/addTableSo_Liquid', {idx : produk_id, ids : idso}, 'tableGridDataLiquid');
        $('#example7').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": false,
          "bAutoWidth": true,
          "bDestroy": true
        });    
        //document.getElementById("example7").focus();   
    }

  function addProduct(objReference, idx)
  {     
    var Id    = $(objReference).parent().parent().find('td:eq(0)').html();
    var kode  = $(objReference).parent().parent().find('td:eq(1)').html();
    var name  = $(objReference).parent().parent().find('td:eq(2)').html();
    var stock = $(objReference).parent().parent().find('td:eq(3)').html();
    var beli  = $(objReference).parent().parent().find('td:eq(4)').html();
    var qty   = $(objReference).parent().parent().find('td:eq(5)').html();
    var price   = $(objReference).parent().parent().find('td:eq(6)').html();
    var IDproduct   = $(objReference).parent().parent().find('td:eq(7)').html();    
    var count   = $(objReference).parent().parent().find('td:eq(8)').html();
    $('#myModalLiquid').attr('class', 'modal hide'); 
    $('#dialogFormBaru').attr('class', 'modal show');
    $("#idmaterial").val(Id);
    $('#namamaterial').val(name);
    
  }

  function simpanreg()
  {
    var target = "<?php echo site_url("lpb/saveinventory")?>";
      data = $("#formBaru").serialize();
    $.post(target, data, function(e){
      //$(".content-wrapper").html(e);
      //console.log(e);
      //return false;
      //tinymce.triggerSave();
      
      //alert("Kode barang sudah digunakan , silahkan ganti yang lain !!!");
      
        var htmlOut = ajaxFillGridJSON('lpb/inventory_detail_sm'); 
          alert("Data berhasil disimpan.");
          $('.content-wrapper').html(htmlOut);
        // loadhtml = "<?php echo site_url("admin/Bom")?>";
        // alert("Data berhasil disimpan.");
        // $(".content-wrapper").load(loadhtml);    
  
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

 