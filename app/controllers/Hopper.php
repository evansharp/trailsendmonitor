<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hopper extends MY_Controller {

	public function construct(){
		parent::__construct();
		
		//include yoctopuce libraries for recieving and processing data
		
		include APPPATH . 'third_party/yocto_api.php';
		include APPPATH . 'third_party/yocto_genericsensor.php';
		
		// init YAPI in callback mode to recieve inputs
		YAPI::RegisterHub("callback");

	}
      
      // main input function, device serial number should be part of callback URI
      // "debug" URI for viewing posted data
      
	public function _remap( $device_serial ){
		// get the existing streams from the db
		$streams_model = new Streams_model();
		$streamlist = $streams_model->get_all_streams();
		
            $data = isset( $_POST ) ? $_POST : NULL;
            
            if( $device_serial == "debug" ){
                  if( $data ){
	                  	echo "<pre>";
                        foreach ($data as $key => $value) {
                              echo "$key = $value\r\n";
                        }
                        echo "</pre>";
                  }else{
                        echo "No POST data found.";
                  }
            }else{
            	$stream_id = null;
            	
            	//validate module sending data against known streams
            	foreach( $streamlist as $stream){
            		if($stream['device-serial'] == $device_serial){
            			$stream_id = $stream['id'];
            		}
            	}
            	
            	//abort if no stream id
            	if(!$stream_id){
            		die("Device serial \"$device_serial\" not registered in Monitor");
            	}
            	
            	if( $data ){
                  	// do stuff with stream here
                  	
                  	// yGenericSensor methods are:
                  	// get_signalValue() = module measurment in mV
                  	// get_currentValue() = amperage at 12v as calculated by device and configured in VirtualHub
                  	
                  	$sensor = yFindGenericSensor("$device_serial.genericSensor1");

                  	$now = time(); // will manually write time stamp so value are "same time" over two writes.
                  	
                  	// Volts -------------
                  	
                  	$frame_voltage = $sensor.get_signalValue() * 1000 //convert direct reading in mV to V
                  	
                  	// Amps --------------
                  	
                  	$frame_amperage = $sensor.getcurrentValue(); // as configured in VirtualHub
                  	
                  	
                  	// Write! 

                  	if( !$streams_model.write_frame( $stream_id, $now, 'volts', $frame_voltage ) ){
	                  	die("There was an error writing VOLTS to the database.");
                  	}

                  	if( !$streams_model.write_frame( $stream_id, $now, 'amps', $frame_amperage ) ){
	                  	die("There was an error writing AMPS to the database.");
                  	}
                  	
                        
                  }else{
                  	die("Device serial \"$device_serial\" is registered, but not POST data received");
                  }
            }
	}
}
