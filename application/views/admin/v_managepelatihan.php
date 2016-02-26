
<?php //print_r($data_excel);?>




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
    	<div class="col-lg-12">
          	<section class="panel">
            	<header class="panel-heading">
                	Pelatihan
                </header>
         		<div class="panel-body">
         			<a href="" data-toggle="modal" onclick="clickTambahPelatihan();"  data-target="#editModal">Tambah Pelatihan</a>
         			<table class="table table table-hover">
                        <tbody>
                        	<tr>
                        		<form action='<?php echo site_url().'/admin/managepelatihan' ?>' method="GET">
		                        <td style="width: 10px"></th>
		                        <td><input type="text" name="nama_pelatihan" class="form-control" value="<?php echo (isset($_GET['nama_pelatihan'])) ? $_GET['nama_pelatihan'] : '' ;?>"></td>
		                        <td><input type="text" name="date_mulai" class="form-control" value="<?php echo (isset($_GET['date_mulai'])) ? $_GET['date_mulai'] : '' ;?>"></td>
		                        <td><input type="text" name="date_selesai" class="form-control" value="<?php echo (isset($_GET['date_selesai'])) ? $_GET['date_selesai'] : '' ;?>"></td>
		                        <td><input type="text" name="quota" class="form-control" value="<?php echo (isset($_GET['quota'])) ? $_GET['quota'] : '' ;?>"></td>
		                        <td><input type="text" name="tempat" class="form-control" value="<?php echo (isset($_GET['tempat'])) ? $_GET['tempat'] : '' ;?>"></td>
		                        <td><input type="text" name="status" class="form-control" value="<?php echo (isset($_GET['status'])) ? $_GET['status'] : '' ;?>"></td>
		                        <td><button type="submit" class="btn btn-info">Filter</button></td>
		                        </form>
                        	</tr>
                        	<tr>
		                        <th style="width: 10px">#</th>
		                        <th>Nama Pelatihan</th>
		                        <th>Mulai</th>
		                        <th>Selesai</th>
		                        <th>Quota</th>
		                        <th>Tempat</th>
		                        <th>Status</th>
		                        
		                        <th style="width: 100px"></th>
                        	</tr>
                        	<?php foreach ($pelatihan as $key => $value): ?>
                        	<tr>
		                        <td><?php echo $key+1;?></td>
		                        <td><?php echo $value['nama_pelatihan'];?></td>
		                        <td><?php echo $value['date_mulai'];?></td>
		                        <td><?php echo $value['date_selesai'];?></td>
		                        <td><?php echo $value['quota'];?></td>
		                        <td><?php echo $value['tempat'];?></td>
		                        <td><?php echo $value['status'];?></td>
		                        
		                        <td>
		                        	<a data-toggle="modal" onclick="clickEditPelatihan('<?php echo $value['id_pelatihan'];?>','<?php echo $value['nama_pelatihan'];?>','<?php echo $value['date_mulai'];?>','<?php echo $value['date_selesai'];?>','<?php echo $value['time_mulai'];?>','<?php echo $value['time_selesai'];?>','<?php echo $value['quota'];?>','<?php echo $value['tempat'];?>','<?php echo $value['deskripsi'];?>','<?php echo $value['status'];?>','<?php echo $value['kode_surat'];?>');" data-target="#editModal"><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></button></a>
			                        <a data-toggle="modal" onclick="clickHapusPelatihan('<?php echo $value['id_pelatihan'];?>','<?php echo $value['nama_pelatihan'];?>');" data-target="#hapusModal"><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-trash"></i></button></a>
			                        <!--<a href="<?php echo site_url().'/admin/reportexcelpelatihan/'.$value['id_pelatihan'];?>"><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-file"></i></button></a>
									<a href="<?php echo site_url().'/admin/reportexcelpelatihan/'.$value['id_pelatihan'];?>"><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-save-file"></i></button></a>			                    
			                    	-->
			                    </td>
                        	</tr>
                        	<?php endforeach ?>
                            
                        </tbody>
                    </table>
          		</div>
           	</section>
        </div>
	</div>
