  <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->library('form_validation');
        $this->load->library('session');
        
	}

	public function index()
	{

    $start = $this->input->get('start_date');
    $end = $this->input->get('end_date');
    $submitted = $this->input->get('submitted');

    if(empty($start) && empty($end) && empty($submitted)){
      $query = $this->db->query("SELECT alternatif.nama_nasabah, kredit.aproved, kredit.tgl_kredit, k1.nama_sub as nama_sub1, k2.nama_sub as nama_sub2, k3.nama_sub as nama_sub3, k4.nama_sub as nama_sub4, k5.nama_sub as nama_sub5, k1.bobot_sub as bobot1, k2.bobot_sub as bobot2 , k3.bobot_sub as bobot3 , k4.bobot_sub as bobot4 , k5.bobot_sub as bobot5, k1.bobot_global as bobot_global1, k2.bobot_global as bobot_global2, k3.bobot_global as bobot_global3,
            k4.bobot_global as bobot_global4, k5.bobot_global as bobot_global5, kredit.vektor, kredit.aproved    
            FROM kredit INNER JOIN alternatif ON kredit.id_alternatif = alternatif.id_alternatif
            INNER JOIN subkriteria as k1 ON k1.id_sub = kredit.c1
            INNER JOIN subkriteria as k2 ON k2.id_sub = kredit.c2
            INNER JOIN subkriteria as k3 ON k3.id_sub = kredit.c3
            INNER JOIN subkriteria as k4 ON k4.id_sub = kredit.c4
            INNER JOIN subkriteria as k5 ON k5.id_sub = kredit.c5
            ORDER BY kredit.tgl_kredit ASC");

         
         $data=array(
            "kredit"=>$query->result(),
            "dari" => "Semua Data",
            "sampai"=> ""

        );

        $this->load->view('templates_kredit/header');
        $this->load->view('templates_kredit/sidebar');
        $this->load->view('laporan',$data);
        $this->load->view('templates_kredit/footer');

    }else {

     $query = $this->db->query("SELECT alternatif.nama_nasabah, kredit.aproved, kredit.tgl_kredit, k1.nama_sub as nama_sub1, k2.nama_sub as nama_sub2, k3.nama_sub as nama_sub3, k4.nama_sub as nama_sub4, k5.nama_sub as nama_sub5, k1.bobot_sub as bobot1, k2.bobot_sub as bobot2 , k3.bobot_sub as bobot3 , k4.bobot_sub as bobot4 , k5.bobot_sub as bobot5, k1.bobot_global as bobot_global1, k2.bobot_global as bobot_global2, k3.bobot_global as bobot_global3,
            k4.bobot_global as bobot_global4, k5.bobot_global as bobot_global5, kredit.vektor, kredit.aproved    
            FROM kredit INNER JOIN alternatif ON kredit.id_alternatif = alternatif.id_alternatif
            INNER JOIN subkriteria as k1 ON k1.id_sub = kredit.c1
            INNER JOIN subkriteria as k2 ON k2.id_sub = kredit.c2
            INNER JOIN subkriteria as k3 ON k3.id_sub = kredit.c3
            INNER JOIN subkriteria as k4 ON k4.id_sub = kredit.c4
            INNER JOIN subkriteria as k5 ON k5.id_sub = kredit.c5
            WHERE DATE(kredit.tgl_kredit) BETWEEN '$start' AND '$end' ORDER BY kredit.tgl_kredit ASC");

         
         $data=array(
            "kredit"=>$query->result(),
            "dari" => $start,
            "sampai"=> $end
        );

        $this->load->view('templates_kredit/header');
        $this->load->view('templates_kredit/sidebar');
        $this->load->view('laporan',$data);
        $this->load->view('templates_kredit/footer');
    }
  }
        
	



	
}
