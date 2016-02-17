<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name='author' content='PT Syncore Indonesia' />
    <!-- Favicon -->
    <link rel='shortcut icon' href='assets/images/favicons/favicon.png'/>
    <link rel='apple-touch-icon' href='assets/images/favicons/apple-touch-icon-57x57.png'>
    <link rel='apple-touch-icon' sizes='72x72' href='assets/images/favicons/apple-touch-icon-72x72.png'>
    <link rel='apple-touch-icon' sizes='114x114' href='assets/images/favicons/apple-touch-icon-114x114.png'>
    <!-- Bootstrap 3.3.2 -->
    <link href="assets/plugins/bootstrap 3.3.2/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
     <!-- Theme style -->
    <link href="assets/plugins/adminlte/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="assets/plugins/adminlte/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body id="login" class="login-page">
    <div class="login-box">

      <div style="background-color:#38356C; color:#fff; padding:10px; border-radius:10px;" class="box box-solid">     
          

          <div class="box-body">           

            <form action="user/login" method="post" class="loginForm">
              <h3 style="text-align: center;" class="form-signin-heading">SNR EXPORT FURINDO</h3>
              <h5 style="text-align: center;">Jln. Imogiri Barat KM 6.5 no 32 Yogyakarta</h5>
              <hr/>

                <input type="hidden" id="<?php echo config_item('csrf_token_name'); ?>" name="<?php echo config_item('csrf_token_name'); ?>" value="<?php echo GenerateNewCRSFHash() ?>" />
                <div class="form-group has-feedback">
                  <input name="email" type="text" class="form-control" placeholder="Email"/>
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                  <input style="margin:15px 0px" name="kataSandi" type="password" class="form-control" placeholder="Kata Sandi"/>
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                  <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-block">Login</button>
                  </div>
                </div>
            </form>
          </div>
        </div>
    </div>

    <!-- jQuery 2.1.3 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="assets/plugins/bootstrap 3.3.2/js/bootstrap.min.js" type="text/javascript"></script>   
    <!-- Ajax Generic Purpose Function -->
    <script src="assets/js/ajax/ajax.js" type="text/javascript"></script>
    <!-- modernizr -->
    <script src="assets/plugins/modernizr/modernizr-latest.js" type="text/javascript"></script>

    <script>
        $(document).ready(function(e)
        {       
            $('.loginForm').submit(function(e)
            {
                e.preventDefault();     
                sendRequestForm($(this).attr('action'), $(this).serialize(), 'loginForm');    
            });
        });     
    </script>
  </body>
</html>