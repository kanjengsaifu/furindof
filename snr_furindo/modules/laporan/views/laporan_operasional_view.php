<?php //echo "<pre>";print_r($saldoAwal);"</pre>";exit();?>
<div class="content-header">   
  <h1>Catatan Oprasional Detail</h1>
</div>
<div class="content">
  <div class="box box-primary">
      <div class="box-body" style="min-height:800px;">
             <div class="box-header no-print">
                <div class="form-horizontal">
          
                       <div class="row">
                           <div class="col-sm-6">
                           <div class="form-group">
                                <label for="kasbank" class="control-label col-sm-3">Kas Oprasional:</label>
                                <div class="col-sm-9">  
                                  <div class="input-group">
                                    <input type="text" readonly  class="form-control" id="akun" name="akun" >
                                    <input type="hidden" id="kode_akun" name="kode_akun" >
                                      <span class="input-group-btn">
                                        <button type="button" id="btnCariRekanan" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
                                      </span>
                                  </div> 
                                </div> <!-- <div class="col-sm-9">  -->
                              </div> <!-- <div class="form-group"> -->							  
							
                              <div class="form-group">
                                  <label for="rangetanggal" class="control-label col-sm-3">Range Tanggal:</label>
                                  <div class="col-sm-9">          
                                    <div class="input-group">
                                      <input type="text" id="rangetanggal" read-only="readonyl" class="form-control pull-right">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                    </div>
                                  </div> <!-- <div class="col-sm-9">  -->
                              </div> <!-- <div class="form-group"> -->
                               <div class="form-group text-right">
                                  <label for="btnCariBukuKas" class="control-label col-sm-3">&nbsp;</label>
                                  <div class="col-sm-9">      
                                     <button type="button" class="btn btn-sm btn-primary" id="btnCetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak</button>       
                                    <button id="btnCariBukuKas" class="btn btn-sm btn-primary"><span class='glyphicon glyphicon-search' aria-hidden='true'></span>&nbsp;Cari</button>
                                  </div> <!-- <div class="col-sm-9">  -->
                              </div> <!-- <div class="form-group"> -->
                          </div>  <!-- <div class="col-sm-6"> -->       
                      </div>    
                </div>  <!-- <div class="form-horizontal"> -->
          </div>
		 
		 <div class="table-responsive">
			<label>Nama : <span id="headerkas"></span></label>
			</br>
			<label>Saldo Awal : <span id="saldoawal"></span></label>
          <table id="tabelData" width="100%" cellspacing="0" aria-describedby="tabel data" role="grid" class="table table-condensed table-striped table-hover table-bordered">
            <thead>
                <tr role="row">
				  <th style="width:15%;display:table-cell; vertical-align:middle">Tanggal</th>
                  <th style="width:35%;display:table-cell; vertical-align:middle">Deskripsi</th>
                  <th style="width:10%;display:table-cell; vertical-align:middle">Pemasukan</th>
                  <th style="width:10%;display:table-cell; vertical-align:middle">Pengeluaran</th>
                  <th style="width:10%;display:table-cell; vertical-align:middle">Saldo Akhir</th>
                </tr>
             </thead>
            <tbody name="tabelContent" id="tabelContent"></tbody>
            <tfoot>
            </tfoot>
          </table>   
        </div>  <!-- <div class="table-responsive"> -->
    </div> <!-- <div class="box-body"> -->
    </div>
	
	
  </div> <!-- <div class="box box-primary"> -->
</div>

<iframe id="printing-frame" name="print_frame" src="about:blank" class="sr-only"></iframe>

<script src="assets/js/func.js" type="text/javascript"></script>

