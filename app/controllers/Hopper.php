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
			if( $sensor -> isOnline() ){
				$device_name = explode( ".", explode( "-", $sensor -> get_friendlyName() )[0] )[0]; //get the first segment of the return string
				$device_serial = explode( ".", explode( "-", $sensor -> get_hardwareId() )[1] )[0]; //get the first segment of the return string
				//die("Device Name: " . $device_name . " | Device Serial: ". $device_serial);

				//validate module sending data against known streams using hardware id
				$stream_id = null;

				foreach( $streamlist as $stream){
					if( $stream['device-serial'] == $device_serial &&  !$stream['disabled']){
						$stream_id = $stream['id'];
					}
				}

				// if device is unregistered or disabled, skip to the next device
				if( !$stream_id ){
					$sensor = $sensor -> nextGenericSensor();
					continue;
				}

				//create a 'now' in mysql Datetime format
				$now = date('Y-m-d H:i:s'); // will manually write time stamp so time is closer to recorded time.

				// Value --------------
				$frame_value = $sensor -> get_currentValue(); // as configured in VirtualHub

				// Actual -------------
				//$frame_signal =  $sensor -> get_signalValue(); //actual voltage drop in mV for milivolt-rx

				// Write to db!
				if( !$streams_model -> write_frame( $stream_id, $now, $frame_value ) ){
					die("There was an error writing frame for ". $device_name ." to the database.");
				}else{
					echo "Wrote " . $frame_value ." to the database for ". $device_name . " (". $device_serial .") at ". $now;
				}

				echo "<br>";
				echo "--------------------------------------------------------";
				echo "<br>";

				//get the next available sensor or a null pointer if the last one is done
				$sensor = $sensor -> nextGenericSensor();
			}
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
