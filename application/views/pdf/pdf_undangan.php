
<html>
<head>
	<title></title>
	<style type="text/css">
		body {
			<?php if ($is_email!=1): ?>
				background: url("<?php echo base_url();?>assets/img/bg_pdf.jpg");
		    	background-image-resize:6;
			<?php endif ?>
		    

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
		    width: 100%;
		}

		.tbl, .tbl tr td, .tbl tr th {
		    border: 1px solid black;
		    padding: 5px;
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
				<td>Nomor</td>
				<td>: <?php echo $kode_surat;?></td>
			</tr>
			<tr>
				<td>Lamp</td>
				<td>: -</td>
			</tr>
			<tr>
				<td>Hal</td>
				<td>: Undangan Bimtek</td>
			</tr>
		</table>

		<div style="margin-left:500px">
			<p>Kepada Yth.<br>
			Kepala <?php echo $instansi;?><br>
			<?php echo $daerah;?><br>
			Di Tempat</p>
		</div>		
		<div >
			<p>Dengan Hormat.</p>
			<p>&nbsp; &nbsp; &nbsp; &nbsp;Bersama ini perkenankan kami memperkenalkan lembaga kami, 
				Pusat  Studi Ekonomi dan Kebijakan Publik Universitas Gadjah Mada (PSEKP-UGM). 
				PSEKP adalah pusat studi terkemuka di lingkungan UGM, 
				yang memiliki kegiatan utama di bidang penelitian, bimtek/diklat, konsultasi dan pengembangan 
				dalam bidang ekonomi dan kebijakan publik.
			</p>
			<p>&nbsp; &nbsp; &nbsp; &nbsp;Pada kesempatan ini, kami mengajukan penawaran bimtek/diklat untuk mengantisipasi 
				isu-isu terbaru dan perkembangan terkini terkait implementasi peraturan perundang-undangan 
				otonomi daerah. Adapun judul bimtek adalah:
			</p>
			<table class="tbl" >
				<tr>
					<th style="width:80px;">No</th>
					<th>Judul</th>
					<th>Hari/Tanggal</th>
				</tr>
				<tr>
					<td><center>1</center></td>
					<td><?php echo $nama_pelatihan;?></td>
					<td><?php echo $hari_mulai.' - '.$hari_selesai; ?> / <?php echo $date_mulai.' - '.$date_selesai;?></td>
				</tr>
				
			</table>
			<p>
				<i>
					&nbsp; &nbsp; &nbsp; &nbsp;Nb. Mohon konfirmasi terlebih dahulu sebelum mendaftar, 
				Panitia tidak bertanggungjawab atas 
				kesalahan jadwal agenda yang terjadi. Atas perhatiannya diucapkan terimakasih
				</i>
				
			</p>
			<table style="margin-left:30px;">
				<tr>
					<td style="width:80px;">Waktu</td>
					<td>: <?php echo $time_mulai.' - '.$time_selesai;?> WIB</td>
				</tr>
				<tr>
					<td>Tempat</td>
					<td>: <?php echo $tempat;?></td>
				</tr>
			</table>
			<p>
				&nbsp; &nbsp; &nbsp; &nbsp;Setiap judul bimtek/diklat yang kami tawarkan, peserta dikenakan biaya 
				Rp 2.500.000,00 (dua juta lima ratus ribu rupiah), tidak termasuk penginapan dan akomodasi. 
				Untuk lebih jelasnya dapat menghubungi Ibu Istikomah 0816689597 dan Ibu Sumarah 08157998692.
			</p>
			<p>
				&nbsp; &nbsp; &nbsp; &nbsp;Selanjutnya, mohon kerjasamanya untuk disebarluaskan di lingkungan Satuan Kerja 
				Perangkat Daerah (SKPD) Bapak/Ibu/Saudara.
			</p>
			<p>
				&nbsp; &nbsp; &nbsp; &nbsp;Demikian penawaran yang kami sampaikan atas perhatian dan kerjasamanya kami sampaikan terimakasih.
			</p>
		</div>
		

		<div class="ttd">
			<p style="margin-bottom:20px;">
				Yogyakarta, <?php echo $timestamp;?> <br> Kepala, 
			</p>
			
			<p>
				A. Tony Prasetiantono, Ph.D.<br>NIP. 19621027 198703 1 001 
			</p>
		</div>		
 
		<?php if ($is_email==1): ?>
			<a href="<?php echo site_url().'/pdf/pdfundangan/'.$id_peserta_has_pelatihan; ?>">
				Download Undangan
			</a>
			
			<br>
			Anda perlu segera mengkonfirmasi kehadirann anda sebelum quota habis.
			<a href="<?php echo site_url().'/konfirmasi/'; ?>">Konfirmasi Kehadiran anda di sini.</a>
		<?php endif ?>
	</div>
</body>
</html>


