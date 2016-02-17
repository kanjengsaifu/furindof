<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php $a=$_SESSION['IDUser']; ?>
    <section class="sidebar" style="height: auto;">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="assets/images/icons/user.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo 'Administrator'; ?></p>

                <a data-toggle="offcanvas" role="button" href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul style="color: white; list-style-type:none; background-color:#1D1352; padding: 10px 0px 10px 30px;">
            <a data-toggle="offcanvas" role="button" href="#"><li class="header">MAIN NAVIGATION</li></a>
        </ul>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            

        </ul>
    </section>
    
    <!-- /.sidebar -->
</aside>

<script>
$(document).ready(function(e) {

    $('a[class="sidebarMenu"]').click(function(e) {
        e.preventDefault();
        ajaxLinkURL($(this).attr('href'), 'content-wrapper');
        
    });
});
</script>
