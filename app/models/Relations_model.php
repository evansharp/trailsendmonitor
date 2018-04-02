<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relations_model extends CI_Model {

        public function __construct() {

                parent::__construct();

        }

        //-------------------------------------------------
        //
        // Edit Relation Objects
        //
        //-------------------------------------------------

        public function get_all_relations(){
            $this->db->from('relations');
            $result = $this->db->get();

            return $result -> result_array(); //returns results as assoc. array
        }

        public function create_relation( $info ){
            $data = ['info' => $info];
            return $this->db->insert('relations', $data); //returns TRUE/ FALSE
        }

        public function delete_relation( $id ){
            $this->db->where('id', $id);
            $result = $this->db->delete('relations');  //returns FALSE on failure, obj if complete

            return $result;
        }

        public function edit_relation($id, $info){
            $data = ['info' => $info];
            $this->db->where('id', $id);
            return $this->db->update('relations', $data); //returns TRUE/ FALSE
        }

        public function toggle_relation( $id ){
            return $this->db->query("
                                    UPDATE relations
                                    SET `disabled`=NOT `disabled`
                                    WHERE `id` = $id
                                    ");
        }



        //-------------------------------------------------
        //
        // Get relation Data
        //
        //-------------------------------------------------

		public function get_relation_by_id( $id ){
                $result = $this->db->get_where('relations', ['id' => $id], 1);

                if( $result -> result_array() ){
                    $record = $result -> result_array();
                    return $record[0];
                }
                else{
                    return [];
                }
        }
}
