<?php //print_r($peserta);?>
<div class="content">

	<?php if (!(validation_errors()==null)): ?>
		<div class="alert alert-danger" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">Error:</span>
				<?php echo validation_errors(); ?>
		</div>
	<?php endif ?>

	<?php if ($this->session->flashdata('error')): ?>
		<div class="alert alert-danger" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">Error:</span>
				<?php echo $this->session->flashdata('error'); ?>
		</div>
	<?php endif; ?>
	

	<div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                     <h1>Pendaftaran Peserta SECRA KELOMPOK<small>Isi form ini untuk mendaftar</small></h1>
                </header>
       			<div class="panel-body">
       					<?php //echo form_open_multipart('peserta/do_upload');?>
                     <form class="form-horizontal" action='<?php echo site_url().'/peserta/doregisterkelompok' ?>' method="POST" enctype="multipart/form-data">
				  <fieldset>
					  
					<div class="form-group">
					    <label for="nip" class="col-sm-2 control-label">NIP</label>
					    <div class="col-sm-7">
					      <input type="text" class="form-control" name="nip" placeholder="NIP" readonly value="<?php echo $peserta[0]['nip'];?>">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="Nama" class="col-sm-2 control-label">Nama</label>
					    <div class="col-sm-7">
					      <input type="text" class="form-control" name="nama" placeholder="Nama" readonly value="<?php echo $peserta[0]['nama'];?>">
					    </div>
					  </div>

					  <div class="form-group">
						 <label for="pelatihan" class="col-sm-2 control-label">Pelatihan</label>
						 <div class="col-sm-7">
					      <select class="form-control" name="id_pelatihan">
					      	<option value="">Pilih Pelatihan</option>	
						    <?php foreach ($pelatihan_active as $key => $value): ?>
						    	<option value="<?php echo $value['id_pelatihan'];?>"><?php echo $value['nama_pelatihan'];?></option>	
						    <?php endforeach ?>
						  </select>
					    </div>
						 
					</div>

					<div class="form-group">
                    	<label class="col-lg-2 col-sm-2 control-label">Download Excel</label>
                            <div class="col-lg-10">
                                <a href="<?php echo site_url().'/peserta/makeFileExcel' ?>"><p class="form-control-static">Download Excel</p></a> 
                            </div>
                    </div>

					<div class="form-group">
					    <label for="DlEx" class="col-sm-2 control-label">Upload Excel</label>
					    <div class="col-sm-7">
					    	 <input type="file" name="userfile" size="20"  multiple="multiple"/>
					    </div>
					</div>





					<input type="hidden" name="id_peserta" value="<?php echo $peserta[0]['id_peserta'];?>">
					 
				    <div class="form-group">
				        <label class="col-xs-2 control-label">Persetujuan</label>
				        <div class="col-xs-7">
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
				            <button type="submit" id="btnsubmit" class="btn btn-success">Mendaftar Pelatihan</button>
				        </div>
				    </div>
				   
				  </fieldset>
				</form>            

                </div>
            </section>
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
