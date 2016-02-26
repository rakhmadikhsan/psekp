
<?php 
//echo '<pre>';
//print_r($data_point_penilaian);
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
       
        <div class="col-md-2" <?php echo ($id_pelatihan=="") ? "hidden" : "" ;?>>
            <a href="<?php echo site_url().'/pdf/pdfpenilaian/'.$id_pelatihan;?>">
        		<div class="sm-st clearfix">
	                <span class="sm-st-icon st-red"><i class="fa fa-file-pdf-o"></i></span>
	                
	                <div class="sm-st-info">
	                	Form Penilaian
	                </div>
	            </div>
        	</a>
        </div>
       
	</div>


	<div class="row" <?php echo ($id_pelatihan=="") ? "hidden" : "" ;?>>
    	<div class="col-lg-12">
          	<section class="panel">
            	<header class="panel-heading">
                	Penilaian
                </header>
         		<div class="panel-body">
         			<div class="col-lg-12">
         				<table class="table table table-hover">
	                        <tbody>
	                        	<tr>
			                        <th style="width: 10px">#</th>
			                        <th >Sub Penilaian</th>
			                        <th>Point</th>
			                        <th style="width: 100px"></th>
			                        
	                        	</tr>
	                        	<?php 
	                        		$id_kategori_temp=null;
	                        		$number=0;
	                        	?>
	                        	<?php foreach ($data_point_penilaian as $key => $value): ?>
	                        		<?php if ($value['id_kategori_point']!=$id_kategori_temp): ?>
	                        		<?php 
	                        			$number = ($value['id_kategori_point']!=$id_kategori_temp) ? 0 : $number ;
	                        			$id_kategori_temp=$value['id_kategori_point'];
	                        		?>
	                        		<tr>
	                        			<td></td>
	                        			<td><?php echo $value['kategori_point']; ?></td>
	                        			<td></td>
	                        			<td></td>
	                        		</tr>
	                        		<?php endif ?>
	                        		<tr>
	                        			<td><?php echo ++$number ; ?></td>
	                        			<td></td>
	                        			<td><?php echo $value['point_penilaian'];?></td>
	                        			<td>
				                        	<a data-toggle="modal" href="<?php echo site_url().'/admin/hapuspoinpenilaian/'.$value['id_pelatihan_has_point_penilaian'].'/'.$id_pelatihan;?>" ><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-trash"></i></button></a>
					                    </td>
	                        		</tr>
	                        		
	                        	<?php endforeach ?>
	                        	<tr>
	                        		<form action="<?php echo site_url().'/admin/tambahPointPenilaian' ?>" method="GET">
			                        <td style="width: 10px">
			                        	<input type="hidden" name="id_pelatihan" value="<?php echo $id_pelatihan;?>">
			                        </td>
			                        <td>
			                        	<input type="text"  name="kategori" autocomplete="off" class="form-control"  data-provide="typeahead" data-items="4" data-source="[
			                        	<?php foreach ($data_kategori as $key => $val): ?>
			                        		&quot;<?php echo $val['kategori_point'];?>&quot;<?php echo (($key>=sizeof($data_kategori)-1) ? '' : ',') ;?>
			                        	<?php endforeach ?>
			                        	]">
			                        	<ul class="typeahead dropdown-menu" style="top: 69px; left: 19px; display: none;">
              								<li data-value="Alaska" class="active">
              									<a href="#">
              										<strong>Alas</strong>ka
              									</a>
              								</li>
              							</ul>
			                        </td>
			                        <td>
			                        	<input type="text" name="poin" autocomplete="off" class="form-control"  data-provide="typeahead" data-items="4" data-source="[
			                        	<?php foreach ($data_point as $key => $val): ?>
			                        		&quot;<?php echo $val['point_penilaian'];?>&quot;<?php echo (($key>=sizeof($data_point)-1) ? '' : ',') ;?>
			                        	<?php endforeach ?>
			                        	]">
			                        	<ul class="typeahead dropdown-menu" style="top: 69px; left: 19px; display: none;">
              								<li data-value="Alaska" class="active">
              									<a href="#">
              										<strong>Alas</strong>ka
              									</a>
              								</li>
              							</ul>
			                        </td>
			                        <td><button type="submit" class="btn btn-info">Tambahkan</button></td>
			                        </form>
	                        	</tr>
	                        	
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
          window.open("<?php echo site_url();?>"+"/admin/penilaian/"+sel.value,"_self");

    }
</script>
