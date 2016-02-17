<?php
require_once APPPATH.'libraries/PHPExcel/Classes/PHPExcel/IOFactory.php';
?>
<style>
	.seperator{
		border: 1px solid #ccc;
		padding: 10px 0px 10px 0px;
		margin:20px 0px 20px 0px;
		border-radius:3px;
	}
	.header1{
		text-align:center;
		border-bottom:1px solid #ccc;
		margin:0px 0px 10px 0px;
	}
	
	li.ui-menu-item{
		background:#fff;
		list-style-type:none;
		width:210px !important;
		margin:0px !important;
		left:0px !important;
		padding:5px;
		border-bottom:1px dashed #ccc;
	}
	
	li.ui-menu-item:hover{
		background:#ccc;
		cursor:pointer;
	}
</style>
<div class="content-header">   
	<h1>Tambah Sales Order</h1>
</div>
	
<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<form id="form-regksm" onsubmit="simpanreg(); return false;">
	  		<div class="content">	  			
				<div class="col-md-6">								
				<?php 	
				 	$file_path ='assets/export/file.xls';          
					$objPHPExcel = PHPExcel_IOFactory::load($file_path);		
					$sheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
					$no = 1;		
					foreach($sheet as $row):
						//foreach($row as $key => $val)
				?>	
				<div class="form-horizontal">
					<div class="row">
						<div class="col-sm-12">    
							  <div class="form-group">
								  <label for="kasbank" class="control-label col-sm-3">Kode Product :</label>
								  <div class="col-sm-4">          
									<input type="text" readonly="true" value="<?php echo $row['B']; ?>" class="form-control" name="noreg[]"/>
								  </div>
								  <div class="col-sm-4">          
									<input type="text" readonly="true" value="<?php echo $row['C']; ?>" class="form-control" name="qty[]"/>
								  </div>
							  </div>
						  </div>
					</div>
				</div>
				<?php	 
					$no++;
					endforeach;		
				?>
				</div>				
				<div class="col-md-6"></div>
				<button type="submit" class="btn btn-primary btn-sm">
				<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
				Simpan Data</button>
				<div class="table-responsive" style="width:90%; margin:0px auto;">

				</div>			
			</div>
			
		</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	function simpanreg()
	{
		var target = "<?php echo site_url("admin/buatso")?>";
			data = $("#form-regksm").serialize();
		$.post(target, data, function(e){
			$(".content-wrapper").html(e);
			//console.log(e);
			return false;
			//tinymce.triggerSave();
			
			//alert("Kode barang sudah digunakan , silahkan ganti yang lain !!!");
			
			loadhtml = "<?php echo site_url("admin/Ksm")?>";
			alert("Data berhasil disimpan.");
			$(".content-wrapper").load(loadhtml);
		
		});
	}
</script>