<?php //echo "<pre>";print_r($distribusi);"</pre>";exit();?>
<style>
    ul li.list{
        list-style-type:bullet;
    }
</style>
<div style="text-align:center" class="content-header">   
    <h1><b>Data Surat Masuk</b></h1>
</div>
<div class="content">
    <div class="box box-primary">
        <div class="box-body" style="min-height:800px;">
                        
            <div class="content">
                <div style="padding:5px 0px">
                    <button onclick="tambahdata()" class="btn btn-sm btn-success">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    Tambah Baru
                    </button>                    
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead style="">
                        <tr>            
                            <th style="text-align:center; width:7%"> No</th>
                            <th style="text-align:center; width:10%"> Kode </th>
                            <th style="text-align:center; width:28%"> Nama </th>
                            <th style="text-align:center; width:40%"> Keterangan </th>
                            <th style="text-align:center; width:15%"> Action </th>
                        </tr>
                    </thead>
                    <tbody id="tableGridData">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>   
                    </tbody>
                </table>               
                
            </div>
        </div>
    </div>
</div>

<!-- modal tambah -->
<div class="modal hide" id="dialogFormBaru" tabindex="2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="formBaru" class="form-horizontal" enctype="multipart/form-data" onsubmit="simpandata(); return false;">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Tambah Surat Masuk</h4>
      </div>
      <div class="modal-body">
        <div class="pesanBaru"></div>
           
                                            
            <div class="form-group form-group">
                <label for="nomor" class="col-sm-2 control-label">Nomor</label>
                <div class="col-sm-10">
                    <input id="nomor" name="nomor" value="" type="text" class="form-control"/>
                </div>
            </div>
            <div class="form-group form-group">
                <label for="satuanBaru" class="col-sm-2 control-label">File</label>
                <div class="col-sm-10 list-file-cr">
                    <input id="upload" type="file" class="form-control"/>   
                </div>
            </div>
            <div class="form-group form-group">
                <label for="biayaBaru" class="col-sm-2 control-label">Deskripsi</label>
                <div class="col-sm-10">
                    <textarea type="text"  id="diskripsi" class="form-control" name="diskripsi"/></textarea>
                </div>
            </div>   
          

      </div>
      <div class="modal-footer">

        <button type="submit" class="btn btn-sm btn-success">Save</button>
        <button type="button" class="btn btn-sm btn-warning" id="btnBatalBaru">Batal</button>

      </div>
        </form>
    </div>
  </div>
</div>
<!--end modal tambah -->

<script src="assets/js/func.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        loadGridData();
        $("#upload").on('change', prePareUpload);

        $('#btnBatalBaru').click( function(e){
            e.preventDefault(); 
            $('#dialogFormBaru').attr('class', 'modal hide');
            //$('body').attr('class', 'skin-green layout-boxed sidebar-collapse'); 
        });
        
    });

    function tambahdata()
    {
        $('#dialogFormBaru').attr('class', 'modal show');
        //$('body').attr('class', 'skin-green layout-boxed sidebar-collapse modal-open'); 
    }
    
    function print()
    {
        var htmlload = "<?php echo site_url("jenisbarang/cetakjenisbarang")?>";
        
        window.open(htmlload);
    }

    function editdata(idreg)
    {
        var target = "<?php echo site_url("jenisbarang/ubahjenisbarang")?>/"+idreg;
        
        $(".content-wrapper").load(target);
    }

    function deletedata(objReference)
    { 
               
        isDelete = confirm('Yakin data akan dihapus ?');
        if (isDelete) sendRequestForm('arsip/Hapusjenisbarang', {IDDel: objReference}, 'content');
        //if (isDelete) sendRequestForm('arsip/unlink', {file: File}, 'content');

        loadhtml = "<?php echo site_url("arsip/suratmasuk")?>";           
        $(".content-wrapper").load(loadhtml);
    }

        function myFunction() {
        var x = document.getElementById("myFile");
        //$('#dialogFormBaru').attr('class', 'modal hide');
        x.disabled = true;
    }

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
            //console.log(val.name);
        });
        $.ajax({
            url : '<?php echo site_url("arsip/uploadFileMulti")?>',
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

        var target = "<?php echo site_url("arsip/unlink")?>";
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

    function loadGridData(){    
        ajaxDataGrid('<?php echo base_url()?>arsip/addTableArsip', '', 'tableGridData');       
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
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>


