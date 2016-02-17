<section class="content-header">        
	<h1>Transaksi</h1>
</section>
<section class="content">   
<!-- <div class="row">
    <div class="col-lg-3 col-xs-6">
      
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>REG</h3>
          <p>Registrasi KSM</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" onclick="change_skin(&quot;skin-purple&quot;)" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      
      <div class="small-box bg-green">
        <div class="inner">
          <h3>KGT</h3>
          <p>Kegiatan</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" onclick="change_skin(&quot;skin-purple&quot;)" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>KRY</h3>
          <p>Karyawan</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" onclick="change_skin(&quot;skin-purple&quot;)" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      
      <div class="small-box bg-red">
        <div class="inner">
          <h3>DEP</h3>
          <p>Departemen</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" onclick="change_skin(&quot;skin-purple&quot;)" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    
  </div> -->  

  <div class="row">
    <?php
     $masuk = $this->db->query("SELECT kode, trx_kas_det.uraian, sum(nominal) as nominal, jenis from trx_kas_det inner join trx_kas 
        on trx_kas.id_kas = trx_kas_det.id_kas where kode in (select kode_pemasukan from mst_pemasukan) 
        or kode in (select kode_pengeluaran from mst_pengeluaran) and jenis='um'")->row();
     $keluar = $this->db->query("SELECT kode, trx_kas_det.uraian, sum(nominal) as nominal, jenis from trx_kas_det inner join trx_kas 
        on trx_kas.id_kas = trx_kas_det.id_kas where kode in (select kode_pemasukan from mst_pemasukan) 
        or kode in (select kode_pengeluaran from mst_pengeluaran) and jenis='uk'")->row();
    ?>

      <div class="col-md-4 col-sm-6 col-xs-12">

        <div class="info-box">

          <span class="info-box-icon bg-aqua" style="height:75px;line-height:75px;"><i class="fa fa-money"></i></span>

          <div class="info-box-content">

            <span class="info-box-text">Saldo Bulan Ini</span>

            <span class="info-box-number" style="margin-bottom:3px;font-size:30px;"><span id="pemasukanAjax">0</span></span>

          </div><!-- /.info-box-content -->

           <span class="info-box-text">

              <div class="box box-solid bg-aqua collapsed-box" style="margin-bottom:0px">

                  <div class="box-header">

                    <i class="fa fa-th"></i>

                    <h3 class="box-title" style="font-size:13px"><a href="#" onclick="tranShow('BKM')" style="color:white">Lihat Rincian</a></h3>

                  </div>

                  <div class="box-body border-radius-none" style="display: none;"></div><!-- /.box-body -->

                  <div class="box-footer no-border" style="display: none;"></div><!-- /.box-footer -->

              </div> <!-- <div class="box box-solid bg-green collapsed-box"> -->

            </span>  

        </div><!-- /.info-box -->

      </div><!-- /.col -->



      <!-- fix for small devices only -->

      <div class="clearfix visible-sm-block"></div>



      <div class="col-md-4 col-sm-6 col-xs-12">

        <div class="info-box">

          <span class="info-box-icon bg-green" style="height:75px;line-height:75px;"><i class="fa fa-arrow-right"></i></span>

          <div class="info-box-content">

            <span class="info-box-text">Pemasukan Bulan Ini</span>

            <span class="info-box-number" style="margin-bottom:3px;font-size:30px;"><span id="pemasukanAjax"><?php echo rp($masuk->nominal); ?></span></span>

          </div><!-- /.info-box-content -->

           <span class="info-box-text">

              <div class="box box-solid bg-green collapsed-box" style="margin-bottom:0px">

                  <div class="box-header">

                    <i class="fa fa-th"></i>

                    <h3 class="box-title" style="font-size:13px"><a href="#" onclick="tranShow('BKM')" style="color:white">Lihat Rincian</a></h3>

                  </div>

                  <div class="box-body border-radius-none" style="display: none;"></div><!-- /.box-body -->

                  <div class="box-footer no-border" style="display: none;"></div><!-- /.box-footer -->

              </div> <!-- <div class="box box-solid bg-green collapsed-box"> -->

            </span>  

        </div><!-- /.info-box -->

      </div><!-- /.col -->

      



      <div class="col-md-4 col-sm-6 col-xs-12">

        <div class="info-box">

          <span class="info-box-icon bg-red" style="height:75px;line-height:75px;"><i class="fa fa-arrow-left"></i></span>

          <div class="info-box-content">

            <span class="info-box-text">Pengeluaran Bulan Ini</span>

            <span class="info-box-number" style="margin-bottom:3px;font-size:30px;"><span id="pengeluaranAjax"><?php echo rp($keluar->nominal); ?></span></span>

          </div><!-- /.info-box-content -->

           <span class="info-box-text">

              <div class="box box-solid bg-red collapsed-box" style="margin-bottom:0px">

                  <div class="box-header">

                    <i class="fa fa-th"></i>

                    <h3 class="box-title" style="font-size:13px"><a href="#" onclick="tranShow('BKK')" style="color:white">Lihat Rincian</a></h3>

                  </div>

                  <div class="box-body border-radius-none" style="display: none;"></div><!-- /.box-body -->

                  <div class="box-footer no-border" style="display: none;"></div><!-- /.box-footer -->

              </div> <!-- <div class="box box-solid bg-red collapsed-box"> -->

          </span>    

        </div><!-- /.info-box -->

      </div><!-- /.col -->
      <div class="col-sm-6">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Agenda Kegiatan</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Nama Kegiatan</th>
                    <th>Status</th>
                    <th>Peserta</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><a href="pages/examples/invoice.html"><?php echo date('d F Y') ?></a></td>
                    <td>Rapat Pengurus</td>
                    <td><span class="label label-success">Priority</span></td>
                    <td><div class="sparkbar" data-color="#00a65a" data-height="20">Pengurus</div></td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html"><?php echo date('d F Y') ?></a></td>
                    <td>Pelatihan Administrasi</td>
                    <td><span class="label label-success">Priority</span></td>
                    <td><div class="sparkbar" data-color="#00a65a" data-height="20">Pengurus</div></td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html"><?php echo date('d F Y') ?></a></td>
                    <td>Pencairan Dana</td>
                    <td><span class="label label-success">Priority</span></td>
                    <td><div class="sparkbar" data-color="#00a65a" data-height="20">Pengurus & Nasabah</div></td>
                  </tr>                    
                </tbody>
              </table>
            </div><!-- /.table-responsive -->
          </div><!-- /.box-body -->
          <div class="box-footer clearfix">
            <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Tambah Kegiatan</a>
            <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">Lihat Semua</a>
          </div><!-- /.box-footer -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    <div class="col-sm-6">
    <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Pemasukan dan Pengeluaran</h3>
        </div>
        <div class="box-body chart-responsive">
          <div class="chart" id="bar-chart" style="height: 300px;"></div>
        </div><!-- /.box-body -->
      </div>
    </div>

</div> 
     
</section>
<script type="text/javascript">
var bar = new Morris.Bar({
      element: 'bar-chart',
      resize: true,
      data: [
        {y: 'Januari', a: 100, b: 90},
        {y: 'Februari', a: 75, b: 65},
        {y: 'Maret', a: 50, b: 40},
        {y: 'April', a: 75, b: 65},
        {y: 'Mei', a: 50, b: 40},
        {y: 'Juni', a: 75, b: 65},
        {y: 'Juli', a: 100, b: 90}
      ],
      barColors: ['#00a65a', '#f56954'],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['CPU', 'DISK'],
      hideHover: 'auto'
    });
</script>