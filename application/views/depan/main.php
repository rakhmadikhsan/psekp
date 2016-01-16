<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />





</head>
<body>
	<script language="javascript" type="text/javascript">
	 function lanfTrans(lan)
	 {
	   switch(lan)
	   {
	   case 'en': document.getElementById('dlang').value='en';document.langForm.submit(); break;
	   case 'fr': document.getElementById('dlang').value='fr'; document.langForm.submit(); break;
	   case 'es': document.getElementById('dlang').value='es'; document.langForm.submit(); break;
	   } 
	 }
	</script>
<!--
<a href="<?php echo base_url();;?>">indo</a>
<a href="<?php echo base_url().'index.php/main_en';?>">en</a>
<?php echo $this->lang->line('dpn_home');?> -->




<form name="langForm" id="langForm" action="<?php echo base_url().'index.php/main/languages';?>" method="post"> 

<?php // 'welcome' - [Home page controller] ?>

<input type="hidden" name="dlang" id="dlang"> 

<?php // 'dlang' - [Language choosen] ?>

<input type="hidden" name="current" id="current" value="<?php echo substr(uri_string(),1,strlen(uri_string()));?>">

<?php // 'current' - [Current page url] ?>

<?php // [Language images] ?>
 
<img src="<?=base_url()?>images/fr.png" onClick="lanfTrans('fr');" width="16" height="11" title="To French"> &nbsp; 

<img src="<?=base_url()?>images/en.png" onClick="lanfTrans('en');" width="16" height="11" title="To English"> &nbsp;
<img src="<?=base_url()?>images/es_flag.gif" onClick="lanfTrans('es');" width="16" height="11" title="To Spanish"> &nbsp;

<?php echo form_close(); ?>

<?php translate("Welcome to codeigniter",$lang);?>
</body>
</html>