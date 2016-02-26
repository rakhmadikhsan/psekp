
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PESKP - Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/login.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div class="container">
  
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    
    <div class="col-md-4">
      <section class="login-form">
         <?php if (!($this->session->flashdata('msg')==null)): ?>
          <div class="alert alert-success" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <?php echo $this->session->flashdata('msg'); ?>
          </div>
        <?php endif ?>
        <?php echo validation_errors(); ?>
        <form method="post" action="<?php echo site_url().'/verifyloginpeserta' ?>" role="login">
          Login Peserta
          <input type="username" name="nip" id="nip" placeholder="NIP" required class="form-control input-lg" />
          
         
          <div class="pwstrength_viewport_progress"></div>
          
          
          <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Masuk</button>
        	<center><a href="<?php echo site_url().'/register'?>">Daftar Baru</a></center>
        </form>
      	  
      </section>  
      </div>
      
      <div class="col-md-4"></div>
      

  </div>

  
</div>
 <script src="<?php echo base_url();?>assets/js/login.js" type="text/javascript"></script>
</body>

</html>
    