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
	<h1>Tambah PO Sample</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">
			<form id="addkso" onsubmit="simpanreg(); return false;">
			<input type="hidden" id="soid" name="so_id" value="" required/>
			<div class="form-horizontal">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">NO PO :</label>
							<div class="col-sm-8">
								<input class="form-control" id="nomor" name="nomor" value="" required/>
							</div>
						</div>
						<!-- <div class="form-group">
						  <label class="control-label col-sm-3">NO Reff:</label>
						  <div class="col-sm-8" id="col-kontak">
							<div class="input-group">
                                <input type="text" readonly  value="" class="form-control" id="Sales" name="sales" >
                                <input type="hidden" id="id_sales" value="" name="id_sales" >
								<span class="input-group-btn">
					       			<button type="button" id="btnCariSO" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
					       		</span>
					       	</div>
						</div>	
					  </div> -->					
						
						<div class="form-group">
						<label for="kegiatan" class="col-sm-3 control-label">Vendor :</label>
							<div class="col-sm-8" id="col-kontak">
								<div class="input-group">
                                    <input type="text" readonly  value="" class="form-control" id="vendor" name="vendor" >
                                    <input type="hidden" id="id_rekanan" value="" name="id_customer" >
									<span class="input-group-btn">
						       			<button type="button" id="btnCariRekanan" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
						       		</span>
						       	</div>
							</div>							
						</div>

						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">PO Date :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly value="" onchange="dateupdate()" role="date" class="form-control date" id="tglreg" name="tglreg" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                  </div>
							</div>
						</div>
						
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Delivery Date :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly role="date" value="" class="form-control date" id="tglship" name="tgldel" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                  </div>
							</div>
						</div>
						
					</div>

					<div class="col-sm-6">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Phone :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly value="" role="date" class="form-control date" id="phone" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> 
                                  </div>
							</div>
						</div>
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Address :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly value="" role="date" class="form-control date" id="address" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span> 
                                  </div>
							</div>
						</div>
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Note :</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="note"></textarea>
							</div>
						</div>
					</div>
						
					
				</div>
			</div>
			
			<div class="seperator">
			
			<div class="header1">
				<h4>RINCIAN PRODUCT ORDER</h4>
			</div>			
				<div class="table-responsive" style="width:99%; margin:0px auto;">     
					<table id="tables"  width="100%" cellspacing="0" aria-describedby="tabel transaksi" role="grid" class="table table-striped table-bordered">
						<thead>
							<tr role="row">
								<th class="btn-primary" style="width:5%; text-align:center; vertical-align: middle;">No</th>
								<th class="btn-primary" style="width:14%; text-align:center; vertical-align: middle;">Code</th>
								<th class="btn-primary" style="width:24%; text-align:center; vertical-align: middle;">Material Name</th>
								<th class="btn-primary" style="width:12%; text-align:center; vertical-align: middle;">Price</th>
								<th class="btn-primary" style="width:8%; text-align:center; vertical-align: middle;">QTY</th>
								<th class="btn-primary" style="width:37%; text-align:center; vertical-align: middle;">Description</th>
								<td style="width:8%; "><button type="button" id="btnBaru" title="Pilih Material" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span></button></td>
								<td style="width:8%; "><button type="button" id="btnCari" title="Tambah Material" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-upload"></span></button></td>
							</tr>
						 </thead>
						<tbody name="tabelContent" id="tabelContent">
														
						</tbody>
						<tfoot>
						</tfoot>
					</table>					
			   </div>	
				
		
			<div class="form-horizontal footer">
				<div class="row" id="addcol">
					<div class="col-sm-6">
						&nbsp;&nbsp;<button type="submit" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Simpan Data</button>
						<!-- <button onclick="adddataprint('')" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-print"></span> Simpan Data dan Cetak</button>
						<button onclick="batal()" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-minus-sign"></span> Batal</button> -->
					</div>
				</div>				
			</div>		
		</div>
		</form>
	</div>
