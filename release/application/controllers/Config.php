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
        $this->load->view('ConfigDrugRoom_view');
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

    public function test(){
        $queue = $this->load->database('queue',true);
        $queue->select('value_name');
        $queue->where('id', 'dep_screen_monitor');
        $queue->from('sys_value');
        $query = $queue->get()->result();
        foreach($query as $val){
            
            $a =$val->value_name;
        }
        echo $a;
        echo $jso;
    }

}