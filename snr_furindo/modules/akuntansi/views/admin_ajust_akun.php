<style type="text/css">
	.form-control{
		margin: 2px;
	}
</style>
<div class="content-header">   
	<h1>Ajustment Akuntansi</h1>
</div>
<form id="addkso" onsubmit="simpanreg(); return false;">
<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<button type="button" class="btn btn-sm btn-primary" onclick="addAjs()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
				<br>	
			</div>
			<div class="" style="width:100%; margin:0px auto;"> 
				<table id="example2" class="table table-bordered table-striped table-responsive">
		            <thead style="">
		                <tr>            
		                    <th style="text-align:center; width:5%"> NO</th>
		                    <th style="text-align:center; width:10%"> Tanggal</th>
		                    <th style="text-align:center; width:38%"> Keterangan</th>                    
		                    <th style="text-align:center; width:15%"> Status</th>
		                    <th style="text-align:center; width:20%"> User Create</th>	
		                    <th style="text-align:center; width:10%"> Action</th>		                    		                    
		                </tr>
		            </thead>
		            <tbody id="ajaxTreeGrid">
		            <?php $i=1; foreach($jurnal->result() as $row): ?>
		            	<tr>
		            		<td><?php echo $i; ?></td>
		            		<td><?php echo $row->tgl; ?></td>
		            		<td><?php echo $row->keterangan; ?></td>
		            		<td><?php echo $row->status==1?"ACTIVE":"NOT ACTIVE"; ?></td>
		            		<td><?php echo $row->user_created; ?></td>
		            		<td style="text-align:center"><button onclick="editAjust(<?php echo $row->id; ?>)" class="brn btn-warning" ><span class="glyphicon glyphicon-pencil"> Edit</button></td>
		            	</tr>
		            <?php $i++; endforeach; ?>                   
		            </tbody>
		        </table>
			</div>						
		</div> 
	  </div>	  
	</div> 
</div>
<script type="text/javascript">
	function addAjs(){
		var kodeTipeKaryawan = ajaxFillGridJSON('akuntansi/addAjustmentAkun', {}); 
		$('.content-wrapper').html(kodeTipeKaryawan);
	}
	function editAjust(idx){
		var kodeTipeKaryawan = ajaxFillGridJSON('akuntansi/editAjustmentAkun', {ids:idx}); 
		$('.content-wrapper').html(kodeTipeKaryawan);
	}
</script>
<script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": true
        });
      });
</script>