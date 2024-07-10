<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DisplayWaitExamination extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}

    public function index(){
        $cur_date = date('Y-m-d'); 
        //echo $cur_date;
        //$this->$hosxp = $this->load->database('hosxp', TRUE); 
        $queue = $this->load->database('queue',true);

        $queue->select('value_name');
        $queue->where('id', 'dep_Exam_monitor');
        $queue->from('sys_value');
        $query = $queue->get()->result();

        foreach($query as $val){
            
            $qdep =$val->value_name;
        }

        $queue->select('sub_queue');
        $queue->from('sys_configs');
        $data['q'] = $queue->get()->row();


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
            AND v.cur_dep IN($qdep) 
            -- AND v.cur_dep_busy='N'
            -- '020','021','027','028','032'
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
            AND v.cur_dep IN($qdep)
            -- AND v.cur_dep_busy='N'
            AND v.pt_priority in('1','2')  
            GROUP BY v.vsttime,v.hn,l.lab_count,xh.confirm_all,l.report_count,v.pt_priority,spl.name,v.vn,v.oqueue,v.cur_dep_time, p.pname,p.fname,p.lname,ovq.pttype_check ,erg.er_emergency_level_id 
            ORDER BY v.pt_priority DESC,v.cur_dep_time ");

        $data['pt'] = $sql->result();
        $data['priority'] = $sql2->result();
        //print_r($sql->result());

        $this->load->view('DisplayWaitExamination_view',$data);
        

    } 

    public function getPatientName(){
        $cur_date = date('Y-m-d');

        $queue = $this->input->post('q');
        
        $sql = $this->db->query(" SELECT  fname,lname FROM ovst o
        LEFT JOIN patient pt ON pt.hn=o.hn
        WHERE oqueue= $queue AND vstdate='$cur_date' ");

        foreach($sql->result() as $a){
            $fname = $a->fname;
            $lname = $a->lname;
        }

        $text = $fname;
        $lang = "th-TH";
        $file = "./audio/" . $text .".mp3";

        if (!file_exists($file))
        {
            $mp3 = file_get_contents(
            'https://translate.google.com/translate_tts?ie=UTF-8&q='. urlencode($text) .'&tl='. $lang .'&client=tw-ob');
            file_put_contents($file, $mp3);
        }

        $text = $lname;
        $lang = "th-TH";
        $file = "./audio/" . $text .".mp3";

        if (!file_exists($file))
        {
            $mp3 = file_get_contents(
            'https://translate.google.com/translate_tts?ie=UTF-8&q='. urlencode($text) .'&tl='. $lang .'&client=tw-ob');
            file_put_contents($file, $mp3);
        }

        echo json_encode($sql->result());

    }

    public function getComputerName(){

        $data = array(
            'vn'=>$this->input->get('fvn'),
            'comname'=>$this->input->get('fcomputername'),
            'depcode'=>$this->input->get('fdepartment')
        );

        $this->db->replace('wanorn_queue_computername', $data);
        redirect('index.php/DisplayWaitExamination/closepage');
    }

	public function closepage(){
        
        $this->load->view("close_popup_veiw");
    }	
}