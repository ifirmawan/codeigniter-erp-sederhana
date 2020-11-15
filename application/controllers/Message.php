<?php 

/**
* 
*/
class Message extends MY_Controller
{
	
	function __construct(argument)
	{
		parent::__construct();
		$this->load->model('financial/message');
		$this->load->library('template');
	}

	public function submit(){
		$from_id = $this->session->userdata('user_id');
		$this->form_validation->set_rules('to_id', '<b>to_id</b>', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('from_id', '<b>to_id</b>', 'trim|required|valid_email|max_length[20]');
		$this->form_validation->set_rules('message', '<b>message</b>', 'trim|required|max_length[100]');

		$arr['to_id'] 		= 
		$arr['from_id'] 	= $from_id;
		$arr['message'] 	= $this->input->post('message');
		$arr['created_at']	= date('Y-m-d H:i:s');

		if ($this->form_validation->run() == FALSE) {

			$arr['success'] = false;
			$arr['notif'] = '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . validation_errors() . '</div>';
		} else {

			$this->db->insert('message',$arr);
			$detail = $this->db->select('*')->from('message')->where('id',$this->db->insert_id())->get()->row();
			$arr['name'] = $detail->name;
			$arr['email'] = $detail->email;
			$arr['subject'] = $detail->subject;
			$arr['created_at'] = $detail->created_at;
			$arr['id'] = $detail->id;
			$arr['new_count_message'] = $this->db->where('read_status',0)->count_all_results('message');
			$arr['success'] = true;
			$arr['notif'] = '<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Message sent ...</div>';

		}
		
		echo json_encode($arr);
	}
}