</div>
</div>

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content" style="width:760px">
      <div class="modal-header">
        <button type="button" class="close Count" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Product</h4>
      </div>
      <div class="modal-body">
      	<input type="hidden" id="caridata" oninput="loadGridData1()" placeholder="Cari data product" value="" class="form-control" autofocus>        
		<table id="example3" class="table table-bordered table-striped">
            <thead style="">
                <tr>            
                    <th class="sorting" tabindex='0' style="text-align:center; width:7%"> No</th>
                    <th class="sorting" tabindex='1' style="text-align:center; width:15%"> Kode </th>
                    <th class="sorting" tabindex='2' style="text-align:center; width:53%"> Nama </th>
                    <th class="sorting" tabindex='3' style="text-align:center; width:10%"> Qty </th> 
                    <th class="hidden" tabindex='4' style="text-align:center; width:10%"> Qty </th>
                    <th class="hidden" tabindex='5' style="text-align:center; width:10%"> Qty </th>
                    <th class="hidden" tabindex='6' style="text-align:center; width:10%"> Qty </th>                    
                    <th class="sorting" tabindex='7' style="text-align:center; width:10%"> Action </th>
                </tr>
            </thead>
            <tbody id="tableGridData">                   
            </tbody>
        </table>		
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="myModalRekanan">
  <div class="modal-dialog">
    <div class="modal-content" style="width:760px">
      <div class="modal-header">
        <button type="button" class="close Rekanan" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Vendor</h4>
      </div>
      <div class="modal-body">
      	<input type="hidden" id="caridatarekanan" oninput="loadGridDataRekanan1()" placeholder="Cari data product" value="" class="form-control" autofocus>        
		<table id="example4" class="table table-bordered table-striped">
            <thead style="">
                <tr>            
                    <th style="text-align:center; width:7%"> No</th>
                    <th style="text-align:center; width:15%"> Kode </th>
                    <th style="text-align:center; width:58%"> Nama </th>
                    <!-- <th style="text-align:center; width:13%"> Telp </th>  -->                   
                    <th style="text-align:center; width:15%"> Action </th>
                </tr>
            </thead>
            <tbody id="tableGridDataRekanan">                   
            </tbody>
        </table>		
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->  
</div><!-- /.modal -->

