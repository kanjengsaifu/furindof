<div class="content-header">   
	<h1>History Inventory Suport Material</h1>
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
          <h4 class="modal-title" id="FormTambahData">Tambah Data Inventory</h4>
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
        <div class="form-group">
            <label for="Nomor" class="col-sm-4 control-label">Note</label>
              <div class="col-sm-8">
                <textarea class="form-control" name="note"></textarea>
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

<div class="modal hide" id="dialogFormUbah" tabindex="1" role="dialog" aria-labelledby="FormUbahData" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="FormTambahData">Ubah Data Inventory</h4>
        </div>
        <form id="formUbah" class="form-horizontal" onsubmit="updatereg(); return false;">
        <input id="idv" readonly name="idv" type="hidden" class="form-control" required/>
        <div class="modal-body">
          <div class="pesanBaru"></div>
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Material/Product Name</label>
          <div class="col-sm-8">
            <div class="input-group">
              <input id="idm"  name="idmaterial" type="hidden" class="form-control" required/>
                <input id="namamtl" readonly type="text" class="form-control" required/>
                <span class="input-group-btn">
                  <button type="button" class="btn btn-info" onclick="btnmaterial()"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
                </span>
              </div> 
          </div>
        </div>
        <div class="form-group">
          <label for="jabatan" class="col-sm-4 control-label">Warehouse </label>
          <div class="col-sm-8">
              <select id="whs" name="whs" class="form-control">
                <option value=''>:: Pilih Warehouse::</option>
                <?php  
                  $CI = get_instance();
                  $selectQuery =  $CI->db->query("SELECT * from mst_warehouse ");
                  $arrTipeKaryawan = $selectQuery->result_array();
                  foreach ($arrTipeKaryawan as $row) {
                    echo "<option id='whs-".$row['warehouse_id']."' value='".$row['warehouse_id']."'>".$row['warehouse_name']."</option>";
                  }
                ?>
              </select>
          </div>
        </div>
        <div class="form-group">
          <label for="jabatan" class="col-sm-4 control-label">Categories </label>
          <div class="col-sm-8">
              <select id="cat" name="categories" class="form-control">
                <option value=''>:: Pilih INVENTORY CATEGORIES::</option>
                <option id="cat-stock" value='stock'>Stock</option>
                <option id="cat-buffer" value='buffer'>Buffer</option>
                <option id="cat-wip" value='wip'>Wip</option>
                <option id="cat-sample" value='sample'>Sample</option>
                <option id="cat-pinjam" value='pinjam'>Pinjam</option>
              </select>
          </div>
        </div>
        <div class="form-group">
          <label for="jabatan" class="col-sm-4 control-label">Item Categories </label>
          <div class="col-sm-8">
              <select id="item" name="item" class="form-control">
                <option value=''>:: Pilih ITEM INVENTORY CATEGORIES::</option>
                <option id="item-material" value='material'>Material</option>
                <option id="item-product" value='product'>Product</option>
              </select>
          </div>
        </div>
        <div class="form-group">
          <label for="jabatan" class="col-sm-4 control-label">Jenis </label>
          <div class="col-sm-8">
              <select id="jenis" name="jenis" class="form-control">
                <option id="jenis-in" value='in'>Masuk</option>
                <option id="jenis-out" value='out'>Keluar</option>
              </select>
          </div>
        </div>        
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Nominal</label>
          <div class="col-sm-8">
              <input type="number" placeholder="Price USD" name="price" id="price" class="form-control"/>  
          </div>
        </div>
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Qty</label>
          <div class="col-sm-8">
              <input type="number" placeholder="Qty" name="qty" id="qty" class="form-control"/>   
          </div>
        </div>
        <div class="form-group">
            <label for="Nomor" class="col-sm-4 control-label">Note</label>
              <div class="col-sm-8">
                <textarea class="form-control" id="note" name="note"></textarea>
              </div>
            </div>       
        </div>
        <div class="modal-footer">
          <button type="submit" id="tbh" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-warning" id="btnBatalUbah">Batal</button>
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
                    <th class="hidden" tabindex='0' style="text-align:center; width:10%"> No</th>
                    <th class="sorting" tabindex='1' style="text-align:center; width:15%"> Kode </th>
                    <th class="sorting" tabindex='2' style="text-align:center; width:55%"> Nama </th>
                    <th class="sorting" tabindex='3' style="text-align:center; width:10%"> Stock </th>
                    <th class="hidden" tabindex='4' style="text-align:center; width:10%"> Qty </th>
                    <th class="hidden" tabindex='5' style="text-align:center; width:10%"> Qty </th> 
                    <th class="sorting" tabindex='6' style="text-align:center; width:10%"> Action </th>
                </tr>
            </thead>
            <tbody id="tableGridDataLiquid">                   
            </tbody>
        </table>    
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
<script>
	$(document).ready(function () {
      //loadGridDataLiquid();  
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

        $('#btnBatalUbah').click(function(e)
          {
        e.preventDefault();         
          $('#dialogFormUbah').attr('class', 'modal hide');               
          });
        $('.Liquid').click(function(e)
        {
          //$('#example7').dataTable().fnDestroy();
          $('#myModalLiquid').attr('class', 'modal hide'); 
          //$('#dialogFormBaru').attr('class', 'modal show');
        });
        loadGridData();

    });
    
	
	function deleteConfirmShow(ids)
	{ 

	 	var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');
		var dataKaryawan = selection[0];
		
		var idx	 = dataKaryawan.idx;
		var nama = dataKaryawan.kode;
		
	   	isDelete = confirm('Yakin Inventory '+ nama +' akan dihapus ?');
	  	if (isDelete) sendRequestForm('gudang/HapusInv', {ID : idx}, 'box-body');
	  	kodeTipeKaryawan = ajaxFillGridJSON('gudang/Inventory_gudang_sm'); 
		$('.content-wrapper').html(kodeTipeKaryawan);
	}

  function btnmaterial()

  {     
    $('#myModalLiquid').attr('class', 'modal show');  
  } 

	function dialogFormEditShow()
  { 
    var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');

    var data = selection[0];

    var idx       = data.idx,     
        kode      = data.kode,
        nama      = data.nama,
        qty       = data.qty,
        status    = data.status,
        wh        = data.wh,
        categories= data.categories,
        idm       = data.idm,
        item      = data.item,
        note      = data.note,
        nominal   = data.nominal
      
      $('#idv').val(idx);      
      $('#idm').val(idm);
      $('#namamtl').val(nama);
      $('#price').val(nominal);
      $('#qty').val(qty);     
      $('#whs-'+wh).attr('selected','selected');     
      $('#cat-'+categories).attr('selected','selected');
      $('#item-'+item).attr('selected','selected');
      $('#jenis-'+status).attr('selected','selected');
      $('#note').val(note);

      $('#dialogFormUbah').attr('class', 'modal show');

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
                  { name: "date",   type: "date" },
                  { name: "qty",  type: "string" },
                  { name: "ttl_qty",  type: "string" },
                  { name: "awal",  type: "string" },
                  { name: "status",   type: "string" },
                  { name: "wh",   type: "string" },
                  { name: "categories",   type: "string" },
                  { name: "idm",   type: "string" },
                  { name: "item",   type: "string" },
                  { name: "nominal",   type: "string" },
                  { name: "note",   type: "string" },
                  { name: "no",   type: "string" },
                  { name: "action",   type: "string" }
             ],
            url : "lpb/GetDaftarInvGudang",
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
            showfilterrow: true,
            filterable: true,
            columnsResize: true,
            height: '600px',
            pageable : true,
            pageSize : 10000,
            groupable: true,
            //groupsrenderer: groupsrenderer,
            //groups: ['nama'],
            //pagerPosition : 'bottom',
            filterMode: 'excel',
            //selectionmode: 'multiplecellsextended',
            theme: 'fresh',
            width: '100%',
            columns: [
              { text: 'PID', cellsAlign: 'center', align: 'center', dataField: 'no', width : '5%'},
              { text: 'Kode', cellsAlign: 'left', filtertype: 'checkedlist', align: 'center', dataField: 'kode', width : '9%'},
              { text: 'Nama', cellsAlign: 'left', filtertype: 'checkedlist', align: 'center', dataField: 'nama', width : '37%'},
              { text: 'Date', cellsAlign: 'center', datafield: 'date', align: 'center', filtertype: 'range', cellsformat: 'd',  width : '8%'},
              { text: 'Stock Awal', cellsAlign: 'center', align: 'center', dataField: 'awal', width : '9%'},
              { text: 'Qty', cellsAlign: 'center', align: 'center', dataField: 'qty', width : '8%'},
              { text: 'Total Stock', cellsAlign: 'center', align: 'center', dataField: 'ttl_qty', width : '9%'},
              { text: 'Status', cellsAlign: 'center', filtertype: 'checkedlist', align: 'center', dataField: 'status', width : '7%'},
              { text: '', cellsAlign: 'center', align: 'center', filtertype: 'checkedlist', dataField: 'action', width: '8%' }
            ]
        }).on('rowDoubleClick', function(event)
        {	  
        	//var idx = dataAdapter['idx'];         	
        	dialogFormEditShow();
	    });	
	}  


  function loadGridDataLiquid(){ 
    var produk_id = $('#caridataliquid').val();
    var idso = $('#id_sales').val();     
        ajaxDataGrid('<?php echo base_url()?>suport/addTableSo_material', {idx : produk_id, ids : idso}, 'tableGridDataLiquid');
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
    var stock   = $(objReference).parent().parent().find('td:eq(3)').html();
    var beli  = $(objReference).parent().parent().find('td:eq(4)').html();
    var qty   = $(objReference).parent().parent().find('td:eq(5)').html();
    var price   = $(objReference).parent().parent().find('td:eq(6)').html();
    var IDproduct   = $(objReference).parent().parent().find('td:eq(7)').html();    
    var count   = $(objReference).parent().parent().find('td:eq(8)').html();
    $('#myModalLiquid').attr('class', 'modal hide'); 
    //$('#dialogFormBaru').attr('class', 'modal show');
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
      
        var htmlOut = ajaxFillGridJSON('gudang/Inventory_gudang_sm'); 
          alert("Data berhasil disimpan.");
          $('.content-wrapper').html(htmlOut);
        // loadhtml = "<?php echo site_url("admin/Bom")?>";
        // alert("Data berhasil disimpan.");
        // $(".content-wrapper").load(loadhtml);    
  
    });
  }

  function updatereg()
  {
    var target = "<?php echo site_url("lpb/updateinventory")?>";
      data = $("#formUbah").serialize();
    $.post(target, data, function(e){
      //$(".content-wrapper").html(e);
      //console.log(e);
      //return false;
      //tinymce.triggerSave();
      
      //alert("Kode barang sudah digunakan , silahkan ganti yang lain !!!");
      
        var htmlOut = ajaxFillGridJSON('gudang/Inventory_gudang_sm'); 
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

 