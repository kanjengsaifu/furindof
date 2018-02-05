<div class="content-header">   
	<h1>Daftar Packing Product</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<button type="button" class="btn btn-sm btn-primary" id="btnTambahBaru"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
				<!-- <button type="button" class="btn btn-sm btn-primary" id="btnCetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak PDF</button>	 -->	
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
          <label for="kodeKaryawan" class="col-sm-4 control-label">Nama Kelompok</label>
          <div class="col-sm-8">
              <input type="text" oninput="lookUpUsername(this.value)" placeholder="Material Code" name="nama" id="nama" class="form-control" required/> 
              <span id="error3" style="margin-top:4px; color: Red; display: none">* kode sudah ada</span>
              <span id="error2"  style="margin-top:4px; color: green; display: none">* kode tersedia</span> 
          </div>
        </div>
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Simpanan Pokok</label>
          <div class="col-sm-8">
              <input type="text" placeholder="Simpanan Pokok" name="pokok" id="" class="form-control" required/>  
          </div>
        </div>        
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Simpanan Wajib</label>
          <div class="col-sm-8">
              <input type="number" placeholder="Simpanan Wajib" name="wajib" id="" class="form-control"/>   
          </div>
        </div>
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Bunga Pinjaman</label>
          <div class="col-sm-8">
              <input type="number" placeholder="Bunga Pinjaman" name="pinjam" id="" class="form-control"/>  
          </div>
        </div>
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Bunga Simpanan</label>
          <div class="col-sm-8">
              <input type="number" placeholder="Bunga Pinjaman" name="simpan" id="" class="form-control"/>  
          </div>
        </div>
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Denda Pinjaman</label>
          <div class="col-sm-8">
              <input type="number" placeholder="Denda Pinjaman" name="denda" id="" class="form-control"/>   
          </div>
        </div>  
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Keterangan</label>
          <div class="col-sm-8">
              <textarea name="keterangan" class="form-control"></textarea>
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

<div class="modal hide" id="dialogFormEdit" tabindex="1" role="dialog" aria-labelledby="FormTambahData" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="FormTambahData">Edit Data Material</h4>
        </div>
        <form id="formEdit" class="form-horizontal" onsubmit="updatereg(); return false;">
        <input type="hidden" name="idx" id="idx" class="form-control"/> 
        <div class="modal-body">
          <div class="pesanEdit"></div>           
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Nama Kelompok</label>
          <div class="col-sm-8">
              <input type="text" oninput="lookUpUsername(this.value)" placeholder="Material Code" name="nama" id="nama1" class="form-control" required/> 
              <span id="error3" style="margin-top:4px; color: Red; display: none">* kode sudah ada</span>
              <span id="error2"  style="margin-top:4px; color: green; display: none">* kode tersedia</span> 
          </div>
        </div>
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Simpanan Pokok</label>
          <div class="col-sm-8">
              <input type="text" placeholder="Simpanan Pokok" name="pokok" id="pokok" class="form-control" required/>  
          </div>
        </div>        
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Simpanan Wajib</label>
          <div class="col-sm-8">
              <input type="number" placeholder="Simpanan Wajib" name="wajib" id="wajib" class="form-control"/>   
          </div>
        </div>
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Bunga Pinjaman</label>
          <div class="col-sm-8">
              <input type="number" placeholder="Bunga Pinjaman" name="pinjam" id="pinjam" class="form-control"/>  
          </div>
        </div>
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Bunga Simpanan</label>
          <div class="col-sm-8">
              <input type="number" placeholder="Bunga Pinjaman" name="simpan" id="bunga" class="form-control"/>  
          </div>
        </div>
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Denda Pinjaman</label>
          <div class="col-sm-8">
              <input type="number" placeholder="Denda Pinjaman" name="denda" id="denda" class="form-control"/>   
          </div>
        </div>  
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Keterangan</label>
          <div class="col-sm-8">
              <textarea id="ket" name="keterangan" class="form-control"></textarea>
          </div>
        </div>                
        
        <div class="modal-footer">
          <button type="submit" id="tbh1" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-warning" id="btnBatalEdit">Batal</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

 
	
