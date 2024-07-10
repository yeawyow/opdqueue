<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DisplayWaitScreen extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}

    public function index(){
        $cur_date = date('Y-m-d'); 

        $queue = $this->load->database('queue',true);
        $queue->select('value_name');
        $queue->where('id', 'dep_screen_monitor');
        $queue->from('sys_value');
        $query = $queue->get()->result();

        foreach($query as $val){
            
            $qdep =$val->value_name;
        }

        $queue->select('vn');
        //$queue->where('id', 'dep_screen_monitor');
        $queue->from('snk_call_skip');
        $qry = $queue->get()->result();
        foreach($qry as $val){
            $skip = $val->vn;
        }

        $queue->select('sub_queue,call_queue');
        $queue->from('sys_configs');
        $data['q'] = $queue->get()->row();
        //echo $cur_date;
        //$this->$hosxp = $this->load->database('hosxp', TRUE); 
        $sql = $this->db->query("SELECT v.vn,v.hn,v.vstdate,v.oqueue,v.main_dep_queue,v.pt_priority,k.department,xh.confirm_all,l.lab_count,l.report_count,CONCAT(p.pname,p.fname,'  ',p.lname) AS ptname,ovq.pttype_check  
        FROM ovst v  
        LEFT OUTER JOIN patient p ON p.hn=v.hn  
        LEFT OUTER JOIN lab_status l ON l.vn = v.vn  
        LEFT OUTER JOIN xray_head xh ON xh.vn = v.vn  
        LEFT OUTER JOIN ovst_seq ovq ON ovq.vn = v.vn  
        LEFT OUTER JOIN kskdepartment k ON k.depcode = v.cur_dep  
        WHERE v.vstdate='$cur_date'
        AND v.cur_dep IN($qdep)-- IN('010','014','065','004')
        AND v.cur_dep_busy='N'
        AND (v.pt_priority ='0' OR v.pt_priority IS NULL)
        AND v.hn NOT IN ('')  ORDER BY v.oqueue ");

        $sql2 = $this->db->query("SELECT v.vn,v.hn,v.vstdate,v.oqueue,v.main_dep_queue,v.pt_priority,k.department,xh.confirm_all,l.lab_count,l.report_count,CONCAT(p.pname,p.fname,'  ',p.lname) AS ptname,ovq.pttype_check  
        FROM ovst v  
        LEFT OUTER JOIN patient p ON p.hn=v.hn  
        LEFT OUTER JOIN lab_status l ON l.vn = v.vn  
        LEFT OUTER JOIN xray_head xh ON xh.vn = v.vn  
        LEFT OUTER JOIN ovst_seq ovq ON ovq.vn = v.vn  
        LEFT OUTER JOIN kskdepartment k ON k.depcode = v.cur_dep  
        WHERE v.vstdate='$cur_date' 
        AND v.cur_dep IN($qdep) -- IN('010','014','065','004')
        AND v.cur_dep_busy='N'
        AND v.pt_priority in('1','2')
        AND v.hn NOT IN ('')  ORDER BY v.pt_priority DESC,v.cur_dep_time ");

        $data['pt'] = $sql->result();
        $data['priority'] = $sql2->result();
        //print_r($sql->result());
        $this->load->view('header-queue',$data);
        $this->load->view('DisplayWaitScreen_view',$data);
        $this->load->view('footer',$data);
        

    } 

   
   
}