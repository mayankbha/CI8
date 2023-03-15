<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

    public $table_name = '';
    public $primary_key = 'id';

    public function __construct() {
        parent::__construct();

        if (!$this->table_name) {
            $this->table_name = strtolower(plural(get_class($this)));
        }
    }

    public function record_count() {
        return $this->db->count_all($this->table_name);
    }

    public function get($id) {
        return $this->db->get_where($this->table_name, array($this->primary_key => $id))->row();
    }

    public function get_all($fields = '', $where = array(), $table = '', $limit = '', $start = '', $order_by = '', $order = 'DESC', $group_by = '') {

        $data = array();
        if ($fields != '') {
            $this->db->select($fields);
        }

        if (count($where)) {
            $this->db->where($where);
        }

        if ($table != '') {
            $this->table_name = $table;
        }

        if ($limit != '') {
            $this->db->limit($limit);
        }

        if ($limit != '' && $start != '') {
            $this->db->limit($limit, $start);
        }

        if ($order_by != '') {
            $this->db->order_by($order_by, $order);
        }

        if ($group_by != '') {
            $this->db->group_by($group_by);
        }

        $Q = $this->db->get($this->table_name);

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();

        return $data;
    }

    public function get_all_object($fields = '', $where = array(), $table = '', $limit = '', $order_by = '', $group_by = '') {
        $data = array();
        if ($fields != '') {
            $this->db->select($fields);
        }

        if (count($where)) {
            $this->db->where($where);
        }

        if ($table != '') {
            $this->table_name = $table;
        }

        if ($limit != '') {
            $this->db->limit($limit);
        }

        if ($order_by != '') {
            $this->db->order_by($order_by);
        }

        if ($group_by != '') {
            $this->db->group_by($group_by);
        }

        $Q = $this->db->get($this->table_name)->result();

        return $Q;
    }

    public function insert($data) {
        //$data['date_created'] = $data['date_updated'] = date('Y-m-d H:i:s');
        //$data['created_from_ip'] = $data['updated_from_ip'] = $this->input->ip_address();

        $success = $this->db->insert($this->table_name, $data);

        if ($success) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function insert_batch($data){
        $this->db->insert_batch($this->table_name, $data);
    }

    public function update($data, $id) {
        //$data['date_updated'] = date('Y-m-d H:i:s');
        //$data['updated_from_ip'] = $this->input->ip_address();

        $this->db->where($this->primary_key, $id);
        return $this->db->update($this->table_name, $data);
    }

    public function delete($id) {
        $this->db->where($this->primary_key, $id);

        return $this->db->delete($this->table_name);
    }
}