<script>
  $(document).ready(function () {
                      
      resetForm();
	  
		
      $('#rangetanggal').daterangepicker({
        'buttonClasses' : "btn btn-sm btn-primary",
        'opens'         : 'right',
        'applyClass'    : "btn btn-sm btn-primary",
        'cancelClass'   : "btn btn-sm btn-success" 
      }, 
      function(start, end, label){
      });


      $('#btnCariBukuKas').click(function(e)
      {
         e.preventDefault();
		 
		 var target = "<?php echo site_url("laporan/GetDataOpsDetail") ?>";
			data = {
				"kas" : $("#kas").val(),
				"range" : $("#rangetanggal").val()
			}
			$.post(target, data, function(e){
				
				dataJson = $.parseJSON(e);
				//console.log(dataJson);
				//return false;
				$("#headerkas").html(dataJson.header);
				$("#saldoawal").html(formatCurrency(dataJson.saldoawal));
				
				if(dataJson.status == 1 || dataJson == 2)
				{
					fillGridData(dataJson.dataList, dataJson.saldoawal);
				}
				else
				{
					alert("Tidak Ada Data Transaksi.");
					fillGridData(dataJson.dataList, dataJson.saldoawal);
					
				}
			})
 
         
         
      });
  
      $('#btnCetak').click( function(e)
      {
        e.preventDefault();
		var kas = $("#kas").val();
		var tgl = $("#rangetanggal").val().split(" s/d ");
		var target = "<?php echo site_url("laporan/DataOpsDetailPrint")?>/"+kas+"/"+tgl[0]+"/"+tgl[1];
		window.open(target);
        //printArea('printArea');
		
      });  
      
    });
  
  function fillGridData(recordset, saldoAwal)
  {

    var table  = document.getElementById('tabelContent');

    table.innerHTML = '';

    if (recordset.length > 0)
    {
	  subTotal = 0;
	  saldoAwal = saldoAwal;
	  
      for(i=0 ; i< recordset.length; i++)
      {
        
			var Tanggal			= recordset[i].Tanggal;
			var Keterangan     = recordset[i].Uraian;
			if(recordset[i].Jenis == "um")
			{
				var NominalDebit	= recordset[i].Nominal;
				var NominalKredit	= 0;
			}
			else
			{
				var NominalDebit	= 0;
				var NominalKredit	= recordset[i].Nominal;
			}
			

			var row         = table.insertRow();
			
			colTanggal		   = row.insertCell(0);
			colKeterangan    = row.insertCell(1);
			colNominalDebit  = row.insertCell(2);
			colNominalKredit = row.insertCell(3);
			

			colNominalDebit.style.textAlign        = 'right';
			colNominalKredit.style.textAlign        = 'right';

			colTanggal.innerHTML = Tanggal
			colKeterangan.innerHTML     = Keterangan;
			colNominalDebit.innerHTML      = formatCurrency(NominalDebit);
			colNominalKredit.innerHTML      = formatCurrency(NominalKredit);
			
			
			if(i == 0)
			{
				subTotal +=+ (eval(saldoAwal) + eval(NominalDebit)) - eval(NominalKredit);
				Saldo = formatCurrency(subTotal);
				colSaldo = row.insertCell(4);
				
				colSaldo.style.textAlign        = 'right';
				
				colSaldo.innerHTML      = Saldo;
			}
			else
			{
				subTotal +=+ (eval(colSaldo.innerHTML) + eval(NominalDebit)) - eval(NominalKredit);
				Saldo = formatCurrency(subTotal);
				colSaldo = row.insertCell(4);
				
				colSaldo.style.textAlign        = 'right';
				
				colSaldo.innerHTML      = Saldo;
			}
			
			
			console.log(colSaldo.innerHTML);
			//var SaldoAkhir = 
		
		}
  
    }

  }

  function resetForm()
  {
   
    document.getElementById('rangetanggal').value    = '<?php echo FirstDay(date("m"), date("Y")); ?> s/d <?php echo LastDay(date("m"), date("Y")); ?>';
    document.getElementById('rangetanggal').readOnly = true; 

    $('#btnCariBukuKas').click();

  }
  
  function ubah(objReference)
  {
      var idx     = $(objReference).parent().parent().find('td:first').find('span:first').html();
      var jenis   = $(objReference).parent().parent().find('td:first').find('span:last').html();

      var htmlOut = ajaxFillGridJSON('laporan/UbahKas', {"idx" : idx, "jenis" : jenis});
      $('.content-wrapper').html(htmlOut);
  }

  function hapus(objReference)
  { 
    var idx     = $(objReference).parent().parent().find('td:first').find('span:first').html();
    var nomor   = $(objReference).parent().parent().find('td').eq(1).html();
  
    isDelete = confirm('Yakin BKK dengan nomor '+ nomor +' akan dihapus ?');

    if (isDelete)
    {
        var jsonData = ajaxItemsTrans('transaksi/HapusBKK', {idx : idx} );
  
        var isSuccess = jsonData.textStatus == 'success';
    
        $('#alertMessage, .backDropOverlay').remove();
        
        var strColor = (isSuccess) ? 'info' : 'danger';

        $('.box-body').before("<div class='alert alert-"+ strColor +"' id='alertMessage'>"+ jsonData.textInfo +"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");    

        var table   = document.getElementById('tabelContent');
        var index   = objReference.parentNode.parentNode.sectionRowIndex;

        if (isSuccess) table.deleteRow(index);

        $(window).scrollTop(0);

    }
  }

  function printArea(elementId) {
  
    var strCSS1 = ajaxFillGridJSON('assets/plugins/bootstrap 3.3.2/css/bootstrap.min.css');
    var strCSS2 = ajaxFillGridJSON('https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css '); 
    var strCSS3 = ajaxFillGridJSON('assets/plugins/adminlte/css/AdminLTE.min.css');
    var strCSS4 = ajaxFillGridJSON('assets/plugins/adminlte/css/skins/_all-skins.min.css');
    var strCSS5 = ajaxFillGridJSON('assets/css/style.css');
      
   
    var strContent = document.getElementById(elementId).innerHTML;

    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<style>'+ strCSS1 + strCSS2 + strCSS3 +  strCSS4 + strCSS5 +'</style>' + strContent; 
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
  }
                
</script>

 