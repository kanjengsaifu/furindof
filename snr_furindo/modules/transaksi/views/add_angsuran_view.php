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
	<h1>Input Angsuran</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">
		<form id="addkangsuran" onsubmit="simpanreg(); return false;">
			<div class="form-horizontal">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Nomor BKM :</label>
							<div class="col-sm-8">
								<input class="form-control" readonly id="nomor" name="nomor" value=""/>
							</div>
						</div>

						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Tanggal :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly onblur="setMenuZIndex('')" onclick="setMenuZIndex(' noZIndex')" role="date" class="form-control" id="tanggal" name="tanggal" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                  </div>
							</div>
						</div>
						<div class="form-group">
						<label for="kegiatan" class="col-sm-3 control-label">Diterima Dari :</label>
							<div class="col-sm-8" id="col-kontak">								
                                <input type="text" readonly value="<?php echo $nasabah->row()->nama_ksm; ?>"  class="form-control" id="nama_ksm" >
                                <input type="hidden" id="idksm" value="<?php echo $nasabah->row()->id_ksm; ?>" name="id_ksm"/>
                                <input type="hidden" id="idpinjaman" value="<?php echo $id_pinjaman; ?>" name="id_pinjaman"/>	
							</div>							
						</div>	
						<div class="form-group">
						<label for="kegiatan" class="col-sm-3 control-label">Masuk Ke :</label>
							<div class="col-sm-8" id="col-kontak">								
                               <div class="input-group">
		                            <input type="text" readonly  class="form-control" id="kasbank" name="kasbank" required/>
		                            <input type="hidden" id="id_kasbank" name="id_kasbank" required/>
									<span class="input-group-btn">
						       			<button type="button" id="btnCariKasbank" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
						       		</span>	
					       		</div>	
							</div>							
						</div>												
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Catatan :</label>
							<div class="col-sm-8">
								<textarea class="form-control" id="catatan" name="catatan" required/></textarea>
							</div>
						</div>
					</div>				
				</div>
			</div>
			<div class="seperator">			
			<div class="header1">
				<h3>Rincian Angsuran KSM <?php echo $nasabah->row()->nama_ksm; ?></h3>
			</div>		
				
				<div class="table-responsive" style="width:90%; margin:0px auto;">     
					<table id="tables"  width="100%" cellspacing="0" aria-describedby="tabel transaksi" role="grid" class="table table-striped table-bordered">
						<thead>
							<tr role="row">
								<th style="width:15%; text-align:center;">Kode</th>
								<th style="width:37%; text-align:center;">Keterangan</th>
								<th style="width:20%; text-align:center;">Nominal</th>
								<th style="width:25%; text-align:center;">Memo</th>
								<th style="width:8%; text-align:center;">Aksi</th>
							</tr>
						 </thead>
						<tbody id="tbl_pokok">
							<tr>
								<td class="btn-primary"><b>6.1.2</b></td>
								<td colspan="4" class="btn-primary"><b>Angsuran Pokok</b></td>								
							</tr>													
							<?php $i=0; foreach ($nasabah->result() as $raw ) { $i++;
								$bunga = ($raw->nominal*$raw->bunga);
								$angsuran = number_format($raw->angsuran-$bunga);

								?>
							<tr id="baris-<?php echo $i; ?>">
								<td>
									<input type="hidden" id="cek-baris-<?php echo $i; ?>" value="1"/>
									<input type="hidden" id="id-nas-<?php echo $i; ?>" value="<?php echo $raw->id_nasabah; ?>" name="id-nas-[]"/>
									<input type="hidden" id="idpinjamandet-<?php echo $i; ?>" value="<?php echo $raw->id_pinjaman; ?>" name="id_pinjaman_det[]"/>
									<input style="width:100%; border-radius:3px;" readonly value="<?php echo $raw->kode_nasabah; ?>" onblur="getkode(this)" class="form-control autocomplate" type="text" id="kode-<?php echo $i; ?>" name="kode[]"/>
								</td>
								<td><input style="width:100%; border-radius:3px" value="Angsuran ke 1 <?php echo $raw->nama; ?>" readonly="readonly" class="form-control" type="text" id="uraian-<?php echo $i; ?>" name="uraian[]"/></td>
								<td><input style="width:100%; border-radius:3px;text-align:right;" readonly class="form-control" value="<?php echo $angsuran; ?>" type="text" onblur="calculates()" onkeyup="getnumeric(this)" id="nominal-<?php echo $i; ?>" name="nominal_pokok[]"/></td>
								<td><input style="width:100%; border-radius:3px" class="form-control" readonly value="dibayar tunai" type="text" id="memo-<?php echo $i; ?>" name="memo[]"/></td>
								<td><button type="button" onclick="ambilsimpan(this)" id="simpan-button-<?php echo $i; ?>" title="Ambil dari Simpanan" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-info-sign"></span></button></td>
							</tr>
							<?php } ?>
						</tbody>
						<tbody>
							<tr>
								<td class="btn-primary"><b>4.1.1</b></td>
								<td colspan="4" class="btn-primary"><b>Jasa / Bunga Pinjaman KSM</b></td>								
							</tr>													
							<?php $i=0; foreach ($nasabah->result() as $raw ) { $i++;
								$bunga = ($raw->nominal*$raw->bunga);
								$angsuran = number_format($bunga);

								?>
							<tr id="baris-bunga-<?php echo $i; ?>">
								<td>
									<input type="hidden" id="bunga-baris-<?php echo $i; ?>" value="1"/>
									<input type="hidden" id="id-nas-jasa-<?php echo $i; ?>" value="<?php echo $raw->id_nasabah; ?>" name="id-nas-jasa-[]"/>
									<input style="width:100%; border-radius:3px" value="<?php echo $raw->kode_nasabah; ?>" onblur="getkode(this)" class="form-control autocomplate" type="text" id="kode-<?php echo $i; ?>" name="kode-jasa[]"/>
								</td>
								<td><input style="width:100%; border-radius:3px" value="Jasa Angsuran ke 1 <?php echo $raw->nama; ?>" readonly="readonly" class="form-control" type="text" id="uraian-<?php echo $i; ?>" name="uraian-jasa[]"/></td>
								<td><input style="width:100%; border-radius:3px;text-align:right;" class="form-control" value="<?php echo $angsuran; ?>" type="text" onblur="calculates()" onkeyup="getnumeric(this)" id="nominal1-<?php echo $i; ?>" name="nominal_jasa[]"/></td>
								<td><input style="width:100%; border-radius:3px" class="form-control" value="dibayar tunai" type="text" id="memo1-<?php echo $i; ?>" name="memo-jasa[]"/></td>
								<td><button type="button" onclick="ambilbunga(this)" id="jasa-button-<?php echo $i; ?>" title="Ambil dari Simpanan" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-info-sign"></span></button></td>
							</tr>
							<?php } ?>
						</tbody>
						<tbody>
							<tr>
								<td class="btn-primary"><b>6.1.2</b></td>
								<td colspan="4" class="btn-primary"><b>Simpanan Wajib KSM</b></td>								
							</tr>													
							<?php $i=0; foreach ($nasabah->result() as $raw ) { $i++;
								$angsuran = number_format($raw->angsuran);

								?>
							<tr id="baris-wajib-<?php echo $i; ?>">
								<td>
									<input type="hidden" id="wajib-baris-<?php echo $i; ?>" value="1"/>
									<input type="hidden" id="id-nas-wajib-<?php echo $i; ?>" value="<?php echo $raw->id_nasabah; ?>" name="id-nas-wajib-[]"/>
									<input style="width:100%; border-radius:3px" value="<?php echo $raw->kode_nasabah; ?>" onblur="getkode(this)" class="form-control autocomplate" type="text" id="kodes-<?php echo $i; ?>" name="kode-wajib[]"/>
									<input type="hidden" id="nm-nasabah-<?php echo $i; ?>" value="<?php echo $raw->nama; ?>"/>
								</td>
								<td><input style="width:100%; border-radius:3px" value="Simpanan WAjib <?php echo $raw->nama; ?>" readonly="readonly" class="form-control" type="text" id="uraian-<?php echo $i; ?>" name="uraian-wajib[]"/></td>
								<td><input style="width:100%; border-radius:3px;text-align:right;" class="form-control" value="10000" type="text" onblur="calculates()" onkeyup="getnumeric(this)" id="nominal2-<?php echo $i; ?>" name="nominal_wajib[]"/></td>
								<td><input style="width:100%; border-radius:3px" class="form-control" value="dibayar tunai" type="text" id="memo2-<?php echo $i; ?>" name="memo-wajib[]"/></td>
								<td><button type="button" onclick="ambilwajib(this)" id="wajib-button-<?php echo $i; ?>" title="Ambil dari Simpanan" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-info-sign"></span></button></td>
							</tr>
							<?php } ?>
						</tbody>
						<tbody name="tabelContent" id="tabelContent">
							<tr>
								<td class="btn-primary"><b>6.1.3</b></td>
								<td colspan="3" class="btn-primary"><b>Simpanan Sukarela KSM</b></td>
								<td style="width:5%; "><button type="button" onclick="tambahnasabah()" title="Tambah data" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus-sign"></span></button></td>								
							</tr>
						</tbody>
						<tfoot>
						</tfoot>
					</table>
					<!-- <button style="margin-top:-25px;" type="button" data-toggle="modal" data-target="#addkode" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Tambah Kode</button> -->

			   </div>
			   <div class="form-horizontal">
				 <div class="row">
			   		<div class="col-sm-6">
			   			<?php $i=0; foreach ($nasabah->result() as $raw ) { $i++;?>			   			
						<div class="form-group">
						<label for="nama" class="col-sm-4 control-label">Total <?php echo $raw->nama; ?> :</label>
							<div class="col-sm-8">
								<input class="form-control" disabled="disabled" id="total-<?php echo $i; ?>" name="total_bayar[]" value=""/>								
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="col-sm-6" style="padding-right: 68px;">
						<table width="100%">
							<tr>
								<th style="width:100%; text-align:center; font-size:50px;" class="btn-success">TOTAL BAYAR</th>
							</tr>
							<tr>
								<th height="120" style="width:100%; text-align:center; font-size:50px;" id="total_bayar" class="btn-success">Rp </th>
							</tr>
						</table>

					</div>
				</div>
			</div>			
				<div class="form-horizontal">
					<div class="row">
						<div class="col-sm-6" style="padding-left: 66px; padding-top: 10px;">
							<button type="submit" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Simpan Data</button>
							<button class="btn btn-sm btn-info"><span class="glyphicon glyphicon-print"></span> Simpan Data dan Cetak</button>
							<button onclick="batal()" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-minus-sign"></span> Batal</button>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
							<label for="Nomor" class="col-sm-3 col-sm-offset-2 control-label" style="padding: 30px;"></label>
								<div class="col-sm-6">
									<input class="form-control" type="hidden" id="total" name="total" value=""/>
									<input id="kasbank" type="hidden" name="kasbank" value="1" />	
								</div>
							</div>											
						</div>
					</div>
				</div>
			</div>	
		</form>			
	</div>
</div>

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

<div class="modal fade" id="kasModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close Kasbank" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Kas Bank</h4>
      </div>
      <div class="modal-body">        
			<div id="ajaxKasbank"></div>		
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script src="<?php echo base_url()?>assets/js/func.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function(){
		var tglreg = "<?php echo date("d-m-Y")?>";
		$("#tanggal").val(tglreg);		
		getnobkm("<?php echo $bkm ?>");
		calculates();	
		
		//return false;
		
		if(0 != 0)
		{
			
			
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
			var HTMLOut = ajaxFillGridJSON('transaksi/BKK');
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
				
			});
		});

		$('#btnCariKasbank').click(function(e)

	    {

			e.preventDefault(); 		

	    	$('#alertMessage').remove();

	    	$('#kasModal').attr('class', 'modal show');  

	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	loadGridDataKas();
	    });
		
		
	});

	function loadGridDataKas(){



	     var source =

         {		

             dataType: "json",

             dataFields: [

                  { name: "idx", 			type: "string" },
                  
                  { name: "kode", 			type: "string" },

                  { name: "nama", 			type: "string" },                  

                  { name: "action", 		type: "string" }

             ],

            url : "transaksi/GetDaftarKasBank",

            id  : "idx"

         };



        var dataAdapter = new $.jqx.dataAdapter(source, {

            loadComplete: function () {		

            }

        });



       	// create jqxDataTable.

        $("#ajaxKasbank").jqxDataTable(

        {

            source: dataAdapter,

            pagerButtonsCount: 10,

            altRows: true,

            filterable: true,

            height: '400px',

            pageable : true,

            pageSize : 10,

            pagerPosition : 'bottom',

            filterMode: 'simple',

            theme: 'fresh',

            width: '100%',

            columnsResize: true,

            columns: [

              { text: 'Kode', cellsAlign: 'left', align: 'center', dataField: 'kode', width : '25%'},

              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '60%'},              

              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '15%' }

            ]

        });

	}

	function pilihKasbank(nama, idx)
	{
		var name = nama.replace(/_/g, " ");
		$('#kasbank').val(name);
		$('#id_kasbank').val(idx);
		$('#kasModal').attr('class', 'modal hide');
	}
	
	function tambahnasabah()
	{
		$("#modalSimpanan").modal("show");
		//addrow();
		carinasabah();
			
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
	            ColAksi.innerHTML = "<button onclick=tambahkontak("+NoKsm+") class='btn btn-xs btn-warning'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Pilih</button>";
	            
	        }
	    }
    }

    function tambahkontak(lengths){
			$("#modalSimpanan").modal("hide");
			var idbutton = "delete-button-"+$("tr > td > button").length;
				kode = $("#kodes-"+lengths).val();
				nama = $("#nm-nasabah-"+lengths).val();
				idnas = $("#id-nas-"+lengths).val();
				
				//min = eval(lengths)+eval(1);
			//console.log(min);
			if($("#uraian-"+lengths).length == 0)
			{
				//console.log("#kode-"+lengths);
				var row  = "<tr>";
					row += "<td><input type='text' onblur='getkode(this)' name='kode[]' id='kode-"+lengths+"' class='form-control autocomplate'/></td>";
					row += "<td><input type='text' readonly='readonly' name='uraian[]' id='uraian-"+lengths+"' class='form-control'/></td>";
					row += "<td><input type='text' style='text-align:right;'name='nominal[]' id='nominal-"+lengths+"' onblur='calculates()' onkeyup='getnumeric(this)' class='form-control'required/></td>";
					row += "<td><input type='text' name='memo[]' id='memo-"+lengths+"' class='form-control'/><input type='hidden' name='id-sr-[]' value='"+idnas+"' /></td>";
					row += "<td><button type='button' onclick='deleterow(this,\"\")' id='"+idbutton+"' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button></td>";
					row += "</tr>";
			}
			else
			{
				lengthss = eval(lengths);
				//console.log(lengthss);
				var row  = "<tr class='sukarela'>";
					row += "<td><input type='text' value='"+kode+"' onblur='getkode(this)' name='kode-sr[]' id='kode-"+lengthss+"' class='form-control autocomplate'/></td>";
					row += "<td><input type='text' value='Simpanan Sukarela "+nama+"' readonly='readonly' name='uraian-sr[]' id='uraian-"+lengthss+"' class='form-control'/></td>";
					row += "<td><input type='text' style='text-align:right;'name='nominal_sr[]' id='nominal3-"+lengthss+"' onblur='calculates()' onkeyup='getnumeric(this)' class='form-control'required/></td>";
					row += "<td><input type='text' value='dibayar tunai' name='memo-sr[]' id='memo-"+lengthss+"' class='form-control'/><input type='hidden' name='id-sr-[]' value='"+idnas+"' /></td>";
					row += "<td><button type='button' onclick='deleterow(this,\"\")' id='"+idbutton+"' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button></td>";
					row += "</tr>";
			}
			$("#tabelContent tr:last").after(row);
			
			
		}
	
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
		//alert("oke");
		var getElemID = $(elem).prop("id");
		var target = "<?php echo site_url("transaksi/getkodemstBKK")?>";
			data =  {
						"kode" : $("#"+getElemID).val()
				    }
		$.post(target, data, function(e){
			var dataJson = $.parseJSON(e);
			//console.log(e);
			//return false;
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
		var obk = $("#tbl_pokok tr").length;
			obj = obk - 1;	
			subtotal =0;	
			grand_total = 0;
			tag3 =0;	
		for (var i = 1; i <= 5; i++) {
			tag = $("#nominal-"+i).val();
			tag1 = $("#nominal1-"+i).val();
			tag2 = $("#nominal2-"+i).val();
			
			total = 0;
			total1 = 0;
			total2 = 0;
			total3 = 0;				
			//return false;
			total = parseInt(tag.replace(/,/ig,""));
			total1 = parseInt(tag1.replace(/,/ig,""));
			total2 = parseInt(tag2.replace(/,/ig,""));
			cek = $("#nominal3-"+i).length;
			if (cek == 0) {
				subtotal = total+total1+total2+total3;
			} else {
				tag3 = $("#nominal3-"+i).val();
				total3 = parseInt(tag3.replace(/,/ig,""));
				subtotal = total+total1+total2+total3;
			}
			
		
			grand_total +=+ subtotal;
			$("#total-"+i).val(formatCurrency(subtotal));
			
			
		}
		
		 $("#total_bayar").html('Rp '+formatCurrency(grand_total));
		
		
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
	
	function simpanreg()
	{
		var target = "<?php echo site_url("transaksi/saveangsuran")?>";
			data = $("#addkangsuran").serialize();
			cek = $('#kasbank').val();
		if (cek=='') {
			alert("Data Kasbank tidak boleh kosong");
			return false;
		}else{

			$.post(target, data, function(e){
				//console.log(e);
				//$(".content-wrapper").html(e);
				//return false;
				//tinymce.triggerSave();
				
				//alert("Kode barang sudah digunakan , silahkan ganti yang lain !!!");
				
				loadhtml = "<?php echo site_url("transaksi/Angsuran")?>";
				alert("Data berhasil disimpan.");
				$(".content-wrapper").load(loadhtml);
			
			});
		}
	}
	
	function addDataBKKDetsil(id, detail)
	{
		var target = "<?php echo site_url("transaksi/InputDetailPostBKK2")?>/"+id;
			data = detail;
		$.post(target, data, function(x){
			console.log(x);
			alert("Data Telah Berhasil Disimpan !!");
			$(".content-wrapper").load("transaksi/BKK");
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
	
	function ambilsimpan(obj)
	{
		var index	= obj.parentNode.parentNode.sectionRowIndex;
			cek = $("#cek-baris-"+index).val();
		if (cek == 1) {	
			$("#baris-"+index).css('background-color', 'blue');
			$("#cek-baris-"+index).val(2);
			$("#memo-"+index).val('dibayar dari simpanan KSM');
			//$("#simpan-button-"+index).button('option', 'label', 'New Title');
			$("#simpan-button-"+index).html('<span class="glyphicon glyphicon-minus-sign"></span>')
			$("#simpan-button-"+index).attr('class','btn btn-xs btn-danger');
			$("#simpan-button-"+index).attr('title', 'Batal Ambil Simpanan');
			
		} else {
			$("#baris-"+index).css('background-color', 'white');
			$("#cek-baris-"+index).val(1);
			$("#memo-"+index).val('dibayar tunai');
			$("#simpan-button-"+index).html('<span class="glyphicon glyphicon-info-sign"></span>')
			$("#simpan-button-"+index).attr('class','btn btn-xs btn-success');
			$("#simpan-button-"+index).attr('title', 'Ambil dari Simpanan');
		}
		//alert(index);
	}

	function ambilbunga(obj)
	{
		var index	= obj.parentNode.parentNode.sectionRowIndex;
			cek = $("#bunga-baris-"+index).val();
		if (cek == 1) {	
			$("#baris-bunga-"+index).css('background-color', 'blue');
			$("#bunga-baris-"+index).val(2);
			$("#memo1-"+index).val('dibayar dari simpanan KSM');
		} else {
			$("#baris-bunga-"+index).css('background-color', 'white');
			$("#bunga-baris-"+index).val(1);
			$("#memo1-"+index).val('dibayar tunai');
		}
		//alert(index);
	}

	function ambilwajib(obj)
	{
		var index	= obj.parentNode.parentNode.sectionRowIndex;
			cek = $("#wajib-baris-"+index).val();
		if (cek == 1) {	
			$("#baris-wajib-"+index).css('background-color', 'blue');
			$("#wajib-baris-"+index).val(2);
			$("#memo2-"+index).val('dibayar dari simpanan KSM');
		} else {
			$("#baris-wajib-"+index).css('background-color', 'white');
			$("#wajib-baris-"+index).val(1);
			$("#memo2-"+index).val('dibayar tunai');
		}
		//alert(index);
	}

	function deleterow(obj, iddet)
	{
		var table   = document.getElementById('tabelContent');
			index	= obj.parentNode.parentNode.sectionRowIndex;
		//console.log(obj.parentNode.parentNode.sectionRowIndex);
		//return false;
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
		
		var target = "<?php echo site_url("transaksi/getDataBKK2")?>";
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
					
					colKode.innerHTML    = "<input type='hidden'  name='idkasdet[]' value='"+ parse.datadetail[i].idkasdet +"'/><input onblur='getkode(this)' type='text' id='kode-"+num+"' class='form-control autocomplate' name='kode[]' value='" + parse.datadetail[i].kode + "'/>";
                    colKeterangan.innerHTML   = "<input type='text' name='uraian[]' id='uraian-"+num+"' readonly='readonly' class='form-control' value='" + parse.datadetail[i].uraian + "'/>";
                    colNominal.innerHTML    = "<input type='text' style='text-align:right' onblur='calculates()' onkeyup='getnumeric(this)' id='nominal-"+num+"' name='nominal[]' class='form-control' value='" + formatCurrency(parse.datadetail[i].nominalawal) + "'/>";
                    colMemo.innerHTML   = "<input type='text' id='memo-"+num+"' name='memo[]' class='form-control' value='" + parse.datadetail[i].memo + "'/>";
                    colAksi.innerHTML    = "<button type='button' onclick='deleterow(this,\""+parse.datadetail[i].idkasdet+"\")' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button>";
                    
					//colMemo.innerHTML      = "<span>" + memo + "</span>";
				}
			}
			
			calculates();		
			
			
		});
	}
	
	function editdataBKK(idHeader)
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
					$(".content-wrapper").load("transaksi/BKK");
					
					
					//console.log(ex);
				}				//window.open("transaksi/main");
			});
		});
	}
	
	function editdataprint(idHeader)
	{
		var getparam = editdataBKK(idHeader);
		var url = "<?php echo site_url("transaksi/PrintTransDetailBKK2")?>/"+idHeader;			//console.log(url);		window.open(url);
		
	}
	
	function batal()
	{
		$(".content-wrapper").load("transaksi/BKK");
	}
	
	function adddataprint()
	{
		adddataBKK();
		
		var nomor = $("#nomor").val();
		//console.log(nomor);
		//return false;
		var url = "<?php echo site_url("transaksi/PrintTransDetailBKM2ByNomor")?>/"+nomor;
		//console.log(url);
		setInterval(function(){window.location.href = url},2000);
		
	}
	
	function addkode()
	{
		
		
		var target = "<?php echo site_url("transaksi/add_mst_kode_bkk")?>";
			data = $("#add-kode").serialize();
		$.post(target, data, function(e){
			
			var json = $.parseJSON(e);
						if(json[0].status == true)			{
				$(function () {
					
					console.log(json);
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
				target = "<?php echo site_url("transaksi/HapusDetailBKK")?>";
				data = {
					"IDTransDetail" :IDTransDetail
				}
			$.post(target, data, function(e){
				//console.log(e);
				
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
	
	function getnobkm(param)
	{
		
		getNum = param.split("-");
		Nums = parseInt(getNum[1]);
		Num  = eval(Nums) + 1;
		
		
		if(Num <= 9)
		{
			code = getNum[0]+"-"+"000"+Num;
		}
		else if(Num > 9 && Num <= 99)
		{
			code = getNum[0]+"-"+"00"+Num;
		}
		else if(Num > 99 && Num <= 999)
		{
			code = getNum[0]+"-"+"0"+Num;
		}
		else
		{
			code = getNum[0]+"-"+Num;
		}
		$("#nomor").val(code);
		return code;
	}
</script>