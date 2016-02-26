
<?php 
//echo '<pre>';
//print_r($data_submited);
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
       
         <div class="col-md-6" <?php echo ($id_pelatihan=="") ? "hidden" : "" ;?>>
            <section class="panel">
            	<header class="panel-heading">
                	Pilih Pengajar
                </header>
         		<div class="panel-body">
         			<div class="col-lg-12">
						<div class="form-group">
							 <label class="col-sm-4">Pengajar</label>
							 <div class="col-sm-8">
								<select class="form-control" name="id_pengajar" id="id_pengajar" value="" onchange="goToAnotherPage2(this);">
								    <option value="">Pilih Pengajar</option>
								    <?php foreach ($data_pengajar as $key => $value): ?>
								    	<option value="<?php echo $value['id_pelatihan_has_pengajar'];?>"><?php echo $value['nama'];?></option>	
								    <?php endforeach ?>
								</select>
							 </div>
							 
						</div>
						<div class="form-group">
							 <label class="col-sm-4">Tanggal Mengajar</label>
							 <label class="col-sm-8"><?php echo (isset($pengajar[0]['tanggal_mengisi'])) ? $pengajar[0]['tanggal_mengisi'] : '-'  ;?></label>
							 
						</div>
						<div class="form-group">
							 <label class="col-sm-4">Materi</label>
							 <label class="col-sm-8"><?php echo (isset($pengajar[0]['materi'])) ? $pengajar[0]['materi'] : '-' ;?></label>
							 
						</div>
         			</div>
         			

         			
          		</div>
           	</section>
		</div>
       
	</div>


	<div class="row" <?php echo ($id_pengajar=="") ? "hidden" : "" ;?>>
    	<div class="col-lg-12">
          	<section class="panel">
            	<header class="panel-heading">
                	Hasil Penilaian
                </header>
         		<div class="panel-body">
         			<a class="btn btn-success pull-right" href="<?php echo site_url().'/pdf/pdfhasilpenilaian/'.$id_pelatihan.'/'.$id_pengajar;?>"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> Hasil Penilaian</a>
         			<div class="col-lg-12">
         				<table class="table table table-hover ">
	                        <thead>
	                        	<tr>
			                        <th style="width: 10px">#</th>
			                        <th >Poin</th>
			                        <th style="width: 80px"><center>Sangat Buruk</center></th>
			                        <th style="width: 80px"><center>Buruk</center></th>
			                        <th style="width: 80px"><center>Cukup</center></th>
			                        <th style="width: 80px"><center>Baik</center></th>
			                        <th style="width: 80px"><center>Baik Sekali</center></th>
			                     	<input type="hidden" value="<?php echo $value['id_pelatihan_has_pengajar'];?>" name="id_pelatihan_has_pengajar">
			                     	<input type="hidden" value="<?php echo $id_pelatihan;?>" name="id_pelatihan">
	                        	</tr>
	                        </thead>

	                        <tbody  class="tb_penilaian">
	                        	<?php 
	                        		$total[1]=0;
	                        		$total[2]=0;
	                        		$total[3]=0;
	                        		$total[4]=0;
	                        		$total[5]=0;
	                        	?>
	                        	<?php foreach ($result_penilaian as $key => $value): ?>
	                        		<tr class="active">
	                        			<td></td>
	                        			<td><?php echo $value['kategori'];?></td>
	                        			<td></td>
	                        			<td></td>
	                        			<td></td>
	                        			<td></td>
	                        			<td></td>
	                        		</tr>
	                        		<?php 
	                        			$nomor=1;
	                        		?>
	                        		<?php foreach ($value['point'] as $key => $valu): ?>
	                        			<tr>
	                        				<td><?php echo $nomor++; ?></td>
	                        				<td><?php echo $valu['point'];?></td>
	                        				<td><center><?php echo (isset($valu[1])) ? $valu[1] : '0' ;?></center></td>
	                        				<td><center><?php echo (isset($valu[2])) ? $valu[2] : '0' ;?></center></td>
	                        				<td><center><?php echo (isset($valu[3])) ? $valu[3] : '0' ;?></center></td>
	                        				<td><center><?php echo (isset($valu[4])) ? $valu[4] : '0' ;?></center></td>
	                        				<td><center><?php echo (isset($valu[5])) ? $valu[5] : '0' ;?></center></td>

	                        			</tr>
	                        			<?php 
	             							for ($i=1; $i <6 ; $i++) { 
		                        				# code...
		                        				if(isset($valu[$i]))
		                        				{
		                        					$total[$i]=$total[$i]+$valu[$i];
		                        				}
		                        			}

	                        			 ?>
	                        		<?php endforeach ?>
	                        		<?php 
	                        			$nomor=1;
	                        		?>
	                        	<?php endforeach ?>
	                        	<tr class="active">
	                        		<td></td>
	                        		<th>TOTAL</th>
	                        		<td><center><?php echo $total[1]; ?></center></td>
	                        		<td><center><?php echo $total[2]; ?></center></td>
	                        		<td><center><?php echo $total[3]; ?></center></td>
	                        		<td><center><?php echo $total[4]; ?></center></td>
	                        		<td><center><?php echo $total[5]; ?></center></td>
	                        	</tr>
	                        </tbody>
	                        <tfoot>
	                        	
	                        </tfoot>
	                    </table>
	                    <table class="table table-striped">
	                    	<thead>
	                    		<tr>
		                    		<th style="width:200px">Inputan</th>
		                    		<td></td>
		                    	</tr>
	                    	</thead>
	                    	
	                    	<tr>
	                    		<td >Jumlah Peserta</td>
	                    		<td ><?php echo $jumlah_peserta	; ?></td>
	                    	</tr>
	                    	<tr>
	                    		<td>Telah Menigisi</td>
	                    		<td><?php echo $data_submited; ?></td>
	                    	</tr>
	                    	<tr>
	                    		<td>Belum mengisi</td>
	                    		<td><?php echo ($jumlah_peserta-$data_submited); ?></td>
	                    	</tr>
	                    </table>

	                    <table class="table table table-striped ">
	                        <thead>
	                        	<tr>
			                        <th style="width: 10px">#</th>
			                        <th >Kritik dan Saran</th>
			                        
	                        	</tr>
	                        </thead>

	                        <tbody  class="tb_penilaian">
	                        	<?php foreach ($penilaian_pengjar_kritik_saran as $key => $value): ?>
	                        	<tr>
	                        		<td><?php echo 1+$key; ?></td>
	                        		<td><?php echo $value['kritik_saran'];?></td>
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

    	var id_pengajar = document.getElementById('id_pengajar');
    	id_pengajar.value = "<?php echo $id_pengajar;?>";
	})();

	

    function goToAnotherPage(sel) {
          //alert(sel.value)        ;
          window.open("<?php echo site_url();?>"+"/admin/datapenilaian/"+sel.value,"_self");

    }

        function goToAnotherPage2(sel) {
          //alert(sel.value)        ;
         
          window.open("<?php echo site_url().'/admin/datapenilaian/'.$id_pelatihan.'/';?>"+sel.value,"_self");

    }
</script>
