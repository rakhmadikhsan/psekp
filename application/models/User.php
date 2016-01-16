<?php
  Class User extends CI_Model
  {
   function login($username, $password)
   {
     $this -> db -> where('username', $username);
     //$this -> db -> where('password', MD5($password));
     $this -> db -> where('password', md5($password));
     $this -> db -> limit(1);
     $data = $this -> db -> get('user');
   
     return $data -> result_array();
   }
  }
?>