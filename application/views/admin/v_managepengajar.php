	
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
                	PENGAJAR
                </header>
         		<div class="panel-body">
         			<a href="" data-toggle="modal" onclick="clickTambahPelatihan();"  data-target="#editModal">Tambah Pengajar</a>
         			<table class="table table table-hover">
                        <tbody>
                        	<tr>
                        		<form action='<?php echo site_url().'/admin/managepengajar' ?>' method="GET">
		                        <td style="width: 10px"></th>
		                        <td><input type="text" name="nip" class="form-control" value="<?php echo (isset($_GET['nip'])) ? $_GET['nip'] : '' ;?>"></td>
		                        <td><input type="text" name="nama" class="form-control" value="<?php echo (isset($_GET['nama'])) ? $_GET['nama'] : '' ;?>"></td>
		                        <td><input type="text" name="jabatan" class="form-control" value="<?php echo (isset($_GET['jabatan'])) ? $_GET['jabatan'] : '' ;?>"></td>
		                        <td><input type="text" name="instansi" class="form-control" value="<?php echo (isset($_GET['instansi'])) ? $_GET['instansi'] : '' ;?>"></td>
		                        <td><input type="text" name="email" class="form-control" value="<?php echo (isset($_GET['email'])) ? $_GET['email'] : '' ;?>"></td>
		                        <td><input type="text" name="universitas" class="form-control" value="<?php echo (isset($_GET['universitas'])) ? $_GET['universitas'] : '' ;?>"></td>
		                        <td><input type="text" name="status" class="form-control" value="<?php echo (isset($_GET['status'])) ? $_GET['status'] : '' ;?>"></td>
		                        <td><button type="submit" class="btn btn-info">Filter</button></td>

		                        </form>
                        	</tr>
                        	<tr>
		                        <th style="width: 10px">#</th>
		                        <th>NIP</th>
		                        <th>Nama</th>
		                        <th>Jabatan</th>
		                        <th>Instansi</th>
		                        <th>Email</th>
		                        <th>Universitas</th>
		                        <th>Status</th>
		                        
		                        <th style="width: 100px"></th>
                        	</tr>
                        	<?php foreach ($data_pengajar as $key => $value): ?>
                        	<tr>
		                        <td><?php echo $key+1;?></td>
		                        <td><?php echo $value['nip'];?></td>
		                        <td><?php echo $value['nama'];?></td>
		                        <td><?php echo $value['jabatan'];?></td>
		                        <td><?php echo $value['instansi'];?></td>
		                        <td><?php echo $value['email'];?></td>
		                        <td><?php echo $value['universitas'];?></td>
		                        <td><?php echo $value['status'];?></td>
		                        <td>
		                        	<a data-toggle="modal" onclick="clickEditPic(<?php echo $value['id_pengajar'];?>,'<?php echo $value['nip'];?>','<?php echo $value['nama'];?>','<?php echo $value['img'];?>');" data-target="#imageModal"><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-picture"></i></button></a>
		                        	<a data-toggle="modal" onclick="clickEditPengajar(
		                        	'<?php echo $value['id_pengajar'];?>', 
		                        	'<?php echo $value['nama'];?>', 
		                        	'<?php echo $value['instansi'];?>', 
		                        	'<?php echo $value['jabatan'];?>', 
		                        	'<?php echo $value['alamat'];?>', 
		                        	'<?php echo $value['tanggal_lahir'];?>', 
		                        	'<?php echo $value['email'];?>', 
		                        	'<?php echo $value['facebook'];?>', 
		                        	'<?php echo $value['twitter'];?>', 
		                        	'<?php echo $value['keahlian'];?>', 
		                        	'<?php echo $value['universitas'];?>', 
		                        	'<?php echo $value['status'];?>', 
		                        	'<?php echo $value['nip'];?>'
		                        		);" data-target="#editModal"><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></button></a>
			                         <a data-toggle="modal" onclick="clickHapus(<?php echo $value['id_pengajar'];?>,'<?php echo $value['nip'];?>');" data-target="#hapusModal"><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-trash"></i></button></a>
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
					  		<label for="nip" class="col-sm-2 control-label">Nip</label>
					    	<div class="col-sm-8">
					      		<input type="text" class="form-control" id="nip" name="nip" placeholder="NIP"  value="">
					    	</div>
					  	</div>
						<div class="form-group">
					  		<label for="nip" class="col-sm-2 control-label">Nama</label>
					    	<div class="col-sm-8">
					      		<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pengajar"  value="">
					    	</div>
					  	</div>
					  	<div class="form-group">
					    	<label for="nip" class="col-sm-2 control-label">Instansi</label>
					    	<div class="col-sm-8">
					      		<input type="text" class="form-control" id="instansi" name="instansi" placeholder="Instansi"  value="">
					    	</div>
					 	</div>
					  	<div class="form-group">
					    	<label for="nip" class="col-sm-2 control-label">Jabatan</label>
					    	<div class="col-sm-8">
					      		<input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan"  value="">
					    	</div>
					 	</div>
					  	<div class="form-group">
					    	<label for="Nama" class="col-sm-2 control-label">Alamat</label>
					    	<div class="col-sm-8">
					      		<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="">
					    	</div>
					  	</div>
					   	<div class="form-group">
					    	<label for="Nama" class="col-sm-2 control-label">Tanggal Lahir</label>
					    	<div class="col-sm-8">
					      		<input type="text" class="form-control" data-format="yyyy-MM-dd" id="tanggal_lahir" name="tanggal_lahir" value="" placeholder="Tanggal Lahir" />
					    	</div>
					  	</div>
					   	<div class="form-group">
					    	<label for="Nama" class="col-sm-2 control-label">Email</label>
					    	<div class="col-sm-8">
					      		<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="">
					    	</div>
					  	</div>
					   	<div class="form-group">
					    	<label for="Nama" class="col-sm-2 control-label">Facebook</label>
					    	<div class="col-sm-8">
					      		<input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook" value="">
					    	</div>
					   	</div>
					   	<div class="form-group">
					    	<label for="Nama" class="col-sm-2 control-label">Twitter</label>
					    	<div class="col-sm-8">
					      		<input type="text" class="form-control" id="twitter" name="twitter" placeholder="Twitter" value="">
					    	</div>
					   	</div>
					   	<div class="form-group">
					    	<label for="Nama" class="col-sm-2 control-label">Keahlian</label>
					    	<div class="col-sm-8">
					      		<input type="text" class="form-control" id="keahlian" name="keahlian" placeholder="Keahlian" value="">
					    	</div>
					   	</div>
					   
					   	<div class="form-group">
					    	<label for="Nama" class="col-sm-2 control-label">Universitas</label>
					    	<div class="col-sm-8">
					      		<input type="text" class="form-control" id="universitas" name="universitas" placeholder="Universitas" value="">
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

