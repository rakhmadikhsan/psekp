
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PESKP - Register Peserta</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	<div class="container">
		<div class="container">

			<div class="page-header">
			    <h1>Pendaftaran Peserta <small>Isi form ini untuk mendaftar</small></h1>
			</div>
				
				<?php if (!(validation_errors()==null)): ?>
					<div class="alert alert-danger" role="alert">
					  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					  <span class="sr-only">Error:</span>
					  <?php echo validation_errors(); ?>
					</div>
				<?php endif ?>
				<form class="form-horizontal" action='<?php echo site_url().'/register/doregister' ?>' method="POST">
				  <fieldset>
					  
					  <div class="form-group">
					    <label for="nip" class="col-sm-2 control-label">NIP</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" name="nip" placeholder="NIP"  value="<?=set_value('nip') ?>">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="Nama" class="col-sm-2 control-label">Nama</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?=set_value('nama') ?>">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="hp" class="col-sm-2 control-label">HP</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" name="hp" placeholder="No HP"  value="<?=set_value('hp') ?>">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="email" class="col-sm-2 control-label">Email</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" name="email" placeholder="Alamat Email"  value="<?=set_value('email') ?>">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="instansi" class="col-sm-2 control-label">Instansi</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" name="instansi" placeholder="Instansi"  value="<?=set_value('instansi') ?>">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="daerah" class="col-sm-2 control-label">Daerah</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" name="daerah" placeholder="Daerah"  value="<?=set_value('daerah') ?>">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="Alamat" class="col-sm-2 control-label">Alamat</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" name="alamat" placeholder="Alamat Rumah"  value="<?=set_value('alamat') ?>">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="email" class="col-sm-2 control-label">Telepon</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" name="telepon" placeholder="Telepon"  value="<?=set_value('telepon') ?>">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="fax" class="col-sm-2 control-label">Fax</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" name="fax" placeholder="Fax"  value="<?=set_value('fax') ?>">
					    </div>
					  </div>
				    <div class="control-group">

				    <div class="form-group">
				        <label class="col-xs-2 control-label">Persetujuan</label>
				        <div class="col-xs-8">
				            <div style="border: 1px solid #e5e5e5; height: 200px; overflow: auto; padding: 10px;">
				                <p>Lorem ipsum dolor sit amet, veniam numquam has te. No suas nonumes recusabo mea, est ut graeci definitiones. His ne melius vituperata scriptorem, cum paulo copiosae conclusionemque at. Facer inermis ius in, ad brute nominati referrentur vis. Dicat erant sit ex. Phaedrum imperdiet scribentur vix no, ad latine similique forensibus vel.</p>
				                <p>Dolore populo vivendum vis eu, mei quaestio liberavisse ex. Electram necessitatibus ut vel, quo at probatus oportere, molestie conclusionemque pri cu. Brute augue tincidunt vim id, ne munere fierent rationibus mei. Ut pro volutpat praesent qualisque, an iisque scripta intellegebat eam.</p>
				                <p>Mea ea nonumy labores lobortis, duo quaestio antiopam inimicus et. Ea natum solet iisque quo, prodesset mnesarchum ne vim. Sonet detraxit temporibus no has. Omnium blandit in vim, mea at omnium oblique.</p>
				                <p>Eum ea quidam oportere imperdiet, facer oportere vituperatoribus eu vix, mea ei iisque legendos hendrerit. Blandit comprehensam eu his, ad eros veniam ridens eum. Id odio lobortis elaboraret pro. Vix te fabulas partiendo.</p>
				                <p>Natum oportere et qui, vis graeco tincidunt instructior an, autem elitr noster per et. Mea eu mundi qualisque. Quo nemore nusquam vituperata et, mea ut abhorreant deseruisse, cu nostrud postulant dissentias qui. Postea tincidunt vel eu.</p>
				                <p>Ad eos alia inermis nominavi, eum nibh docendi definitionem no. Ius eu stet mucius nonumes, no mea facilis philosophia necessitatibus. Te eam vidit iisque legendos, vero meliore deserunt ius ea. An qui inimicus inciderint.</p>
				            </div>
				        </div>
				    </div>
				    <div class="form-group has-feedback has-success">
				        <div class="col-xs-8 col-xs-offset-2">
				            <div class="checkbox">
				                <label>
				                    <input type="checkbox" onclick="agr();" id="agree" value="agree" data-fv-field="agree"> Agree with the terms and conditions
				                </label>
				            </div>
				        </div>
				    </div>

				   	<div class="form-group has-feedback has-success">
				        <div class="col-xs-8 col-xs-offset-2">
				            <button type="submit" id="btnsubmit" class="btn btn-success">Register</button>
				        </div>
				    </div>
				   
				  </fieldset>
				</form>
		</div>	  
	 
	  
	</div>

    <script type="text/javascript">
     		document.getElementById('btnsubmit').disabled  = true;
           function agr()
			{
				//console.log("works");
			  if (document.getElementById('agree').checked) 
			  {
			  	
			      document.getElementById('btnsubmit').disabled  = false;
			  } else {
			      document.getElementById('btnsubmit').disabled  = true;
			  }
			}

    </script>

</body>

</html>
