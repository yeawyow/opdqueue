<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ControlDisplayWaitER extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}

    public function index(){
       
        $cur_date = date('Y-m-d'); 
        $queue = $this->load->database('queue',true);
        
        
        $queue->select('value_name');
        $queue->where('id', 'dep_ER_monitor');
        $queue->from('sys_value');
        $query = $queue->get()->result();

        foreach($query as $val){
            
            $qdep =$val->value_name;
        }

        $sql2 = $this->db->query("SELECT   v.vsttime,v.hn AS hn,l.lab_count,xh.confirm_all,l.report_count, v.spclty,v.pt_priority AS pt_priority,v.vn AS vn,
        v.oqueue AS oqueue,v.cur_dep_time AS cur_dep_time,ovq.pttype_check, spl.name AS spclty_name,erg.er_emergency_level_id,
        COUNT(s.vn) AS svn_count,  COUNT(r.vn) AS rx_count,COUNT(r1.vn) AS pay_count  , COUNT(t.vn) AS finance_count ,
            CONCAT(p.pname,p.fname,'  ',p.lname) AS ptname,v.cur_dep,IF(xh.vn<>'','1','0')AS xray_send,v.main_dep_queue  
            FROM ovst v 
            LEFT OUTER JOIN patient p ON p.hn=v.hn  
            LEFT OUTER JOIN pq_screen s ON s.vn=v.vn  
            LEFT OUTER JOIN rx_operator r ON r.vn=v.vn  
            LEFT OUTER JOIN rcpt_print t ON t.vn=v.vn  
            LEFT OUTER JOIN lab_status l ON l.vn = v.vn  
            LEFT OUTER JOIN xray_head xh ON xh.vn = v.vn  
            LEFT OUTER JOIN rx_operator r1 ON r1.vn=v.vn AND r1.pay='Y' 
            LEFT OUTER JOIN ovst_seq ovq ON ovq.vn = v.vn  
            LEFT OUTER JOIN spclty spl ON spl.spclty = v.spclty  
            LEFT OUTER JOIN er_regist erg ON erg.vn = v.vn 
            WHERE v.vstdate='$cur_date'
            AND v.cur_dep IN($qdep) -- IN('020','021','027','028','032' )
            -- AND v.cur_dep_busy='N'
            AND v.pt_priority in('0','1','2')  
            GROUP BY v.vsttime,v.hn,l.lab_count,xh.confirm_all,l.report_count,v.pt_priority,spl.name,v.vn,v.oqueue,v.cur_dep_time, p.pname,p.fname,p.lname,ovq.pttype_check ,erg.er_emergency_level_id 
            ORDER BY v.pt_priority DESC,v.cur_dep_time ");

       
        $arrayObject = $sql2->result();
        $additionalService = array();

        foreach($arrayObject as $data){
            $sql3 = $queue->query("SELECT q_vn,erlevel FROM `tbl_queue` WHERE q_vn='$data->vn'")->result();
            
            if(empty($sql3)){
                if($data->pt_priority == 0){
                    $data->erlevel = '5';
                }else if($data->pt_priority == 1){
                    $data->erlevel = '3'; 
                }else if($data->pt_priority == 2){
                    $data->erlevel = '1';
                }
                
                array_push($additionalService,$data);
                
            }else{
                foreach($sql3 as $k=>$val){
                    $data->erlevel = $val->erlevel;
                    array_push($additionalService,$data);
                    
                }
            }
            

        }
        $data = array();
        $data['priority'] = $additionalService; 

        $queue->select('sub_queue');
        $queue->from('sys_configs');
        
        $data['q'] = $queue->get()->row();

        //print_r($data);
        //echo '<br /><br />';
        //print_r($additionalService);
        $this->load->view('ControlDisplayWaitER_view',$data);
        //echo json_encode($data);
        
    }

    
    
    
}