<div class="modal fade" id="myModalSales">
  <div class="modal-dialog">
    <div class="modal-content" style="width:760px">
      <div class="modal-header">
        <button type="button" class="close Sales" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Sales Order</h4>
      </div>
      <div class="modal-body">
      	<input type="hidden" id="caridatasales" oninput="loadGridDataSales()" placeholder="Cari data product" value="" class="form-control" autofocus>        
		<table id="example5" class="table table-bordered table-striped">
            <thead style="">
                <tr>            
                    <th style="text-align:center; width:7%"> No</th>
                    <th style="text-align:center; width:15%"> Kode </th>
                    <th style="text-align:center; width:58%"> Nama </th>
                    <!-- <th style="text-align:center; width:13%"> Telp </th>  -->                   
                    <th style="text-align:center; width:15%"> Action </th>
                </tr>
            </thead>
            <tbody id="tableGridDataSales">                   
            </tbody>
        </table>		
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal hide" id="dialogFormBaru" tabindex="1" role="dialog" aria-labelledby="FormTambahData" aria-hidden="true">
	 <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title" id="FormTambahData">Tambah Data Material</h4>
	      </div>
	      <form id="formBaru" class="form-horizontal" onsubmit="simpanmat(); return false;">
	      <div class="modal-body">
	      	<div class="pesanBaru"></div>	      		
  			<div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Material Item COde</label>
			    <div class="col-sm-8">
		    	  	<input type="text" oninput="lookUpUsername(this.value)" placeholder="Material Code" name="code" id="code" class="form-control" required/> 
		    	  	<span id="error3" style="margin-top:4px; color: Red; display: none">* kode sudah ada</span>
        			<span id="error2"  style="margin-top:4px; color: green; display: none">* kode tersedia</span>	
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Material Name</label>
			    <div class="col-sm-8">
		    	  	<input type="text" placeholder="Material Name" name="name" id="" class="form-control" required/> 	
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="jabatan" class="col-sm-4 control-label">Categories </label>
			    <div class="col-sm-8">
			       	<select name="categories" class="form-control">
			       		<option value=''>:: Pilih MATERIAL CATEGORIES ::</option>
			       		<?php  
			       			$CI = get_instance();
			       			$selectQuery =  $CI->db->query("SELECT * from mst_material_categories ");
			       			$arrTipeKaryawan = $selectQuery->result_array();
			       			foreach ($arrTipeKaryawan as $row) {
			       				echo "<option value='".$row['material_categories_id']."'>".$row['material_categories_name']."</option>";
			       			}
			       		?>
			       	</select>
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="jabatan" class="col-sm-4 control-label">Categories Group </label>
			    <div class="col-sm-8">
			       	<select name="Group" class="form-control">
			       		<option value=''>:: Pilih MATERIAL CATEGORIES GROUP::</option>
			       		<?php  
			       			$CI = get_instance();
			       			$selectQuery =  $CI->db->query("SELECT * from ref_material_categories_group ");
			       			$arrTipeKaryawan = $selectQuery->result_array();
			       			foreach ($arrTipeKaryawan as $row) {
			       				echo "<option value='".$row['material_categories_group_id']."'>".$row['material_categories_group_name']."</option>";
			       			}
			       		?>
			       	</select>
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="jabatan" class="col-sm-4 control-label">Satuan </label>
			    <div class="col-sm-8">
			       	<select name="Satuan" class="form-control">
			       		<option value=''>:: Pilih Satuan::</option>
			       		<?php  
			       			$CI = get_instance();
			       			$selectQuery =  $CI->db->query("SELECT * from ref_unit ");
			       			$arrTipeKaryawan = $selectQuery->result_array();
			       			foreach ($arrTipeKaryawan as $row) {
			       				echo "<option value='".$row['unit_id']."'>".$row['unit_name']."</option>";
			       			}
			       		?>
			       	</select>
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Deafault Material Usd</label>
			    <div class="col-sm-8">
		    	  	<input type="number" placeholder="Material Price USD" name="usd" id="" class="form-control"/> 	
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Default Material Price</label>
			    <div class="col-sm-8">
		    	  	<input type="number" placeholder="Price USD" name="price" id="" class="form-control"/> 	
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Default Material CBM</label>
			    <div class="col-sm-8">
		    	  	<input type="number" placeholder="Material CBM" name="cbm" id="" class="form-control"/> 	
			    </div>
		    </div>				    
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Minimal Stock</label>
			    <div class="col-sm-8">
		    	  	<input type="number" placeholder="Minimal Stock" name="stock"  class="form-control"/> 	
			    </div>
		    </div>		          
	      </div>
	      <div class="modal-footer">
	        <button type="submit" id="tbh" class="btn btn-primary">Tambah</button>
	        <button type="button" class="btn btn-warning" id="btnBatalTambahKaryawan">Batal</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
		$("#tglship").val(tglreg);
		loadGridDataSO();
		loadGridDataRekanan();
		loadGridData();
		var tglreg = "<?php echo date("d-m-Y")?>";
		
		$("#tglreg").val(tglreg);
			
		$(".date").datepicker({
			format : "dd-mm-yyyy",
			//startDate : new Date('<?php echo date('Y-m-d', strtotime("-".$_SESSION['Akses']." days"))?>'),
		    //endDate : new Date('<?php echo date('Y-m-d', strtotime("+90 days"))?>'),
			autoclose : true,
		});			
		dateupdate();
		
		$('.Count').click(function(e)
	    {
	    	//$('#example3').dataTable().fnDestroy();
	    	$('#myModal').attr('class', 'modal hide'); 
	    });
	    $('.Rekanan').click(function(e)
	    {
	    	
	    	//$('#example4').dataTable().fnDestroy();		
	    	
	    	$('#myModalRekanan').attr('class', 'modal hide'); 
	    });
	    
	    $('#btnBatalTambahKaryawan').click( function(e){
    		e.preventDefault(); 
    		$('#dialogFormBaru').attr('class', 'modal hide');
   		}); 

	    $('.Sales').click(function(e)
	    {
	    	$('#myModalSales').attr('class', 'modal hide'); 
	    });
		$('#btnCari').click(function(e)

	    {			
	    	$('#alertMessage').remove();

	    	$('#dialogFormBaru').attr('class', 'modal show');  

	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	
	    });

	    $('#btnBaru').click(function(e)

	    {
			
	    	$('#alertMessage').remove();

	    	$('#myModal').attr('class', 'modal show'); 
	    	
	    });

	    $('#btnCariRekanan').click(function(e)

	    {

			e.preventDefault(); 		

	    	$('#alertMessage').remove();

	    	$('#myModalRekanan').attr('class', 'modal show');  

	    	document.getElementById("caridatarekanan").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	
	    });

	    $('#btnCariSO').click(function(e)

	    {

			e.preventDefault(); 		

	    	$('#alertMessage').remove();

	    	$('#myModalSales').attr('class', 'modal show');  

	    	document.getElementById("caridatasales").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	
	    });
	});