</div>	  

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
     	<form id="formeditpelatihan" class="form-horizontal" action="" method="POST">
	     	<div class="modal-content">
	     		<div class="modal-header">
	     			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	     			<h4 id="judul" class="modal-title">Edit Pelatihan</h4>
	     		</div>
	     		<div class="modal-body">
	     			<fieldset>
					  
					  <div class="form-group">
					    <label for="nip" class="col-sm-2 control-label">Nama Pelatihan</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="nama_pelatihan" name="nama_pelatihan" placeholder="Nama Pelatihan"  value="">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="nip" class="col-sm-2 control-label">No Surat</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="kode_surat" name="kode_surat" placeholder="Nomor Surat"  value="">
					    </div>
					  </div>
					  
					  <div class="form-group">
					    <label for="Nama" class="col-sm-2 control-label">Waktu</label>
					    <div class="col-sm-8">
					      <input type="text" placeholder="Periode Pelatihan" class="form-control" id="datetimerange" name="datetimerange" value="2016-01-01 15:00 - 2016-01-05 20:00" />
					    </div>
					  </div>
					
					   <div class="form-group">
					    <label for="Nama" class="col-sm-2 control-label">Quota</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="quota" name="quota" placeholder="Quota" value="">
					    </div>
					  </div>
					   <div class="form-group">
					    <label for="Nama" class="col-sm-2 control-label">Tempat</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Tempat" value="">
					    </div>
					  </div>
					   <div class="form-group">
					    <label for="Nama" class="col-sm-2 control-label">Deskripsi</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi" value="">
					    </div>
					      </div>
					   
					    <div class="form-group">
						 <label for="pelatihan" class="col-sm-2 control-label">Status</label>
						 <div class="col-sm-8">
					      <select class="form-control" name="status" id="status" value="1">
					      	<option value="1">Aktif</option>
					      	<option value="0">Tidak Aktif</option>		
						  </select>
					    </div>
						 
						</div>
					  </fieldset>
					</div>
					
	     		<div class="modal-footer">
	     			<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
	     			<button class="btn btn-warning" type="submit">Simpan</button>
	     		</div>
	     	</div>
	     </form>
     </div> 
</div>
<!-- modal -->
<!-- Modal -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Hapus Peserta</h4>
			</div>
			<form  class="form-horizontal" id="formhapuspeserta" action="" method="POST" enctype="multipart/form-data">
			<div id="body_hapus" class="modal-body">
				Body goes here...
			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
				<button class="btn btn-danger" type="submit" type="button">Hapus</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- modal -->

<script type="text/javascript">

    function clickEditPelatihan(id_pelatihan, nama_pelatihan, waktu_mulai, waktu_selesai,jam_mulai,jam_selesai, quota, tempat, deskripsi, status, kode_surat) {
      	document.getElementById('judul').innerHTML="Edit Pelatihan";
      	var edit_nama_pelatihan = document.getElementById('nama_pelatihan');
        var edit_kodesurat = document.getElementById('kode_surat');
        var edit_datetimerange = document.getElementById('datetimerange');
        var edit_quota = document.getElementById('quota');
        var edit_tempat = document.getElementById('tempat');
        var edit_deskripsi = document.getElementById('deskripsi');
        var edit_status = document.getElementById('status');

        var formeditpelatihan = document.getElementById('formeditpelatihan');
        
        

        edit_nama_pelatihan.value=nama_pelatihan;
        edit_kodesurat.value=kode_surat;
        $('#datetimerange').data('daterangepicker').setStartDate(waktu_mulai+" "+jam_mulai.substring(0,4));
        $('#datetimerange').data('daterangepicker').setEndDate(waktu_selesai+" "+jam_selesai.substring(0,4));
        
        //alert(waktu_mulai+" "+jam_mulai.substring(0,4)+" - "+waktu_selesai+" "+jam_selesai.substring(0,4));
       	//edit_datetimerange.value= waktu_mulai+" "+jam_mulai.substring(0,4)+" - "+waktu_selesai+" "+jam_selesai.substring(0,4);
        edit_quota.value=quota;
        edit_tempat.value=tempat;
        edit_deskripsi.value=deskripsi;
        edit_status.value=status;
       

        formeditpelatihan.action="<?php echo site_url();?>"+"/admin/ubahPelatihan/"+id_pelatihan;
    }

	function clickTambahPelatihan()
	{
		document.getElementById('judul').innerHTML="Tambah Pelatihan";
		var edit_nama_pelatihan = document.getElementById('nama_pelatihan');
        var edit_kodesurat = document.getElementById('kode_surat');
        var edit_datetimerange = document.getElementById('datetimerange');
        var edit_quota = document.getElementById('quota');
        var edit_tempat = document.getElementById('tempat');
        var edit_deskripsi = document.getElementById('deskripsi');
        var edit_status = document.getElementById('status');

        var formeditpelatihan = document.getElementById('formeditpelatihan');
        
        

        edit_nama_pelatihan.value="";
        edit_kodesurat.value="";
        $('#datetimerange').val('');
        //$('#datetimerange').data('daterangepicker').setStartDate("");
        //$('#datetimerange').data('daterangepicker').setEndDate("");
        
        //alert(waktu_mulai+" "+jam_mulai.substring(0,4)+" - "+waktu_selesai+" "+jam_selesai.substring(0,4));
       	//edit_datetimerange.value= waktu_mulai+" "+jam_mulai.substring(0,4)+" - "+waktu_selesai+" "+jam_selesai.substring(0,4);
        edit_quota.value="";
        edit_tempat.value="";
        edit_deskripsi.value="";
        edit_status.value="1";

        formeditpelatihan.action="<?php echo site_url();?>"+"/admin/tambahPelatihan";
	}

    function clickHapusPelatihan(id_pelatihan, nama_pelatihan) {
    	var formhapuspeserta=document.getElementById('formhapuspeserta');
    	formhapuspeserta.action="<?php echo site_url();?>"+"/admin/hapusPelatihan/"+id_pelatihan;
        document.getElementById("body_hapus").innerHTML = "Apakah anda yakin akan menghapus <b>"+nama_pelatihan+"</b>?";
    }

</script>