<script>
	$(document).ready(function () {                    
    	    
        loadGridData();

        $('#btnTambahBaru').click(function(e)
          {
            e.preventDefault(); 
            //resetForm();
            $('#alertMessage').remove();
            $('#dialogFormBaru').attr('class', 'modal show');               
        });

        $('#btnBatalTambah').click( function(e){
            e.preventDefault(); 
            $('#dialogFormBaru').attr('class', 'modal hide');
        }); 

        $('#btnBatalEdit').click( function(e){
            e.preventDefault(); 
            $('#dialogFormEdit').attr('class', 'modal hide');
        });   

    });

	function loadGridData(){
	     var source =
         {		
             dataType: "json",
             dataFields: [
                  { name: "idx", 	type: "string" },
                  { name: "nama", 	type: "string" },
                  { name: "pokok", 	type: "string" },
                  { name: "wajib", 	type: "string" },
                  { name: "bunga", 	type: "string" },
                  { name: "bunga2",  type: "string" },
                  { name: "denda", 	type: "string" },
                  { name: "ket", 	type: "string" },
                  { name: "action",  type: "string" }
             ],
            url : "sample/GetDaftarAnggota",
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
              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '20%'},
              // { text: 'Foto', cellsAlign: 'left', align: 'center', dataField: 'foto', width : '12%'},
              { text: 'exp', cellsAlign: 'left', align: 'center', dataField: 'pokok', width : '10%'},
              { text: 'wjk', cellsAlign: 'center', align: 'center', dataField: 'wajib', width : '10%'},
              { text: 'opj', cellsAlign: 'center', align: 'center', dataField: 'bunga', width : '10%'},
              { text: 'whg', cellsAlign: 'center', align: 'center', dataField: 'denda', width : '10%'},
              { text: 'Deskripsi', cellsAlign: 'left', align: 'center', dataField: 'ket', width : '20%'},
              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '15  %' }
            ]
        }).on('rowDoubleClick', function(event)
        {	  
        	//var idx = dataAdapter['idx'];         	
        	dialogFormEditShow();
	    });	
	}  

  function dialogFormEditShow()
  { 
    var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');

    var data = selection[0];

    var idx       = data.idx,     
        nama    = data.nama,
        pokok    = data.pokok,
        wajib     = data.wajib,
        bunga     = data.bunga,
        bunga2     = data.bunga2,
        denda     = data.denda,
        ket     = data.ket;
      //alert(categories);
      $('#alertMessage').remove();
      $('#idx').val(idx);
      $('#nama1').val(nama);
      $('#pokok').val(pokok);
      $('#wajib').val(wajib);
      $('#pinjam').val(bunga);
      $('#bunga').val(bunga2);
      $('#denda').val(denda);
      $('#ket').val(ket);      
      

      $('#dialogFormEdit').attr('class', 'modal show');

  }

  function deleteConfirmShow()
  { 

    var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');
    var dataKaryawan = selection[0];
    
    var idx  = dataKaryawan.idx;
    var nama = dataKaryawan.nama;
    
      isDelete = confirm('Yakin Kelompok '+ nama +' akan dihapus ?');
      if (isDelete) sendRequestForm('sample/HapusKelompok', {ID : idx}, 'box-body');
      var htmlOut = ajaxFillGridJSON('sample/kelompok');       
      $('.content-wrapper').html(htmlOut);
  }
        

  function simpanreg()
  {
    var target = "<?php echo site_url("sample/savekelompok")?>";
      data = $("#formBaru").serialize();
    $.post(target, data, function(e){
      //$(".content-wrapper").html(e);
      //console.log(e);
      //return false;      
        var htmlOut = ajaxFillGridJSON('sample/kelompok'); 
        alert("Data berhasil disimpan.");
        $('.content-wrapper').html(htmlOut);
    });
  } 

  function updatereg()
  {
    var target = "<?php echo site_url("sample/updatekelompok")?>";
      data = $("#formEdit").serialize();
    $.post(target, data, function(e){
      //$(".content-wrapper").html(e);
      //console.log(e);
      //return false;      
        var htmlOut = ajaxFillGridJSON('sample/kelompok'); 
        alert("Data berhasil disimpan.");
        $('.content-wrapper').html(htmlOut);
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

 