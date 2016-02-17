<style>
	.seperator{
		border: 1px solid #ccc;
		padding: 10px 0px 10px 0px;
		margin:20px 0px 20px 0px;
		border-radius:3px;
	}
	.header{
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
	<h1>Input Bukti Kas Masuk</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body text-right">
            <button id="BackToDaftar" class="btn btn-sm btn-primary" ><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Kembali Ke Daftar</button>
        </div>
	</div>
	
	
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-horizontal">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Nomor BKM :</label>
							<div class="col-sm-7">
								<input class="form-control" id="nomor" name="nomor" value=""/>
							</div>
						</div>
						
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Tanggal :</label>
							<div class="col-sm-7">
								<div class="input-group date">
                                    <input type="text" readonly onblur="setMenuZIndex('')" onclick="setMenuZIndex(' noZIndex')" role="date" class="form-control" id="tanggal" name="tanggal" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                  </div>
							</div>
						</div>
						
						<div class="form-group">
						<label for="kegiatan" class="col-sm-3 control-label">Rekanan :</label>
							<div class="col-sm-7" id="col-kontak">
								<select id="kontak" name="kontak" class="form-control">
								  <?php 
										foreach ($this->data['dataList']['arrKontak'] as $row) 
										{
										   echo "<option value='".$row['IDKontak']."'>".$row['NamaKontak']."</option>";
										}
									?>
							   </select>
							</div>
							<div class="col-sm-2">
								<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Rekanan</button>
							</div>
						</div>
						
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Catatan :</label>
							<div class="col-sm-7">
								<input class="form-control" id="catatan" name="catatan" value=""/>
							</div>
						</div>
						
					</div>
					
					
				</div>
			</div>
			
			<div class="seperator">
			
			<div class="header">
				<h4>RINCIAN BUKTI KAS MASUK</h4>
			</div>
			<form id="addkasmasuk">
				<div class="table-responsive" style="width:90%; margin:0px auto;">     
					<table id="tables"  width="100%" cellspacing="0" aria-describedby="tabel transaksi" role="grid" class="table table-striped table-bordered">
						<thead>
							<tr role="row">
								<th style="width:15%; text-align:center;">Kode</th>
								<th style="width:45%; text-align:center;">Keterangan</th>
								<th style="width:20%; text-align:center;">Nominal</th>
								<th style="width:20%; text-align:center;">Memo</th>
								<td style="width:5%; "><button type="button" id="add-button" title="Tambah data" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus-sign"></span></button></td>
							</tr>
						 </thead>
						<tbody name="tabelContent" id="tabelContent">
							<tr>
								<td>
									<input style="width:100%; border-radius:3px" onblur="getkode(this)" class="form-control autocomplate" type="text" id="kode-1" name="kode[]"/>
								</td>
								<td><input style="width:100%; border-radius:3px" readonly="readonly" class="form-control" type="text" id="uraian-1" name="uraian[]"/></td>
								<td><input style="width:100%; border-radius:3px;text-align:right;" class="form-control" type="text" onblur="calculates()" onkeyup="getnumeric(this)" id="nominal-1" name="nominal[]"/></td>
								<td><input style="width:100%; border-radius:3px" class="form-control" type="text" id="memo-1" name="memo[]"/></td>
								<td><button type="button" onclick="deleterow(this)" id="delete-button-1" title="hapus data" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-minus-sign"></span></button></td>
							</tr>
						</tbody>
						<tfoot>
						</tfoot>
					</table>
					<button style="margin-top:-25px;" type="button" data-toggle="modal" data-target="#addkode" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Kode</button>
			   </div>
			</form>
				<div class="form-horizontal">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
							<label for="Nomor" class="col-sm-3  control-label">Terbilang :</label>
								<div class="col-sm-9">
									<input class="form-control" disabled="disabled" id="terbilang" name="terbilang" value=""/>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
							<label for="Nomor" class="col-sm-3 col-sm-offset-2 control-label">Total :</label>
								<div class="col-sm-6">
									<input class="form-control" disabled="disabled" id="total" name="total" value=""/>
								</div>
							</div>
							<div class="form-group">
							<label for="Nomor" class="col-sm-3 col-sm-offset-2 control-label">Masuk Ke :</label>
								<div class="col-sm-6" >									<div id="label-kasbank">
									<select id="kasbank" name="kasbank" class="form-control">
									   <?php
										  
											foreach ($this->data['dataList']['arrKasBank'] as $row) 
											{
											   echo "<option value='".$row['IDKasBank']."'>".$row['Nama']."</option>";
											}

										?>
								   </select>								   </div>								   <button type="button" data-toggle="modal" data-target="#modalKasBank" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Kas Bank</button>
								</div>																
							</div>
							
						</div>
					</div>
				</div>
			</div>
		
			<div class="form-horizontal footer">
				<div class="row" id="addcol">
					<div class="col-sm-6">
						<button onclick="adddataBKM()" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Simpan Data</button>
						<button onclick="adddataprint('<?php echo  $idx ?>')" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-print"></span> Simpan Data dan Cetak</button>
						<button onclick="batal()" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-minus-sign"></span> Batal</button>
					</div>
				</div>
				
				<div class="row" id="editcol">
					<div class="col-sm-6">
						<button onclick="editdataBKM('<?php echo  $idx ?>')" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-pencil"></span> Edit Data</button>
						<button onclick="editdataprint('<?php echo  $idx ?>')" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-print"></span> Edit Data dan Cetak</button>
						<button onclick="batal()" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-minus-sign"></span> Batal</button>
					</div>
				</div>
			</div>
		
		</div>
	</div>
</div>

<div class="modal fade" id="modalKasBank">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Master Kas Bank</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal">
		<form id="add-kasbank">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
					<label for="Nomor" class="col-sm-3  control-label">Kode :</label>
						<div class="col-sm-8">
							<input class="form-control" id="kodekasbank" name="kode" value=""/>
						</div>
					</div>
					
					<div class="form-group">
					<label for="Nomor" class="col-sm-3  control-label">Nama :</label>
						<div class="col-sm-8">
							<input class="form-control" id="namakasbank" name="nama" value=""/>
						</div>
					</div>
					
					<div class="form-group">
					<label for="Nomor" class="col-sm-3  control-label">No Rekening :</label>
						<div class="col-sm-8">
							<input class="form-control" id="norek" name="norek" value=""/>
						</div>
					</div>
					
					<div class="form-group">
					<label for="Nomor" class="col-sm-3  control-label">Nama Bank :</label>
						<div class="col-sm-8">
							<input class="form-control" id="namabank" name="namabank" value=""/>
						</div>
					</div>
					
				</div>
			</div>
		</form>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addkasbank()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Rekanan</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal">
		<form id="add-rekanan">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
					<label for="Nomor" class="col-sm-3  control-label">Kode :</label>
						<div class="col-sm-8">
							<input class="form-control" id="koderekanan" name="kode" value=""/>
						</div>
					</div>
					
					<div class="form-group">
					<label for="Nomor" class="col-sm-3  control-label">Nama :</label>
						<div class="col-sm-8">
							<input class="form-control" id="namarekanan" name="nama" value=""/>
						</div>
					</div>
					
					<div class="form-group">
					<label for="Nomor" class="col-sm-3  control-label">Alamat :</label>
						<div class="col-sm-8">
							<input class="form-control" id="alamat" name="alamat" value=""/>
						</div>
					</div>
					
					<div class="form-group">
					<label for="Nomor" class="col-sm-3  control-label">Telepone :</label>
						<div class="col-sm-8">
							<input class="form-control" id="telp" name="telp" value=""/>
						</div>
					</div>
					
					<div class="form-group">
					<label for="Nomor" class="col-sm-3  control-label">Kontak Tipe :</label>
						<div class="col-sm-8">
							<select id="kontaktipe" name="kontaktipe" class="form-control">
								  <?php 
										foreach ($this->data['dataList']['arrKontakTipe'] as $row) 
										{
										   echo "<option value='".$row['IDKontakTipe']."'>".$row['NamaKontakTipe']."</option>";
										}
									?>
							   </select>
						</div>
					</div>
					
					<div class="form-group">
					<label for="Nomor" class="col-sm-3  control-label">Kontak Jenis :</label>
						<div class="col-sm-8">
							<select id="kontakjenis" name="kontakjenis" class="form-control">
								  <?php 
										foreach ($this->data['dataList']['arrKontakJenis'] as $row) 
										{
										   echo "<option value='".$row['IDKontakJenis']."'>".$row['NamaKontakJenis']."</option>";
										}
									?>
							   </select>
						</div>
					</div>
				</div>
			</div>
		</form>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addrekanan()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="addkode">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data Master Pemasukan</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal">
		<form id="add-kode">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
					<label for="Nomor" class="col-sm-3  control-label">Kode :</label>
						<div class="col-sm-8">
							<input class="form-control" id="kodepenerima" name="kodepenerima" value=""/>
						</div>
					</div>
					
					<div class="form-group">
					<label for="Nomor" class="col-sm-3  control-label">Nama :</label>
						<div class="col-sm-8">
							<input class="form-control" id="namapenerima" name="nama" value=""/>
						</div>
					</div>
					
				</div>
			</div>
		</form>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addkode()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<script src="<?php echo base_url()?>assets/js/func.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function(){
		
		
		var penerimaan = <?php echo $jsonOutputPenerimaan;?>;
		
			
		
		$(".autocomplate").autocomplete({
			minLength : 1,
			source : penerimaan,
			change : function(event, ui)
			{
				if(ui.item != null)
				{
					console.log(ui);
					var numid = $(this).prop("id").split("-");
					$("#kode-"+numid[1]).val(  ui.item.id );
					$("#uraian-"+numid[1]).val( ui.item.label );
				}
			}
		});
		//console.log($.parseJSON(penerimaan));
		$("#add-button").click(function(){
			//console.log($("tr > td > button").length);
			var idbutton = "delete-button-"+$("tr > td > button").length;
				lengths = $("tr > td > button").length;
				
				//min = eval(lengths)+eval(1);
			//console.log(min);
			if($("#uraian-"+lengths).length == 0)
			{
				//console.log("#kode-"+lengths);
				var row  = "<tr>";
					row += "<td><input type='text' onblur='getkode(this)' name='kode[]' id='kode-"+lengths+"' class='form-control autocomplate'/></td>";
					row += "<td><input type='text' readonly='readonly' name='uraian[]' id='uraian-"+lengths+"' class='form-control'/></td>";
					row += "<td><input type='text' style='text-align:right;'name='nominal[]' id='nominal-"+lengths+"' onblur='calculates()' onkeyup='getnumeric(this)' class='form-control'/></td>";
					row += "<td><input type='text' name='memo[]' id='memo-"+lengths+"' class='form-control'/></td>";
					row += "<td><button type='button' onclick='deleterow(this,\"\")' id='"+idbutton+"' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button></td>";
					row += "</tr>";
			}
			else
			{
				lengthss = eval(lengths) + eval(1);
				console.log(lengthss);
				var row  = "<tr>";
					row += "<td><input type='text' onblur='getkode(this)' name='kode[]' id='kode-"+lengthss+"' class='form-control autocomplate'/></td>";
					row += "<td><input type='text' readonly='readonly' name='uraian[]' id='uraian-"+lengthss+"' class='form-control'/></td>";
					row += "<td><input type='text' style='text-align:right;'name='nominal[]' id='nominal-"+lengthss+"' onblur='calculates()' onkeyup='getnumeric(this)' class='form-control'/></td>";
					row += "<td><input type='text' name='memo[]' id='memo-"+lengthss+"' class='form-control'/></td>";
					row += "<td><button type='button' onclick='deleterow(this,\"\")' id='"+idbutton+"' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button></td>";
					row += "</tr>";
			}
			$("#tabelContent tr:last").after(row);
			//alert("oke");
			
			$(document).ready(function(){
				$(".autocomplate").autocomplete({
					minLength : 1,
					source : penerimaan,
					change : function(event, ui)
					{
						if(ui.item != null)
						{
							console.log(ui);
							var numid = $(this).prop("id").split("-");
							$("#kode-"+numid[1]).val(  ui.item.id );
							$("#uraian-"+numid[1]).val( ui.item.label );
						}
					}
				});
			});
		});
		
		//resetForm();
		var idx = '<?php echo $idx; ?>';
		document.getElementById('tanggal').value = '<?php echo RealDateTime('', false); ?>'; 
        document.getElementById('nomor').value = "<?php echo GetNextNo( GetAutoNum('KAS', 'um')); ?>";
		//return false;
		
		if(idx.length > 0)
		{
			fillGetData('<?php echo $idx; ?>');
			
			$("#addcol").hide();
			//$("#editcol").hide();
			//alert("oke");
			//var total = $("#total").html().split(".");
			//parse = total[0].replace(/,/ig,"");
			//getTotalNominal = formatCurrency(parse).split(".");
			//$("#nominal").val(getTotalNominal[0]);
			//console.log(formatCurrency(parse));
		}
		else
		{
			$("#editcol").hide();
		}
		
		$("#BackToDaftar").click(function(e){
			e.preventDefault();
			var HTMLOut = ajaxFillGridJSON('transaksi/BKM');
            $('.content-wrapper').html(HTMLOut);
		});
		
		$("#btnBatal").click(function(e){
		   e.preventDefault(); 
           $(this).attr('class', 'btn btn-sm btn-danger sr-only');
           $('#btnTambahBaru').attr('class', 'btn btn-sm btn-primary');
           $('#btnRevisi').attr('class', 'btn btn-sm btn-primary sr-only');
           $('[role="inputSection"]').attr('class', 'box-body');
           resetFormTrans();
		});
		
		
		$("#btnTambahBaru").click(function(e){
			e.preventDefault();
			var TotalBKM = $("#total").html().replace(/,/g,"").split(".");
				NominalDetail = $("#nominalDetail").val().replace(/,/ig,"");
				SumBKM = parseInt(eval(TotalBKM[0]) + eval(NominalDetail));
			//console.log(SumBKM);
			//return false;
			var IDKategori = $("#kategori").val();
			var IDKontak	= $("#kontak").val();
			var Keterangan = $("#keterangan").val();
			var Nomor = $("#nomor").val();
			var NomorBukti = $("#nomorbukti").val();
			var Tanggal = $("#tanggal").val();
			var IDKasBank = $("#kasbank").val();
			var Nominal = $("#nominal").val();
			var Uraian = $("#uraian").val();
			var NominalDet = $("#nominalDetail").val();
			var Memo = $("#memo").val();
			
			if(IDKategori == "" || IDKontak == "" || Keterangan == "" || Nomor == "" || NomorBukti == "" || Tanggal == "" || IDKasBank == "" || Nominal == "" || Uraian == "" || NominalDet == "" || Memo == "")
			{
				alert("Lengkapi Data Terlebih dahulu !!");
				
				return false;
			}
			
			if(SumBKM > parseInt(Nominal.replace(/,/ig,"")))
			{
				alert("Jumlah total Kas Masuk Tidak Seimbang Dengan Nominal awal");
				return false;
			}
			
			var target = "<?php echo site_url("transaksi/inputPostBKM")?>";
			var data = {
				"IDKategori" : IDKategori,
				"IDKontak" : IDKontak,
				"Keterangan" : Keterangan,
				"NomorBukti" : NomorBukti,
				"Nomor" : Nomor,
				"Tanggal" : Tanggal,
				"IDKasBank" : IDKasBank,
				"Nominal" : Nominal.replace(/,/ig,""),
				"Uraian" : Uraian,
				"NominalDet" : NominalDet.replace(/,/ig,""),
				"Memo" : Memo
			}
			
			$.post(target, data, function(response){
				//console.log(response);
				//return false;
				$("#tabelContent").html(response);
				//if(idx.length == 0)
				//{
					//$("#tabelContent").html(response);
				//}
				//else
				//{
					//fillGridData('<?php echo $idx; ?>');
				//}
				//calculate();
			});
		});
		
		$("#btnRevisi").click(function(){
			//alert("oke");
			var target = "<?php echo site_url("transaksi/UpdateDetailBKM/")?>";
				data = {
					"IDTransDetail" : $("#hIDTransDetail").val(),
					"Uraian" : $("#uraian").val(),
					"NominalDetail" : $("#nominalDetail").val().replace(/,/ig,""),
					"Memo" : $("#memo").val()
				}
			$.post(target, data, function(e){
				//console.log(e);
				fillGridData('<?php echo $idx; ?>');
			});
		});
		
		
	});
	
	
	
	// REVISI FUNCTION //
	function addkasbank()
	{
		$("#label-kasbank").html("Loading ...");
		target = "<?php echo site_url("transaksi/add_mst_kasbank")?>";
		data = $("#add-kasbank").serialize();
		
		$.post(target, data, function(e){
			$("#label-kasbank").html(e);
			$("#modalKasBank").modal("hide");
			$("#kodekasbank").val("");
			$("#namakasbank").val("");
			$("#norek").val("");
			$("#namabank").val("");
			
		});
	}
	
	function getkode(elem)
	{
		
		var getElemID = $(elem).prop("id");
		var target = "<?php echo site_url("transaksi/getkodemstBKM")?>";
			data =  {
						"kode" : $("#"+getElemID).val()
				    }
		$.post(target, data, function(e){
			//console.log(e);
			//return false;
			var dataJson = $.parseJSON(e);
			if(dataJson.item.status)
			{
				var numid = $(elem).prop("id").split("-");
					$("#kode-"+numid[1]).val(  dataJson.item.id );
					$("#uraian-"+numid[1]).val( dataJson.item.label );
			}
			
		});
	}
	
	
	function calculates()
	{
		var tag = $("input[name='nominal[]']");
			total = 0;
		
		
		$(tag).each(function(){
			total +=+ $(this).val().replace(/,/ig,"");
		});
		
		//for(i=1;i<=tag.length;i++)
		//{
			
			//total +=+ $("#nominal-"+i).val().replace(/,/ig,"");
			
		//}
		//var num = total.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
		$("#total").val(formatCurrency(total));
		CurrToString(total);
		//console.log(total);
		
	}
	
	function CurrToString(nominal)
	{
		var target = "<?php echo site_url("transaksi/CurrToString")?>";
			data = {
				nominal : nominal
			};
			$.post(target, data, function(e){
				//console.log(e);
				$("#terbilang").val(e);
				//return e;
			});
	}
	
	function adddataBKM()
	{
		var target = "<?php echo site_url("transaksi/InputPostBKM2")?>";
			detail = $("#addkasmasuk").serialize();
			data = { 
						"nomor" : $("#nomor").val(),
						"tanggal" : $("#tanggal").val(),
						"kontak" : $("#kontak").val(),
						"catatan" : $("#catatan").val(),
						"kasbank" : $("#kasbank").val()
					}
			
			
		$.post(target, data, function(e){
			if(e)
			{
				//console.log(e);
				addDataBKMDetsil(e, detail);
			}			else			{				alert("Kode BKM Sudah ada pada database.");			}
		});
	}
	
	function addDataBKMDetsil(id, detail)
	{
		var target = "<?php echo site_url("transaksi/InputDetailPostBKM2")?>/"+id;
			data = detail;
		$.post(target, data, function(x){
			//console.log(x);
			alert("Data Telah Berhasil Disimpan !!");
			$(".content-wrapper").load("transaksi/BKM");
		})
		
	}
	
	function addrekanan()
	{
		var target = "<?php echo site_url("transaksi/InputRekanan")?>";
			data = $("#add-rekanan").serialize();
		
		$("#col-kontak").html("Loading ...");
		$.post(target, data, function(e){
			console.log(e);
			$("#col-kontak").html(e);
			$("#koderekanan").val("");
			$("#namarekanan").val("");
			$("#alamat").val("");
			$("#telp").val("");
			$("#myModal").modal("hide");
		});
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

	function defaultrow()
	{
		alert("Harus Data terlebih dahulu !!");
	}
	
	function deleterow(obj, iddet)
	{
		//console.log(iddet);
		//return false;
		var table   = document.getElementById('tabelContent');
			index	= obj.parentNode.parentNode.sectionRowIndex;
		if(iddet)
		{
			isDelete = confirm("Yakin anda akan menghapus data ini ?");
			
			if(isDelete)
			{
				var target = "<?php echo site_url("transaksi/deletePostDetail2")?>";
					data = {
						idx : iddet
					}
				
				$.post(target, data, function(e){
					console.log(e);
				});
				
				table.deleteRow(index);
				calculates();
			}
			
		}
		else
		{
			table.deleteRow(index);
			calculates();
		}
	}
	
	
	function fillGetData(Idx)
	{
		//console.log(Idx);
		
		var target = "<?php echo site_url("transaksi/getDataBKM2")?>";
			data = {
				"Idx" : Idx
			}
		$.post(target, data, function(e){
			
			var parse = $.parseJSON(e);
				table = document.getElementById("tables");
				
				rowsTab = document.getElementById("tableContent");
				//console.log(table.childNodes[3]);
			$("#nomor").val(parse.header.nomor);
			$("#tanggal").val(parse.header.tgl);
			$("#kontak").val(parse.header.idkontak);
			$("#catatan").val(parse.header.uraian);
			$("#kasbank").val(parse.header.idkasbank);
			
			table.childNodes[3].childNodes[1].remove();
			
			if(parse.datadetail.length > 0)
			{
				for(i=0;i<parse.datadetail.length;i++)
				{
					var num = eval(i)+eval(1);
					 var row             = table.childNodes[3].insertRow();
					
						colKode           = row.insertCell(0);
						colKeterangan     = row.insertCell(1);
						colNominal        = row.insertCell(2);
						colMemo           = row.insertCell(3);
						colAksi           = row.insertCell(4);
					
					colKode.innerHTML    = "<input type='hidden' name='idkasdet[]' value='"+ parse.datadetail[i].idkasdet +"'/><input type='text' onblur='getkode(this)' class='form-control autocomplate' name='kode[]' id='kode-"+num+"' value='" + parse.datadetail[i].kode + "'/>";
                    colKeterangan.innerHTML   = "<input type='text' name='uraian[]' id='uraian-"+num+"' readonly='readonly' class='form-control' value='" + parse.datadetail[i].uraian + "'/>";
                    colNominal.innerHTML    = "<input type='text' style='text-align:right' onblur='calculates()' onkeyup='getnumeric(this)' id='nominal-"+num+"' name='nominal[]' class='form-control' value='" + formatCurrency(parse.datadetail[i].nominalawal) + "'/>";
                    colMemo.innerHTML   = "<input type='text' id='memo-"+num+"' name='memo[]' class='form-control' value='" + parse.datadetail[i].memo + "'/>";
                    colAksi.innerHTML    = "<button type='button' onclick='deleterow(this,\""+parse.datadetail[i].idkasdet+"\")' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button>";
                    
					//colMemo.innerHTML      = "<span>" + memo + "</span>";
				}
			}
			
			calculates();
			
			var penerimaan = <?php echo $jsonOutputPenerimaan;?>;
			$(".autocomplate").autocomplete({
				minLength : 1,
				source : penerimaan,
				change : function(event, ui)
				{
					if(ui.item != null)
					{
						console.log(ui);
						var numid = $(this).prop("id").split("-");
						$("#kode-"+numid[1]).val(  ui.item.id );
						$("#uraian-"+numid[1]).val( ui.item.label );
					}
				}
			});
			
		});
	}
	
	function editdataBKM(idHeader)
	{
		//alert(idHeader);
		//return false;
		var target = "<?php echo site_url("transaksi/EditDataPost")?>/"+idHeader;
			data = $("#addkasmasuk").serialize();
		
		$.post(target, data, function(e){
			//console.log(e);
			var target = "<?php echo site_url("transaksi/EditDataPostHeader")?>/"+idHeader;
			var datas = {
							nomor : $("#nomor").val(),
							tanggal : $("#tanggal").val(),
							kontak : $("#kontak").val(),
							catatan : $("#catatan").val(),
							kasbank : $("#kasbank").val()
						}
			$.post(target, datas, function(ex){
				//console.log(ex);
				if(ex)
				{
					alert("Data Berhasil Diupdate !!");
					$(".content-wrapper").load("transaksi/BKM");
					
				}
			});
			
		});
	}
	
	function editdataprint(idHeader)
	{
		var getparam = editdataBKM(idHeader);
		
		if(idHeader)
		{
			var url = "<?php echo site_url("transaksi/PrintTransDetailBKM2")?>/"+idHeader;
			//console.log(url);
			//window.open(url);
			setInterval(function(){window.location.href= url},2000);
			//setInterval(function(){window.open(url);},2000);
		}
		
	}
	
	function batal()
	{
		$(".content-wrapper").load("transaksi/BKM");
	}
	
	function adddataprint()
	{
		adddataBKM();
		
		var nomor = $("#nomor").val();
		//console.log(nomor);
		//return false;
		var url = "<?php echo site_url("transaksi/PrintTransDetailBKM2ByNomor")?>/"+nomor;
		//console.log(url);
		setInterval(function(){window.location.href = url},2000);
		
	}
	
	function addkode()
	{
		var penerimaan = <?php echo $jsonOutputPenerimaan;?>;
		
		var target = "<?php echo site_url("transaksi/add_mst_kode")?>";
			data = $("#add-kode").serialize();
		$.post(target, data, function(e){
			var json = $.parseJSON(e);			if(json[0].status == true)			{
				$(function () {
					$('.autocomplate').autocomplete({ 
					minLength:1,
					source: json,
					change : function(event, ui)
						{
							if(ui.item != null)
							{
								console.log(ui);
								var numid = $(this).prop("id").split("-");
								$("#kode-"+numid[1]).val(  ui.item.id );
								$("#uraian-"+numid[1]).val( ui.item.label );
							}
						}
					});
				});								$("#namapenerima").val("");				$("#kodepenerima").val("");				$("#addkode").modal("hide");			}			else			{				alert("Kode Master telah ada di Pemasukan atau Pengeluaran");			}
			
		});
	}
	
	// END REVISI FUNCTION //
	
	function ubah(objReference)
	{
		var table = document.getElementById('tabelContent');
		var index   = objReference.parentNode.parentNode.sectionRowIndex;
		
		//console.log(table.rows[index].cells[0].childNodes[0]);
		//return false;
		$('#btnBatal').attr('class', 'btn btn-sm btn-danger');
        $('#btnTambahBaru').attr('class', 'btn btn-sm btn-primary sr-only');
        $('#btnRevisi').attr('class', 'btn btn-sm btn-primary');
        
        $('[role="inputSection"]').attr('class', 'box-body alert alert-info');
		
		document.getElementById('hIDTransDetail').value    = table.rows[index].cells[0].childNodes[0].innerHTML;
		document.getElementById('uraian').value    = table.rows[index].cells[0].childNodes[1].innerHTML;
		document.getElementById('nominalDetail').value   = table.rows[index].cells[1].childNodes[0].innerHTML;
		document.getElementById('memo').value            = table.rows[index].cells[2].childNodes[0].innerHTML;
		
		//console.log(table.rows[index].cells[0].childNodes[1]);
		
	}
	
	function hapus(objReference)
	{
		var table = document.getElementById('tabelContent');
		var index   = objReference.parentNode.parentNode.sectionRowIndex;
		
		isDelete = confirm('Yakin data akan dihapus ?');
		//console.log(table.rows[index].cells[0].childNodes[0]);
		//return false;
		if(isDelete)
		{
		
			var IDTransDetail = document.getElementById('hIDTransDetail').value    = table.rows[index].cells[0].childNodes[0].innerHTML;
				target = "<?php echo site_url("transaksi/HapusDetailBKM")?>";
				data = {
					"IDTransDetail" :IDTransDetail
				}
			$.post(target, data, function(e){
				//console.log(e);
				fillGridData('<?php echo $idx; ?>');
				calculate();
			});
		}
		
	}
	
	function setMenuZIndex(toggle)
    {
        $('header').eq(0).attr('class','main-header' + toggle);
        $('header').eq(1).attr('class','main-header' + toggle);
    }
	
	function pickup(data)
    {
       var selection = $("#ajaxDaftarSPM").jqxDataTable('getSelection');

        var dataPilih = selection[0];    


        document.getElementById('DaftarSPM').setAttribute('class', 'collapse');

        fillGridData(dataPilih.idx);

    }
	
	
	function resetFormTrans()
    {
        $("input[id=uraian]").val('');
		$("input[id=nominalDetail]").val('');
		$("input[id=memo]").val('');
    }
	
	function loadDaftarSPM(Kategori, TanggalAwal, TanggalAkhir, KataKunci)
    {

       var source = {
        dataType: "json",
        dataFields: [{
            name: "idx",
            type: "string"
        }, {
            name: "Nomor",
            type: "string"
        }, {
            name: "IDKegiatan",
            type: "string"
        }, {
            name: "IDKategori",
            type: "string"
        }, {
            name: "IDKasBank",
            type: "string"
        }, {
            name: "NilaiTukar",
            type: "string"
        }, {
            name: "NomorBukti",
            type: "string"
        },{
            name: "Tanggal",
            type: "string"
        }, {
            name: "Uraian",
            type: "string"
        }, {
            name: "Pengguna",
            type: "string"
        }, {
            name: "Nominal",
            type: "string"
        }, {
            name: "Kegiatan",
            type: "string"
        }, {
            name: "Action",
            type: "string"
        }],
        url: "transaksi/GetDaftarBKM/" + Kategori + "/" + TanggalAwal + "/" + TanggalAkhir + "/" + KataKunci,
        id: "idx"
    };

    var filterChanged = false;

    var dataAdapter = new $.jqx.dataAdapter(source, {
        loadComplete: function() {}
    });

    // create jqxDataTable.
    $("#ajaxDaftarSPM").jqxDataTable({
        source: dataAdapter,
        pageable: true,
        pagerButtonsCount: 10,
        altRows: true,
        height: '380px',
        theme: 'fresh',
        pageSize: 100,
        pagerPosition: 'bottom',
        width: '100%',
        columns: [{
            text: 'Nomor',
            align: 'center',
            dataField: 'Nomor',
            cellsalign : 'center',
            width: '10%'
        }, {
            text: 'Tanggal',
            align: 'center',
            cellsalign : 'center',
            dataField: 'Tanggal',
            width: '10%'
        }, {
            text: 'Uraian',
            align: 'center',
            dataField: 'Uraian',
            width: '25%'
        }, {
            text: 'Pengguna',
            align: 'center',
            dataField: 'Pengguna',
            width: '10%'
        },{
            text: 'Nominal',
            align: 'center',
            cellsalign : 'right',
            dataField: 'Nominal',
            width: '10%'
        }, {
            text: 'Kegiatan',
            align: 'center',
            dataField: 'Kegiatan',
            width: '25%'
        },{
            text: '',
            align: 'center',
            cellsalign : 'center',
            dataField: 'Action',
            width: '10%'
        }]
    }).on('rowDoubleClick', function(event)
		{               
			pickup();
		}); 
    }
	
	function fillGridData(Idx)
    {

        var table = document.getElementById('tabelContent');  
            table.innerHTML = '';


        var jsonData = ajaxFillGridJSON('transaksi/GetDataBKM', {IDBKM : Idx});
            
            jsonData    = $.parseJSON(jsonData);
			
            recordSet   = jsonData.daftarDataBKMDetail;
            headerData  = jsonData.headerData;
			
			
            
            //document.getElementById('kegiatan').value     = (headerData.length > 0) ? headerData[0].Kegiatan : '';
			document.getElementById('kategori').value     = (headerData.length > 0) ? headerData[0].Kategori : '';
            document.getElementById('kontak').value     = (headerData.length > 0) ? headerData[0].Kontak : '';
            document.getElementById('keterangan').value       = (headerData.length > 0) ? headerData[0].Uraian : '';
            document.getElementById('nomor').value     = (headerData.length > 0) ? headerData[0].Nomor : '';
            document.getElementById('tanggal').value      = (headerData.length > 0) ? headerData[0].Tanggal : ''; 
            document.getElementById('nomorbukti').value   = (headerData.length > 0) ? headerData[0].NomorBukti : '';
            //document.getElementById('kasbank').value      = (headerData.length > 0) ? headerData[0].KasBank : '';
            //document.getElementById('nominal').value      = (headerData.length > 0) ? headerData[0].Nominal : '';


            var i = 0;
            if (recordSet.length > 0)
            {

                for(i = 0; i < recordSet.length; i++)
                {

                    var IDTransDetail   = recordSet[i].IDTransDetail,
                        uraian          = recordSet[i].Uraian,
                        nominal         = recordSet[i].Nominal,
                        memo            = recordSet[i].Memo;

                    var row             = table.insertRow();
                
                    colUraian           = row.insertCell(0);
                    colNominal          = row.insertCell(1);
                    colMemo             = row.insertCell(2);
                    colAksi             = row.insertCell(3);

                    colNominal.style.textAlign  = 'right';

                    colUraian.innerHTML    = "<span class='sr-only'>" + IDTransDetail + "</span><span>" + uraian + "</span>";
                    colNominal.innerHTML   = "<span>"+ formatCurrency(nominal) + "</span>";
                    colMemo.innerHTML      = "<span>" + memo + "</span>";

                    colAksi.innerHTML      = "<div onclick=\"ubah(this);\" class='btn btn-xs btn-warning'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></div><div onclick=\"hapus(this);\"  style='margin-left:3px;' class='btn btn-xs btn-danger' ><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></div>";       
 
                   
                } // for(i = 0; i < recordSet.length; i++)

                calculate();
				//console.log(recordSet);
				//return false;

            }  //if (recordSet.length > 0)   
    };
	
	function print(idx)
	{
		var url = "<?php echo site_url("transaksi/PrintTransDetailBKM")?>/"+IDTransdetail+"/"+idx;
		//console.log(url);
		window.open(url);
	}
	
	function cariBKM()
	{
		var KegiatanBKM = $("#KegiatanDaftarBkm").val();
		var KategoriBKM = $("#KategoriDaftarBKM").val();
		var TanggalAwal = $("#tanggalAwal").val();
		var TanggalAkhir = $("#tanggalAkhir").val();
		var KataKunci = $("#kataKunci").val();
		
		loadDaftarSPM(KegiatanBKM, KategoriBKM, TanggalAwal, TanggalAkhir, KataKunci);
	}
	
	function calculate()
    {
		
        var table = document.getElementById('tabelContent');
		var nominalawal = $("#nominal").val().replace(/,/ig,"");

        var total = 0;
        var colNominal  = 1;

        for(i = 0; i < table.rows.length; i++)
        {
            
            var nominal = strToCurr(table.rows[i].cells[colNominal].childNodes[0].innerHTML); 
            total      += nominal;
        }    
        document.getElementById('total').innerHTML = formatCurrency(total);
		$("#terbilang").val(terbilang(total));
		//var total = $("#total").html().replace(/,/ig,"").split(.);
		//console.log(total);
		
    }
	
	function calculate2()
    {
    
        var table = document.getElementById('tabelContent');

        var total = 0;
        var colNominal  = 1;

        for(i = 0; i < table.rows.length; i++)
        {
            //console.log(table.rows[i].cells[colNominal].childNodes[0]);
            var nominal = table.rows[i].cells[colNominal].childNodes[0];
				//nominal = nominal.replace(/./ig,"").innerHTML;
            //total      += nominal;
        }    
        
		
        //document.getElementById('total').innerHTML = formatCurrency(total);
    }
	
	
    function calculateNominal()
    {
         var table = document.getElementById('tabelContent');

        var total       = 0;
        var colNominal  = 1;

        for(i = 0; i < table.rows.length; i++)
        {
            
            var nominal = strToCurr(table.rows[i].cells[colNominal].childNodes[0].innerHTML); 
            total      += nominal;
        }    

        document.getElementById('nominal').value =  total;
    }
	
	
</script>