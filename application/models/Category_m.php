<?php
class Category_m extends CI_Model {
        
        public function __construct()
	{
                parent::__construct();
                $this->table = "category";
                $this->post = $this->input->post();
        }
        
        public function get_data()
        {
                $server_side = $this->post['server_side'];
                parse_str($this->post['filter'], $filter);
                if($filter['type']!=''){
                        $this->db->where('type', $filter['type']);
                }

                $this->db->select("SQL_CALC_FOUND_ROWS *", FALSE);
                $this->db->from($this->table);

                if($server_side == true){
                        $this->db->limit( $this->post['length'], $this->post['start']);;
                }
                $query = $this->db->get();

                $data = $query->result_array();
                
                $query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
                $total_res = $query->row()->Count;

                return [
                        "data" => $data,
                        "total_res" => $total_res,
                ];
        }

        public function insert($data)
        {
                $this->db->insert($this->table, $data);
        }

        public function update($data, $id)
        {
                $this->db->update($this->table, $this, array('id' => $id));
        }

}