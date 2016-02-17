<?php //echo "<pre>";print_r($distribusi);"</pre>";exit();?>
<style>
	ul li.list{
		list-style-type:bullet;
	}
	iframe{
    width: 100%;
    height: 40px !important;
    display: block;}
</style>
<div class="content-header">   
	<h1>Tambah Data Jenis Barang</h1>
</div>
<div class="content">
	<div class="box box-primary">
	  	<div class="box-body" style="min-height:800px;">
			<div class="content" style="min-height:150px;">
				<div class="col-md-6">
				<form id="formsave" onsubmit="simpandata(); return false;">				
					<div class="form-horizontal">
						<div class="row">
							<div class="col-sm-12">    
								<div class="form-group">
								  <label for="kasbank" class="control-label col-sm-4">Kode Jenis Barang :</label>
								  <div class="col-sm-8">          
									<input type="text" readonly value="" id="kode_jenis_barang" class="tinymce form-control" name="kode_jenis_barang" required/>
								  </div> <!-- <div class="col-sm-9">  -->
								</div> <!-- <div class="form-group"> -->
							</div>  <!-- <div class="col-sm-6"> -->
						</div>
						<div class="row">
							<div class="col-sm-12">    
								<div class="form-group">
								  <label for="kasbank" class="control-label col-sm-4">Nama Jenis Barang :</label>
								  <div class="col-sm-8">          
									<input type="text" value="" id="nama_jenis_barang" class=" tinymce form-control" name="nama_jenis_barang" required/>
								  </div> <!-- <div class="col-sm-9">  -->
								</div> <!-- <div class="form-group"> -->
							</div>  <!-- <div class="col-sm-6"> -->
						</div>						
						<div class="row">
							<div class="col-sm-12">    
								<div class="form-group">
								  <label for="kasbank" class="control-label col-sm-4"></label>
								  <div class="col-sm-8">          
									<button  type="submit" class="btn btn-sm btn-primary">
									<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
									Simpan Data
									</button>
								  </div> <!-- <div class="col-sm-9">  -->
								</div> <!-- <div class="form-group"> -->
							</div>  <!-- <div class="col-sm-6"> -->
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="assets/js/func.js" type="text/javascript"></script>
 <script src="<?php echo base_url()?>assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		getnobarang("<?php echo $barang->kode_jenis_barang?>");
		
	});
	
	
	
	function simpandata()
	{
		var target = "<?php echo site_url("jenisbarang/savejenisbarang")?>";
			data = $("#formsave").serialize();
		$.post(target, data, function(e){
			//console.log(e);
			//return false;
			//tinymce.triggerSave();
			if (e==1) {
				alert("Kode Jenis barang sudah digunakan , silahkan ganti yang lain !!!");
			}else{
			loadhtml = "<?php echo site_url("jenisbarang/datajenisbarang")?>";
			alert("Data berhasil disimpan.");
			$(".content-wrapper").load(loadhtml);
			}
		});
	}
	
	function deletedata(objReference)
	{ 
		var IDx		  = $(objReference).parent().parent().find('td:eq(0)').html();
		var Nama 		= $(objReference).parent().parent().find('td:eq(1)').html();
		
	   	isDelete = confirm('Yakin kalibrasi '+ Nama +' akan dihapus ?');
	  	if (isDelete) sendRequestForm('setup/HapusLaboratorium', {IDDel: IDx}, 'content');
	  	loadGridData();
	}

	function getnobarang(param)
	{
		
		getNum = param.split(" ");
		Nums = parseInt(getNum[1]);
		Num  = eval(Nums) + 1;
		
		
		if(Num <= 9)
		{
			code = getNum[0]+" "+"000"+Num;
		}
		else if(Num > 9 && Num <= 99)
		{
			code = getNum[0]+" "+"00"+Num;
		}
		else if(Num > 99 && Num <= 999)
		{
			code = getNum[0]+" "+"0"+Num;
		}
		else
		{
			code = getNum[0]+" "+Num;
		}
		$("#kode_jenis_barang").val(code);
		return code;
	}
</script>
