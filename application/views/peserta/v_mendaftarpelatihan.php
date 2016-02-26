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
                     <h1>Pendaftaran Peserta <small>Isi form ini untuk mendaftar</small></h1>
                </header>
       			<div class="panel-body">
                      <form class="form-horizontal" action='<?php echo site_url().'/peserta/doregister' ?>' method="POST">
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
					<input type="hidden" name="id_peserta" value="<?php echo $peserta[0]['id_peserta'];?>">
					 
				    <div class="form-group">
				        <label class="col-xs-2 control-label">Persetujuan</label>
				        <div class="col-xs-7">
				            <div style="border: 1px solid #e5e5e5; height: col-xs-80px; overflow: auto; padding: 10px;">
				                <p>Saya bersedia untuk menghadiri pelatihan dengan tepat waktu. Serta mematuhi seluruh peraturan yang ditetapkan di pelatihan ini.</p>
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
