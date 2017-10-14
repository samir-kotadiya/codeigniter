<?php

class Packages_model extends MY_Model
{

    /*
    *   Constructor to set table name
    *
    */

    public function __construct()
    {
        $this->table = TABLE_PACKAGES;
         $this->dependents = array(
            array(
                'table' => TABLE_PACKAGES_FEATURES,
                'key' => 'planid'
            )
        );
    }


    /*
    * Get all published features of plan
    */
    public function getPlanFeatures(){
        
        $query = $this->db->query("SELECT * FROM ".TABLE_PLAN_FEATURES);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }

    }

    /*
    *   Get all package data by filter store in session
    *   Limit of recored's are passed as argument
    */
    public function getPackages($start, $limit)
    {
        //get a session value of filtering    
        $sorting = $this->session->userdata('packages_sorting');
        if (! empty($sorting)) {
            //set filter order in query
            $sortquery = "ORDER BY {$sorting['order']} {$sorting['dir']}";
        } else {
            //no filter than pass default value
            $sortquery = 'ORDER BY id ASC ';
        }
        
        //Create query to get data from package data
        $query = $this->db->query("SELECT *
                    FROM $this->table as p                     
                    $sortquery 
                    LIMIT $start,$limit
                ");
        //Exicute query
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }        
    }

    /*
    *   Count numbers for recoreds in package table
    *
    */
    public function getCount()
    {
        $query = $this->db->query("SELECT count(*) as count
            FROM $this->table
        ");
        
        $result = $query->result_array();
        return $result[0]['count'];
    }


    /*
    *   Function is use to find package detail by id
    *   package id is pass as argument
    */
    public function getPackageById($id)
    {

        $this->db->select('*');
        $this->db->from(TABLE_PACKAGES);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $package = array();

        if ($query->num_rows() > 0) {            
            $package = (array) $query->row();
            
            $query = $this->db->query("SELECT * FROM ".TABLE_PACKAGES_FEATURES." WHERE planID = ".$id);
            if ($query->num_rows() > 0) {
                $package['features'] = $query->result_array();                            
            }            
        } 
        return $package;        
    }

    
    /*
    *   Function is use to save package detail
    *   It will performs edit and add task as per id
    */

    public function save($data = array())
    {

        
        $features = array();
        foreach ($data as $dkey => $dvalue) {
            if (strpos($dkey, 'features_') !== FALSE){
                //echo $dkey;

                $fId = substr($dkey, strpos($dkey, '_')+1,strlen($dkey));
                $features[$fId] = $dvalue;
                 $featuresid[] = $fId ;
                unset($data[$dkey]);
            }
        }
        
                
     
        if (! empty($data)) {

            //set post data in proper formate
            $data['published'] = $data['published'][0];
            $data['features'] = implode(',', $featuresid);
            if( isset($data['siteurl']) )
                unset($data['siteurl']);
                  
          

            if ($data['id'] > 0) {                                                                

                // Edit package                 
                $this->db->where('id', $data['id']);
                $this->db->update(TABLE_PACKAGES, $data);                
                $id = $data['id'];

                foreach ($features as $fkey => $feature) {

                    $insetData['planId'] = $id;
                    $insetData['featureId'] = $fkey;
                    $insetData['value'] = $feature;

                    $query = $this->db->query("UPDATE ".TABLE_PACKAGES_FEATURES." SET value= '".$feature."' WHERE planID = ".$id." AND featureId = ".$fkey);                    
                    $fId = $this->db->insert_id();
                }



            } else {         

                $data['create_date'] = date("Y-m-d");                                   
                // (Insert) Create new package   
                   ;
                $this->db->insert(TABLE_PACKAGES, $data);
                $id = $this->db->insert_id();

                if($id > 0){
                    
                    foreach ($features as $fkey => $feature) {

                        $insetData['planId'] = $id;
                        $insetData['featureId'] = $fkey;
                        $insetData['value'] = $feature;

                        $this->db->insert(TABLE_PACKAGES_FEATURES, $insetData);
                        $fId = $this->db->insert_id();
                    }

                }

            } 

            //returns a package id
            return (isset($id)) ? $id : FALSE;
        } else {
            return false;
        }
    }

}