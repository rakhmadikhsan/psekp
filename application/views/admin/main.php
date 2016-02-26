
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!--
    <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    
    -->
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
    <link href='<?php echo base_url();?>assets/css/css.css' rel='stylesheet' type='text/css'>
    <!-- Theme style -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css" />




    
    <?php 
        $sya[0]="Manage Pelatihan";
        $sya[1]="Manage Pengajar";
        $sya[2]="Detail Pelatihan";
    ?>

     <?php 
        $nam_posts[0]="Semua Post";
        $nam_posts[1]="Berita Post";
        $nam_posts[2]="Pengumuman Post";
        $nam_posts[3]="Agenda Post";
        $nam_posts[4]="Link Nav";
        $nam_posts[5]="Draft";
        $nam_posts[6]="Trash";

     ?>
    <?php if (in_array($page, $sya)): ?>
        <!-- Daterange picker -->
       <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/daterangepicker.css" />

    <?php endif ?>

    <?php if (in_array($page, $nam_posts) || ($page=="Images")): ?>
        <!-- Daterange picker -->
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css" />

    <?php endif ?>

    

    <?php 
        $syaw[0]="Sertifikat";
        $syaw[1]="Banner dan Mitra";
        $syaw[2]="Navigasi";
    ?>
    <?php if (in_array($page, $syaw)): ?>
        <!-- Daterange picker -->
        <link href="<?php echo base_url();?>assets/css/bootstrap-editable.css" rel="stylesheet"/>
        
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
                                <li class="<?php echo ($page=='Dashboard') ? 'active' : '' ;?>" <?php echo ($role==1) ? '' : 'hidden' ;?>>
                                    <a href="<?php echo site_url().'/admin' ?>">
                                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                                    </a>
                                </li>
                                <li class="<?php echo ($page=='Manage Peserta') ? 'active' : '' ;?>"  <?php echo ($role==1) ? '' : 'hidden' ;?>>
                                    <a href="<?php echo site_url().'/admin/managepeserta' ?>">
                                        <i class="fa fa-users"></i> <span>Manage Peserta</span>
                                    </a>
                                </li>

                                <li class="<?php echo ($page=='Manage Pengajar') ? 'active' : '' ;?>"  <?php echo ($role==1) ? '' : 'hidden' ;?>>
                                    <a href="<?php echo site_url().'/admin/managepengajar' ?>">
                                        <i class="fa fa-user"></i> <span>Manage Pengajar</span>
                                    </a>
                                </li>

                                <li class="<?php echo ($page=='Manage Pelatihan') ? 'active' : '' ;?>"  <?php echo ($role==1) ? '' : 'hidden' ;?>>
                                    <a href="<?php echo site_url().'/admin/managepelatihan' ?>">
                                        <i class="fa fa-calendar-o"></i> <span>Manage Pelatihan</span>
                                    </a>
                                </li>
                                <li class="<?php echo ($page=='Detail Pelatihan') ? 'active' : '' ;?>"  <?php echo ($role==1) ? '' : 'hidden' ;?>>
                                    <a href="<?php echo site_url().'/admin/detailpelatihan' ?>">
                                        <i class="fa fa-calendar-plus-o"></i> <span>Detail Pelatihan</span>
                                    </a>
                                </li>

                                <li class="<?php echo ($page=='Pendaftaran Berkelompok') ? 'active' : '' ;?>"  <?php echo ($role==1) ? '' : 'hidden' ;?>>
                                    <a href="<?php echo site_url().'/admin/pendaftaranberkelompok' ?>">
                                        <i class="fa fa-glass"></i> <span>Pendaftaran Berkelompok</span>
                                    </a>
                                </li>

                                <li class="<?php echo ($page=='Sertifikat') ? 'active' : '' ;?>"  <?php echo ($role==1) ? '' : 'hidden' ;?>>
                                    <a href="<?php echo site_url().'/admin/sertifikat' ?>">
                                        <i class="fa fa-graduation-cap"></i> <span>Sertifikat</span>
                                    </a>
                                </li>

                                <li class="<?php echo ($page=='Penilaian') ? 'active' : '' ;?>"  <?php echo ($role==1) ? '' : 'hidden' ;?>>
                                    <a href="<?php echo site_url().'/admin/penilaian' ?>">
                                        <i class="fa fa-bar-chart"></i> <span>Penilaian</span>
                                    </a>
                                </li>

                                <li class="<?php echo ($page=='Submit Penilaian') ? 'active' : '' ;?>"  <?php echo ($role==1) ? '' : 'hidden' ;?>>
                                    <a href="<?php echo site_url().'/admin/submitpenilaian' ?>">
                                        <i class="fa fa-bar-chart-o"></i> <span>Submit Penilaian</span>
                                    </a>
                                </li>

                                <li class="<?php echo ($page=='Data Penilaian') ? 'active' : '' ;?>"  <?php echo ($role==1) ? '' : 'hidden' ;?>>
                                    <a href="<?php echo site_url().'/admin/datapenilaian' ?>">
                                        <i class="fa fa-bar-chart-o"></i> <span>Data Penilaian</span>
                                    </a>
                                </li>

                                <!-- ==================================================================================================================== -->
                                <li class="<?php echo ($page=='Dashboard Penulis') ? 'active' : '' ;?>"  <?php echo ($role==2) ? '' : 'hidden' ;?>>
                                    <a href="<?php echo site_url().'/admin' ?>">
                                        <i class="fa fa-bar-chart-o"></i> <span>Dashboard</span>
                                    </a>
                                </li>
                               
                                <li class="<?php echo (in_array($page, $nam_posts) || ($page=='Edit Post')) ? 'active' : '' ;?>"  <?php echo ($role==2) ? '' : 'hidden' ;?>>
                                    <a href="<?php echo site_url().'/admin/semuapost' ?>">
                                        <i class="fa fa-bar-chart-o"></i> <span>Post</span>
                                    </a>
                                </li>
                                <li class="<?php echo ($page=='Tambah Post') ? 'active' : '' ;?>"  <?php echo ($role==2) ? '' : 'hidden' ;?>>
                                    <a href="<?php echo site_url().'/admin/tambahpost' ?>">
                                        <i class="fa fa-bar-chart-o"></i> <span>Tambah Post</span>
                                    </a>
                                </li>
                                <li class="<?php echo ($page=='Navigasi') ? 'active' : '' ;?>"  <?php echo ($role==2) ? '' : 'hidden' ;?>>
                                    <a href="<?php echo site_url().'/admin/navigasi' ?>">
                                        <i class="fa fa-bar-chart-o"></i> <span>Navigasi</span>
                                    </a>
                                </li>

                                <li class="<?php echo ($page=='Images') ? 'active' : '' ;?>"  <?php echo ($role==2) ? '' : 'hidden' ;?>>
                                    <a href="<?php echo site_url().'/admin/images' ?>">
                                        <i class="fa fa-bar-chart-o"></i> <span>Images</span>
                                    </a>
                                </li>
                                <li class="<?php echo ($page=='Set Images') ? 'active' : '' ;?>"  <?php echo ($role==2) ? '' : 'hidden' ;?>>
                                    <a href="<?php echo site_url().'/admin/setimages' ?>">
                                        <i class="fa fa-bar-chart-o"></i> <span>Set Images</span>
                                    </a>
                                </li>
                                <li class="<?php echo ($page=='Banner dan Mitra') ? 'active' : '' ;?>"  <?php echo ($role==2) ? '' : 'hidden' ;?>>
                                    <a href="<?php echo site_url().'/admin/bannerdanmitra' ?>">
                                        <i class="fa fa-bar-chart-o"></i> <span>Banner & Mitra</span>
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
		                }else if($page == 'Detail Pelatihan')
                        {
                            $this->load->view('admin/v_detail_pelatihan');
                        }else if($page == 'Pendaftaran Berkelompok')
                        {
                            $this->load->view('admin/v_pendaftaranberkelompok');
                        }else if($page == 'Sertifikat')
                        {
                            $this->load->view('admin/v_sertifikat');
                        }else if($page == 'Penilaian')
                        {
                            $this->load->view('admin/v_penilaian');
                        }else if($page == 'Submit Penilaian')
                        {
                            $this->load->view('admin/v_submitnilai');
                        }else if($page == 'Data Penilaian')
                        {
                            $this->load->view('admin/v_data_penilaian');
                        }
		                 //============= Untuk  Penulis ================
                        else if($page == 'Tambah Post')
                        {
                            $this->load->view('admin/v_p_tambahpost');
                        }else if($page == 'Edit Post')
                        {
                            $this->load->view('admin/v_p_tambahpost');
                        }


                        else if(in_array($page, $nam_posts))
                        {
                            $this->load->view('admin/v_p_semuapost');
                        }

                        else if($page=="Navigasi")
                        {
                            $this->load->view('admin/v_p_navigasi');
                        }

                        else if($page=="Images")
                        {
                            $this->load->view('admin/v_p_images');
                        }

                        else if($page=="Set Images")
                        {
                            $this->load->view('admin/v_p_set_images');
                        }
                        else if($page=="Banner dan Mitra")
                        {
                            $this->load->view('admin/v_p_banner_dan_mitra');
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

        <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-typeahead.js" type="text/javascript"></script>

        <?php if (in_array($page, $sya)): ?>
            <script src="<?php echo base_url();?>assets/js/moment.min.js"></script>         

            <script src="<?php echo base_url();?>assets/js/daterangepicker.js"></script>

        <?php endif ?>


        <?php if (in_array($page, $syaw)): ?>
            <script src="<?php echo base_url();?>assets/js/bootstrap-editable.min.js"></script>

        <?php endif ?>

        <?php if (($page=="Tambah Post") || ($page=="Edit Post")): ?>
            <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
            <script>tinymce.init({ 
                relative_urls : false,
                remove_script_host : false,
                convert_urls : true,
                  selector: 'textarea',
                  height: 300,
                  theme: 'modern',
                  plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                  ],
                  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                  toolbar2: 'print preview media | forecolor backcolor emoticons',
                  image_advtab: true,
                  templates: [
                    { title: 'Test template 1', content: 'Test 1' },
                    { title: 'Test template 2', content: 'Test 2' }
                  ]

            });</script>
        <?php endif ?>

        <?php if (in_array($page, $nam_posts)|| ($page=="Images")): ?>
            <script src=" https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
   
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
            $(function() {
                $('input[name="datetimerange"]').daterangepicker({
                    timePicker: true,
                    timePicker24Hour: true,
                    timePickerIncrement: 5,
                    locale: {
                        format: 'YYYY-MM-DD HH:mm'
                    }
                });
            });
        <?php endif ?>

        <?php if ($page=="Manage Pengajar"): ?>
            $(function() {
                $('input[name="tanggal_lahir"]').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true
                });
                $('input[name="tanggal_lahir"]').val="";
            });
        <?php endif ?>

        <?php if ($page=="Detail Pelatihan"): ?>
            $(function() {
                $('input[name="tanggal_mengisi"]').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    <?php 
                        $startDate="";
                        $endDate="";
                        if((isset($data_pelatihan[0]['date_mulai'])) && (isset($data_pelatihan[0]['date_mulai'])))
                        {
                            $expDateStart=explode('-', $data_pelatihan[0]['date_mulai']);
                            $expDateSelesai=explode('-', $data_pelatihan[0]['date_selesai']);
                            $startDate=$expDateStart[1].'/'.$expDateStart[2].'/'.$expDateStart[0];
                            $endDate=$expDateSelesai[1].'/'.$expDateSelesai[2].'/'.$expDateSelesai[0];    
                        }
                        
                    ?>
                    minDate: '<?php echo $startDate;?>',
                    maxDate: '<?php echo $endDate;?>'
                });
                $('input[name="tanggal_mengisi"]').val="";
            });

            $( "#cb_all" ).change(function() {
              // Check input( $( this ).val() ) for validity here
                if($(this).is(":checked")) {
                  //'checked' event code
                   $('.cb').each(function () {
                       $(this).prop("checked", true);
                  });
                }else
                {
                    $('.cb').each(function () {
                       $(this).prop("checked", false);
                  });
                }
                
            });
            
            $( "#hapus_checked" ).click(function() {
                 //alert('gotcha');
                 var fruits = [];
                $('.cb:checked').each(function () {
                    //alert('gotcha');
                    var pare= $(this).parent().find("#hiddenvar").val();

                    fruits.push(pare)
                       //$(this).prop("checked", false);
                });
                //$.post(, {'id_kehadiran[]': fruits});

               $.post("<?php echo site_url().'/admin/hapuspesertahaspelatihanarray/';?>", {'id_kehadiran[]': fruits,'id_pelatihan': <?php echo $id_pelatihan;?>}, 
                    function(returnedData){
                    //alert(returnedData);
                      location.reload();
                });
            });

             $( ".cb_hadir" ).change(function() {
              // Check input( $( this ).val() ) for validity here
                if($(this).is(":checked")) {
                  //'checked' event code
                   alert('active');
                   //$(this).parent().text("active");
                }else
                {
                    alert('non active');
                    //$(this).parent().text("non active");
                }
                
            });
        <?php endif ?>



        <?php if ($page=="Sertifikat"): ?>
           $.fn.editable.defaults.mode = 'inline';
            $(document).ready(function() {
                 $('.username').editable({
                        showbuttons: false,
                        url: '<?php echo site_url().'/test/xedit' ?>',   
                        success: function(response, newValue) {
                                if(response.status == 'error') return response.msg; //msg will be shown in editable form
                        }
                });
            });
            $('.username').on('save.newuser', function(){
                var that = this;
                setTimeout(function() {
                    $(that).closest('tr').next().find('.username').editable('show');
                }, 200);
            });
        <?php endif ?>

        <?php if ($page=="Navigasi"): ?>
           $.fn.editable.defaults.mode = 'inline';
            $(document).ready(function() {
                 $('.nav_name').editable({
                        showbuttons: false,
                        url: '<?php echo site_url().'/admin/xeditNav/1' ?>',   
                        success: function(response, newValue) {
                                if(response.status == 'error') return response.msg; //msg will be shown in editable form
                        }
                });
            });
             $.fn.editable.defaults.mode = 'inline';
            $(document).ready(function() {
                 $('.nav_link').editable({
                        showbuttons: false,
                        url: '<?php echo site_url().'/admin/xeditNav/2' ?>',   
                        success: function(response, newValue) {
                                if(response.status == 'error') return response.msg; //msg will be shown in editable form
                        }
                });
            });

            $(document).ready(function() {
                 $('.subnav_name').editable({
                        showbuttons: false,
                        url: '<?php echo site_url().'/admin/xeditSubNav/1' ?>',   
                        success: function(response, newValue) {
                                if(response.status == 'error') return response.msg; //msg will be shown in editable form
                        }
                });
            });
             $.fn.editable.defaults.mode = 'inline';
            $(document).ready(function() {
                 $('.subnav_link').editable({
                        showbuttons: false,
                        url: '<?php echo site_url().'/admin/xeditSubNav/2' ?>',   
                        success: function(response, newValue) {
                                if(response.status == 'error') return response.msg; //msg will be shown in editable form
                        }
                });
            });

            $('.nav_name').on('save.newuser', function(){
                var that = this;
                setTimeout(function() {
                    //$(that).closest('tr').next().find('.nav_name').editable('show');
                }, 200);
            });
            $('.nav_link').on('save.newuser', function(){
                var that = this;
                setTimeout(function() {
                    //$(that).closest('tr').next().find('.nav_name').editable('show');
                }, 200);
            });

            $('.subnav_name').on('save.newuser', function(){
                var that = this;
                setTimeout(function() {
                    //$(that).closest('tr').next().find('.nav_name').editable('show');
                }, 200);
            });
            $('.subnav_link').on('save.newuser', function(){
                var that = this;
                setTimeout(function() {
                    //$(that).closest('tr').next().find('.nav_name').editable('show');
                }, 200);
            });
        <?php endif ?>

        <?php if ($page=="Banner dan Mitra"): ?>
           $.fn.editable.defaults.mode = 'inline';
            $(document).ready(function() {
                 $('.banner_nama').editable({
                        showbuttons: false,
                        url: '<?php echo site_url().'/admin/xeditbannermitra/1' ?>',   
                        success: function(response, newValue) {
                                if(response.status == 'error') return response.msg; //msg will be shown in editable form
                        }
                });

                $('.banner_src').editable({
                        showbuttons: false,
                        url: '<?php echo site_url().'/admin/xeditbannermitra/2' ?>',   
                        success: function(response, newValue) {
                                if(response.status == 'error') return response.msg; //msg will be shown in editable form
                        }
                });

                $('.banner_link').editable({
                        showbuttons: false,
                        url: '<?php echo site_url().'/admin/xeditbannermitra/3' ?>',   
                        success: function(response, newValue) {
                                if(response.status == 'error') return response.msg; //msg will be shown in editable form
                        }
                });
            });
            $('.banner_nama').on('save.newuser', function(){
                var that = this;
                setTimeout(function() {
                    //$(that).closest('tr').next().find('.banner_nama').editable('show');
                }, 200);
            });

            $('.banner_src').on('save.newuser', function(){
                var that = this;
                setTimeout(function() {
                    //$(that).closest('tr').next().find('.banner_src').editable('show');
                }, 200);
            });

            $('.banner_link').on('save.newuser', function(){
                var that = this;
                setTimeout(function() {
                    //$(that).closest('tr').next().find('.banner_link').editable('show');
                }, 200);
            });
        <?php endif ?>

        <?php if (in_array($page, $nam_posts) || ($page=="Images")): ?>
          $(document).ready(function() {
            $('#example').DataTable();
        } );
        <?php endif ?>

        <?php if ($page=="Images"): ?>
      

            <?php foreach ($map as $key => $value): ?>
                      document.getElementById("copyButton<?php echo $key; ?>").addEventListener("click", function() {
                        copyToClipboard(document.getElementById("copyTarget<?php echo $key; ?>"));
                    });              
            <?php endforeach ?>


            function copyToClipboard(elem) {
                  // create hidden text element, if it doesn't already exist
                var targetId = "_hiddenCopyText_";
                var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
                var origSelectionStart, origSelectionEnd;
                if (isInput) {
                    // can just use the original source element for the selection and copy
                    target = elem;
                    origSelectionStart = elem.selectionStart;
                    origSelectionEnd = elem.selectionEnd;
                } else {
                    // must use a temporary form element for the selection and copy
                    target = document.getElementById(targetId);
                    if (!target) {
                        var target = document.createElement("textarea");
                        target.style.position = "absolute";
                        target.style.left = "-9999px";
                        target.style.top = "0";
                        target.id = targetId;
                        document.body.appendChild(target);
                    }
                    target.textContent = elem.textContent;
                }
                // select the content
                var currentFocus = document.activeElement;
                target.focus();
                target.setSelectionRange(0, target.value.length);
                
                // copy the selection
                var succeed;
                try {
                      succeed = document.execCommand("copy");
                } catch(e) {
                    succeed = false;
                }
                // restore original focus
                if (currentFocus && typeof currentFocus.focus === "function") {
                    currentFocus.focus();
                }
                
                if (isInput) {
                    // restore prior selection
                    elem.setSelectionRange(origSelectionStart, origSelectionEnd);
                } else {
                    // clear temporary content
                    target.textContent = "";
                }
                return succeed;
            }
        <?php endif ?>


        <?php if ($page=="Tambah Post"): ?>
          $( "#judul" ).change(function() {
            var valu= this.value;
            valu= valu.replace(/ /g, "_");
              $("#perma").val(valu);
            });

          $("#submit").click( function()
            {
                var judul = $("#judul").val();
                var perma = $("#perma").val();
                var tipe = $("#tipe").val();

                var text = tinyMCE.activeEditor.getContent();;
                //alert(text);

                post("<?php echo site_url().'/admin/doTambahPost'?>", {judul: judul, perma: perma, content:text, tipe:tipe});
            });

           $("#draft").click( function()
            {
                var judul = $("#judul").val();
                var perma = $("#perma").val();
                var tipe = $("#tipe").val();

                var text = tinyMCE.activeEditor.getContent();;
                //alert(text);

                post("<?php echo site_url().'/admin/doTambahDraft'?>", {judul: judul, perma: perma, content:text, tipe:tipe});
            });


        <?php endif ?>

         <?php if ($page=="Edit Post"): ?>
          $( "#judul" ).change(function() {
            var valu= this.value;
            valu= valu.replace(/ /g, "_");
              $("#perma").val(valu);
            });

          $("#simpan").click( function()
            {
                var judul = $("#judul").val();
                var perma = $("#perma").val();
                var tipe = $("#tipe").val();
                var id_post = <?php echo $data_post['id_post'] ?>;

                var text = tinyMCE.activeEditor.getContent();;
                //alert(text);

                post("<?php echo site_url().'/admin/doEditPost'?>", {judul: judul, perma: perma, content:text, tipe:tipe, id_post:id_post});
            });

        <?php endif ?>


        function post(path, params, method) {
            method = method || "post"; // Set method to post by default if not specified.

            // The rest of this code assumes you are not using a library.
            // It can be made less wordy if you use one.
            var form = document.createElement("form");
            form.setAttribute("method", method);
            form.setAttribute("action", path);

            for(var key in params) {
                if(params.hasOwnProperty(key)) {
                    var hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden");
                    hiddenField.setAttribute("name", key);
                    hiddenField.setAttribute("value", params[key]);

                    form.appendChild(hiddenField);
                 }
            }

            document.body.appendChild(form);
            form.submit();
        }



