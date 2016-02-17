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
	<h1>Edit Data Jenis Barang</h1>
</div>
<div class="content">
	<div class="box box-primary">
	  	<div class="box-body" style="min-height:800px;">
			<div class="content" style="min-height:150px;">
				<div class="col-md-6">
				<form id="formsave">				
					<div class="form-horizontal">
						<div class="row">
							<input type="hidden" value="<?php echo $barang->ID?>" id="id_jenis" class="tinymce form-control" name="id_jenis"/>
							<div class="col-sm-12">    
								<div class="form-group">
								  <label for="kasbank" class="control-label col-sm-4">Kode Jenis Barang :</label>
								  <div class="col-sm-8">          
									<input type="text" readonly value="<?php echo $barang->Kode?>" id="kode_jenis_barang" class="tinymce form-control" name="kode_jenis_barang"/>
								  </div> <!-- <div class="col-sm-9">  -->
								</div> <!-- <div class="form-group"> -->
							</div>  <!-- <div class="col-sm-6"> -->
						</div>
						<div class="row">
							<div class="col-sm-12">    
								<div class="form-group">
								  <label for="kasbank" class="control-label col-sm-4">Nama Jenis Barang :</label>
								  <div class="col-sm-8">          
									<input type="text" value="<?php echo $barang->Nama?>" id="nama_jenis_barang" class=" tinymce form-control" name="nama_jenis_barang"/>
								  </div> <!-- <div class="col-sm-9">  -->
								</div> <!-- <div class="form-group"> -->
							</div>  <!-- <div class="col-sm-6"> -->
						</div>						
						<div class="row">
							<div class="col-sm-12">    
								<div class="form-group">
								  <label for="kasbank" class="control-label col-sm-4"></label>
								  <div class="col-sm-8">          
									<button onclick="updatedata()" type="button" class="btn btn-sm btn-primary">
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
		
	});
	
	
	
	function updatedata()
	{
		var target = "<?php echo site_url("jenisbarang/updatejenisbarang")?>";
			data = $("#formsave").serialize();
		$.post(target, data, function(e){
			//console.log(e);
			//return false;
			//tinymce.triggerSave();
			loadhtml = "<?php echo site_url("jenisbarang/datajenisbarang")?>";
			alert("Data berhasil diubah.");
			$(".content-wrapper").load(loadhtml);
		});
	}	
	
</script>
