<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{

    protected $table = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function publish($cids)
    {
        if ($this->table == '') {
            return false;
        }
        
        $this->db->query('UPDATE ' . $this->table . ' SET published=1 WHERE id IN(' . implode(",", $cids) . ')');
        return true;
    }

    public function unpublish($cids)
    {
        if ($this->table == '') {
            return false;
        }
        
        $this->db->query('UPDATE ' . $this->table . ' SET published=0 WHERE id IN(' . implode(",", $cids) . ')');
        return true;
    }

    /**
     * Set @var table and @var key value in object(In child class) to delete record match to $cids
     *
     * Set array of @var dependents for object (In child class) to remove records from those tables
     * There are table and key values in @var dependents array
     *
     * @param array $cids            
     *
     * @return bool;
     */
    public function delete($cids)
    {
        if ($this->table == '') {
            return false;
        }
        
        $pkey = 'id';
        if (isset($this->key)) {
            $pkey = $this->key;
        }
        
        // Delete from main table
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE ' . $pkey . ' IN (' . implode(",", $cids) . ')');
        
        // Delete from dependent tables based on table name and key name
        if (! empty($this->dependents)) {
            foreach ($this->dependents as $dependent) {
                if (isset($dependent['table']) && isset($dependent['key'])) {
                    $this->db->query('DELETE FROM ' . $dependent['table'] . ' WHERE ' . $dependent['key'] . ' IN (' . implode(",", $cids) . ')');
                }
            }
        }
        
        $this->PostDeleteAction();
        return true;
    }

    public function PostDeleteAction()
    {
        return true;
    }
}
