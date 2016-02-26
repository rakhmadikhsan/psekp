
<?php 
//echo '<pre>';
//print_r($data_point);
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
						
         			</div>
         			

         			
          		</div>
           	</section>
		</div>
	</div>


	<div class="row" <?php echo ($id_pengajar=="") ? "hidden" : "" ;?>>
    	<div class="col-lg-12">
          	<section class="panel">
            	<header class="panel-heading">
                	Penilaian (<?php echo $data_submited;?>/<?php echo $jumalh_peserta;?>)
                </header>
         		<div class="panel-body" >
         			<?php echo ($data_submited>=$jumalh_peserta) ? "Semua penilaian dari peserta telah tersubmit." : "" ;?>
         			<div class="col-lg-12"  <?php echo ($data_submited>=$jumalh_peserta) ? "hidden" : "" ;?>>

         				<form method="POST" action="<?php echo site_url().'/admin/tambahkanpenilaian' ?>">
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
			                     	<input type="hidden" value="<?php echo $id_pengajar;?>" name="id_pelatihan_has_pengajar">
			                     	<input type="hidden" value="<?php echo $id_pelatihan;?>" name="id_pelatihan">
	                        	</tr>
	                        </thead>

	                        <tbody  class="tb_penilaian">

	                        	
	                        	<?php 
	                        		$id_kategori_temp=null;		
	                        		$number=1;
	                        	?>
	                        	<?php foreach ($data_point as $key => $value): ?>
	                        		<input type="hidden" value="<?php echo $value['id_pelatihan_has_point_penilaian'];?>" name="idaspek[<?php echo $key;?>][id]">
	                        		<?php
	                        			$number = ($value['id_kategori_point']!=$id_kategori_temp) ? 1 : $number ;
	                        		?>
	                        		<?php if ($value['id_kategori_point']!=$id_kategori_temp): ?>
	                        			<tr class="success">
	                        				<th></th>
	                        				<th><?php echo $value['kategori_point'];?></th>
	                        				   <th></th>
						                       <th></th>
						                       <th></th>
						                       <th></th>
						                       <th></th>
	                        			</tr>
	                        		<?php endif ?>
	                        		<tr>
	                        			<td><?php echo $number++;?></td>
	                        			<td><?php echo $value['point_penilaian'];?></td>
	                        			
		                        			<td>
		                        				<center>
		                        					<input type="radio" name="idaspek[<?php echo $key;?>][nilai]" id="seasonSummer" value="1" >
		                        				</center>
					                        	
						                    </td>
						                    <td>
					                        	<center>
		                        					<input type="radio" name="idaspek[<?php echo $key;?>][nilai]" id="seasonSummer" value="2" >
		                        				</center>
		                        			</td>
						                    <td>
					                        	<center>
		                        					<input type="radio" name="idaspek[<?php echo $key;?>][nilai]" id="seasonSummer" value="3" >
		                        				</center>
		                        			</td>
						                    <td>
					                        	<center>
		                        					<input type="radio" name="idaspek[<?php echo $key;?>][nilai]" id="seasonSummer" value="4" >
		                        				</center>
		                        			</td>
						                    <td>
					                        	<center>
		                        					<input type="radio" name="idaspek[<?php echo $key;?>][nilai]" id="seasonSummer" value="5" >
		                        				</center>
		                        			</td>
					                	
	                        		</tr>
	                        		<?php 
	                        			
	                        			$id_kategori_temp=$value['id_kategori_point'];
	                        		?>
	                        	<?php endforeach ?>
	                        	
	                       		
	                        </tbody>
	                        <tfoot>
	                        	
	                        </tfoot>
	                    </table>
	                    <div  class="col-lg-12">
		                	<label>Kritik dan Saran</label>
			             	<textarea class="form-control" rows="5" name="kritik_saran"></textarea>
			             	<br>
		              	</div>
		              	<div class="col-lg-12">
		              		<input class="btn btn-primary" type="submit" value="Submit">
		              	</div>
	                   </form>
	                    
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
          window.open("<?php echo site_url();?>"+"/admin/submitpenilaian/"+sel.value,"_self");

    }
    function goToAnotherPage2(sel) {
          //alert(sel.value)        ;
         
          window.open("<?php echo site_url().'/admin/submitpenilaian/'.$id_pelatihan.'/';?>"+sel.value,"_self");

    }

</script>
