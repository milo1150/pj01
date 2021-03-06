<?php
class ad_report extends CI_Controller{
	public function __construct(){
        parent::__construct();
		$this->load->model('ad_report_model');
		$this->load->model('Admin_report_model');
		if($this->session->userdata('username') == ''){
			redirect(base_url().'ad_login');
		} 
    }
	function index() {
		$this->ad_list();
	}
	public function ad_list(){								 
		$this->session->unset_userdata('graph_data');						
		$data['ad_list'] = $this->ad_report_model->admin_list();
		$this->load->view('admin/report/ad_report_single',$data);			
	}
	function admin_report(){
		$username = $this->input->post('username');		 		
		$data = $this->ad_report_model->order_alltime($username);
		//print_r($data['year_data_accept']);
		$this->load->view('admin/report/ad_report_single_detail',$data);		
	}
	public function flexReport(){
		$post = json_decode(file_get_contents('php://input'),true);
		$data = $this->Admin_report_model->flexReport($post);
		echo json_encode($data);
	}
}
