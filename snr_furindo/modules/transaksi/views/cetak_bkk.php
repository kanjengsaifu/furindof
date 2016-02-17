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
  $kas_data = $this->db->query("SELECT * from trx_kas inner join mst_kontak on trx_kas.id_kontak = mst_kontak.id where id_kas = '".$kas."'")->row();
?>

<table class="tg" width="100%">
      
      <col style="width: 5%">
      <col style="width: 15%">
      <col style="width: 45%">
      <col style="width: 30%">      

   
   <tr> 
   <th style="border-style:none; font-size:11px; height:-10px;">
      <img src="<?php echo base_url().'assets/images/logo.png'?>" alt="Logo Bakti Husada"/>
    </th>   
    <th colspan="2" style="border-style:none; font-size:11px; height:-10px;">
      <label style="font-family:courier; font-size:11px; ">KOPERASI BINA SEJAHTERA</label><br>
      <label style="font-family:courier; font-size:11px; ">Jogotirto Berbah Sleman Yogyakarta</label><br>
      <label style="font-family:courier; font-size:11px; ">Telp : 085733299999</label>
    </th>
    <th colspan="1" style="border-style:none; font-size:11px;">
      <label style="font-family:courier; font-size:11px; ">Nomor : <?php echo $kas_data->nomor_kas; ?></label><br>
      <label style="font-family:courier; font-size:11px; ">Tanggal : <?php echo date("d F Y", strtotime($kas_data->tgl_kas)); ?></label><br>
      <label style="font-family:courier; font-size:11px; ">Kas / Bank : Kas Kecil</label>
    </th>
  </tr>   
  <tr>
      <td colspan="4" style="border-style:none;border-bottom:0px solid black; text-align:center; font-size:16px;">
        <b>BUKTI KAS / BANK KELUAR</b>
      </td>
  </tr> 

  <tr>
      <td colspan="4" style="border-style:none;border-bottom:1px solid black; font-size:11px;">
        <label style="font-family:courier; font-size:11px; ">Dibayarkan Kepada : <?php echo $kas_data->nama; ?> </label><br>
        <label style="font-family:courier; font-size:11px; ">Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $kas_data->alamat; ?></label><br>
        <label style="font-family:courier; font-size:11px; ">Untuk Pembayaran &nbsp;: <?php echo $kas_data->uraian; ?></label>
      </td>
  </tr> 
      
  <tr>
    <th class="tg-s6z2">No</th>
    <th class="tg-s6z2">Kode</th>
    <th class="tg-s6z2">Keterangan</th>
    <th class="tg-baqh">Jumlah</th>
  </tr>
  <?php 
      $data = $this->db->query("SELECT * from trx_kas_det where id_kas = '".$kas."'");
      $i=1;
      $ttl=0;
      foreach ($data->result() as $row) {
       
      
  ?>
  <tr>
    <td class="tg-s6z2"><?php echo $i; ?></td>
    <td class="tg-031e"><?php echo $row->kode; ?></td>
    <td class="tg-031e"><?php echo $row->memo; ?></td>
    <td class="tg-yw4l"><?php  $ttl += $row->nominal; echo rp($row->nominal); ?></td>
  </tr>  
  <?php $i++; }?>
  <tr>
    <td colspan="3" style="text-align:right;"><b>TOTAL</b></td>
    <td style="text-align:right;"><?php echo rp($ttl);  ?></td>
  </tr>
  <tr>      
      <td colspan="4" style="border-style:none;border-bottom:0px solid black; text-align:left; font-size:14px;">
        <b>Terbilang : <?php echo $terbilang; ?></b>
      </td>
  </tr> 
</table>
<br>
<label style="font-family:courier; font-size:12px; ">Dibuat Oleh,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:12px; ">Diperiksa Oleh,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:12px; ">Disetujui Oleh,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:12px; ">Diterima Oleh,</label>
<br><br><br><br>
<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;</u>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
   &nbsp;&nbsp;</u>
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