function loadGridData(){ 
		var produk_id = $('#caridata').val();
		var idso = $('#id_sales').val();		 
        ajaxDataGrid('<?php echo base_url()?>raw/addTableSo_sample', {idx : produk_id, ids : idso}, 'tableGridData');
        $('#example3').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": false,
          "bAutoWidth": false,
          "bDestroy": true
        });       
    }

function dateupdate() {
	var d = $("#tglreg").val().split('-');
		n = d[0];
		b = parseInt(n)+30;
		c = d[1];
		e = d[2];
	//$("#tglterima").val($("#tglkirim").val());
	//$("#tglmulai").val($("#tglkirim").val());
	//var barutanggal : ($("#tglkirim").val()).getDate();
	//newdate : date("d", strtotime(barutanggal));
	//console.log(b);
	$("#tglship").datepicker({
	    dateFormat: "yy-mm-dd",
	    startDate : new Date('<?php echo date('Y-m-d', strtotime("-3 days"))?>'),
	}).datepicker('setDate', +b+'-'+c+'-'+e);
}

function loadGridData1(){ 
		var produk_id = $('#caridata').val();
		var idso = $('#id_sales').val();		 
        ajaxDataGrid('<?php echo base_url()?>raw/addTableSo_det1', {idx : produk_id, ids : idso}, 'tableGridData');
             
    }

function loadGridDataSO(){ 
		var produk_id = $('#caridatasales').val();  
        ajaxDataGrid('<?php echo base_url()?>raw/addTableSales', {idx : produk_id}, 'tableGridDataSales'); 
        $('#example5').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": false,
          "bAutoWidth": false,
          "bDestroy": true
        });      
    }	

function loadGridDataRekanan(){ 
		var produk_id = $('#caridatarekanan').val();

        ajaxDataGrid('<?php echo base_url()?>raw/addTableRekanan', {idx : produk_id}, 'tableGridDataRekanan'); 
        $('#example4').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": false,
          "bAutoWidth": false,
          "bDestroy": true
        });       
    }

function loadGridDataRekanan1(){ 
		var produk_id = $('#caridatarekanan').val();

        ajaxDataGrid('<?php echo base_url()?>raw/addTableRekanan1', {idx : produk_id}, 'tableGridDataRekanan'); 
               
    }	

