<?php
  ob_start();
?>
<page footer="page">

    <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:courier;font-size:12px;padding:5px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:courier;font-size:12px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; }
.tg .tg-s6z2{text-align:center}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-yw4l{text-align:right;vertical-align:top}
</style>
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
    font-size: 18px;
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
<p style="text-align:center; font-weight:bodt">
<label style="font-family:courier; font-size:18px; ">KOPERASI BINA SEJAHTERA</label><br>
<label style="font-family:courier; font-size:18px; ">JOGOTIRTO BERBAH SLEMAN YOGYAKARTA</label><br>
<label style="font-family:courier; font-size:18px; ">NERACA</label><br>
<label style="font-family:courier; font-size:12px; ">PER : <?php $tgl = date("F Y"); echo $tgl; ?></label><br>
</p>
<table id="tables"  width="100%" cellspacing="10" aria-describedby="tabel transaksi" role="grid" class="table table-bordered" style="font-family:courier; font-size:14px;">
            
    <tr role="row">
      <td colspan="3" width="650" style="text-align:left;"><b>AKTIVA</b></td>                                          
    </tr>            
    <tbody name="tabelContent" id="tabelContent">
    <?php 
      $jml = 0;   
        
      $a=0; 
      foreach ($aktiva->result() as $kas) { 
      $a++;
        $jml += $kas->total; ?>
        
      <tr>
        <td style="text-align:center;"><?php echo $kas->kode_kasbank; ?></td>
        <td><?php echo $kas->nama_kasbank; ?></td>
        <td style="text-align:right;"><?php echo rp($kas->total); ?></td>               
      </tr>
    <?php } ?>                      
      
      <tr>
        <td></td>
        <td colspan="1" style="text-align:left;"><b>Jumlah</b></td>
        <td style="text-align:right;"><b><?php echo rp($jml); ?></b></td>
      </tr>
      <tr>
        <td colspan="3" style="text-align:left;"><b>PASSIVA</b></td>               
      </tr>
    <?php 
      $jml_pasiva = 0;    
        
      $a=0; 
      foreach ($pasiva->result() as $kas1) { 
      $a++;
        if($kas1->total < 0){
          $kas1->total = $kas1->total*-1;
        }
        
        $jml_pasiva += $kas1->total; ?>
        
      <tr>
        <td style="text-align:center;"><?php echo $kas1->kode_kasbank; ?></td>
        <td><?php echo $kas1->nama_kasbank; ?></td>
        <td style="text-align:right;"><?php echo rp($kas1->total); ?></td>                
      </tr>
    <?php } ?>    
      
      <tr>
        <td style="text-align:center;"></td>
        <td>Laba tahun berjalan</td>
        <td style="text-align:right;"><?php $laba = $debet->nominal-$kredit->nominal+32476377+11558920; echo rp($laba); ?></td>               
      </tr>       
      
      <tr>
        <td></td>
        <td colspan="1" style="text-align:left;"><b>Jumlah</b></td>
        <td style="text-align:right;"><b><?php echo rp($jml_pasiva+$laba); ?></b></td>
      </tr>
      <tr>
        <td colspan="3"></td>
      </tr>             
    </tbody>            
  </table>
<br>
<br>
<p style="text-align:right;">
<label style="font-family:courier; font-size:12px;">Jogotirto,<?php $tgl = date("d F Y"); echo $tgl; ?></label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
<label style="font-family:courier; font-size:12px;">Dibuat Oleh,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!-- label style="font-family:courier; font-size:12px; ">Diperiksa Oleh,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:12px; ">Disetujui Oleh,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:12px; ">Diterima Oleh,</label> -->
<br><br><br><br><br>
<label><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp; </u></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
   <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;</u>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;</u>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;
<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;</u> -->
</page>
<?php

  $content = ob_get_clean();

  // conversion HTML => PDF
  require_once APPPATH.'third_party/html2pdf_v4.03/html2pdf.class.php'; // arahkan ke folder html2pdf
  
  try
  {
    $html2pdf = new HTML2PDF('P','A4','fr', false, 'ISO-8859-15',array(15, 10, 0, 5)); //setting ukuran kertas dan margin pada dokumen anda
    //$html2pdf->setModeDebug();
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_Perjenis.pdf');
  }
  catch(HTML2PDF_exception $e) { echo $e; } 

?>