<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ContronDisplayWaitER extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}

    public function index(){
        $cur_date = date('Y-m-d'); 
        //echo $cur_date;
        //$this->$hosxp = $this->load->database('hosxp', TRUE);
        $queue = $this->load->database('queue',true);
        $queue->select('sub_queue');
        $queue->from('sys_configs');
        $data['q'] = $queue->get()->row();
        
        $queue->select('value_name');
        $queue->where('id', 'dep_ER_monitor');
        $queue->from('sys_value');
        $query = $queue->get()->result();

        foreach($query as $val){
            
            $qdep =$val->value_name;
        }

        $sql = $this->db->query("SELECT   v.vsttime,v.hn AS hn,l.lab_count,xh.confirm_all,l.report_count, v.spclty,v.pt_priority AS pt_priority,v.vn AS vn,
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
            AND v.pt_priority = '0'  
            GROUP BY v.vsttime,v.hn,l.lab_count,xh.confirm_all,l.report_count,v.pt_priority,spl.name,v.vn,v.oqueue,v.cur_dep_time, p.pname,p.fname,p.lname,ovq.pttype_check ,erg.er_emergency_level_id 
            ORDER BY v.oqueue ");

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
            AND v.pt_priority in('1','2')  
            GROUP BY v.vsttime,v.hn,l.lab_count,xh.confirm_all,l.report_count,v.pt_priority,spl.name,v.vn,v.oqueue,v.cur_dep_time, p.pname,p.fname,p.lname,ovq.pttype_check ,erg.er_emergency_level_id 
            ORDER BY v.pt_priority DESC,v.cur_dep_time ");

        $data['pt'] = $sql->result();
        $data['priority'] = $sql2->result();
        //print_r($sql->result());

        $this->load->view('ContronDisplayWaitER_view',$data);

    } 

    public function jong(){
        $queue = $this->load->database('queue',true);
        $his = $this->load->database('default',true);

        $cur_date = date('Y-m-d'); 
   
        $queue->select('value_name');
        $queue->where('id', 'dep_ER_monitor');
        $queue->from('sys_value');
        $query = $queue->get()->result();

        foreach($query as $val){
            
            $qdep =$val->value_name;
        }

        /*
        $his->select(' ovst.vsttime,ovst.hn ,ovst.spclty,ovst.pt_priority ,tbl_queue.`erlevel`');
        $his->from('ovst');
        $his->join($queue->database.'.tbl_queue','ovst.vn=tbl_queue.q_vn', 'left');
        $his->where('vstdate','2020-02-10');
        $res = $his->get()->result();
        echo json_encode($res);*/

        $his->select("ovst.vsttime,ovst.hn AS hn,lab_status.lab_count,xray_head.confirm_all,lab_status.report_count, ovst.spclty,ovst.pt_priority AS pt_priority,ovst.vn AS vn,
        ovst.oqueue AS oqueue,ovst.cur_dep_time AS cur_dep_time,ovst_seq.pttype_check, spclty.name AS spclty_name,er_regist.er_emergency_level_id,
        COUNT(pq_screen.vn) AS svn_count,  COUNT(rx_operator.vn) AS rx_count,COUNT(rx_operator.vn) AS pay_count  , COUNT(rcpt_print.vn) AS finance_count ,
        CONCAT(patient.pname,patient.fname,'  ',patient.lname) AS ptname,ovst.cur_dep,IF(xray_head.vn<>'','1','0')AS xray_send,ovst.main_dep_queue,tbl_queue.erlevel "); 
        $his->from('ovst'); 
        $his->join('patient','patient.hn=ovst.hn','left');  
        $his->join('pq_screen','pq_screen.vn=ovst.vn','left');  
        $his->join('rx_operator','rx_operator.vn=ovst.vn AND rx_operator.pay="Y"','left');   
        $his->join('rcpt_print', 'rcpt_print.vn=ovst.vn','left');  
        $his->join('lab_status', 'lab_status.vn = ovst.vn','left');  
        $his->join('xray_head', 'xray_head.vn = ovst.vn','left');  
        $his->join('ovst_seq', 'ovst_seq.vn = ovst.vn','left');  
        $his->join('spclty', 'spclty.spclty = ovst.spclty','left');  
        $his->join('er_regist', 'er_regist.vn = ovst.vn','left'); 
        $his->join($queue->database.'.tbl_queue','ovst.vn=tbl_queue.q_vn', 'left');
        $his->where('ovst.vstdate',$cur_date);
        $his->where_in('ovst.cur_dep','011'); 
        $his->where_in('ovst.pt_priority',array('0','1', '2'));  
        $his->group_by(array('ovst.vsttime','ovst.hn','lab_status.lab_count','xray_head.confirm_all','lab_status.report_count','ovst.pt_priority','spclty.name','ovst.vn','ovst.oqueue','ovst.cur_dep_time', 'patient.pname','patient.fname','patient.lname','ovst_seq.pttype_check' ,'er_regist.er_emergency_level_id')); 
        $his->order_by('ovst.pt_priority DESC,ovst.cur_dep_time ASC');
        $res = $his->get()->result();
        echo json_encode($res);
    }

    public function test(){
        $cur_date = date('Y-m-d'); 
        //echo $cur_date;
        //$this->$hosxp = $this->load->database('hosxp', TRUE);
        $queue = $this->load->database('queue',true);
        $queue->select('sub_queue');
        $queue->from('sys_configs');
        $data['q'] = $queue->get()->row();
        
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

        $sql3 = $queue->query("SELECT q_vn,erlevel FROM `tbl_queue` WHERE DATE_FORMAT( q_dateupdate,'%Y-%m-%d') = '2020-02-11'");
       
        $arrayObject = $sql2->result();
        $arraySQL3 = $sql3->result();
        $additionalService = array();

        foreach($arraySQL3 as $k=>$val){
            foreach($arrayObject as $data) {
                if ($val->q_vn == $data->vn) {
                    $data->erlevel = $val->erlevel;
                    array_push($additionalService,$data);
                   // echo $val->erlevel;
                }
            }
        }
       echo json_encode($additionalService);
        /*foreach($arrayObject as $data) {

            if ('630211092108' == $data->vn) {
                print_r($data);
            }
            
            //print_r($data);
            //echo array_search('630211092108', array_column($data, 'q_vn'));
            /*foreach($data as $struct) {
              
            }*/
            //!ok
            //$data->JONG = "JANG";
            //array_push($additionalService,$data);
            //! end ok
            
        //}*/
        
     

        
    } 
	
    
    
}