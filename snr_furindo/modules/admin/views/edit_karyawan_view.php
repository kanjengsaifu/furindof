<div class="content-header">   
	<h1>Edit Data Karyawan</h1>
</div>

<div class="content">
	 <div class="box box-primary">
    <!-- <div class="box-header with-border">
      <h3 class="box-title">
      Tambah Pemilik Hewan
      </h3>
    </div> -->
    <div class="box-body" style="min-height:500px;">
   <!---konten-->
   <div class="col-md-12">
      <form id="formBaru" onsubmit="simpanreg(); return false;">
        <input type="hidden" value="<?php echo $krs->id_karyawan ?>" name="karyawan">        
        <div class="col-md-6 form-horizontal">
          <div class="row">             
            <div class="col-sm-12">    
              <div class="form-group">
                <label style="text-align:left" class="control-label col-sm-4" for="kodeKaryawan">Kode </label>
                <div class="col-sm-8">
                <input type="text" name="kodeKaryawan" id="kodeKaryawan" value="<?php echo $krs->kode_karyawan; ?>" class="form-control" required/>           
                </div> <!-- <div class="col-sm-9">  -->
              </div> <!-- <div class="form-group"> -->
            </div>  <!-- <div class="col-sm-6"> -->
          </div>
          <div class="row">             
            <div class="col-sm-12">    
              <div class="form-group">
                <label style="text-align:left" class="control-label col-sm-4" for="namapemilik">Nama Lengkap </label>
                <div class="col-sm-8">          
                <input size="40" type="text" display="none" value="<?php echo $krs->nama_karyawan; ?>" class="form-control" id="nama_pemilik" placeholder="Nama Lengkap Anda" name="nama" required>                
                </div> <!-- <div class="col-sm-9">  -->
              </div> <!-- <div class="form-group"> -->
            </div>  <!-- <div class="col-sm-6"> -->
          </div>
          <div class="row">
            <div class="col-sm-12">    
              <div class="form-group">
                  <label style="text-align:left" for="jabatan" class="col-sm-4 control-label">Jabatan </label>
                  <div class="col-sm-8">
                      <select name="jabatan" class="form-control">
                        <option value=''>:: Pilih Jabatan ::</option>
                        <?php  
                          $CI = get_instance();
                          $selectQuery =  $CI->db->query("select id_jabatan as IDJabatan, nama_jabatan as NamaJabatan   
                                          from ref_jabatan ");
                          $arrTipeKaryawan = $selectQuery->result_array();
                          
                          foreach ($arrTipeKaryawan as $row) {
                            if($krs->id_jabatan == $row['IDJabatan'])
                              { 
                                $cek = 'selected=selected';
                              }else {
                                $cek = '';
                              }
                            echo "<option ".$cek." value='".$row['IDJabatan']."'>".$row['NamaJabatan']."</option>";
                          }
                        ?>
                      </select>
                  </div>
                </div>
            </div>  <!-- <div class="col-sm-6"> -->
          </div>
          <div class="row">
            <div class="col-sm-12">    
              <div class="form-group">
                <label style="text-align:left" class="control-label col-sm-4" for="email">Email</label>
                <div class="col-sm-8">
                <input type="email" value="<?php echo $krs->email; ?>" oninput="lookUpUsername(this.value)" class="form-control" id="email" placeholder="user@example.com" name="email" required>
                <span id="error3" style="margin-top:4px; color: Red; display: none">* Email sudah ada</span>
                <span id="error2"  style="margin-top:4px; color: green; display: none">* Email tersedia</span>
                </div> <!-- <div class="col-sm-9">  -->
              </div> <!-- <div class="form-group"> -->
            </div>  <!-- <div class="col-sm-6"> -->
          </div>
          <div class="row">
            <div class="col-sm-12">    
              <div class="form-group">
                <label style="text-align:left" class="control-label col-sm-4" for="password">Password</label>
                <div class="col-sm-8">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                <span style="margin-top:4px; color: green;">* Kosongkan Password jika tidak diganti</span>
                </div> <!-- <div class="col-sm-9">  -->
              </div> <!-- <div class="form-group"> -->
            </div>  <!-- <div class="col-sm-6"> -->
          </div>
          
          <div class="row">
            <div class="col-sm-12">    
              <div class="form-group">
                <label style="text-align:left" class="control-label col-sm-4" for="email">Telepon</label>
                <div class="col-sm-8">
                <input type="text" value="<?php echo $krs->telp; ?>" onkeypress="return IsNumeric(event);" class="form-control" ondrop="return false;" onpaste="return false;" id="hp" placeholder="Nomer Telepon" name="hp">
                <span id="error" style="color: Red; display: none">* Hanya boleh angka (0 - 9)</span>
                </div> <!-- <div class="col-sm-9">  -->
              </div> <!-- <div class="form-group"> -->
            </div>  <!-- <div class="col-sm-6"> -->
          </div>
          <div class="row">
            <div class="col-sm-12">    
              <div class="form-group">
                  <label style="text-align:left" for="jabatan" class="col-sm-4 control-label">Group Pengguna </label>
                  <div class="col-sm-8">
                      <select name="group" id="group" class="form-control">
                        <option value=''>:: Pilih Group ::</option>
                        <?php  
                          $CI = get_instance();
                          $selectQuery =  $CI->db->query("select id_group as IDGroup, nama_group as NamaGroup     
                                          from sys_group where id_group not in (select id_group from sys_group where id_group = 1) ");
                          $arrTipeKaryawan = $selectQuery->result_array();
                          foreach ($arrTipeKaryawan as $row) {
                            if($krs->id_group == $row['IDGroup'])
                              { 
                                $cek1 = 'selected=selected';
                              }else {
                                $cek1 = '';
                              }
                            echo "<option ".$cek1." value='".$row['IDGroup']."'>".$row['NamaGroup']."</option>";
                          }
                        ?>
                      </select>
                  </div>
                </div>
            </div>  <!-- <div class="col-sm-6"> -->
          </div>
          <div class="row">
            <div class="col-sm-12">    
              <div class="form-group">
                <label style="text-align:left" class="control-label col-sm-4" for="password">Waktu Akses</label>
                <div class="col-sm-8">
                  <input  type="number" class="form-control" name="user_entry" value="<?php echo $krs->user_entry; ?>">               
                </div> 
              </div> 
            </div>  
          </div>
          <div class="row">
            <div class="col-sm-12">    
              <div class="form-group">
                <label style="text-align:left" class="control-label col-sm-4" for="alamat">Alamat</label>
                <div class="col-sm-8">          
                <textarea class="form-control" rows="3" id="alamat_pemilik" placeholder="Masukkan Alamat Anda" name="alamat"><?php echo $krs->alamat; ?></textarea>
                </div> <!-- <div class="col-sm-9">  -->
              </div> <!-- <div class="form-group"> -->
            </div>  <!-- <div class="col-sm-6"> -->
          </div>     
          <div class="row">
            <div class="col-sm-12">    
              <div class="form-group">
                <label class="control-label col-sm-4" for="simpan" class="control-label col-sm-4"></label>
                <div class="col-sm-7">          
                <button id="tbh" type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Update</button>
                <button type="reset" class="btn btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                </div> <!-- <div class="col-sm-9">  -->
              </div> <!-- <div class="form-group"> -->
            </div>  <!-- <div class="col-sm-6"> -->
          </div>
        </div>
        <div class="col-md-6" >
          <div class="row">
            <div class="col-sm-12">    
              <div class="form-group">
                <label for="email" class="control-label col-sm-4">Foto :</label>
                <div class="col-sm-8">                        
                <!-- <input type="file" name="foto" id="foto"></input> <br /> -->
                  <div style="padding:20px; line-height:10; text-align:center;border:1px dashed #000; min-height:100px;">
                    <img id="blah" src="uploads/<?php echo $krs->foto ?>" alt="Rekomendasi (215 x 215) px">
                    <input type="hidden" name="kosong" id="kosong"></input>
                  </div>
                  <small>* format gambar : gif, jpg, png, jpeg, bmp</small>
                  <div class="col-sm-10 list-file-cr">
                    <input id="upload" name="foto" type="file">   
                </div> <br /><br /> 
                </div> <!-- <div class="col-sm-9">  -->
              </div> <!-- <div class="form-group"> -->
            </div>  <!-- <div class="col-sm-6"> -->
          </div>
        </div>
      </form>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
  </div> 
</div>

<script type="text/javascript">

$(document).ready(function(){
        
        $("#upload").on('change', prePareUpload);        
        
    });

var specialKeys = new Array();
    specialKeys.push(8); //Backspace
    function IsNumeric(e) {
        var keyCode = e.which ? e.which : e.keyCode
        var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
        document.getElementById("error").style.display = ret ? "none" : "inline";
        return ret;
    }

    function lookUpUsername(name){
    $.post( 
        '<?php echo site_url("admin/ajax_lookUpUemail")?>',
         { email: name },
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
function readURL(input){
      if(input.files&&input.files[0]){
        var reader = new FileReader();

        reader.onload = function (e){
          $('#blah').attr('src',e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
 
    $("#upload").change(function(){
        readURL(this);
         $('#kosong').val('isi');
    });

function prePareUpload(event)
    {
        file = event.target.files;
        loadHtml = "<div class='bg bg-success bg-xs' style='padding:5px 10px; border-radius:3px; color:#555;'><input type='hidden' id='hapus' name='file[]' value='"+file[0].name+"' /><span class='glyphicon glyphicon-file' aria-hidden='true'></span> "+file[0].name+" <span class='glyphicon glyphicon-remove pull-right' onclick='removes(this)' aria-hidden='true'></span></div>";
        $(".list-file-cr").append(loadHtml);
        
        saveUpload(event);
        
        //console.log(file);
    }

    function saveUpload(event)
    {
        event.stopPropagation();
        event.preventDefault();
        //$("#btnSimpan").attr("disabled", "disabled");
        //$("#btnSimpan").html("Loading . . .");
         var data = new FormData();
         $.each(file, function(key, val){
            data.append(key, val);
            console.log(val.name);
        });
        $.ajax({
            url : '<?php echo site_url("admin/uploadFileMulti")?>',
            type : 'POST',
            data : data,
            cache : false,
            processData : false,
            contentType : false,
            success: function(res, textStatus, jqXHR)
            {
                //console.log(res);
            },
            error: function(jqXHR, textStatus, errorMessage)
            {
                //console.log('ERRORS: ' + textStatus);
            }
            
        });
        
    }

    function removes(obj)
    {
        //console.log($('#hapus').val());
        $(obj).parents().eq(0).remove();
        //console.log($(obj).parents().eq(0).find("input:first").val());       

        var target = "<?php echo site_url("admin/unlink")?>";
            data = {file : $(obj).parents().eq(0).find("input:first").val()}
        $.post(target,data,function(e){
            //console.log(e);
            //return false;
           
        });

    }

    function simpandata()
    {
        var target = "<?php echo site_url("arsip/savefile")?>";
            data = $("#formBaru").serialize();
        $.post(target, data, function(e){
            //console.log(e);
            //return false;
            alert("Data berhasil disimpan.");
            $('#dialogFormBaru').attr('class', 'modal hide');
           
        });
        loadGridData();
    }  

  function simpanreg()
	{
		//var target = "<?php //echo base_url()."index.php/admin/insert_pemilik"?>";
		data = $("#formBaru").serialize();
		var htmlOut = ajaxFillGridJSON('admin/update_karyawan', data, 'pesanBaru');
			//$('.content-wrapper').html(htmlOut);
      //return false;
			//tinymce.triggerSave();
			
			//alert("Kode barang sudah digunakan , silahkan ganti yang lain !!!");
			
			loadhtml = "<?php echo site_url("admin/Karyawan")?>";
			alert("Data berhasil disimpan.");
			$(".content-wrapper").load(loadhtml);
		
		
	}


</script>