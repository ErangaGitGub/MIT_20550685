<?php
/**
* Class:  Template_model 
* Author: Eranga
* Date:   22/03/2021
*/
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'models/core/'.'Base_model.php');

class Template_model extends Base_model
{
	protected $table = "templates";

    public function get_templates($temp_channel="", $temp_type="", $brcode="", $status="")
    {
        $this->db->where('temp_channel', $temp_channel); 
        $this->db->where('temp_type', $temp_type); 
        $this->db->where('brcode', $brcode); 

        if ($status!=='') {
        $this->db->where('status', $status); 
        }        

        $this->db->order_by("temp_name", "ASC");

        $query = $this->db->get($this->table);

        return $query->result();
    }


    public function get_nxtid()
    {
        $query = $this->db->get($this->table);      
        return sprintf("%04d", $query->num_rows()+1);    
    }

    public function save_template_log($temp=[])
    {
        $template = [
            'temp_ref' => $temp['ref'],
            'temp_name' => $temp['name'],
            'temp_channel' => $temp['channel'],
            'temp_type' => $temp['type'],
            'brcode' => $temp['brcode'],
            'status' => 'A',
            'created_at' => $this->get_current_datetime(),
            'created_by' => $this->get_current_username(),
            'updated_at' => $this->get_current_datetime(),
            'updated_by' => $this->get_current_username(),
            'ip_address' => $_SESSION['logged_in_ip'],
            'machine_name' => $_SESSION['logged_in_machine']
        ];


        if ($this->db->insert($this->table, $template)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_template_log($ref='')
    {
        $this->db->where('temp_ref', $ref);    
        $result = $this->db->delete($this->table);
    }
   
    public function is_template_exist($tempname="", $temp_channel="", $temp_type="", $brcode="")
    {
        $this->db->where('temp_name', $tempname);
        $this->db->where('temp_channel', $temp_channel);
        $this->db->where('temp_type', $temp_type);
        $this->db->where('brcode', $brcode);

        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0){

        return true;

        } else{

        return false;

        }
    }

}
