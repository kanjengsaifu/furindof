<section class="content-header">        
  <h1>Admin</h1>
</section>
<section class="content">   
<div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div style="cursor:pointer;" id="REG" class="small-box bg-aqua">
        <div class="inner">
          <h3>REG</h3>
          <p>Registrasi KSM</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a onclick="change_skin(&quot;skin-purple&quot;)" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        
      </div>
    </div><!-- ./col -->
    <div style="cursor:pointer;" id="KGT" class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>KGT</h3>
          <p>Kegiatan</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a onclick="change_skin(&quot;skin-purple&quot;)" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
    <div style="cursor:pointer;" class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div id="KRY" class="small-box bg-yellow">
        <div class="inner">
          <h3>KRY</h3>
          <p>Karyawan</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a onclick="change_skin(&quot;skin-purple&quot;)" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
    <div style="cursor:pointer;" id="DEP" class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>DEP</h3>
          <p>Departemen</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a onclick="change_skin(&quot;skin-purple&quot;)" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
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
    
  </div><!-- /.row -->   
     
</section>

<script type="text/javascript">
$(document).ready(function(e){       

      $('#REG').click(function(e)
      {   
        var loadhtml = "<?php echo site_url("admin/Ksm")?>";
        $(".content-wrapper").load(loadhtml);

      });

      $('#KGT').click(function(e)
      {   
        var loadhtml = "<?php echo site_url("admin/Kegiatan")?>";
        $(".content-wrapper").load(loadhtml);

      });

      $('#KRY').click(function(e)
      {   
        var loadhtml = "<?php echo site_url("admin/Karyawan")?>";
        $(".content-wrapper").load(loadhtml);

      });

      $('#DEP').click(function(e)
      {   
        var loadhtml = "<?php echo site_url("admin/Departemen")?>";
        $(".content-wrapper").load(loadhtml);

      });      

  });

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