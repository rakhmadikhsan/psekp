<?php
    Class M_peserta_has_pelatihan extends CI_Model
    {
        function tambah_peserta_has_pelatihan($par)
        {
            $this->db->insert('peserta_has_pelatihan', $par); 
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }

        function ubah_peserta_has_pelatihan($id_peserta_has_pelatihan,$par)
        {
          $this->db->where('id_peserta_has_pelatihan', $id_peserta_has_pelatihan);
          $data=$this->db->update('peserta_has_pelatihan', $par);
          return $data;
        }

        function getJadwal()
        {
          $query = $this->db->query("SELECT pelatihan.id_pelatihan, pelatihan.tempat, pelatihan.date_mulai, pelatihan.date_selesai, pelatihan.time_mulai, pelatihan.time_selesai, IF(a.jumlah IS NULL , 0, a.jumlah) as jumlah, pelatihan.quota, pelatihan.nama_pelatihan from (select peserta_has_pelatihan.id_pelatihan_fk as id_pelatihan, COUNT(*) as jumlah from peserta_has_pelatihan
            WHERE peserta_has_pelatihan.status_kehadiran=1
            group by peserta_has_pelatihan.id_pelatihan_fk) as a
            right join pelatihan
            on a.id_pelatihan=pelatihan.id_pelatihan
            WHERE pelatihan.date_mulai >= CURRENT_DATE() and pelatihan.`status`=1");

          return $query -> result_array();
        }

       function getSisaQuota($id_pelatihan)
       {
           $this->load->model('m_pelatihan','',TRUE);
           $parPelatihan['id_pelatihan']=$id_pelatihan;
           $data_pelatihan=$this->m_pelatihan->getPelatihan($parPelatihan);
        
           $quota=$data_pelatihan[0]['quota'];

           $parPHP['id_pelatihan_fk']=$id_pelatihan;
           $parPHP['status_kehadiran']=1;
           $dataPHP=$this->getPesertaHasPelatihan($parPHP);
          
           $jumlahPeserta=count($dataPHP);

           if($jumlahPeserta<$quota)
           {
              return $quota-$jumlahPeserta;
           }else
           {
              return 0;
           }
      }

      function konfirmasiPeserta($nip,$id_peserta)
      {
         $this->db->select('*')
          ->from('peserta_has_pelatihan')
          ->join('peserta', 'peserta_has_pelatihan.id_peserta_fk = peserta.id_peserta')
          ->join('pelatihan', 'peserta_has_pelatihan.id_pelatihan_fk = pelatihan.id_pelatihan')
          ->where('peserta_has_pelatihan.id_peserta_has_pelatihan',$id_peserta)
          ->where('peserta.nip',$nip);
          $data = $this->db->get();
          return $data -> result_array();
      }

      function hapus_peserta_has_pelatihan($par)
      {
         return $this->db->delete('peserta_has_pelatihan', $par);
      }

      function hapus_kehadiran_array($id_kehadiran_array)
      {
          $this->db->trans_start();
          foreach ($id_kehadiran_array as $key => $value) {
            $par['id_peserta_has_pelatihan']=$value;
            $this->hapus_peserta_has_pelatihan($par);
          }
          $this->db->trans_complete();
          $result=$this->db->trans_status();
          return $result;
      }

      function getPesertaHasPelatihan($par)
      {
          $data = $this->db->get_where('peserta_has_pelatihan', $par);
          return $data -> result_array();
      }

      function getForPrintPDF($id_peserta_has_pelatihan)
      {
          $this->db->select('*')
          ->from('peserta_has_pelatihan')
          ->join('peserta', 'peserta_has_pelatihan.id_peserta_fk = peserta.id_peserta')
          ->join('pelatihan', 'peserta_has_pelatihan.id_pelatihan_fk = pelatihan.id_pelatihan')
          ->where('peserta_has_pelatihan.id_peserta_has_pelatihan',$id_peserta_has_pelatihan);
          $data = $this->db->get();
          return $data -> result_array();
      }

      function getRiwayatPelatihan($id_peserta)
      {
          $this->db->select('*')
          ->from('peserta_has_pelatihan')
          ->join('peserta', 'peserta_has_pelatihan.id_peserta_fk = peserta.id_peserta')
          ->join('pelatihan', 'peserta_has_pelatihan.id_pelatihan_fk = pelatihan.id_pelatihan')
          ->where('peserta.id_peserta',$id_peserta);
          $data = $this->db->get();
          return $data -> result_array();
      }

      function register($par)
      {
          $result="";
          $this->db->trans_start();
          $sisa_quota=$this->getSisaQuota($par['id_pelatihan_fk']);

          if($sisa_quota)
          {
             $this->tambah_peserta_has_pelatihan($par);
             $result = 'sukses';
          }
          else{
             $result = "quota penuh";
          }

          if(!$this->db->trans_complete())
          {
             $result = "teransaksi gagal";
          }

              return $result;   
        }

        /*function cek_jumlah_peserta($id_pelatihan)
        {
            $query= $this->db->query('select count(*) as jumlah_peserta from peserta_has_pelatihan where peserta_has_pelatihan.id_pelatihan_fk='.$id_pelatihan);
            $data=$query->result();
            print_r($data);
            break 1;
            return $data['jumlah_peserta'];
        }*/
    }

    


?>