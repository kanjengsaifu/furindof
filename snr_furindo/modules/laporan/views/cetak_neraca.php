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
<label style="font-family:courier; font-size:18px; ">SNR EKSPOR FURINDO</label><br>
<label style="font-family:courier; font-size:18px; ">Kunden RT05, Sendangsari, Pajangan, Bantul, Yogyakarta</label><br>
<label style="font-family:courier; font-size:18px; ">NERACA</label><br>
<label style="font-family:courier; font-size:12px; ">PER : <?php $Sampai=$_POST['Sampai'];echo $Sampai; ?></label><br>
</p>
<table id="tables"  width="100%" cellspacing="10" aria-describedby="tabel transaksi" role="grid" class="table table-bordered" style="font-family:courier; font-size:14px;">
    
    <tr role="row">
      <td colspan="3" width="650" style="text-align:left;"><b>AKTIVA</b></td>                                          
    </tr>            
    <tbody name="tabelContent" id="tabelContent">
    <?php 
      $jml = 0;   
      $Dari=$_POST['Dari'];
      $Sampai=$_POST['Sampai'];
        
      $a=0; 
      foreach ($aktiva->result() as $kas) { 
      $ajs = $this->db->query("SELECT * from ajs_jurnal_detail where akun ='".$kas->kode_kasbank."' AND id_ajs_jurnal=".$idz."")->row();
      $ajsNilai=!isset($ajs->nominal)?0:$ajs->nominal;
      $aktif = $this->db->query("SELECT kode_kasbank,nama_kasbank, sum(nominal) as total from mst_kasbank left join trx_jurnal on mst_kasbank.kode_kasbank =
                trx_jurnal.akun where status = 0 and level !=0 and (trx_jurnal.tgl BETWEEN '".$mulai."' AND '".$akhir."') and trx_jurnal.akun='".$kas->kode_kasbank."'")->row(); 
      $a++;
        $jml += $aktif->total+$ajsNilai; ?>
        
      <tr>
        <td style="text-align:center;"><?php echo $kas->kode_kasbank; ?></td>
        <td><?php echo $kas->nama_kasbank; ?></td>
        <td style="text-align:right;"><?php echo rp($aktif->total+$ajsNilai); ?></td>               
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
              $jml_pasiva= 0; 
              $jml_hutang =0; 
                
              $a=0; 
              foreach ($pasiva->result() as $kas1) { 
              $ajs = $this->db->query("SELECT * from ajs_jurnal_detail where akun ='".$kas1->kode_kasbank."' AND id_ajs_jurnal=".$idz."")->row();
              $ajsNilai=!isset($ajs->nominal)?0:$ajs->nominal;
              $pasif = $this->db->query("SELECT kode_kasbank,nama_kasbank, sum(nominal) as total from mst_kasbank left join trx_jurnal on mst_kasbank.kode_kasbank =
                trx_jurnal.akun where status = 1 and mst_kasbank.id_induk =38 and (trx_jurnal.tgl BETWEEN '".$mulai."' AND '".$akhir."') and trx_jurnal.akun='".$kas1->kode_kasbank."'")->row();
              $a++;
                $kas1->total = $pasif->total+$ajsNilai;
                if($kas1->total < 0){
                  $kas1->total = $kas1->total*-1;
                }
                
                $jml_pasiva += $kas1->total;
                $jml_hutang += $kas1->total; ?>
                
            
        
      <tr>
        <td style="text-align:center;"><?php echo $kas1->kode_kasbank; ?></td>
        <td><?php echo $kas1->nama_kasbank; ?></td>
        <td style="text-align:right;"><?php echo rp($kas1->total); ?></td>                
      </tr>
    <?php } ?>    
    <tr>
                <td></td>
                <td colspan="1" style="text-align:left;"><b>Total Hutang</b></td>
                <td style="text-align:right;"><b><?php echo 'Rp '.number_format($jml_hutang).'.00'; ?></b></td>
              </tr> 

      
     <tr>
                <td colspan="3" style="text-align:left; background: #A19DE2;">EKUITAS</td>                
              </tr>
            <?php 
              $jml_ekuitas = 0;   
                
              $a=0; 
              foreach ($ekuitas->result() as $kas2) { 
              $ajs = $this->db->query("SELECT * from ajs_jurnal_detail where akun ='".$kas2->kode_kasbank."' AND id_ajs_jurnal=".$idz."")->row();
              $ajsNilai=!isset($ajs->nominal)?0:$ajs->nominal;
              $ekuit = $this->db->query("SELECT kode_kasbank,nama_kasbank, sum(nominal) as total from mst_kasbank left join trx_jurnal on mst_kasbank.kode_kasbank =
                trx_jurnal.akun where status = 1 and mst_kasbank.id_induk =46 and (trx_jurnal.tgl BETWEEN '".$mulai."' AND '".$akhir."') and trx_jurnal.akun='".$kas2->kode_kasbank."'")->row();
              $a++;
                $kas2->total = $ekuit->total+$ajsNilai;
                if($kas2->total < 0){
                  $kas2->total = $kas2->total*-1;
                }
                
                $jml_pasiva += $kas2->total;
                $jml_ekuitas += $kas2->total; ?>
              <tr>
                <td style="text-align:center;"><?php echo $kas2->kode_kasbank; ?></td>
                <td><?php echo $kas2->nama_kasbank; ?></td>
                <td style="text-align:right;"><?php echo 'Rp '.number_format($kas2->total).'.00'; ?></td>               
              </tr>
            <?php } ?>
              <tr>
                <td></td>
                <td colspan="1" style="text-align:left;"><b>Total Ekuitas</b></td>
                <td style="text-align:right;"><b><?php echo 'Rp '.number_format($jml_ekuitas).'.00'; ?></b></td>
              </tr>

              <?php 
                for ($i=0; $i < 18 ; $i++) {                  
              ?>
                <tr>
                  <td colspan="3" style="color:white;">1</td>
                </tr>
              <?php } ?>    
              
              <tr>
                <td style="text-align:center;"></td>
                <td>Laba tahun berjalan</td>                
                <td style="text-align:right;"><?php $laba = $debet->nominal+$kredit->nominal; echo 'Rp '.number_format($laba).'.00'; ?></td>  
                            
              </tr>       
              
              <tr>
                <td></td>
                <td colspan="1" style="text-align:left;"><b>Jumlah</b></td>
                <td style="text-align:right;"><b><?php echo 'Rp '.number_format($jml_pasiva+$laba).'.00'; ?></b></td>
              </tr>
              <tr>
                <td colspan="3"></td>
              </tr>             
            </tbody>                
  </table>
<br>
<br>
<p style="text-align:right;">
<label style="font-family:courier; font-size:12px;">Bantul,<?php $tgl = date("d F Y"); echo $tgl; ?></label>
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