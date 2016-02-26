
<?php //print_r($data_peserta);?>
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
							 <label class="col-sm-8 "><?php echo $date_start_end; ?></label>
						</div>
         			</div>
         			

         			
          		</div>
           	</section>
        </div>
       
        <div class="col-md-2" <?php echo ($id_pelatihan=="") ? "hidden" : "" ;?>>
            <a href="<?php echo site_url().'/exc/reportExcelPelatihan/'.$id_pelatihan ?>">
        		<div class="sm-st clearfix">
	                <span class="sm-st-icon st-green"><i class="fa fa-file-excel-o"></i></span>
	                <div class="sm-st-info">
	                	<label>Report Excel</label>
	                </div>
	            </div>
        	</a>
        </div>
        <div class="col-md-2" <?php echo ($id_pelatihan=="") ? "hidden" : "" ;?>>
        	<a href="">
        		<div class="sm-st clearfix">
	                <span class="sm-st-icon st-red"><i class="fa fa-file-excel-o"></i></span>
	                <div class="sm-st-info">
	                	<label>Untuk Access</label>
	                	
	                </div>
	            </div>
        	</a>
            
        </div>	
	</div>


	<div class="row" <?php echo ($id_pelatihan=="") ? "hidden" : "" ;?>>
		<div class="col-lg-12">
          	<section class="panel">
            	<header class="panel-heading">
                	Pengajar
                </header>
         		<div class="panel-body">
         			<div class="col-lg-12">
         				<table class="table table table-hover">
	                        <tbody>
	                        	<tr>
			                        <th style="width: 10px">#</th>
			                        
			                        <th>Nama</th>

			                        <th>Materi</th>
			                        <th>Tanggal</th>
			                        <th style="width: 100px"></th>
	                        	</tr>
	                        	<?php foreach ($data_pengajar as $key => $value): ?>
	                        	<tr>
			                        <td><?php echo $key+1;?></td>
			                        
			                        <td><?php echo $value['nama'];?></td>
			                        <td><?php echo $value['materi'];?></td>
			                        <td><?php echo $value['date_nice'];?></td>
			                        <td>
			                        	<a data-toggle="modal" href="<?php echo site_url().'/admin/hapuspelatihanhaspengajar/'.$value['id_pelatihan_has_pengajar'].'/'.$id_pelatihan;?>" ><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-trash"></i></button></a>
				                    </td>
	                        	</tr>
	                        	<?php endforeach ?>
	                            <tr>
			                        <td></td>
			                        <form action="<?php echo site_url().'/admin/tambahpelatihanhaspengajar'?>" method="POST">
			                        <td>
			                        	<input type="hidden" name="id_pelatihan_fk" class="form-control" value="<?php echo $id_pelatihan;?>">
			                        	<select class="form-control" name="id_pengajar_fk" id="id_pengajar" value="">
										    <option value=""> - </option>
										    <?php foreach ($pengajar_active as $key => $value): ?>
										    	<option value="<?php echo $value['id_pengajar'];?>"><?php echo $value['nama'];?></option>	
										    <?php endforeach ?>
										</select>
									</td>
									<td>
										<input type="text" name="materi"  autocomplete="off" class="form-control" id="materi">
									</td>
									<td>
										<input type="text" class="form-control" data-format="yyyy-MM-dd" id="tanggal_mengisi" name="tanggal_mengisi" value="" placeholder="Tanggal Lahir" />
									</td>
			                        <td>
			                        	<button type="submit" class="btn btn-primary">Tambahkan</button>
				                    </td>
				                	</form>
	                        	</tr>
	                        </tbody>
	                    </table>
         			</div>
         			
         			
          		</div>
           	</section>
        </div>
    	<div class="col-lg-12" <?php echo ($id_pelatihan=="") ? "hidden" : "" ;?>>
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
			                        <th>Email</th>
			                        <th>Hp</th>
			                        <th>Tgl Daftar</th>
			                        <?php if (sizeof($data_peserta)>0): ?>
			                        	<th><input id="cb_all" type="checkbox" value=""></th>
			                        	<th>
			                        		<div class="btn-group" data-toggle="buttons">
					                        	<select class="form-control" name="status" id="status">
												    <option value="0"> Belum Konfirmasi </option>
												    <option value="1"> Hadir </option>
												    <option value="2"> Tidak Hadir </option>
												</select>
											</div>
			                        	</th>
			                        	<th style="width: 100px">
			                        		<a  ><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-envelope"></i></button></a>
			                        		<a  id="hapus_checked"><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-trash"></i></button></a>
			                        	</th>
			                        	
			                        <?php endif ?>
			                        
	                        	</tr>
	                        	<?php foreach ($data_peserta as $key => $value): ?>
	                        	<tr>
			                        <td><?php echo $key+1;?></td>
			                        <td><?php echo $value['nip'];?></td>
			                        <td><?php echo $value['nama'];?></td>
			                        <td><?php echo $value['instansi'];?></td>
			                        <td><?php echo $value['daerah'];?></td>
			                        <td><?php echo $value['email'];?></td>
			                        <td><?php echo $value['hp'];?></td>
			                        <td><?php echo $value['datetime_daftar'];?></td>
			                        <td><input id="hiddenvar" type="hidden" value="<?php echo $value['id_peserta_has_pelatihan'];?>"><input class="cb" type="checkbox" value=""></td>
			                        <td>
			                        	<div class="btn-group" data-toggle="buttons">
				                        	<select class="form-control" name="status" id="status">
											    <option value="0" <?php echo ($value['status_kehadiran']==0) ? 'selected' : '' ;?>> Belum Konfirmasi </option>
											    <option value="1" <?php echo ($value['status_kehadiran']==1) ? 'selected' : '' ;?>> Hadir </option>
											    <option value="2" <?php echo ($value['status_kehadiran']==2) ? 'selected' : '' ;?>> Tidak Hadir </option>
											</select>
										</div>
			                        </td>
			                        <td>
			                        	
			                        	<a data-toggle="modal" href="<?php echo site_url().'/admin/hapuspesertahaspelatihana/'?>" ><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-envelope"></i></button></a>
			                        	<a data-toggle="modal" href="<?php echo site_url().'/admin/hapuspesertahaspelatihan/'.$value['id_peserta_has_pelatihan'].'/'.$id_pelatihan;?>" ><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-trash"></i></button></a>
				                    	
				                    </td>
				                    
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
		var aad=document.getElementById("aad");
		var id_pelatihan = document.getElementById('id_pelatihan');
    	id_pelatihan.value = "<?php echo $id_pelatihan;?>";
    	
    	
	})();

	

    function goToAnotherPage(sel) {
          //alert(sel.value)        ;
          window.open("<?php echo site_url();?>"+"/admin/detailpelatihan/"+sel.value,"_self");

    }
</script>
