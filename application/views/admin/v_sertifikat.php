
<?php 
//echo '<pre>';
//print_r($data_peserta);
//echo '</pre>';
?>
<div class="content">
	<?php if ($this->session->flashdata('msg')): ?>
      	<div class="alert alert-success" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <?php echo $this->session->flashdata('msg'); ?>
    	</div>

	<?php elseif($this->session->flashdata('error')): ?>
    	<div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <?php echo $this->session->flashdata('error'); ?>
    	</div>
    <?php endif; ?>

    <div class="row">
    	<div class="col-lg-6">
          	<section class="panel">
            	<header class="panel-heading">
                	Pilih Pelatihan
                </header>
         		<div class="panel-body">
         			<div class="col-lg-12">
						<div class="form-group">
							 <label class="col-sm-4">Nama Pelatihan</label>
							 <div class="col-sm-8">
								<select class="form-control" name="id_pelatihan" id="id_pelatihan" value="" onchange="goToAnotherPage(this);">
								    <option value="">Pilih Pelatihan</option>
								    <?php foreach ($pelatihan_active as $key => $value): ?>
								    	<option value="<?php echo $value['id_pelatihan'];?>"><?php echo $value['nama_pelatihan'];?></option>	
								    <?php endforeach ?>
								</select>
							 </div>
							 
						</div>
						<div class="form-group">
							 <label class="col-sm-4">Tanggal</label>
							 <label class="col-sm-8 "><?php echo ((isset($data_pelatihan[0]['date_mulai'])) ? $data_pelatihan[0]['date_mulai'] : "") .' - '.((isset($data_pelatihan[0]['date_selesai'])) ? $data_pelatihan[0]['date_selesai'] : ""); ?></label>
						</div>
         			</div>
         			

         			
          		</div>
           	</section>
        </div>
       
      
	</div>


	<div class="row" <?php echo ($id_pelatihan=="") ? "hidden" : "" ;?>>
    	<div class="col-lg-12">
          	<section class="panel">
            	<header class="panel-heading">
                	Peserta
                </header>
         		<div class="panel-body">
         			<div class="col-lg-12">
         				<table class="table table table-hover">
	                        <tbody>
	                        	<tr>
			                        <th style="width: 10px">#</th>
			                        <th>NIP</th>
			                        <th>Nama</th>
			                        <th>Instansi</th>
			                        <th>Daerah</th>
			                        <th style="width: 200px">Nomor Sertifikat</th>
			                        
	                        	</tr>
	                        	<?php foreach ($data_peserta as $key => $value): ?>
	                        	<tr  class="gradeA">
			                        <td><?php echo $key+1;?></td>
			                        <td><?php echo $value['nip'];?></td>
			                        <td><?php echo $value['nama'];?></td>
			                        <td><?php echo $value['instansi'];?></td>
			                        <td><?php echo $value['daerah'];?></td>
			                        <td><a href="#" class="username" data-type="text" data-pk="<?php echo $value['id_peserta_has_pelatihan'];?>" data-title="Enter username"><?php echo $value['sertifikat'];?></a></td>
			          
	                        	</tr>
	                        	<?php endforeach ?>
	                            
	                        </tbody>
	                    </table>
         			</div>
         			
         			
          		</div>
           	</section>
        </div>
        
	</div>
</div>	  

<script type="text/javascript">
	(function() {
	   // your page initialization code here
	   // the DOM will be available here
		//alert("<?php echo $id_pelatihan;?>") 

		var id_pelatihan = document.getElementById('id_pelatihan');
    	id_pelatihan.value = "<?php echo $id_pelatihan;?>";
	})();

	

    function goToAnotherPage(sel) {
          //alert(sel.value)        ;
          window.open("<?php echo site_url();?>"+"/admin/sertifikat/"+sel.value,"_self");

    }
</script>
