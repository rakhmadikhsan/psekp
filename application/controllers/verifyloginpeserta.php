<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLoginPeserta extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('m_peserta','',TRUE);
 }

 function index()
 {
   //This method will have the credentials validation
   $this->load->library('form_validation');

   $this->form_validation->set_rules('nip', 'Nip', 'trim|required|xss_clean|callback_check_database');

   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.  User redirected to login page
     redirect('loginpeserta');
   }
   else
   {
     //Go to private area
     redirect('peserta');
   }

 }

 function check_database($nip)
 {

   //query the database
   $result = $this->m_peserta->login($nip);

   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'id' => $row['id_peserta'],
         'nip' => $row['nip'],
         'nama' => $row['nama']
       );
       //print_r($result);
       //echo $result[0]['id_user'];
       //die();
       $this->session->set_userdata('logged_in_peserta', $sess_array);
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid NIP');
     // $this->session->set_flashdata('error',"NIP yang anda masukkan salah atau belum terdaftar.");
     // redirect("main");
     return false;
   }
 }
}
?>