<!-- modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Upload Photo</h4>
			</div>
			<form  class="form-horizontal" id="formuoloadimage" action="<?php echo site_url().'/peserta/uploadPic'; ?>" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<div>
						
						<fieldset>
							<div class="form-group">
							    <label for="nip" class="col-sm-1">NIP</label>
							    <label id="picNIP" class="col-sm-5 ">NIP</label>
							  </div>
							<div class="form-group">
							    <label for="Nama" class="col-sm-1 ">Nama</label>
							    <label id="picNama" class="col-sm-5 ">NIP</label>
							</div>
						<fieldset>
						<center>
							<img id="img_peserta" src="" class="img-responsive"	width="150" height="150">
						</center>

					</div>
					<br>
					<input type="file" name="userfile" size="100"  multiple="multiple"/>

				</div>
				<div class="modal-footer">
					<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
					<button class="btn btn-success" type="submit">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- modal -->

<script type="text/javascript">

    function clickEditPengajar(id_pngajar, nama, jabatan, instansi, alamat, tanggal_lahir, email, facebook, twitter, keahlian, universitas, status, nip) {
      	document.getElementById('judul').innerHTML="Edit Pengajar";
      	var edit_nama = document.getElementById('nama');
      	var edit_instansi = document.getElementById('instansi');
      	var edit_jabatan = document.getElementById('jabatan');
      	var edit_alamat = document.getElementById('alamat');
      	var edit_tanggal_lahir = document.getElementById('tanggal_lahir');
      	var edit_email = document.getElementById('email');
      	var edit_facebook = document.getElementById('facebook');
      	var edit_twitter = document.getElementById('twitter');
      	var edit_keahlian = document.getElementById('keahlian');
      	var edit_universitas = document.getElementById('universitas');
      	var edit_status = document.getElementById('status');
		var edit_nip = document.getElementById('nip');
        var formeditpelatihan = document.getElementById('formeditpelatihan');
        
        
        //$('#datetimerange').data('daterangepicker').setStartDate(waktu_mulai+" "+jam_mulai.substring(0,4));
        //$('#datetimerange').data('daterangepicker').setEndDate(waktu_selesai+" "+jam_selesai.substring(0,4));
        
        //alert(waktu_mulai+" "+jam_mulai.substring(0,4)+" - "+waktu_selesai+" "+jam_selesai.substring(0,4));
       	//edit_datetimerange.value= waktu_mulai+" "+jam_mulai.substring(0,4)+" - "+waktu_selesai+" "+jam_selesai.substring(0,4);
        edit_nama.value=nama;
        edit_jabatan.value=jabatan;
        edit_alamat.value=alamat;
        //edit_tanggal_lahir.value=tanggal_lahir;
        //$('input[name="tanggal_lahir"]').val='04/11/1991';
        $('#tanggal_lahir').data('daterangepicker').setStartDate(tanggal_lahir);
        $('#tanggal_lahir').data('daterangepicker').setEndDate(tanggal_lahir);
        edit_email.value=email;
        edit_facebook.value=facebook;
        edit_twitter.value=twitter;
        edit_keahlian.value=keahlian;
        edit_universitas.value=universitas;
        edit_status.value=status;
        edit_nip.value=nip;
       	edit_instansi.value=instansi;

        formeditpelatihan.action="<?php echo site_url();?>"+"/admin/ubahPengajar/"+id_pngajar;
    }

	function clickTambahPelatihan()
	{
		document.getElementById('judul').innerHTML="Tambah Pengajar";
		var edit_nama = document.getElementById('nama');
		var edit_instansi = document.getElementById('instansi');
      	var edit_jabatan = document.getElementById('jabatan');
      	var edit_alamat = document.getElementById('alamat');
      	var edit_tanggal_lahir = document.getElementById('tanggal_lahir');
      	var edit_email = document.getElementById('email');
      	var edit_facebook = document.getElementById('facebook');
      	var edit_twitter = document.getElementById('twitter');
      	var edit_keahlian = document.getElementById('keahlian');
      	var edit_universitas = document.getElementById('universitas');
      	var edit_status = document.getElementById('status');
		var edit_nip = document.getElementById('nip');
        var formeditpelatihan = document.getElementById('formeditpelatihan');
        formeditpelatihan.action="<?php echo site_url();?>"+"/admin/tambahPengajar";
        

        //$('#tanggal_lahir').data('daterangepicker').setStartDate(null);
        //$('#tanggal_lahir').data('daterangepicker').setEndDate(null);
		edit_tanggal_lahir.value="";
        edit_nama.value="";
        edit_jabatan.value="";
        edit_alamat.value="";
        edit_email.value="";
        edit_facebook.value="";
        edit_twitter.value="";
        edit_keahlian.value="";
        edit_universitas.value="";
        edit_status.value="1";
		edit_instansi.value="";
        edit_nip.value="";
	}

    function clickHapus(id_pengajar, nip) {
    	var formhapuspeserta=document.getElementById('formhapuspeserta');
    	formhapuspeserta.action="<?php echo site_url();?>"+"/admin/hapusPengajar/"+id_pengajar;
        document.getElementById("body_hapus").innerHTML = "Apakah anda yakin akan menghapus <b>"+nip+"</b>?";
    }

    function clickEditPic(id_pengajar,nip,nama,img) {

        var img_src=document.getElementById('img_peserta');
        var formuoloadimage=document.getElementById('formuoloadimage');
        var picNIP=document.getElementById('picNIP');
        var picNama=document.getElementById('picNama');
        img_src.src="<?php echo base_url();?>"+"upload/pengajar/"+img;
        picNama.innerHTML=": "+nama;
        picNIP.innerHTML=": "+nip;
        formuoloadimage.action="<?php echo site_url();?>"+"/admin/uploadPicPengajar/"+id_pengajar;
        //alert(formuoloadimage.action);
    }

</script>


