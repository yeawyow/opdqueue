<?php
    /* ! example from https://stackoverflow.com/questions/804399/codeigniter-create-new-helper
    function yourHelperFunction(){
        $ci=& get_instance();
        $ci->load->database(); 
    
        $sql = "select * from table"; 
        $query = $ci->db->query($sql);
        $row = $query->result();
    }
    */
    function getHospitalName(){
        $ci =& get_instance();
        $db2 = $ci->load->database('queue', TRUE);
        $rs = $db2->get('sys_configs');
        return $rs->row()->hospname; 
    }
    

?>