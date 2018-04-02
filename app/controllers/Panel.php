<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends MY_Controller {

	public function construct(){
		parent::__construct();
	}

	public function index(){
		echo "Panel :: index()";
	}
	public function dashboard(){
		$data = [];


		$template_data = [
					'title'	=> 'Dashboard',
					'active_nav' => 'dashboard',
					'alerts'=> $this->get_alerts(),
					'pane' 	=> $this->load->view('panel/dashboard',$data,TRUE)
				];


		$this->load->view('panel', $template_data);

	}
	/* ===========================================================
	                      Streams
	=============================================================*/


	public function streams(){
		$model = new Streams_model();
		$data['streams'] = $model -> get_all_streams();

		$template_data = [
					'title'	=> 'Streams',
					'active_nav' => 'streams',
					'alerts'=> $this->get_alerts(),
					'pane' 	=> $this->load->view('panel/view_streams',$data,TRUE)
				];


		$this->load->view('panel', $template_data);
	}

	public function create_stream(){
		$model = new Streams_model();

		if(  isset($_POST['new_stream_name']) && isset($_POST['new_stream_desc']) && isset($_POST['new_stream_serial']) && isset($_POST['new_stream_resistance']) ){
			$created = $model -> create_stream( $_POST['new_stream_name'], $_POST['new_stream_desc'], $_POST['new_stream_serial'], $_POST['new_stream_resistance']);
			redirect( base_url("streams") );
		}

		$data = [];

		$template_data = [
					'title'	=> 'Create Stream',
					'active_nav' => 'streams',
					'alerts'=> $this->get_alerts(),
					'pane' 	=> $this->load->view('panel/create_stream',$data,TRUE)
				];


		$this->load->view('panel', $template_data);
	}

	public function delete_stream( $evil_id ){
		$model = new Streams_model();
		$result = $model -> delete_stream( $evil_id );

		redirect( base_url("streams") );

	}
	public function edit_stream( $id ){
		$model = new Streams_model();

		if(  isset($_POST['new_stream_name']) && isset($_POST['new_stream_desc']) && isset($_POST['new_stream_serial']) && isset($_POST['new_stream_resistance'] ) ){
			$created = $model -> edit_stream($id, $_POST['new_stream_name'], $_POST['new_stream_desc'], $_POST['new_stream_serial'], $_POST['new_stream_resistance'] );

			redirect( base_url("streams") );
		}

		$data['stream'] = $model -> get_stream_by_id( $id );

		$template_data = [
					'title'	=> 'Edit Streams',
					'active_nav' => 'streams',
					'alerts'=> $this->get_alerts(),
					'pane' 	=> $this->load->view('panel/edit_stream',$data ,TRUE)
				];


		$this->load->view('panel', $template_data);
	}
	public function view_raw_stream( $id ){
		$model = new Streams_model();
		$data['stream'] = $model -> get_stream_by_id( $id );

		if(  isset($_POST['raw_fetch_start_time']) && isset($_POST['raw_fetch_end_time']) && isset($_POST['label']) ){

			$start_time = date("Y-m-d H:i:s", strtotime( $_POST['raw_fetch_start_time'] )); //format for mysql query
			$end_time = date("Y-m-d H:i:s", strtotime( $_POST['raw_fetch_end_time'] )); //format for mysql query

			$data['raw_data'] = $model -> get_raw_stream( $id, $_POST['label'], $start_time, $end_time );
			$data['range']['start'] = $_POST['raw_fetch_start_time'];
			$data['range']['end'] = $_POST['raw_fetch_end_time'];
			$data['result_label'] = $_POST['label'];
		}else{
			$data['raw_data'] = [];
			$data['range'] = [];
		}

		$template_data = [
					'title'	=> $data['stream']['name'] . " Raw Data",
					'active_nav' => 'streams',
					'alerts'=> $this->get_alerts(),
					'pane' 	=> $this->load->view('panel/view_raw_stream', $data, TRUE)
				];


		$this->load->view('panel', $template_data);
	}

	public function toggle_stream( $stream_id ){
		$model = new Streams_model();
		$result = $model -> toggle_stream( $stream_id );

		redirect( base_url("streams") );

	}


	/* ===========================================================
	                      Relations
	=============================================================*/

	public function relations(){
		$data = [];


		$template_data = [
					'title'	=> 'Relations',
					'active_nav' => 'relations',
					'alerts'=> $this->get_alerts(),
					'pane' 	=> $this->load->view('panel/view_relations',$data,TRUE)
				];


		$this->load->view('panel', $template_data);
	}

	public function create_relation(){
		$model = new Relations_model();

		if(		isset($_POST['new_relation_name'])
			&& 	isset($_POST['new_stream_desc'])
			&& 	isset($_POST['new_stream_serial'])
			&& 	isset($_POST['new_stream_resistance'])
		){
			$info_obj = null;
			$created = $model -> create_relation( $info_obj );
			redirect( base_url("relations") );
		}

		$data = [];

		$template_data = [
					'title'	=> 'Create Relation',
					'active_nav' => 'relations',
					'alerts'=> $this->get_alerts(),
					'pane' 	=> $this->load->view('panel/create_relations',$data,TRUE)
				];


		$this->load->view('panel', $template_data);
	}

	public function edit_relations( $target = '' ){
		$posteddata = isset( $_POST ) ? $_POST : NULL;

		$data = [];

		$template_data = [
					'title'	=> 'Edit Relations',
					'active_nav' => 'relations',
					'alerts'=> $this->get_alerts(),
					'pane' 	=> $this->load->view('panel/edit_relations',$data,TRUE)
				];


		$this->load->view('panel', $template_data);
	}

	public function delete_relations( $evil_id ){
		$model = new Relations_model();
		$result = $model -> delete_relation( $evil_id );

		redirect( base_url("relations") );

	}

	public function toggle_relation( $id ){
		$model = new Relations_model();
		$result = $model -> toggle_stream( $id );

		redirect( base_url("relations") );

	}
	/* ===========================================================
	                      Alerts
	=============================================================*/

	public function alerts(){
		$data = [];


		$template_data = [
					'title'	=> 'Alert History',
					'active_nav' => 'alerts',
					'alerts'=> $this->get_alerts(),
					'pane' 	=> $this->load->view('panel/view_alerts',$data,TRUE)
				];


		$this->load->view('panel', $template_data);
	}
	/* ===========================================================
	                      Settings
	=============================================================*/

	public function settings(){
		$data = [];


		$template_data = [
					'title'	=> 'Monitor Settings',
					'active_nav' => 'settings',
					'alerts'=> $this->get_alerts(),
					'pane' 	=> $this->load->view('panel/settings',$data,TRUE)
				];


		$this->load->view('panel', $template_data);
	}


	/* ===========================================================
	                      Helpers
	=============================================================*/

	private function get_alerts(){
		// use autoloaded Alerts_model function to get 10 latest alerts
		// return schema: ['info|warning|danger', $message, $timestamp, $url]


		//this is some fake data for UI dev
		return [['danger','battery voltage extreme low','timestemp','#'],
						['warning','outside temp below 3 deg C','timestamp','#'],
						['info','some info message','timestamp','#'],
						['info','super extra long info message OMG its soooo long!','timestamp','#']];

	}

}
