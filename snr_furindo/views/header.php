<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SNR Furindo</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name='author' content='BINA SEJAHTERA' />
    <!-- Favicon -->
    <link rel='shortcut icon' href='assets/images/favicons/favicon.png' />
    
    <!-- Bootstrap 3.3.2 -->
    <link href="assets/plugins/bootstrap 3.3.2/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <!--bootstrap select 2-->
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/ionicons.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="assets/plugins/adminlte/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/adminlte/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="assets/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <!-- local style -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    
    <!--treeGrid bootstrap -->
    <link href="assets/plugins/treegrid/css/jquery.treegrid.css" rel="stylesheet" type="text/css" />
    <!--jqwidget-->
    <link rel="stylesheet" href="assets/plugins/jqwidgets/styles/jqx.base.css" type="text/css" />
    <!--jqwidget theme-->
    <link rel="stylesheet" href="assets/plugins/jqwidgets/styles/jqx.fresh.css" type="text/css" />
    <!--bootstrap-switch -->
    <link href="assets/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!--bootstrap editable-->
    <link href="assets/plugins/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css" />
    <!--bootstrap datepicker-->
    <link href="assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
     <!--bootstrap table-->
    <link href="assets/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
     <!--bootstrap select 2-->
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    
    <link href="assets/plugins/datatables/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!-- jQuery 2.1.3 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="assets/plugins/datatables/jquery.datatables.js"></script>
    <script src="assets/plugins/datatables/datatables.bootstrap.js"></script>

    
    <script>
        (function($)
         {
                $("title").ready(function()
                {
                    $("body").append("<div class='backDropOverlay' id='backDropOverlay'><div><img src='assets/images/loading.gif'/><span>Loading..</span></div></div>");
                    $(window).load(function(){
                         $("#backDropOverlay").remove();
                    });
                });
            }

        )(jQuery);

    </script>
    
</head>
<body class="skin-yellow fixed">
    <div class="wrapper">
        <header class="main-header">
            
            <a href="<?php base_url() ?>" class="logo"><img src="assets/images/logo1.png" /><b style="color: #FF6900; font-size:20px;"> SNR FURINDO</b>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <!-- <h1 style="margin: 0px; padding-top:5px;  height: 70px;" class="logo"> <a href="<?php base_url() ?>" /><b>SNR FURINDO</b></a></h1> -->
            <nav class="navbar navbar-static-top" role="navigation">
                
                <!-- Navbar Left -->
                <div class="navbar-custom-menu headerMenu navbar-left hidden-xs">
                    <ul class="nav navbar-nav">
                        
                        <?php foreach ($daftarGroupModul as $row) { echo '<li><a href="'.$row[ 'link_modul']. '" class="modules"><span class="icon icon-'.strtolower($row[ 'nama_modul']). '"></span>'.$row[ 'nama_modul']. '</a></li>'; } ?>
                    </ul>
                </div>
                <!-- Navbar Right -->
                <div class="navbar-custom-menu navbar-right">
                   <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                          <!-- User Account: style can be found in dropdown.less -->
                          <?php $user = $this->db->query("SELECT * from mst_karyawan where id_karyawan = '".$_SESSION['IDUser']."'"); ?>
                          <li class="dropdown user user-menu">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                              <img alt="User Image" class="user-image" src="uploads/<?php echo $user->row()->foto; ?>">
                              <span class="hidden-xs"><?php echo $daftarProfilOperator[0]['NamaLengkap']; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                              <!-- User image -->
                              <li class="user-header">
                                <img alt="User Image" class="img-circle" src="uploads/<?php echo $user->row()->foto; ?>">
                                <p>
                                  <?php echo $daftarProfilOperator[0]['NamaLengkap']." - ".$daftarProfilOperator[0]['Jabatan']; ?>
                                  <?php 
                                    $bulan = GetMonthName($daftarProfilOperator[0]['Bulan']);
                                    $tahun = $daftarProfilOperator[0]['Tahun']; 
                                  ?>
                                  <small>Member since <?php echo $bulan; ?> . <?php echo $tahun; ?></small>
                                </p>
                              </li>
                              <!-- Menu Footer-->
                              <li class="user-footer">
                                <div class="pull-left">
                                  <a class="btn btn-default btn-flat" type="button" onclick="profil(<?php echo $_SESSION['IDUser'] ?>)">Profile</a>
                                </div>
                                <div class="pull-right">
                                  <a class="btn btn-default btn-flat" href="user/logout">Logout</a>
                                </div>
                              </li>
                            </ul>
                          </li>
                        </ul>
                    </div>
                </div>

            </nav>
        </header>
        <script type="text/javascript">
        function profil(idx)
        { 
            var htmlOut = ajaxFillGridJSON('admin/profil2', {ID : idx});
            $(".content-wrapper").html(htmlOut);
        }
        </script>