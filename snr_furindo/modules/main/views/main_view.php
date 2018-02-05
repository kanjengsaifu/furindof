<div class="content-wrapper" style="min-height: 500px;">
	<?php $this->load->view('dashboard_view'); ?>
	<?php
		//untuk sementara di matikan dulu
		$pilihTahunAnggaranAktif = 'aktif';
		if ($pilihTahunAnggaranAktif <> 'aktif')
		{
	?> 	  
  	<div class="row">
  		<div class="col-sm-12"> 
			<div class="box box-warning box-solid">

		          <div class="box-header with-border">
		            <h3 class="box-title">Pilih Tahun Anggaran Aktif</h3>
		          </div><!-- /.box-header -->

		          <div class="box-body">
		          	<div class="pesanSystem"></div>
		            <form action="main/setDatabaseAktif" method="post" id="formPilihDatabase">
		                <input type="hidden" id="<?php echo config_item('csrf_token_name'); ?>" name="<?php echo config_item('csrf_token_name'); ?>" value="<?php echo GenerateNewCRSFHash() ?>" />
		                
		                <?php
		                  
		                  $currentYear = isset($_SESSION['tahunAnggaranAktif']) ? $_SESSION['tahunAnggaranAktif'] : RealDateTime('Year');

		                  foreach ($arrDaftarTahunAnggaran as $value) 
		                  {
		                     $selected = ($currentYear == $value) ? 'checked' : ''; 
		                     echo '<div class="radio">
		                            <label>
		                              <input type="radio" '.$selected.' name="tahunAktif" id="tahunAktif" value="'.$value.'">TA '.$value.'
		                            </label>
		                          </div>';
		                   } 
		                ?>
		            </form>
		            <div class="row">
		                <div class="col-xs-12">
		                   <button type="submit" class="btn btn-warning btn-flat" onclick="setDatabaeAktif()">Pilih</button>
		                </div>
		            </div>     
		          </div>
		        </div>
		        
		    </div>
		</div>
	</div>
	<?php
		}
	?>
</div>
<script>
	
	function setDatabaeAktif()
	{
		sendRequestForm($('#formPilihDatabase').attr('action'), $('#formPilihDatabase').serialize(), 'pesanSystem');
		$('.content-wrapper').html('');

	}
</script>