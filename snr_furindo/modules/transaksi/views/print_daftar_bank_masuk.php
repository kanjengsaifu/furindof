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
<label style="font-family:courier; font-size:18px; ">BUKU BANK</label><br>
<label style="font-family:courier; font-size:12px; ">PERIODE :<?php $tgl = date("d F ", strtotime('1-01-2016')); echo $tgl; ?> S/d <?php $tgl = date("d F Y"); echo $tgl; ?></label><br>
</p>
<table class="tg" width="100%" cellspacing="0" border="1" role="grid" class="table table-bordered" style="font-family:courier; font-size:12px; ">
            
    <tr role="row">
      <th style="text-align:center;"><b>Tanggal</b></th>
      <th style="text-align:center;"><b>Keterangan</b></th>
      <th style="text-align:center;"><b>Nomor Bukti</b></th>
      <th style="text-align:center;"><b>Masuk</b></th>
      <th style="text-align:center;"><b>Keluar</b></th>
      <th style="text-align:center;"><b>Saldo</b></th>                                          
    </tr>            
    <tbody name="tabelContent" id="tabelContent">
      <?php 
        $kas= $this->db->query("SELECT trx_kas.tgl_kas,trx_kas_det.memo,trx_kas.nomor_kas,trx_kas_det.nominal,trx_kas.jenis 
            from trx_kas_det inner join trx_kas on trx_kas.id_kas=trx_kas_det.id_kas where trx_kas.id_kasbank=3");
        $saldo_awal = $this->db->query("SELECT nominal from trx_jurnal where akun = '1.1.2'")->row();
        
        $saldo_total=0;
        $saldo=$saldo_awal->nominal;
        ?>
      <tr>
        <td style="text-align:center;"><?php $tgl = date("d-m-Y ", strtotime('1-01-2016'));  echo $tgl; ?></td>
        <td>Saldo Awal</td>
        <td></td>
        <td style="text-align:right;"></td>
        <td style="text-align:right;"></td>
        <td style="text-align:right;"><?php echo rp($saldo); ?></td>               
      </tr>
      <?php
        $a=0; foreach ($kas->result() as $kas1) { 
        $a++;
        if ($kas1->jenis == 'um') {               
        ?>
      <tr>
        <td style="text-align:center;"><?php $tgl = date("d-m-Y",strtotime($kas1->tgl_kas)); echo $tgl; ?></td>
        <td><?php echo $kas1->memo; ?></td>
        <td><?php echo $kas1->nomor_kas; ?></td>
        <td style="text-align:right;"><?php echo rp($kas1->nominal); ?></td>
        <td style="text-align:right;"></td>
        <td style="text-align:right;"><?php $saldo += $kas1->nominal; echo 'Rp '.number_format($saldo).'.00'; ?></td>               
      </tr>
      <?php } else { ?>
      <tr>
        <td style="text-align:center;"><?php $tgl = date("d-m-Y",strtotime($kas1->tgl_kas)); echo $tgl; ?></td>
        <td><?php echo $kas1->memo; ?></td>
        <td><?php echo $kas1->nomor_kas; ?></td>        
        <td style="text-align:right;"></td>
        <td style="text-align:right;"><?php echo rp($kas1->nominal); ?></td>
        <td style="text-align:right;"><?php $saldo -= $kas1->nominal; echo 'Rp '.number_format($saldo).'.00'; ?></td>               
      </tr>
      <?php } } ?>
      <tr>        
        <td style="text-align:center;" colspan="3"><b>Saldo Akhir</b></td>        
        <td style="text-align:right;"></td>
        <td style="text-align:right;"></td>
        <td style="text-align:right;"><b><?php echo rp($saldo); ?></b></td>               
      </tr>
      <!-- <tr>
        <td></td>
        <td colspan="1" style="text-align:left;"><b>Total Pemasukan</b></td>
        <td style="text-align:right;"><b><?php echo rp($ttl_masuk); ?></b></td>
      </tr> -->
            
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