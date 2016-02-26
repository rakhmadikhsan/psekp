
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PSEKP Konfirmasi Sukses</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Developed By M Abdur Rokib Promy">
    <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->

    <!-- jvectormap -->
    <link href="<?php echo base_url();?>assets/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->

    <!-- <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" /> -->
    <!-- Daterange picker -->
    
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /> -->
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- Theme style -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css" />

      </head>
      <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
            <div class="container">
			  <div class="row" style="height:200px;"></div>
			  <div class="row">
			    <div class="col-sm-12">
			    	<p class="text-center">Yang terhormat, Bp/Ibu: <strong><?php echo $nama; ?></strong></p>
			    	<p class="text-center">dengan NIP: <strong><?php echo $nip; ?></strong> dan ID Peserta: <strong><?php echo $id_peserta ?></strong></p>
			    	
			      	<p class="text-center">Anda telah menkonfirmasi pada pelatihan: <strong><?php echo $data_pelatihan[0]['nama_pelatihan']; ?></strong></p>
			      	<p class="text-center">yang akan dilaksanakan pada <strong><?php echo $mulai_selesai; ?></strong></p>
			      	<p class="text-center">pukul <strong><?php echo $jam_mulai_selesai; ?> WIB</strong></p> 
			      	<p class="text-center"><a href="<?php echo site_url().'/pdf/pdfkonfirmasi/'.$id_peserta; ?>">Download kartu peserta</a></p>
			    </div>
			</div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.min.js" type="text/javascript"></script>

        <!-- jQuery UI 1.10.3 -->
        <script src="<?php echo base_url();?>assets/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js" type="text/javascript"></script>

	</body>
</html>