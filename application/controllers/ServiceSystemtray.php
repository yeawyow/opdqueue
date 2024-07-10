<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ServiceSystemtray extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}

    public function index(){
        $msg = $this->input->get('msg');
        $dep = $this->input->get('dep');
        if($msg == 'HOSxPScreen'){
            $this->opdscreen($dep);
        }else if($msg == 'call_to_exam_room'){
            $this->doctor_call($dep);
        }else if($msg == 'HOSxPDent'){
            $this->dentscreen($dep);
        }
    }

    public function dentscreen($dep){
        $cur_date = date('Y-m-d'); 

        $queue = $this->load->database('queue',true);
        $query = $queue->query("SELECT * FROM snk_call_skip");
        
        if($query->num_rows() == 0){
            $s = "' '";
        }else{
            $skip = [];
            $queue->select('vn');
            $queue->from('snk_call_skip');
            $qry = $queue->get()->result();
            foreach($qry as $val){
                //$skip = $val->vn;
                array_push($skip,$val->vn);
            }
            $s = implode(",",$skip);
        }
         
        $sql = $this->db->query("SELECT v.vn,v.hn,v.vstdate,v.oqueue,v.main_dep_queue,v.pt_priority,k.department
        ,xh.confirm_all,l.lab_count,l.report_count,CONCAT(p.pname,p.fname,'  ',p.lname) AS ptname,ovq.pttype_check
        ,o.nextdate,TIMESTAMPDIFF(YEAR,p.birthday,NOW()) AS age  
        FROM ovst v  
        LEFT OUTER JOIN patient p ON p.hn=v.hn  
        LEFT OUTER JOIN lab_status l ON l.vn = v.vn  
        LEFT OUTER JOIN xray_head xh ON xh.vn = v.vn  
        LEFT OUTER JOIN ovst_seq ovq ON ovq.vn = v.vn  
        LEFT OUTER JOIN kskdepartment k ON k.depcode = v.cur_dep
        LEFT OUTER JOIN oapp o ON o.hn=v.hn AND o.nextdate='$cur_date'  
        WHERE v.vstdate ='$cur_date'
        AND v.cur_dep IN($dep)  
        AND v.cur_dep_busy='N'
        AND (v.pt_priority = 0 OR v.pt_priority IS NULL OR v.pt_priority ='')
        AND v.vn NOT IN ($s)
        AND v.hn NOT IN ('')  ORDER BY v.oqueue ");

        $sql2 = $this->db->query("SELECT v.vn,v.hn,v.vstdate,v.oqueue,v.main_dep_queue,v.pt_priority,k.department
        ,xh.confirm_all,l.lab_count,l.report_count,CONCAT(p.pname,p.fname,'  ',p.lname) AS ptname,ovq.pttype_check
        ,o.nextdate,TIMESTAMPDIFF(YEAR,p.birthday,NOW()) AS age  
        FROM ovst v  
        LEFT OUTER JOIN patient p ON p.hn=v.hn  
        LEFT OUTER JOIN lab_status l ON l.vn = v.vn  
        LEFT OUTER JOIN xray_head xh ON xh.vn = v.vn  
        LEFT OUTER JOIN ovst_seq ovq ON ovq.vn = v.vn  
        LEFT OUTER JOIN kskdepartment k ON k.depcode = v.cur_dep
        LEFT OUTER JOIN oapp o ON o.hn=v.hn AND o.nextdate='$cur_date'  
        WHERE v.vstdate ='$cur_date'
        AND v.cur_dep  IN($dep) --  IN('010','014','065','004')
        AND v.cur_dep_busy='N'
        AND v.pt_priority in('1','2')
        AND v.vn NOT IN ($s) 
        AND v.hn NOT IN ('')  ORDER BY v.pt_priority DESC,v.cur_dep_time ");

        $sql_skip = $this->db->query("SELECT v.vn,v.hn,v.vstdate,v.oqueue,v.main_dep_queue,v.pt_priority,k.department
        ,xh.confirm_all,l.lab_count,l.report_count,CONCAT(p.pname,p.fname,'  ',p.lname) AS ptname,ovq.pttype_check
        ,o.nextdate,TIMESTAMPDIFF(YEAR,p.birthday,NOW()) AS age  
        FROM ovst v  
        LEFT OUTER JOIN patient p ON p.hn=v.hn  
        LEFT OUTER JOIN lab_status l ON l.vn = v.vn  
        LEFT OUTER JOIN xray_head xh ON xh.vn = v.vn  
        LEFT OUTER JOIN ovst_seq ovq ON ovq.vn = v.vn  
        LEFT OUTER JOIN kskdepartment k ON k.depcode = v.cur_dep 
        LEFT OUTER JOIN oapp o ON o.hn=v.hn AND o.nextdate='$cur_date' 
        WHERE v.vstdate ='$cur_date'  
        AND v.cur_dep  IN($dep) -- IN('010','014','065','004')  
        AND v.cur_dep_busy='N'
        -- AND v.pt_priority in('0','1','2')
        AND v.vn  IN ($s) 
        AND v.hn NOT IN ('')  ORDER BY v.pt_priority DESC,v.cur_dep_time ");

        $data['pt'] = $sql->result();
        $data['priority'] = $sql2->result();
        $data['skip'] = $sql_skip->result();
        //print_r($sql->result());

        echo json_encode($data);
        
    }

    public function opdscreen($dep){
        $cur_date = date('Y-m-d'); 

        $queue = $this->load->database('queue',true);
        $query = $queue->query("SELECT * FROM snk_call_skip");
        
        if($query->num_rows() == 0){
            $s = "' '";
        }else{
            $skip = [];
            $queue->select('vn');
            $queue->from('snk_call_skip');
            $qry = $queue->get()->result();
            foreach($qry as $val){
                //$skip = $val->vn;
                array_push($skip,$val->vn);
            }
            $s = implode(",",$skip);
        }
         
        $sql = $this->db->query("SELECT v.vn,v.hn,v.vstdate,v.oqueue,v.main_dep_queue,v.pt_priority,k.department,
        xh.confirm_all,l.lab_count,l.report_count,CONCAT(p.pname,p.fname,'  ',p.lname) AS ptname,ovq.pttype_check,
        o.nextdate,TIMESTAMPDIFF(YEAR,p.birthday,NOW()) AS age  
        FROM ovst v  
        LEFT OUTER JOIN patient p ON p.hn=v.hn  
        LEFT OUTER JOIN lab_status l ON l.vn = v.vn  
        LEFT OUTER JOIN xray_head xh ON xh.vn = v.vn  
        LEFT OUTER JOIN ovst_seq ovq ON ovq.vn = v.vn  
        LEFT OUTER JOIN kskdepartment k ON k.depcode = v.cur_dep
        LEFT OUTER JOIN oapp o ON o.hn=v.hn AND o.nextdate='$cur_date'  
        WHERE v.vstdate ='$cur_date'
        AND v.cur_dep IN($dep)  
        AND v.cur_dep_busy='N'
        AND (v.pt_priority = 0 OR v.pt_priority IS NULL OR v.pt_priority ='')
        AND v.vn NOT IN ($s)
        AND v.hn NOT IN ('')  ORDER BY v.oqueue ");

        $sql2 = $this->db->query("SELECT v.vn,v.hn,v.vstdate,v.oqueue,v.main_dep_queue,v.pt_priority,k.department,
        xh.confirm_all,l.lab_count,l.report_count,CONCAT(p.pname,p.fname,'  ',p.lname) AS ptname,ovq.pttype_check,
        o.nextdate,TIMESTAMPDIFF(YEAR,p.birthday,NOW()) AS age  
        FROM ovst v  
        LEFT OUTER JOIN patient p ON p.hn=v.hn  
        LEFT OUTER JOIN lab_status l ON l.vn = v.vn  
        LEFT OUTER JOIN xray_head xh ON xh.vn = v.vn  
        LEFT OUTER JOIN ovst_seq ovq ON ovq.vn = v.vn  
        LEFT OUTER JOIN kskdepartment k ON k.depcode = v.cur_dep
        LEFT OUTER JOIN oapp o ON o.hn=v.hn AND o.nextdate='$cur_date'  
        WHERE v.vstdate ='$cur_date'
        AND v.cur_dep  IN($dep) --  IN('010','014','065','004')
        AND v.cur_dep_busy='N'
        AND v.pt_priority in('1','2')
        AND v.vn NOT IN ($s) 
        AND v.hn NOT IN ('')  ORDER BY v.pt_priority DESC,v.cur_dep_time ");

        $sql_skip = $this->db->query("SELECT v.vn,v.hn,v.vstdate,v.oqueue,v.main_dep_queue,v.pt_priority,k.department
        ,xh.confirm_all,l.lab_count,l.report_count,CONCAT(p.pname,p.fname,'  ',p.lname) AS ptname,ovq.pttype_check
        ,o.nextdate,TIMESTAMPDIFF(YEAR,p.birthday,NOW()) AS age  
        FROM ovst v  
        LEFT OUTER JOIN patient p ON p.hn=v.hn  
        LEFT OUTER JOIN lab_status l ON l.vn = v.vn  
        LEFT OUTER JOIN xray_head xh ON xh.vn = v.vn  
        LEFT OUTER JOIN ovst_seq ovq ON ovq.vn = v.vn  
        LEFT OUTER JOIN kskdepartment k ON k.depcode = v.cur_dep 
        LEFT OUTER JOIN oapp o ON o.hn=v.hn AND o.nextdate='$cur_date' 
        WHERE v.vstdate ='$cur_date'  
        AND v.cur_dep  IN($dep) -- IN('010','014','065','004')  
        AND v.cur_dep_busy='N'
        -- AND v.pt_priority in('0','1','2')
        AND v.vn  IN ($s) 
        AND v.hn NOT IN ('')  ORDER BY v.pt_priority DESC,v.cur_dep_time ");

        $data['pt'] = $sql->result();
        $data['priority'] = $sql2->result();
        $data['skip'] = $sql_skip->result();
        //print_r($sql->result());

        echo json_encode($data);
        
    } 

    public function doctor_call($dep){
        $cur_date = date('Y-m-d'); 
        $queue = $this->load->database('queue',true);
        $query = $queue->query("SELECT * FROM snk_call_skip");
        
        if($query->num_rows() == 0){
            $s = "' '";
        }else{
            $skip = [];
            $queue->select('vn');
            $queue->from('snk_call_skip');
            $qry = $queue->get()->result();
            foreach($qry as $val){
                //$skip = $val->vn;
                array_push($skip,$val->vn);
            }
            $s = implode(",",$skip);
        }

        $sql = $this->db->query("SELECT   v.vsttime,v.hn AS hn,l.lab_count,xh.confirm_all,l.report_count, v.spclty,v.pt_priority AS pt_priority,v.vn AS vn,
        v.oqueue AS oqueue,v.cur_dep_time AS cur_dep_time,ovq.pttype_check, spl.name AS spclty_name,erg.er_emergency_level_id,
        COUNT(s.vn) AS svn_count,  COUNT(r.vn) AS rx_count,COUNT(r1.vn) AS pay_count  , COUNT(t.vn) AS finance_count ,
            CONCAT(p.pname,p.fname,'  ',p.lname) AS ptname,v.cur_dep,IF(xh.vn<>'','1','0')AS xray_send,
            v.main_dep_queue,o.nextdate,TIMESTAMPDIFF(YEAR,p.birthday,NOW()) AS age  
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
            LEFT OUTER JOIN oapp o ON o.hn=v.hn AND o.nextdate='$cur_date'   
            WHERE v.vstdate='$cur_date'
            AND v.cur_dep IN($dep) -- IN('020','021','027','028','032' )
            -- AND v.cur_dep_busy='N'
            AND (v.pt_priority = 0 OR v.pt_priority IS NULL OR v.pt_priority ='')
            AND v.vn NOT IN ($s)  
            GROUP BY v.vsttime,v.hn,l.lab_count,xh.confirm_all,l.report_count,v.pt_priority,spl.name,v.vn,v.oqueue,v.cur_dep_time, p.pname,p.fname,p.lname,ovq.pttype_check ,erg.er_emergency_level_id 
            ORDER BY v.oqueue ");

        $sql2 = $this->db->query("SELECT   v.vsttime,v.hn AS hn,l.lab_count,xh.confirm_all,l.report_count, v.spclty,v.pt_priority AS pt_priority,v.vn AS vn,
        v.oqueue AS oqueue,v.cur_dep_time AS cur_dep_time,ovq.pttype_check, spl.name AS spclty_name,erg.er_emergency_level_id,
        COUNT(s.vn) AS svn_count,  COUNT(r.vn) AS rx_count,COUNT(r1.vn) AS pay_count  , COUNT(t.vn) AS finance_count ,
            CONCAT(p.pname,p.fname,'  ',p.lname) AS ptname,v.cur_dep,IF(xh.vn<>'','1','0')AS xray_send,
            v.main_dep_queue,o.nextdate,TIMESTAMPDIFF(YEAR,p.birthday,NOW()) AS age  
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
            LEFT OUTER JOIN oapp o ON o.hn=v.hn AND o.nextdate='$cur_date'   
            WHERE v.vstdate='$cur_date'
            AND v.cur_dep IN($dep) -- IN('020','021','027','028','032' )
            -- AND v.cur_dep_busy='N'
            AND v.pt_priority in('1','2')
            AND v.vn NOT IN ($s)  
            GROUP BY v.vsttime,v.hn,l.lab_count,xh.confirm_all,l.report_count,v.pt_priority,spl.name,v.vn,v.oqueue,v.cur_dep_time, p.pname,p.fname,p.lname,ovq.pttype_check ,erg.er_emergency_level_id 
            ORDER BY v.pt_priority DESC,v.cur_dep_time ");

        $sql_skip = $this->db->query("SELECT   v.vsttime,v.hn AS hn,l.lab_count,xh.confirm_all,l.report_count, v.spclty,v.pt_priority AS pt_priority,v.vn AS vn,
        v.oqueue AS oqueue,v.cur_dep_time AS cur_dep_time,ovq.pttype_check, spl.name AS spclty_name,erg.er_emergency_level_id,
        COUNT(s.vn) AS svn_count,  COUNT(r.vn) AS rx_count,COUNT(r1.vn) AS pay_count  , COUNT(t.vn) AS finance_count ,
            CONCAT(p.pname,p.fname,'  ',p.lname) AS ptname,v.cur_dep,IF(xh.vn<>'','1','0')AS xray_send,
            v.main_dep_queue,o.nextdate,TIMESTAMPDIFF(YEAR,p.birthday,NOW()) AS age  
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
            LEFT OUTER JOIN oapp o ON o.hn=v.hn AND o.nextdate='$cur_date'   
            WHERE v.vstdate='$cur_date'
            AND v.cur_dep IN($dep) -- IN('020','021','027','028','032' )
            AND v.vn  IN ($s)
            GROUP BY v.vsttime,v.hn,l.lab_count,xh.confirm_all,l.report_count,v.pt_priority,spl.name,v.vn,v.oqueue,v.cur_dep_time, p.pname,p.fname,p.lname,ovq.pttype_check ,erg.er_emergency_level_id 
            ORDER BY v.pt_priority DESC,v.cur_dep_time ");
            
        $data['pt'] = $sql->result();
        $data['priority'] = $sql2->result();
        $data['skip'] = $sql_skip->result();
        //print_r($sql->result());
        echo json_encode($data);
        //$this->load->view('ContronDisplayWaitExamination_view',$data);
        

    }

    public function systemtray_click(){
        //$cur_date = date('Y-m-d'); 
        $queue = $this->load->database('queue',true);
        $vn = $this->input->get('vn');
        
        $qry = $queue->query("SELECT vn,`tblrows`,`tblcall` FROM `sys_systemtray` WHERE vn ='$vn'");
        $data['click_able'] = $qry->result();
            
        echo json_encode($data);

    }

    public function callIPD(){
        $an = $this->input->get('an');
        $qry = $this->db->query("SELECT  ipt_order_id,an, order_type,rxdate, rxtime,day_queue_number 
        FROM ipt_order_no 
        WHERE an ='$an' AND order_type IN('Hme','IRx') 
        ORDER BY rxdate DESC ,rxtime DESC LIMIT 1  ");

        $sql2 = $this->db->query("SELECT hn FROM ipt WHERE an='$an'");

        $data['oid'] = $qry->result();
        $data['hn'] = $sql2->result();
        echo json_encode($data);
    }

    public function drugIPDconfirm(){
        #$an = $this->input->get('an');
        $ip = $this->input->get('ip');
        $comname = $this->input->get('comp');

        $sql = $this->db->query("SELECT kskloginname FROM onlineuser 
         WHERE servername='$comname' AND computername='$ip'");
        
        $data['user'] = $sql->result();
        
        echo json_encode($data);
    }
   
    public function updateDrugIPD(){
        
        $cur_date = date("Y-m-d H:i:s");
        //echo $cur_date; 
        //UPDATE  SET confirm_datetime='2020-02-19 10:29:43' WHERE ipt_order_id=1471174
        
        $data = array(
            'confirm_prepare' => 'Y',
            'confirm_staff' => $this->input->get('user'),
            'confirm_datetime' => $cur_date
        );
        $this->db->where('ipt_order_id', $this->input->get('oid'));
        $this->db->update('ipt_order_no', $data);
        echo  $this->db->affected_rows();
        
    }
   
}