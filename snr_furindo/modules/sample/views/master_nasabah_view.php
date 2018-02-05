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
          <label for="kodeKaryawan" class="col-sm-4 control-label">Kode</label>
          <div class="col-sm-8">
              <input type="text" oninput="lookUpUsername(this.value)" placeholder="Kode Nasabah" name="kode" id="kode" class="form-control" required/> 
              <span id="error3" style="margin-top:4px; color: Red; display: none">* kode sudah ada</span>
              <span id="error2"  style="margin-top:4px; color: green; display: none">* kode tersedia</span> 
          </div>
        </div>
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Nama</label>
          <div class="col-sm-8">
              <input type="text" placeholder="Simpanan Pokok" name="nama" id="" class="form-control" required/>  
          </div>
        </div>        
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Jenis Kelamin</label>
          <div class="col-sm-8">
              <select name="jk" class="form-control">
                <option value="">::PILIH JK::</option>
                <option value="L">LAKI-LAKI</option>
                <option value="P">PEREMPUAN</option>
              </select>   
          </div>
        </div>
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Telp</label>
          <div class="col-sm-8">
              <input type="text" placeholder="Simpanan Pokok" name="telp" id="" class="form-control" required/>  
          </div>
        </div> 
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Alamat</label>
          <div class="col-sm-8">
              <textarea name="alamat" class="form-control"></textarea>
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
          <div class="pesanBaru"></div>           
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Kode</label>
          <div class="col-sm-8">
              <input type="text" oninput="lookUpUsername(this.value)" placeholder="Material Code" name="kode" id="kode1" class="form-control" required/> 
              <span id="error3" style="margin-top:4px; color: Red; display: none">* kode sudah ada</span>
              <span id="error2"  style="margin-top:4px; color: green; display: none">* kode tersedia</span> 
          </div>
        </div>
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Nama</label>
          <div class="col-sm-8">
              <input type="text" placeholder="Simpanan Pokok" name="nama" id="nama" class="form-control" required/>  
          </div>
        </div>        
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Jenis Kelamin</label>
          <div class="col-sm-8">
              <select name="jk" class="form-control">
                <option value="">::PILIH JK::</option>
                <option id="jk-L" value="L">LAKI-LAKI</option>
                <option id="jk-P" value="P">PEREMPUAN</option>
              </select>   
          </div>
        </div>
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Telp</label>
          <div class="col-sm-8">
              <input type="text" placeholder="Simpanan Pokok" name="telp" id="telp" class="form-control" required/>  
          </div>
        </div> 
        <div class="form-group">
          <label for="kodeKaryawan" class="col-sm-4 control-label">Alamat</label>
          <div class="col-sm-8">
              <textarea name="alamat" id="alamat" class="form-control"></textarea>
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
                  { name: "kode", 	type: "string" },
                  { name: "jk", 	type: "string" },
                  { name: "alamat", 	type: "string" },
                  { name: "telp",   type: "string" },
                  { name: "id_kelompok",  type: "string" },
                  { name: "tgl_masuk", 	type: "string" },
                  { name: "action",  type: "string" }
             ],
            url : "sample/GetDaftarNasabah",
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
              { text: 'Kode', cellsAlign: 'left', align: 'center', dataField: 'kode', width : '10%'},
              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '25%'},
              { text: 'JK', cellsAlign: 'center', align: 'center', dataField: 'jk', width : '10%'},
              { text: 'Alamat', cellsAlign: 'center', align: 'center', dataField: 'alamat', width : '25%'},
              { text: 'Telp', cellsAlign: 'left', align: 'center', dataField: 'telp', width : '10%'},
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

    var idx     = data.idx,     
        kode    = data.kode,
        nama    = data.nama,
        jk      = data.jk,
        alamat  = data.alamat,
        telp    = data.telp;
        
        
      //alert(categories);
      $('#alertMessage').remove();
      $('#idx').val(idx);
      $('#kode1').val(kode);
      $('#nama').val(nama);
      $('#jk-'+jk).attr('selected','selected');
      $('#alamat').val(alamat);
      $('#telp').val(telp);
      

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
     
  function lookUpUsername(name)
  {
    var idx = 0;
      $.post( 
          '<?php echo base_url();?>sample/ajax_lookUpNasabah',
           { code: name },
           function(response) {  
              if (response == 1) {
                  //alert('username ok');
                    document.getElementById("error2").style.display = "inline";
                    document.getElementById("error3").style.display = "none";
                  $('#tbh').prop('disabled', false);
              } else {
                  document.getElementById("error2").style.display = "none";
                  document.getElementById("error3").style.display = "inline";
                  $('#tbh').prop('disabled', true);
              }
           }  
      );
  }   

  function simpanreg()
  {
    var target = "<?php echo site_url("sample/savenasabah")?>";
      data = $("#formBaru").serialize();
    $.post(target, data, function(e){
      $(".content-wrapper").html(e);
      //console.log(e);
      return false;      
        var htmlOut = ajaxFillGridJSON('sample/nasabah'); 
        alert("Data berhasil disimpan.");
        $('.content-wrapper').html(htmlOut);
    });
  } 

  function updatereg()
  {
    var target = "<?php echo site_url("sample/updatenasabah")?>";
      data = $("#formEdit").serialize();
    $.post(target, data, function(e){
      //$(".content-wrapper").html(e);
      //console.log(e);
      //return false;      
        var htmlOut = ajaxFillGridJSON('sample/nasabah'); 
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

 