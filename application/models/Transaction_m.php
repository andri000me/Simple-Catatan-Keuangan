<?php
class Transaction_m extends CI_Model {
        
        public function __construct()
	{
                parent::__construct();
                $this->table = "transaction";
                $this->post = $this->input->post();
        }
        
        public function get_data()
        {
                $query = $this->db->get($this->table);
                return $query->result();
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