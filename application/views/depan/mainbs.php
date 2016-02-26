<?php 
//echo '<pre>';
//print_r($nav);
//echo '</pre>';
 ?>
<html>
<head>
	<?php 
		$title="";
		if ($page=='depan') {
			$title="PSEKP";
		}else if($page=='Berita')
		{
			$title="Berita | PSEKP";
		}else if($page=='Pengumuman')
		{
			$title="Pengumuman | PSEKP";
		}else if($page=='Agenda')
		{
			$title="Agenda | PSEKP";
		}else if($page=='post')
		{
			$title=$post['judul']." | PSEKP";
		}else if($page=='galeri')
		{
			$title="Galeri | PSEKP";
		}
	 ?>
	<title><?php echo $title ?></title>

	 <!-- bootstrap 3.0.2 -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/depan/css/reset.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/depan/css/global.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/depan/css/mep.css" />
	<link type="text/css" href="<?php echo base_url();?>assets/depan/css/jquery.jscrollpane.css" rel="stylesheet" media="all" />
	<link type="text/css" href="<?php echo base_url();?>assets/depan/css/slider.css" rel="stylesheet" media="all" />

    <link href="<?php echo base_url();?>assets/depan/css/depan.css" rel="stylesheet" type="text/css" />


    <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56ceab2bda95bebc"></script>


</head>
<body>
	<div class="wrap-topmenu">
		<div class="w1000 center">
			<a href="http://ugm.ac.id" title="Website Universitas Gadjah Mada" target="_blank" class="L topmenu">Tentang UGM</a><div class="L topmenudevide"></div>
			<a href="http://lib.ugm.ac.id" target="_blank" class="L topmenu">Perpustakaan</a><div class="L topmenudevide"></div>  
    		<a href="http://ugmail.ugm.ac.id" target="_blank" class="L topmenu">UGMail</a><div class="L topmenudevide"></div>
    		<a href="http://feb.ugm.ac.id" target="_blank" class="L topmenu">FEB UGM</a><div class="L topmenudevide"></div>
    		<a href="<?php echo site_url();?>/id" title="Bahasa Indonesia" class="R topmenu active"><img src="<?php echo base_url();?>assets/img/Indonesia.png" width="12" height="10" /> INA</a><div class="R topmenudevide"></div>  
    		<a href="<?php echo site_url();?>/en" target="_self" title="Bahasa Inggris" class="R topmenu"><img src="<?php echo base_url();?>assets/img/us.jpg" width="12" height="10" /> English</a><div class="R topmenudevide"></div>  
		</div>
	</div>


	<div class="container">
		<div class="header" style="background: transparent url(<?php echo $setimage['banner']; ?>) no-repeat right top; width: 1000px; height: 110px;">
		<a href="#" class="logo_ugm"></a> 
			
		</div>
		<div class="wrap-mainnav">
		
			<!--khusus home-->
			<div class="mainnav home"><a class="label" href="<?php echo site_url(); ?>"><?php echo $this->lang->line('BERANDA'); ?></a></div><div class="separator"></div>
			<!--Menu selain home-->		
			<?php foreach ($nav as $key => $value): ?>
				<?php //if ($value['parent']['is_parent_nav']==1): ?>
				<?php  if (sizeof($value['childs']) >0 ): ?>
					<div class="mainnav" id="menuwithdropdown<?php echo $key+1 ?>">
						<a class="label"><?php echo $value['parent']['kategori_parent'] ?></a>
						<ul class="wrap-submainnav">
							<div class="arrownav"></div>
							<?php foreach ($value['childs'] as $key => $valu): ?>
								<li class="submainnav">
									<a href="<?php echo $valu['another_link']; ?>" class="submenulabel">
										<?php echo $valu['kategori']; ?> 
									</a>
								</li>
							<?php endforeach ?>

						</ul>
					</div>
				<?php endif ?>
				<?php  if (sizeof($value['childs']) <=0 ): ?>
				<?php //if ($value['parent']['is_parent_nav']==0): ?>
					<div class="mainnav"><a class="label" href="<?php echo ($value['parent']['parent_id_post']!=null) ? base_url().'index.php/main/post/'.$value['parent']['link'] : $value['parent']['parent_another_link'] ; ?>" target="blank"><?php echo $value['parent']['kategori_parent'] ?></a></div>			
				<?php endif ?>
			<?php endforeach ?>
	    </div>
		<div class=" content bg3 col-xs-12">
	    	<?php
	    		if ($page=='depan') {
	    			$this->load->view('depan/v_depan');
	    		}else if($page=='post')
	    		{
	    			$this->load->view('depan/v_singlepost');
	    		}else if($page=='galeri')
	    		{
	    			$this->load->view('depan/v_galeri');
	    		}else if($page=='Berita')
	    		{
	    			$this->load->view('depan/v_kumpulan_post');
	    		}else if($page=='Pengumuman')
	    		{
	    			$this->load->view('depan/v_kumpulan_post');
	    		}else if($page=='Agenda')
	    		{
	    			$this->load->view('depan/v_kumpulan_post');
	    		}
	    	?>
	    </div>
	</div>

	<div class="copyright">
	Copyright © 2015, Information System Division<br>
	<div itemscope="" itemtype="http://schema.org/Organization"> 
		<span itemprop="name">Faculty of Economics and Business, Universitas Gadjah Mada</span> <br>
		<div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
			Located at: 
			<span itemprop="streetAddress">Jln. Sosio Humaniora No.1 Bulaksumur</span>,
			<span itemprop="addressLocality">Yogyakarta</span>,
			<span itemprop="postalCode">55281</span>
			<span itemprop="addressRegion">Indonesia</span>
		</div>
		<span class="geo">
		   <span class="latitude">
		      <span class="value-title" title="-7.770422"></span>
		   </span>
		   <span class="longitude">
		      <span class="value-title" title="110.379297"></span>
		   </span>
		</span>
		Telephone: <span itemprop="telephone">+62 274 548510</span> |
		Faximile: <span itemprop="Facsimile">+62 274 563212</span> |
		Website: <a href="http://feb.ugm.ac.id" itemprop="url">www.feb.ugm.ac.id</a> <br>
		<a href="//feb.ugm.ac.id/en/sitemap.html" class="links-content">Sitemap</a> | <a href="//feb.ugm.ac.id/en/disclaimer.html" class="links-content">Disclaimer</a>
	</div>	
	<div class="clear">&nbsp;</div>
	<div>
		<img src="http://c.statcounter.com/4316428/0/8f989a40/1/" alt="febugm">
	</div>
</div>

	    

	<script type="text/javascript" src="<?php echo base_url();?>assets/depan/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/depan/js/jquery.cycle02.js"></script>

	<script type="text/javascript" src="<?php echo base_url();?>assets/depan/js/jquery.mousewheel.js"></script>

	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/depan/js/jquery.jscrollpane.min.js"></script>
	
	

	<script type="text/javascript">
		
		$(document).ready(function() {
		    $("#pane1").jScrollPane();
		    $("#pane2").jScrollPane();
		    $("#pane3").jScrollPane();
		    $("#pane4").jScrollPane();
		    $("#pane5").jScrollPane();
		    $("#pane6").jScrollPane();
		});

		$('#carousel-example-generic').carousel({
		  interval: 1000 * 4
		});

		$('#carousel-example-generic2').carousel({
		  interval: 1000 * 5
		});

		$('.carousel').carousel({
		  interval: 1000 * 1
		});


	</script>


</body>
</html>