/*
        <?php if ($page=="Submit Penilaian"): ?>
           $(document).ready(function() {
                var countdata=<?php echo sizeof($data_penilaian);?>;
                var request;

                // Bind to the submit event of our form
                $("#foo").submit(function(event){

                    // Abort any pending request
                    if (request) {
                        request.abort();
                    }
                    // setup some local variables
                    var $form = $(this);

                    // Let's select and cache all the fields
                    var $inputs = $form.find("input, select, button, textarea");

                    var name= $('#id_pelatihan_has_pengajar_fk option:selected').text();
                    
                    //alert("Hooray, it worked!"+" respon:"+name);
                    // Serialize the data in the form
                    var serializedData = $form.serialize();

                    // Let's disable the inputs for the duration of the Ajax request.
                    // Note: we disable elements AFTER the form data has been serialized.
                    // Disabled form elements will not be serialized.
                    $inputs.prop("disabled", true);

                    // Fire off the request to /form.php
                    request = $.ajax({
                        url: "<?php echo site_url().'/admin/tambahPenilaian'?>",
                        type: "post",
                        data: serializedData
                    });

                    // Callback handler that will be called on success
                    request.done(function (response, textStatus, jqXHR){
                        // Log a message to the console
                        countdata++;
                        var obj= JSON.parse(response);
                        //alert("Hooray, it worked!"+" respon:"+response);

                        if(obj.id_penilaian!=0)
                        {
                            //var nama=$("#yourdropdownid option:selected").text();
                             $( ".tb_penilaian" ).append( "<tr><td>"+countdata+"</td><td>"+name+"</td><td>"+obj.nilai+"</td><td></td><td><a data-toggle=\"modal\" href=\"\" ><button class=\"btn btn-default btn-xs\"><i class=\"glyphicon glyphicon-trash\"></i></button></a></td></tr>" );    
                            
                             $('#nilai').val("");
                            window.scrollTo(0,document.body.scrollHeight);
                        }
                        
                        
                    });

                    // Callback handler that will be called on failure
                    request.fail(function (jqXHR, textStatus, errorThrown){
                        // Log the error to the console
                        alert(
                            "The following error occurred: "+
                            textStatus, errorThrown
                        );
                    });

                    // Callback handler that will be called regardless
                    // if the request failed or succeeded
                    request.always(function () {
                        // Reenable the inputs
                        $inputs.prop("disabled", false);
                    });

                    // Prevent default posting of form
                    event.preventDefault();
                });
            });
        <?php endif ?>
        */
    </script>


</body>
</html>