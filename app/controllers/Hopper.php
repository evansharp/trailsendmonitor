<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hopper extends MY_Controller {

	public function construct(){
		parent::__construct();
	}

	public function post(){
		//include yoctopuce libraries for recieving and processing data

		include APPPATH . 'third_party/yocto_api.php';
		include APPPATH . 'third_party/yocto_genericsensor.php';

		// init YAPI in callback mode to recieve inputs
		YAPI::RegisterHub("callback");

		// get registered streams from the db
		$streams_model = new Streams_model();
		$streamlist = $streams_model->get_all_streams();


        $data = isset( $_POST ) ? $_POST : NULL;

		//get the first available sensor to initiate an iterator in the API
		$sensor = YGenericSensor::FirstGenericSensor();

		//iterator to process all sensors
		while( !is_null( $sensor ) ){
			$device_name = explode( ".", $sensor -> get_friendlyName() )[0]; //get the first segment of the return string
			$device_serial = explode( ".", $sensor -> get_hardwareId() )[0]; //get the first segment of the return string

			//validate module sending data against known streams using hardware id
			$stream_id = null;
			foreach( $streamlist as $stream){
				if($stream['device-serial'] == $device_serial){
					$stream_id = $stream['id'];
				}
			}
			// if device is unregistered, skip to the next device
			if( !$stream_id ){
				continue;
			}

			// useful yGenericSensor methods are:
			// get_signalValue() = module measurment in mV
			// get_currentValue() = amperage at 12v as calculated by device and configured in VirtualHub

			//create a 'now' in mysql Datetime format
			$now = date('Y-m-d H:i:s'); // will manually write time stamp so value are "same time" over two writes.

			// Volts -------------

			$frame_voltage = $sensor -> get_signalValue() * 1000; //convert direct reading in mV to V
			echo "Found " . $frame_voltage ." V for ". $device_name . " (". $device_serial .")";

			// Amps --------------

			$frame_amperage = $sensor -> get_currentValue(); // as configured in VirtualHub
			echo "Found " . $frame_amperage ." A for ". $device_name . " (". $device_serial .")";


			// Write to db!

			if( !$streams_model -> write_frame( $stream_id, $now, 'volts', $frame_voltage ) ){
				die("There was an error writing VOLTS of ". $device_name ." to the database.");
			}else{
				echo "Wrote " . $frame_voltage ." V to the database for ". $device_name . " (". $device_serial .") at ". $now;
			}

			if( !$streams_model -> write_frame( $stream_id, $now, 'amps', $frame_amperage ) ){
				die("There was an error writing AMPS of ". $device_name ."  to the database.");
			}else{
				echo "Wrote " . $frame_amperage ." A to the database for ". $device_name . " (". $device_serial .") at ". $now;
			}

			echo "<br>";
			echo "--------------------------------------------------------";
			echo "<br>";

			//get the next available sensor or a null pointer if the last one is done
			$sensor = YGenericSensor::nextGenericSensor();
		}

		echo "Success!";

		YAPI::FreeAPI();
	}

	public function debug(){
        $data = isset( $_POST ) ? $_POST : NULL;

		if( $data ){
		  	echo "<pre>";
		    foreach ($data as $key => $value) {
		          echo "$key = $value\r\n";
		    }
		    echo "</pre>";
		}else{
		    echo "No POST data found.";
		}
	}

}
