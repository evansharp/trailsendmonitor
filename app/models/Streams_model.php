<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Streams_model extends CI_Model {
        // Handles writing input data to the database and deleting datsets when asked

        public function __construct() {

        parent::__construct();

        }

        //-------------------------------------------------
        //
        // Edit Stream Objects
        //
        //-------------------------------------------------

        public function get_all_streams(){
            $this->db->from('streams');
            $result = $this->db->get();

            return $result -> result_array(); //returns results as assoc. array
        }

        public function create_stream($name, $desc, $serial, $shunt_resistance){
            $data = ['name' => $name, 'description' => $desc, 'device-serial' => $serial, 'shunt_resistance' => $shunt_resistance];
            return $this->db->insert('streams', $data); //returns TRUE/ FALSE
        }

        public function delete_stream( $id ){
            $this->db->where('id', $id);
            $res1 = $this->db->delete('streams');  //returns FALSE on failure, obj if complete

            $this->db->where('stream-id', $id);
            $res2 = $this->db->delete('data'); //returns FALSE on failure, obj if complete

            return true;
        }

        public function edit_stream($id ,$name, $desc, $serial, $shunt_resistance){
            $data = ['name' => $name, 'description' => $desc, 'device-serial' => $serial, 'shunt_resistance' => $shunt_resistance];
            $this->db->where('id', $id);
            return $this->db->update('streams', $data); //returns TRUE/ FALSE
        }

        public function toggle_stream( $id ){

            return $this->db->query("
                                    UPDATE streams
                                    SET `disabled`=NOT `disabled`
                                    WHERE `id` = $id
                                    ");
        }



        //-------------------------------------------------
        //
        // Get Stream Data
        //
        //-------------------------------------------------

		public function get_stream_by_id( $id ){
                $result = $this->db->get_where('streams', ['id' => $id], 1);

                if( $result -> result_array() ){
                    $record = $result -> result_array();
                    return $record[0];
                }
                else{
                    return [];
                }
        }

        public function get_raw_stream($id, $label, $time_start, $time_end){
            $this->db->select('timestamp, value');
	        $result = $this->db->get_where('data', ['stream-id' => $id, 'label' => $label, 'timestamp > ' => $time_start, 'timestamp <' => $time_end]);

            return $result -> result_array();
        }

        //-------------------------------------------------
        //
        // Write datum (frame) to a Stream
        //
        //-------------------------------------------------

        public function write_frame( $id , $ts, $label, $value ){
			$data = ['stream-id' => $id, 'timestamp' => $ts, 'label' => $label, 'value' => $value];
			return $this->db->insert('data', $data); //returns TRUE/ FALSE
        }

}
