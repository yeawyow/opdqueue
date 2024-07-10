<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}

    public function index(){
        $this->load->view('Config_view');
    } 

    public function callqueue(){
        $this->db->select('depcode,department');
        $this->db->order_by("depcode", "asc");
        $data['qdep'] = $this->db->get('kskdepartment ')->result();
        $this->load->view('ConfigCallQueue_view',$data);
    }

    public function drugroom(){
        $this->db->select('depcode,department');
        $this->db->order_by("depcode", "asc");
        $data['qdep'] = $this->db->get('kskdepartment ')->result();
        $this->load->view('ConfigDrugRoom_view',$data);
    }

    public function call(){
        $this->load->view('ConfigCallFile_view');
    }

    public function ConfigSceendept(){
        $this->db->select('depcode,department');
        $data['qdep'] = $this->db->get('kskdepartment ')->result();
        $this->load->view('ConfigSceendept_view',$data);
    }

    public function updateconfig(){
        $queue = $this->load->database('queue',true);
        $data = array(
            'call_queue'=> $this->input->post('callq')
            //'hn_len'=>$this->input->post('hn')
        );
        $queue->update('sys_configs', $data);
        echo  $queue->affected_rows();
    }

    public function updatehn_len(){
        $queue = $this->load->database('queue',true);
        $data = array(
            'hn_len'=>$this->input->post('hn')
        );
        $queue->update('sys_configs', $data);
        echo  $queue->affected_rows();
    }

    public function updatesub_queue(){
        $queue = $this->load->database('queue',true);
        $data = array(
            'sub_queue'=>$this->input->post('sub_queue')
        );
        $queue->update('sys_configs', $data);
        echo  $queue->affected_rows();
    }

    public function postDurgQueue(){
        $queue = $this->load->database('queue',true);
        $data = array(
            'drug_queue'=>$this->input->post('drug_queue')
        );
        $queue->update('sys_configs', $data);
        echo  $queue->affected_rows();
    }

    public function module(){
        $this->load->view('Config_module_view');
    }

    public function hnLen(){
        $queue = $this->load->database('queue',true);
        $queue->select('hn_len');
        $queue->from('sys_configs');
        $query = $queue->get()->result();
        echo json_encode($query);
    }

    public function QueueOrNameCalling(){
        $queue = $this->load->database('queue',true);
        $queue->select('call_queue,sub_queue,drug_queue');
        $queue->from('sys_configs');
        $query = $queue->get()->result();
        echo json_encode($query);
    }
    


    public function postDepartment(){
        $queue = $this->load->database('queue',true);

        $data = array(
            'value_name'=>  implode(",",$this->input->post('dep'))
        );

        $queue->where('id', 'dep_screen_monitor');
        $queue->update('sys_value', $data);
        echo  $queue->affected_rows();
       
    }

    public function postDocDept(){
        $queue = $this->load->database('queue',true);

        $data = array(
            'value_name'=>  implode(",",$this->input->post('dep'))
        );

        $queue->where('id', 'dep_Exam_monitor');
        $queue->update('sys_value', $data);
        echo  $queue->affected_rows();
       
    }

    public function postNCDClinic(){
        $queue = $this->load->database('queue',true);

        $data = array(
            'value_name'=>  implode(",",$this->input->post('dep'))
        );

        $queue->where('id', 'ncd_clinic');
        $queue->update('sys_value', $data);
        echo  $queue->affected_rows();
       
    }

    public function dent_morning_afternoon(){
        $queue = $this->load->database('queue',true);
        $data = array(
            'dent_morning'=>$this->input->post('morning'),
            'dent_afternoon'=>$this->input->post('afternoon')
        );
        $queue->update('sys_configs', $data);
        echo  $queue->affected_rows();
    }

    public function get_dent_queue(){
        $queue = $this->load->database('queue',true);
        $queue->select('dent_morning,dent_afternoon');
        $queue->from('sys_configs');
        $query = $queue->get()->result();
        echo json_encode($query);
    }

    public function get_msg(){
        $queue = $this->load->database('queue',true);
        $queue->select('msg_name');
        $queue->from('snk_msg_socket');
        $queue->where('msg_dep_call',$this->input->get('msg'));
        $query = $queue->get()->result();
        echo json_encode($query);
    }

    public function get_msg_combo(){
        $queue = $this->load->database('queue',true);
        $queue->select('msg_dep_call');
        $queue->from('snk_msg_socket');
        $query = $queue->get()->result();
        echo json_encode($query);
    }

    public function get_msg_title(){
        $queue = $this->load->database('queue',true);
        $queue->select('msg_dep_call');
        $queue->from('snk_msg_socket');
        $queue->where('msg_name',$this->input->get('msg'));
        $query = $queue->get()->result();
        echo json_encode($query);
    }

    public function postDrugIPDRoom(){
        $queue = $this->load->database('queue',true);

        $data = array(
            'value_name'=>  implode(",",$this->input->post('dep'))
        );

        $queue->where('id', 'drug_ipd_room');
        $queue->update('sys_value', $data);
        echo  $queue->affected_rows();
       
    }

    public function postDrugOPDRoom(){
        $queue = $this->load->database('queue',true);

        $data = array(
            'value_name'=>  implode(",",$this->input->post('dep'))
        );

        $queue->where('id', 'drug_opd_room');
        $queue->update('sys_value', $data);
        echo  $queue->affected_rows();
       
    }

    public function forward(){
        $this->db->select('depcode,department');
        $this->db->order_by("depcode", "asc");
        $data['qdep'] = $this->db->get('kskdepartment ')->result();
        $this->load->view('ConfigForward_view',$data);
    }

    public function postForward(){
        $queue = $this->load->database('queue',true);

        $data = array(
            'value_name'=>  implode(",",$this->input->post('dep'))
        );

        $queue->where('id', 'dep_forward');
        $queue->update('sys_value', $data);
        echo  $queue->affected_rows();
       
    }

    public function test(){
        $this->load->view('rabbitmq');
    }

}