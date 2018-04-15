<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

        public function __construct() {

                parent::__construct();

        }

        public function get_setting_by_id( $id ){
                $result = $this->db->get_where('settings', ['setting_id' => $id], 1);

                if( $result -> result_array() ){
                    $record = $result -> result_array();
                    return $record[0];
                }
                else{
                    return [];
                }
        }

        public function get_setting_by_name( $name ){
                $result = $this->db->get_where('settings', ['name' => $name], 1);

                if( $result -> result_array() ){
                    $record = $result -> result_array();
                    return $record[0];
                }
                else{
                    return [];
                }
        }

        public function get_all_settings(){
            $this->db->from('settings');
            $result = $this->db->get();

            return $result -> result_array(); //returns results as assoc. array
        }

        public function edit_setting($name, $value){
            $data = ['value' => $value];
            $this->db->where('name', $name);
            return $this->db->update('settings', $data); //returns TRUE/ FALSE
        }
    }

?>
