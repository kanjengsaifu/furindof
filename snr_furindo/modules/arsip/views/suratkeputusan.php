<?php //echo "<pre>";print_r($distribusi);"</pre>";exit();?>
<style>
    ul li.list{
        list-style-type:bullet;
    }
</style>
<div style="text-align:center" class="content-header">   
    <h1><b>Data Surat Keputusan</b></h1>
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

<script src="assets/js/func.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
    
        
    });
    
    
    
    function caridata()
    {
        var target = "<?php echo site_url("jenisbarang/caridatajenisbarang")?>";
            data = $("#formcari").serialize();
        $.post(target, data, function(e){
            //console.log(e);
            //return false;
            dataJson = $.parseJSON(e);
            
            fillGridDistData(dataJson);
        });
    } 

    function fillGridDistData(record)
    {
        var table = document.getElementById('tableGridData');
        table.innerHTML = '';
        
        for(i = 0; i<record.barang.length; i++)
        {
            var KodeBarang = record.barang[i].Kode;
                //NamaBarang = record.barang[i].Nama;
                //TglMasukBarang = record.barang[i].TglMasuk;
                //JumlahBarang = record.barang[i].Jumlah;
                //SatuanBarang = record.barang[i].Satuan;
                NamaJenisBarang = record.barang[i].Nama;
                IdParameter = record.barang[i].ID;
                
            var row = table.insertRow();
            
            var ColKodeBarang = row.insertCell(0);
            //var ColNamaBarang = row.insertCell(1);
            //var ColTglMasukBarang = row.insertCell(2);
            //var ColJumlahBarang = row.insertCell(3);
            //var ColSatuanBarang = row.insertCell(4);
            var ColNamaJenisBarang = row.insertCell(1);
            var ColAksi = row.insertCell(2);
            
            ColKodeBarang.innerHTML = KodeBarang;
            //ColNamaBarang.innerHTML = NamaBarang;
            //ColTglMasukBarang.innerHTML = TglMasukBarang;
            //ColJumlahBarang.innerHTML = JumlahBarang;
            //ColSatuanBarang.innerHTML = SatuanBarang;
            ColNamaJenisBarang.innerHTML = NamaJenisBarang;
            ColAksi.innerHTML = "<button onclick=editdata('"+IdParameter+"') class='btn btn-xs btn-warning'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</button> <button onclick=deletedata('"+IdParameter+"') class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Hapus</button>";
            
        }
    }

    function tambahdata()
    {
        var loadhtml = "<?php echo site_url("jenisbarang/addjenisbarang")?>";
        $(".content-wrapper").load(loadhtml);
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
        if (isDelete) sendRequestForm('jenisbarang/Hapusjenisbarang', {IDDel: objReference}, 'content');
        loadhtml = "<?php echo site_url("jenisbarang/datajenisbarang")?>";           
        $(".content-wrapper").load(loadhtml);
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
