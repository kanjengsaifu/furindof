<div class="content-header">   
	<h1>Tambah Simpanan</h1>
</div>
<div class="content">
	<div class="box box-primary">
	  	<div class="box-body" style="min-height:500px; padding-top:30px;">
			<div class="content" style="min-height:150px !important;">
			<form id="addpinjaman" onsubmit="simpandata(); return false;">				
				<div class="col-md-6">
					
					<div class="form-horizontal">
						<div style="padding-top:10px;" class="form-group">
						  <label for="kasbank" class="control-label col-sm-4">Kode Simpanan :</label>
						  <div class="col-sm-8">          
							<input type="text" readonly id="nomor"  class="form-control" name="nomor" required/>
						  </div> <!-- <div class="col-sm-9">  -->
						</div> <!-- <div class="form-group"> -->
						<div style="padding-top:10px;" class="form-group">
						  <label for="kasbank" class="control-label col-sm-4">Nama KSM :</label>
						  <div class="col-sm-8">          
							<div class="input-group">
								<input id="idksm"  name="idksm" value="" type="hidden" class="form-control"/>
					       		<input id="namaksm" readonly name="namaksm" type="text" class="form-control"/>
						       	<span class="input-group-btn">
					       			<button type="button" class="btn btn-primary" onclick="tambahdata()"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
					       		</span>
				       		</div>
						  </div> <!-- <div class="col-sm-9">  -->
						</div> <!-- <div class="form-group"> -->
						<div style="padding-top:10px;" class="form-group">
						  <label for="kasbank" class="control-label col-sm-4">Tanggal :</label>
						  <div class="col-sm-8">
							<div class="input-group">
							  <input type="text" name="tglreg" id="tglreg" readonly="readonyl" class="form-control pull-right date">
							  <div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							  </div>
							</div>
						  </div> <!-- <div class="col-sm-9">  -->
						</div> <!-- <div class="form-group"> -->
						<!-- <div style="padding-top:10px;" class="form-group">
						  <label for="kasbank" class="control-label col-sm-4">Bunga :</label>
						  <div class="col-sm-8">          
							<input type="text" id="bunga" readonly value="0.05" class="form-control" name="bunga" required/>
						  </div> 
						</div>  -->
						<div style="padding-top:10px;" class="form-group">
						  <label for="kasbank" class="control-label col-sm-4">Jenis Simpanan :</label>
						  <div class="col-sm-8">							
							<select id="jenis" name="jenis" class="form-control">
								<option value="">--PILIH JENIS SIMPANAN--</option>
								<option value="Pokok">SIMPANAN POKON</option>
								<option value="Sukarela">SIMPANAN SUKARELA</option>								
							</select>
						  </div> 
						</div> 
						<div style="padding-top:10px;" class="form-group">						
						  <label for="kasbank" class="control-label col-sm-4"></label>
						  <div class="col-sm-8">
							<button type="submit" class="btn btn-sm btn-success">
								<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
								Simpan Data
							</button>

							<button type="button" id="printsave"  class="btn btn-sm btn-success">
								<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
								Print & Simpan Data
							</button>
							
							
						  </div> <!-- <div class="col-sm-9">  -->
						  
						</div> <!-- <div class="form-group"> -->
					</div>
					
				</div>
				<div class="col-md-6">
					<table class="table table-striped table-bordered">
						<thead>
						<tr>
							<th width="7%">No</th>
							<th width="15%">Kode</th>
							<th width="38%">Nama Nasabah</th>
							<th width="30%">Nominal</th>
							<th width="10%">Aksi </th>
							
						</tr>
						</thead>
						<tbody id="datanasabahdetail"></tbody>
					</table>
					
					<button type="button" onclick="tambahnasabah()" class="btn btn-sm btn-primary">
						<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
						Tambah Data
					</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>

