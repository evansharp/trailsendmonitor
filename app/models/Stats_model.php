<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stats_model extends CI_Model {
        

        public function __construct() {

            parent::__construct();

            //run archiving tasks
            self::_cleanup();

        }



        private static function _cleanup(){
            //do cleanup and rolling archive stuff here

        }
}
?>
