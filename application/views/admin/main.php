
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PSEKP Admin | <?php echo $page;?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Developed By M Abdur Rokib Promy">
    <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url();?>assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo base_url();?>assets/css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url();?>assets/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo base_url();?>assets/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <!-- <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" /> -->

    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url();?>assets/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /> -->
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- Theme style -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css" />

    <?php if ($page=="Manage Pelatihan"): ?>
        <!-- Daterange picker -->
        <link href="<?php echo base_url();?>assets/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />

    <?php endif ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->

          <style type="text/css">

          </style>
      </head>
      <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo site_url().'/admin' ?>" class="logo">
                PSEKP
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span><?php echo $name;?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                
                                        <li>
                                            <a href="<?php echo site_url().'/admin/logout' ?>">
                                            	<i class="fa fa-ban fa-fw pull-right"></i> Logout
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>
                <div class="wrapper row-offcanvas row-offcanvas-left">
                    <!-- Left side column. contains the logo and sidebar -->
                    <aside class="left-side sidebar-offcanvas">
                        <!-- sidebar: style can be found in sidebar.less -->
                        <section class="sidebar">
                            <!-- Sidebar user panel -->
                            <div class="user-panel">
                                <div class="pull-left image">
                                    <img src="<?php echo base_url();?>images/etc/admin_pic.png" class="img-circle" alt="User Image" />
                                </div>
                                <div class="pull-left info">
                                    <p>Hello, <?php echo $username;?></p>

                                    <a href="#"><?php echo $name;?></a>
                                </div>
                            </div>
                           
                            <!-- sidebar menu: : style can be found in sidebar.less -->
                            <ul class="sidebar-menu">
                                <li class="<?php echo ($page=='Dashboard') ? 'active' : '' ;?>">
                                    <a href="<?php echo site_url().'/admin' ?>">
                                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                                    </a>
                                </li>
                                <li class="<?php echo ($page=='Manage Peserta') ? 'active' : '' ;?>">
                                    <a href="<?php echo site_url().'/admin/managepeserta' ?>">
                                        <i class="fa fa-gavel"></i> <span>Manage Peserta</span>
                                    </a>
                                </li>

                                <li class="<?php echo ($page=='Manage Pengajar') ? 'active' : '' ;?>">
                                    <a href="<?php echo site_url().'/admin/managepengajar' ?>">
                                        <i class="fa fa-globe"></i> <span>Manage Pengajar</span>
                                    </a>
                                </li>

                                <li class="<?php echo ($page=='Manage Pelatihan') ? 'active' : '' ;?>">
                                    <a href="<?php echo site_url().'/admin/managepelatihan' ?>">
                                        <i class="fa fa-glass"></i> <span>Manage Pelatihan</span>
                                    </a>
                                </li>

                                <li class="<?php echo ($page=='Pendaftaran Berkelompok') ? 'active' : '' ;?>">
                                    <a href="<?php echo site_url().'/admin/pendaftaranberkelompok' ?>">
                                        <i class="fa fa-glass"></i> <span>Pendaftaran Berkelompok</span>
                                    </a>
                                </li>
                                <!--<li class="<?php echo ($page=='Log Out') ? 'active' : '' ;?>">
                                    <a href="<?php echo site_url().'/admin/logout' ?>">
                                        <i class="fa fa-glass"></i> <span>Log Out</span>
                                    </a>
                                </li>-->

                            </ul>
                        </section>
                        <!-- /.sidebar -->
                    </aside>

                    <aside class="right-side">

                <!-- Main content -->
                <section class="content">
               		 <?php 
               		 
		                if($page == 'Dashboard')
		                {
		                    $this->load->view('admin/v_dashboard');
		                }
		                else if($page == 'Manage Peserta')
		                {
		                    $this->load->view('admin/v_managepeserta');
		                }else if($page == 'Manage Pengajar')
		                {
		                    $this->load->view('admin/v_managepengajar');
		                }else if($page == 'Manage Pelatihan')
		                {
		                    $this->load->view('admin/v_managepelatihan');
		                }else if($page == 'Pendaftaran Berkelompok')
                        {
                            $this->load->view('admin/v_pendaftaranberkelompok');
                        }
		                    
		            ?>

                </section><!-- /.content -->
                
            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.min.js" type="text/javascript"></script>

        <!-- jQuery UI 1.10.3 -->
        <script src="<?php echo base_url();?>assets/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js" type="text/javascript"></script>


        <script src="<?php echo base_url();?>assets/js/plugins/chart.js" type="text/javascript"></script>

        <!-- datepicker
        <script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>-->
        <!-- Bootstrap WYSIHTML5
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>-->
        <!-- iCheck -->
        <script src="<?php echo base_url();?>assets/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- calendar -->
        <script src="<?php echo base_url();?>assets/js/plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>

        <!-- Director App -->
        <script src="<?php echo base_url();?>assets/js/Director/app.js" type="text/javascript"></script>

        <!-- Director dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo base_url();?>assets/js/Director/dashboard.js" type="text/javascript"></script>

        <script src="<?php echo base_url();?>assets/js/plugins/bs-datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>


        <?php if ($page=="Manage Pelatihan"): ?>
                 <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
                <!-- daterangepicker -->
                <script src="<?php echo base_url();?>assets/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

        <?php endif ?>

        <!-- Director for demo purposes -->
        <script type="text/javascript">
            $('input').on('ifChecked', function(event) {
                // var element = $(this).parent().find('input:checkbox:first');
                // element.parent().parent().parent().addClass('highlight');
                $(this).parents('li').addClass("task-done");
                console.log('ok');
            });
            $('input').on('ifUnchecked', function(event) {
                // var element = $(this).parent().find('input:checkbox:first');
                // element.parent().parent().parent().removeClass('highlight');
                $(this).parents('li').removeClass("task-done");
                console.log('not');
            });

        </script>
        <script>
                $('#noti-box').slimScroll({
                    height: '400px',
                    size: '5px',
                    BorderRadius: '5px'
                });

                $('input[type="checkbox"].flat-grey, input[type="radio"].flat-grey').iCheck({
                    checkboxClass: 'icheckbox_flat-grey',
                    radioClass: 'iradio_flat-grey'
                });


    </script>

    <script type="text/javascript">
        <?php if ($page=="Manage Pelatihan"): ?>
            $('input[name="daterange"]').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY h:mm'
                }
            });
        <?php endif ?>
    </script>

   

</body>
</html>