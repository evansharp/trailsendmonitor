<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stats_model extends CI_Model {
    protected $interval;

        public function __construct() {

            parent::__construct();

            $settings = new Settings_model();
            $this -> interval = $settings -> get_setting_by_name('data_post_interval');

            //run archiving tasks
            self::_cleanup();

        }

        public function get_all_stats(){
            return [];
        }

        public function crunch_batt_charge( $amps_val ){
            $interval_in_hrs = $this -> interval / 60 / 60;

            // get current running total for batt i/o
            $result = $this->db->get_where('stats', ['name' => 'batt_ah_running_total'], 1);
            if( $result -> result_array() ){
                $record = $result -> result_array();
                $running_total = $record[0];
            }else{
                $running_total = 0;
            }

            // use interval to adjust posted value from A to a quantity of Ah
            $qt_amps = $amps_val * $interval;

            //update the running total
            $running_total += $qt_amps;

            //write new total to db
            $data = ['value' => $running_total];
            $this->db->where('name', 'batt_ah_running_total');
            return $this->db->update('stats', $data); //returns TRUE/ FALSE
        }



        private static function _cleanup(){
            //do cleanup and rolling archive stuff here

        }
}
?>