function addRekanan(idx, nama, code, phone, address)
	{ 
		var name = nama.replace(/_/ig, ' ');
		var telp = phone.replace(/_/ig, ' ');
	 	$('#vendor').val(name);
	 	$('#id_rekanan').val(idx);
	 	$('#myModalRekanan').attr('class', 'modal hide');
	 	$('#nomor').val(code);
	 	$('#phone').val(telp);
	 	$('#address').val(address); 
	 	//alert(produk_id);
	 	//$('.content-wrapper').html(produk_id);
	 	return false;	
	  	sendRequestForm('admin/insertDetailSo', {IDSo : so_id, IDproduct : idx, price : nama}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('admin/editso', {IDBidang : so_id});	    		
	   	$('.content-wrapper').html(htmlOut);
	}

function addProduct(objReference, idx)
	{ 
		
	 	var Id 		= $(objReference).parent().parent().find('td:eq(0)').html();
		var kode 	= $(objReference).parent().parent().find('td:eq(1)').html();
		var name 	= $(objReference).parent().parent().find('td:eq(2)').html();
		var qty 	= $(objReference).parent().parent().find('td:eq(3)').html();
		var price 	= $(objReference).parent().parent().find('td:eq(4)').html();
		var IDproduct 	= $(objReference).parent().parent().find('td:eq(5)').html();
		var count 	= $(objReference).parent().parent().find('td:eq(6)').html();
		
	 	//return false;	
	  	//console.log($("#tabelContent tr").length);
		//return false;
		var idbutton = "delete-button-"+$("#tabelContent tr").length;
			lengths = $("#tabelContent tr").length;
			harga = price.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			num = lengths +1;
			//name = nama.replace(/_/g, " ");
			
			var row  = "<tr id='tmbinput-"+lengths+"'>";
				row += "<td>"+num+"<input type='hidden' value='"+Id+"' name='id_material[]'/><input type='hidden' value='"+IDproduct+"' name='id_product[]'/></td>";
				row += "<td><input type='text' readonly='readonly' value='"+kode+"' id='uraian-"+lengths+"' class='form-control'/></td>";
				row += "<td><input type='text' value='"+name+"' style='text-align:left;' id='nmproduct-"+lengths+"'class='form-control'/></td>";
				row += "<td><input type='text' value='"+harga+"' name='nominal[]' id='nominal-"+lengths+"' onkeyup='getnumeric(this)' class='form-control'/></td>";
				row += "<td><input type='number' min='1' max='' value='"+qty+"' name='qty[]' id='qty-"+lengths+"' class='form-control autocomplate'/></td>";
				row += "<td><input type='text' name='desc[]' id='desc-"+lengths+"' class='form-control autocomplate'/></td>";
				row += "<td colspan='2' style='text-align:center;'><button type='button' onclick='deleterow("+lengths+")' id='"+idbutton+"' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button></td>";
				row += "</tr>";
				//$("#tabelContent").after(row);
		
		$("#tabelContent").append(row);
		//$('#example3').dataTable().fnDestroy();
		$('#hd'+count).prop('disabled', true);
		//$('#myModal').attr('class', 'modal hide'); 

	  	
	}

	function deleterow(obj)
	{
			
		isDelete = confirm("Apakah Yakin menghapus data ini ?");
			if(isDelete)
			{	
				$('#tmbinput-'+obj).remove();
			}
		//calculates();
		
	}

	function getnumeric(elem)
	{
		
		var getelem = $(elem).attr("id");
			getval = $("#"+getelem).val().replace(/,/ig, '');
			currancy = getval.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			
			getval = $("#"+getelem).val(currancy);
			//$("#"+getelem).val(currancy);
			
			//calculates();
	}

function addSales(idx, nama)
	{ 
	 	$('#Sales').val(nama);
	 	$('#id_sales').val(idx);
	 	$('#myModalSales').attr('class', 'modal hide'); 
	 	loadGridData();
	}

function deletedata(idx)
	{ 
	 	var produk_id = $('#soid').val();
	 	//alert(produk_id);
	 	//$('.content-wrapper').html(produk_id);
	 	//return false;				
	   	isDelete = confirm('Yakin data akan dihapus ?');
	  	if (isDelete) sendRequestForm('admin/habusdataSo', {ID : idx}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('admin/editso', {IDBidang : produk_id});	    		
	   	$('.content-wrapper').html(htmlOut);
	}

function simpanmat()
  {
    var target = "<?php echo site_url("admin/savematerial")?>";
      data = $("#formBaru").serialize();
    $.post(target, data, function(e){
      //$(".content-wrapper").html(e);
      //console.log(e);
      //return false;
      //tinymce.triggerSave();
      
      //alert("Kode barang sudah digunakan , silahkan ganti yang lain !!!");
      
        var htmlOut = ajaxFillGridJSON('raw/po_sample'); 
        alert("Data berhasil disimpan.");
        $('.content-wrapper').html(htmlOut);
        
    });
  }

function simpanreg()
	{
		var idx = $('#soid').val();
			data = $("#addkso").serialize();

		var htmlOut = ajaxFillGridJSON('raw/saveProductSample', data);	    		
	   	//$('.content-wrapper').html(htmlOut);
	   	//return false;
		//sendRequestForm('admin/updateso', data, 'box-body');
		var kodeTipeKaryawan = ajaxFillGridJSON('raw/po_sample', {IDBidang : idx}); 
		alert("Data berhasil disimpan.");
		$('.content-wrapper').html(kodeTipeKaryawan);
		
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