<div class="modal fade" id="modalPermohonan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data KSM</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal">
		
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-md-12">
						<form id="cari-rekanan">
						<div class="form-horizontal">	
							<div class="form-group">
								<label class="control-label col-sm-5">Cari :</label>
								<div class="col-sm-6">          
									<input type="text" oninput="caripermohonan()"  id="kode_search" class="form-control" name="kode"/>
								</div> 
							</div>
						</div>
						</form>
					</div>
					<div class="col-sm-12" style="max-height:280px;overflow-y:auto; margin:20px 0px 20px 0px;">
					<table class="table table-bordered">
						<tr>
							
							<th width="15%">No</th>
							<th width="45%">Kode</th>
							<th width="15%">Nama KSM</th>
							<th width="15%">Aksi</th>
							
						</tr>
						<tbody id="caridataksm"></tbody>
					</table>
					</div>
					
				</div>
			</div>
		</div>
		
		</div>
      </div>
      <div class="modal-footer">
        *Klik tombol "Pilih" untuk memilih nasabah yang diinginkan.
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="modalSimpanan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Nasabah</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal">
		
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-md-12">
						<form id="cari-rekanan">
						<div class="form-horizontal">	
							<div class="form-group">
								<label class="control-label col-sm-5">Cari :</label>
								<div class="col-sm-6">          
									<input type="text" oninput="carinasabah()"  id="kode_search_nasabah" class="form-control" name="kode"/>
								</div> 
							</div>
						</div>
						</form>
					</div>
					<div class="col-sm-12" style="max-height:280px;overflow-y:auto; margin:20px 0px 20px 0px;">
					<table class="table table-bordered">
						<tr>
							
							<th width="15%">No</th>
							<th width="45%">Kode</th>
							<th width="15%">Nama KSM</th>
							<th width="15%">Aksi</th>
							
						</tr>
						<tbody id="caridatanasabah"></tbody>
					</table>
					</div>
					
				</div>
			</div>
		</div>
		
		</div>
      </div>
      <div class="modal-footer">
        *Klik tombol "Pilih" untuk memilih nasabah yang diinginkan.
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
$(document).ready(function(){
	
   
	$(".date").datepicker({
			format : "dd-mm-yyyy",
			startDate : new Date('<?php echo date('Y-m-d', strtotime("-".$_SESSION['Akses']." days"))?>'),
		    endDate : new Date('<?php echo date('Y-m-d', strtotime("+90 days"))?>'),
			autoclose : true,
		});	
	var tglreg = "<?php echo date("d-m-Y")?>";
	$("#tglreg").val(tglreg);	

	var num = "<?php echo $nomor?>";
	if (num == "SPM0001") {
		getnopinjam("SPM0000");
	}else{
		getnopinjam("<?php echo $mohon?>");	
	}
	});

	function tambahdatanasabah(ID)
	{
		console.log(obj);
			//return false;
		var target = "<?php echo site_url("transaksi/changeksm")?>";
		
			data = {
				id_ksm : ID
			}
			
		$.post(target, data, function(e){

		dataJson = $.parseJSON(e);
		var NamaKsm = dataJson.nama;
	        IdKsm = dataJson.idksm;
	        KodeKsm = dataJson.kode;

		var table = document.getElementById('datanasabahdetail');
		num = $("#datanasabahdetail tr").length;
		//console.log(lengths);
		//$( "p" ).insertBefore( "#foo" );
		var row = table.insertRow();
		
		var ColKode = row.insertCell(0);
		var ColNama = row.insertCell(1);
		var ColNominal = row.insertCell(2);
		var ColAngsuran = row.insertCell(3);
		var ColAksi = row.insertCell(4);	
			
		ColKode.innerHTML = KodeKsm;
		ColNama.innerHTML = "<input type='text' readonly='true' value='"+NamaKsm+"' class='form-control baikdeh' name='nmbarang[]'/> <input type='hidden' value='"+IdKsm+"' readonly='true' class='form-control' name='barang[]'/>";
		
		ColNominal.innerHTML = "<input type='text' id='statusstock-"+num+"' class='form-control'/>";
		ColAngsuran.innerHTML = "<input type='number' min='0' readonly='true'  id='jmlminta-"+num+"' class='form-control' name='jumlah[]' required/>";
		ColAksi.innerHTML = "<button onclick=deleterow(this) class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
	
			
		});
		
	}

	function tambahdataksm(ID, obj)
	{
		//console.log(obj);
			//return false;
		//tambahkontak(ID);
		var target = "<?php echo site_url("transaksi/changeksm")?>";
		$("#modalPermohonan").modal("hide");
			data = {
				id_ksm : ID
			}
			
		$.post(target, data, function(e){

		dataJson = $.parseJSON(e);
		var NamaKsm = dataJson.nama;
	        IdKsm = dataJson.idksm;
	        KodeKsm = dataJson.kode;

		$("#namaksm").val(NamaKsm);
		$("#idksm").val(IdKsm);
			
		});
		
	}

	function tambahkontak(ID)
	{
		var target = "<?php echo site_url("transaksi/changekontak2")?>";
		$("#modalSimpanan").modal("hide");
		data = {
				kode : ID
			}
		//console.log(data);
		//return false;
		$.post(target, data, function(e){		
		
		//console.log(e);
		//return false;			
			
			dataJson = $.parseJSON(e);
			var KodeNasabah = dataJson.Kode;
                NamaNasabah = dataJson.Nama;               
                IDNasabah = dataJson.ID;
			
			var table = document.getElementById('datanasabahdetail');
			trx = $("#datanasabahdetail tr").length;
			num = trx+1;

			var row = table.insertRow();
            
            var ColNoNasabah = row.insertCell(0);
            var ColKodeNasabah = row.insertCell(1);
            var ColNamaNasabah = row.insertCell(2);
            var ColNominalNasabah = row.insertCell(3);
            //var ColAngsuranNasabah = row.insertCell(4);	           
            var ColAksi = row.insertCell(4);
            
            ColNoNasabah.innerHTML = num;
            ColKodeNasabah.innerHTML = KodeNasabah;	
            ColNamaNasabah.innerHTML = NamaNasabah;	
            ColNominalNasabah.innerHTML = "<input type='number' id='nominal-"+num+"' oninput=hitungangsur('"+num+"') min='500' max='10000000' step='100' class='form-control' name='nominal[]' required/><input type='hidden' value='"+IDNasabah+"' name='idnasabah[]'/>";
           // ColAngsuranNasabah.innerHTML = "<input type='text' id='angsuran-"+num+"' readonly class='form-control' name='angsuran[]'/><input type='hidden' value='"+IDNasabah+"' name='idnasabah[]'/>";	            
            
		});
	}

	

    function hitungangsur(hts)
	{	
		var lama  = $('#lama').val();
		if(lama == ''){
			alert("pilih lama angsuran terlebih dulu !!!");
		}else{
			var ags  = $('#nominal-'+hts).val();
				lam  = $('#lama').val();
				bung = $('#bunga').val();
				num  = ags/lam;
				csl  = num*bung;
				hsl  = csl+num;
				hks = formatDollar(hsl);
				$('#angsuran-'+hts).val(hks);		
				
		}
	}

	function formatDollar(num) {
	    var p = num.toFixed(2).split(".");
	    return "Rp " + p[0].split("").reverse().reduce(function(acc, num, i, orig) {
	        return  num + (i && !(i % 3) ? "," : "") + acc;
	    }, "") + "." + p[1];
	}
	
	
	function simpandata()
	{
		var target = "<?php echo site_url("transaksi/savesimpanan")?>";
			data = $("#addpinjaman").serialize();
			cek = $("#idksm").val();
			jenis = $('#jenis').val();
			cari = $('#datanasabahdetail tr').length;
						
		if (cek == '') {
			alert("Data Nasabah tidak boleh kosong !");
		}else if(jenis==''){
			alert("Data Jenis Simpanan tidak boleh kosong !");
		}else if(cari==0){
			alert("Tidak ada data nasabah dipilih !");
		}else{
			$.post(target, data, function(e){
				//$(".content-wrapper").html(e);
				//console.log(e);			
				//return false;
				alert("Data Berhasil Disimpan");
				var loadhtml = "<?php echo site_url("transaksi/Simpanan")?>";
				$(".content-wrapper").load(loadhtml);
				//print();
		
			});
		}
		
	}

	function simpanprintdata()
	{
		var target = "<?php echo site_url("permohonan/simpandata")?>";
			data = $("#databarang").serialize();
			
		$.post(target, data, function(e){
			//console.log(e);
			if (e==1) {
				alert("Kode barang sudah digunakan , silahkan ganti yang lain !!!");
			}else{
				alert("Data Berhasil Disimpan");
				var loadhtml = "<?php echo site_url("permohonan/permohonan")?>";
				$(".content-wrapper").load(loadhtml);
				print();
			}
		});
		
	}
	
	function print()
	{
		var target = "<?php echo site_url("permohonan/cetakprintpermohonan")?>";
		window.open(target);
	}

	function addrow()
	{
		
		var table = document.getElementById('dataksmdetail');
		
			num = $("#dataksmdetail tr").length;
		
		//console.log(lengths);
		var row = table.insertRow();
		
		var ColNamaBarang = row.insertCell(0);
		var ColJenisBarang = row.insertCell(1);
		var ColStock = row.insertCell(2);
		var ColJumlah = row.insertCell(3);
		var ColAksi = row.insertCell(4);
		
		
		
		ColNamaBarang.innerHTML = num+1;
		ColJenisBarang.innerHTML = "<input type='text' readonly='true' id='nmbarang-"+num+"' class='form-control baikdeh' name='nmbarang[]'/> <input type='hidden' readonly='true' id='idbarang-"+num+"' class='form-control' name='idbarang[]'/>";
		//ColJenisBarang.innerHTML = "<input type='text' readonly='true' id='jenis-"+num+"' class='form-control' name='jenis[]'/> <input type='hidden' readonly='true' id='idjenis-"+num+"' class='form-control' name='idjenis[]'/>";
		ColStock.innerHTML = "<input type='text' readonly='true' id='statusstock-"+num+"' class='form-control'/>";
		ColJumlah.innerHTML = "<input type='text' class='form-control' name='jumlah[]'/>";
		ColAksi.innerHTML			= "<button onclick=deleterow(this) class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
		
		
		
	}
	
	function deleterow(referance)
	{
		isDelete = confirm("Apakah Yakin menghapus data ini ?");
		if(isDelete)
		{
			var table   = document.getElementById('dataksmdetail');
			var index   = referance.parentNode.parentNode.sectionRowIndex;
			table.deleteRow(index);
		}
	}

	function tambahdata()
	{
		$("#modalPermohonan").modal("show");
		//addrow();
		caripermohonan();
			
	}

	function tambahnasabah()
	{
		$("#modalSimpanan").modal("show");
		//addrow();
		carinasabah();
			
	}

	function caripermohonan()
	{
		var target = "<?php echo site_url("transaksi/caridataksm2")?>";
		
		data = {
				kode : $("#kode_search").val()
			}
		//console.log(data);
		//return false;
		$.post(target, data, function(e){		
			
			dataJson = $.parseJSON(e);
			fillGridDistData(dataJson);
			
			
		});
	}

	function fillGridDistData(record)
    {
        var table = document.getElementById('caridataksm');
        NO = $('.baikdeh').length;
        wy = NO-1;
        table.innerHTML = '';
        if (record.status==true){
	        for(i = 0; i<record.ksm.length; i++)
	        {
	            var KodeKsm = record.ksm[i].Kode;
	                NamaKsm = record.ksm[i].Nama;
	                NoKsm = record.ksm[i].NO;
	                ID = record.ksm[i].ID;
	                
	            var row = table.insertRow();
	            
	            var ColNoKsm = row.insertCell(0);
	            var ColKodeKsm = row.insertCell(1);
	            var ColNamaKsm = row.insertCell(2);	           
	            var ColAksi = row.insertCell(3);
	            
	            ColNoKsm.innerHTML = NoKsm;
	            ColKodeKsm.innerHTML = KodeKsm;
	            ColNamaKsm.innerHTML = NamaKsm;	            
	            ColAksi.innerHTML = "<button onclick=tambahdataksm("+ID+","+wy+") class='btn btn-xs btn-warning'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Pilih</button>";
	            
	        }
	    }
    }

    function carinasabah()
	{
		var target = "<?php echo site_url("transaksi/caridatanasabah")?>";
		
		data = {
				kode : $("#kode_search_nasabah").val(),
				ksm2 : $("#idksm").val()
			}
		//console.log(data);
		//return false;
		$.post(target, data, function(e){		
			
			dataJson = $.parseJSON(e);
			fillGridDistDataNasabah(dataJson);
			
			
		});
	}

	function fillGridDistDataNasabah(record)
    {
        var table = document.getElementById('caridatanasabah');
        NO = $('.baikdeh').length;
        wy = NO-1;
        table.innerHTML = '';
        if (record.status==true){
	        for(i = 0; i<record.ksm.length; i++)
	        {
	            var KodeKsm = record.ksm[i].Kode;
	                NamaKsm = record.ksm[i].Nama;
	                NoKsm = record.ksm[i].NO;
	                ID = record.ksm[i].ID;
	                
	            var row = table.insertRow();
	            
	            var ColNoKsm = row.insertCell(0);
	            var ColKodeKsm = row.insertCell(1);
	            var ColNamaKsm = row.insertCell(2);	           
	            var ColAksi = row.insertCell(3);
	            
	            ColNoKsm.innerHTML = NoKsm;
	            ColKodeKsm.innerHTML = KodeKsm;
	            ColNamaKsm.innerHTML = NamaKsm;	            
	            ColAksi.innerHTML = "<button onclick=tambahkontak("+ID+") class='btn btn-xs btn-warning'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Pilih</button>";
	            
	        }
	    }
    }

    function getnopinjam(param)
	{
		
		getNum = param.split("M");
		Nums = parseInt(getNum[1]);
		Num  = eval(Nums) + 1;
		
		
		if(Num <= 9)
		{
			code = getNum[0]+"M"+"000"+Num;
		}
		else if(Num > 9 && Num <= 99)
		{
			code = getNum[0]+"M"+"00"+Num;
		}
		else if(Num > 99 && Num <= 999)
		{
			code = getNum[0]+"M"+"0"+Num;
		}
		else
		{
			code = getNum[0]+"M"+Num;
		}
		$("#nomor").val(code);
		return code;
	}
	
	
</script>