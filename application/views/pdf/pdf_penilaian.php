
<html>
<head>
	<title></title>
	<style type="text/css">
		.tbl {
		    border-collapse: collapse;
		    width: 100%;
		}

		.tbl, .tbl tr td, .tbl tr th {
		    border: 1px solid black;
		}

		.judul
		{
			  text-align: center;
			  font-weight: bold; 
			  font-size: 15pt;
		}

		.numb
		{
			text-align: center;
		}
	</style>

</head>
<body>

	<div class="judul">
		<p>KUISIONER EVALUASI KINERJA FASILITATOR/PENGAJAR</p>
		<p>"<?php echo $data_pelatihan[0]['nama_pelatihan'];?>"</p>		
	</div>

	<div class="detail">
		<table>
			<tr>
				<td>Nama Fasilitator/Pengajar</td>
				<td>: <?php echo $data_pengajar['nama'];?></td>
			</tr>
			<tr>
				<td>Hari/Tanggal</td>
				<td>: <?php echo $hari_mengisi.', '.$tanggal_mengisi; ?></td>
			</tr>
			<tr>
				<td>Materi</td>
				<td>: <?php echo $data_pengajar['materi'];?></td>
			</tr>
		</table>		
	</div>	
	<div class="poinpoin">
		<p>Berikan tanda (v) pada kolom sesuai dengan penilaian bapak/ibu.</p>
		<table class="tbl">
			<thead>
				<tr>
					<th rowspan="2" style="width: 30px;">No</th>
					<th rowspan="2">Variabel Penilaian</th>
					<th colspan="5">Penilaian Responden</th>
				</tr>
				<tr>
					<th style="width: 50px;">BurukSekali</th>
					<th style="width: 50px;">Buruk</th>
					<th style="width: 50px;">Cukup</th>
					<th style="width: 50px;">Baik</th>
					<th style="width: 50px;">Sangat Baik</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$id_kategori=0; 
					$nomor=0;
				?>
				<?php foreach ($data_poin_penilaian as $key => $value): ?>
					<?php if ($id_kategori!=$value['id_kategori_point']): ?>
					<tr>
						<td></td>
						<td colspan="6"><p><b><?php echo $value['kategori_point'];?></b></p></td>
					</tr>
					<?php $nomor=0;?>
					<?php endif ?>
					<tr>
						<td><center><p class="numb"><?php echo ++$nomor;?>.</p></center></td>
						<td><p><?php echo $value['point_penilaian'];?></p></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<?php 
						$id_kategori=$value['id_kategori_point'];
					?>
				<?php endforeach ?>
				
			</tbody>
		</table>
	</div>
	<div class="masukan">
		<br>
		<p>Saran dan masukan anda akan sangat membantu kami.</p>
		<ul>
			<li style="list-style-type: none">1. Saran dan masukan untuk Substansi Materi :</li>
			<li style="list-style-type: none"> -</li>
			<li style="list-style-type: none"> -</li>
			<li style="list-style-type: none"> -</li>
			<li style="list-style-type: none"> -</li>
			<li style="list-style-type: none"> -</li>
			<li style="list-style-type: none"> -</li>
		</ul>
		<ul>
			<li style="list-style-type: none">2. Saran dan masukan untuk Fasilitator :</li>
			<li style="list-style-type: none"> -</li>
			<li style="list-style-type: none"> -</li>
			<li style="list-style-type: none"> -</li>
			<li style="list-style-type: none"> -</li>
			<li style="list-style-type: none"> -</li>
			<li style="list-style-type: none"> -</li>
		</ul>
	</div>
</body>
</html>


