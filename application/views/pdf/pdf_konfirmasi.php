
<html>
<head>
	<title></title>
	<style type="text/css">
		body {
		    background: url("<?php echo base_url();?>assets/img/bg_pdf.jpg");
		    background-image-resize:6;

		}

		.ttd
		{
			margin-left:500px;;
			background: url('<?php echo base_url();?>assets/img/ttd_undangan.jpg');
			background-image-resize:5; 
			background-repeat:no-repeat;

		}

		p
		{
			 font-size: 12px;
		}

		table
		{
			font-size: 12px;
		}

		.tbl {
		    border-collapse: collapse;
		}

		.tbl, .tbl tr td, .tbl tr th {
		    border: 1px solid black;
		}

		.tbl tr th {
		    background-color: #808080;
		    
		}


	</style>

</head>
<body>
	<div style="height: 140px;"></div>
	<div >
		<table>
			<tr>
				<td>Nomor Regestrasi</td>
				<td>: <?php echo $id_peserta_has_pelatihan;?></td>
			</tr>
			<tr>
				<td>Lamp</td>
				<td>: Registrasi Bimtek</td>
			</tr>
			<tr>
				<td>Hal</td>
				<td>: Pendaftaran Peserta Bimtek</td>
			</tr>
		</table>

		<p>Dengan Hormat.</p>
		<p>&nbsp; &nbsp; &nbsp; &nbsp;Menindaklanjuti surat kami nomor:  
			”<?php echo $kode_surat;?>”, 
			perihal Undangan Bimtek, dengan ini kami mengundang Saudara:
		</p>
		<table style="margin-left:30px;">
			<tr>
				<td style="width:80px;">Nama</td>
				<td>: <?php echo $nama;?></td>
			</tr>
			<tr>
				<td>Instansi</td>
				<td>: <?php echo $instansi;?></td>
			</tr>
			<tr>
				<td>Daerah</td>
				<td>: <?php echo $daerah;?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td>: <?php echo $email;?></td>
			</tr>
			<tr>
				<td>Hp</td>
				<td>: <?php echo $hp;?></td>
			</tr>
			<tr>
				<td>Tlp</td>	
				<td>: <?php echo $telepon;?></td>
			</tr>
		</table>
		<p>
			&nbsp; &nbsp; &nbsp; &nbsp;Untuk mengikuti Bimtek 
			”Implementasi Kebijakan Akuntansi Sesuai PP No. 71/2010 tentang Standar Akuntansi Pemerintahan Berbasis Akrual”  
			yang akan diselenggarakan pada:
		</p>
			<table style="margin-left:30px; ">
			<tr>
				<td style="width:80px;">Hari</td>
				<td>: <?php echo $hari_mulai.' - '.$hari_selesai; ?></td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td>: <?php echo $date_mulai.' - '.$date_selesai;?></td>
			</tr>
			<tr>
				<td>Waktu</td>
				<td>: <?php echo $time_mulai.' - '.$time_selesai;?> WIB</td>
			</tr>
			<tr>
				<td>Tempat</td>
				<td>: <?php echo $tempat;?>
				</td>
			</tr>
		</table>
		<p>
			&nbsp; &nbsp; &nbsp; &nbsp;Registrasi pembayaran bimtek sebesar Rp 2.500.000 (Dua juta limaratus ribu rupiah), 
			dilakukan hari pertama sebelum acara bimtek dimulai. Biaya tidak termasuk penginapan dan akomodasi. 
			Setiap Peserta mendapatkan fasilitas: Seminarkit, Sertifikat, Modul Materi, Makan Siang, Copy Break, 
			Foto Bersama dan Buku Album Angkatan. 
		</p>
		<p>
			&nbsp; &nbsp; &nbsp; &nbsp;Mohon konfirmasi jika terjadi pembatalan kemberangkatan, 
			Agar panitia bisa memberikan kuota kepada peserta lain, memalui email atau sms.
		</p>
		<p>
			&nbsp; &nbsp; &nbsp; &nbsp;Demikian surat panggilan ini kami buat, atas perhatian dan kerjasamanya diucapkan terima kasih. 
		</p>
		

		<div class="ttd" style="margin-left:500px;;
			background: url('<?php echo base_url();?>assets/img/ttd_undangan.jpg');
			background-image-resize:5; background-repeat:no-repeat;">
			<p style="margin-bottom:20px;">
				Yogyakarta, <?php echo $timestamp;?> <br> Kepala, 
			</p>
			
			<p>
				A. Tony Prasetiantono, Ph.D.<br>NIP. 19621027 198703 1 001 
			</p>
		</div>		


	</div>
</body>
</html>


