<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateRoomNo extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}

    public function index(){
        $cur_date = date('Y-m-d'); 
        $sql = $this->db->query("SELECT depcode,department,roomno FROM kskdepartment WHERE department LIKE 'ห้องตรวจ%' ");
        $data['room'] = $sql->result();

        $this->load->view('UpdateRoomNo_view',$data);

    } 

    public function callUpdateFrom(){
        $dep = $this->uri->segment(3, 0);
        $sql = $this->db->query("SELECT depcode,department,roomno FROM kskdepartment WHERE depcode ='$dep' ");
        $data['dep'] = $sql->result();
        $this->load->view('callUpdateFrom_view',$data);

    }

    public function update(){
      
        $data = array( 
            'roomno' => $this->input->post('roomno')  
        );

        $this->db->where('depcode',$this->input->post('depcode'));
        $this->db->update('kskdepartment', $data);

        redirect('index.php/UpdateRoomNo', 'refresh');


    }


		
}