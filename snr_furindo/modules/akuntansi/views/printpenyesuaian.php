<?php
  ob_start();
?>
<page footer="page">

    <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:courier, sans-serif;font-size:12px;padding:5px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:courier, sans-serif;font-size:12px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; }
.tg .tg-s6z2{text-align:center}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-yw4l{text-align:right;vertical-align:top}
</style>
<?php 
  $cek = $this->db->query("SELECT * from trx_jurnal where id_jurnal = '".$jurnal."'")->row();  
?>

<table class="tg" width="100%">
      
      <col style="width: 5%">
      <col style="width: 15%">
      <col style="width: 35%">
      <col style="width: 20%">      
      <col style="width: 20%"> 
   
   <tr> 
   <th style="border-style:none; font-size:11px; height:-10px;">
      <img src="<?php echo base_url().'assets/images/logo11.png'?>" alt="Logo Bakti Husada"/>
    </th>   
    <th colspan="3" style="border-style:none; font-size:11px; height:-10px;">
      <label style="font-family:courier; font-size:11px; ">C.V. SNR EKSPOR FURINDO</label><br>
      <label style="font-family:courier; font-size:11px; ">JL. RING ROAD SELATAN, TLAJUK/WOJO RT.7/RW.11</label><br>
      <label style="font-family:courier; font-size:11px; ">BANGUN HARJO, SEWON, BANTUL, YOGYAKARTA</label><br>
      <label style="font-family:courier; font-size:11px; ">TEL/FAX: +62-274-3057199</label>
    </th>
    <th colspan="1" style="border-style:none; font-size:11px;">
      <label style="font-family:courier; font-size:11px; ">Nomor : <?php echo $cek->nobukti; ?></label><br>
      <!-- <label style="font-family:courier; font-size:11px; ">Tanggal : <?php echo date("d F Y", strtotime($cek->tgl)); ?></label><br> -->
      <label style="font-family:courier; font-size:11px; ">Jurnal Penyesuaian</label>
    </th>
  </tr>   
  <tr>
      <td colspan="5" style="border-style:none;border-bottom:1px solid black; text-align:center; font-size:16px;">
        <b>BUKTI PEMINDAHBUKUAN</b>
      </td>
  </tr> 

  <!-- <tr>
      <td colspan="4" style="border-style:none;border-bottom:1px solid black; font-size:11px;">
        <label style="font-family:courier; font-size:11px; ">Telah Diterima Dari : <?php echo $kas_data->nama; ?> </label><br>
        <label style="font-family:courier; font-size:11px; ">Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $kas_data->alamat; ?></label><br>
        <label style="font-family:courier; font-size:11px; ">Untuk Pembayaran &nbsp;&nbsp;&nbsp;: <?php echo $kas_data->uraian; ?></label>
      </td>
  </tr>  -->
      
  <tr>
    <th class="tg-s6z2">No</th>
    <th class="tg-s6z2">Kode</th>
    <th class="tg-s6z2">Keterangan</th>
    <th class="tg-baqh">Debet</th>
    <th class="tg-baqh">Kredit</th>
  </tr>
  <?php 
      $data = $this->db->query("SELECT * from trx_jurnal where nobukti = '".$cek->nobukti."'");
      $i=1;
      $ttl=0;
      foreach ($data->result() as $row) {
       
      
  ?>
  <tr>
    <td class="tg-s6z2"><?php echo $i; ?></td>
    <td class="tg-031e"><?php echo $row->nomor; ?></td>
    <td class="tg-031e"><?php echo $row->uraian; ?></td>
    <td class="tg-yw4l"><?php if($row->akun == '41001') {echo rp($row->nominal*-1);}else{echo rp($row->nominal);} ?></td>
    <td class="tg-yw4l"><?php if($row->akun == '41001') {echo rp($row->nominal);}else{echo rp($row->nominal*-1);} ?></td>
  </tr>  
  <?php $i++; }?>
  <!-- <tr>
    <td colspan="3" style="text-align:right;"><b>TOTAL</b></td>
    <td style="text-align:right;"><?php echo rp($ttl);  ?></td>
  </tr> -->
  <!-- <tr>      
      <td colspan="4" style="border-style:none;border-bottom:0px solid black; text-align:left; font-size:14px;">
        <b>Terbilang : <?php echo $terbilang; ?></b>
      </td>
  </tr>  -->
</table>
<br><label style="text-align:left; margin-left:500px;">Bantul, <?php echo date("d F Y", strtotime($cek->tgl)); ?> </label>
<br>
<label style="margin-left:500px;">Dibuat Oleh,</label>
<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:12px; ">Diperiksa Oleh,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:12px; ">Disetujui Oleh,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:12px; ">Diterima Oleh,</label> -->
<br><br><br><br>
<u style="margin-left:500px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;</u>
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