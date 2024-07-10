<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DisplayWaitLAB extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}

    public function index(){
        $cur_date = date('Y-m-d'); 

        $queue = $this->load->database('queue',true);
        $queue->select('value_name');
        $queue->where('id', 'ncd_clinic');
        $queue->from('sys_value');
        $query = $queue->get()->result();

        foreach($query as $val){
            
            $qdep =$val->value_name;
        }

        $queue->select('sub_queue,call_queue');
        $queue->from('sys_configs');
        $data['q'] = $queue->get()->row();
        //echo $cur_date;
        //$this->$hosxp = $this->load->database('hosxp', TRUE); 
        $sql = $this->db->query("SELECT a.lab_order_number,CONCAT(b.pname,b.fname,'  ',b.lname) AS ptname,a.vn,a.hn,c.oqueue
        FROM lab_head a
        LEFT JOIN patient b ON a.hn=b.hn
        LEFT JOIN ovst c ON a.vn=c.vn
        WHERE a.`order_date`='$cur_date'
        AND a.`confirm_report`='N'
        AND a.`department`='OPD'
        AND a.`lab_priority_id` in('0','1')
        ORDER BY a.`lab_order_number` ASC");

        $sql2 = $this->db->query("SELECT a.lab_order_number,CONCAT(b.pname,b.fname,'  ',b.lname) AS ptname,a.vn,a.hn,c.oqueue
        FROM lab_head a
        LEFT JOIN patient b ON a.hn=b.hn
        LEFT JOIN ovst c ON a.vn=c.vn
        WHERE a.`order_date`='$cur_date'
        AND a.`confirm_report`='N'
        AND a.`department`='OPD'
        AND a.`lab_priority_id` in('2','3')
        ORDER BY a.`lab_order_number` ASC ");

        $data['pt'] = $sql->result();
        $data['priority'] = $sql2->result();
        //print_r($sql->result());

        $this->load->view('DisplayWaitLAB_view',$data);
        

    } 

		
}