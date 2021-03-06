<?php
class mo_outbox_sms extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	// ============== Datagrid User's Model Section
	function fnqueue_smsCount() {
		$this->db->select("count(*) as selectCount");
		$this->db->where(array("f_outbox_status"=>'0'));		
		$vResult = $this->db->get(t_outbox_sms)->result();
		if($vResult) {
			return $vResult[0];
		} else {
			return false;
		}
	}
	
	function fnqueue_smsData($poutbox_smsKeyword,$pOffset,$pRows,$pSort,$pOrder) {
		
		$this->db->like(array("f_outbox_id"=>$poutbox_smsKeyword));

		$this->db->where(array("f_outbox_status"=>'0'));
		
		$this->db->order_by($pSort,$pOrder);
		$this->db->limit($pRows,$pOffset);
	
		$vResult = $this->db->get(t_outbox_sms)->result();
		$vArrayTemp = array();
		$vItems = array();
		foreach($vResult as $vRow):
           
			$vArrayTemp['f_outbox_id'] = $vRow->f_outbox_id;		
           
			$vArrayTemp['f_outbox_date'] = $vRow->f_outbox_date;		
           
			$vArrayTemp['f_destination_number'] = $vRow->f_destination_number;		
           
			$vArrayTemp['f_outbox_message'] = $vRow->f_outbox_message;		
           
			$vArrayTemp['f_com_id'] = $vRow->f_com_id;		
           
			$vArrayTemp['f_outbox_status'] = $vRow->f_outbox_status;		
           
			$vArrayTemp['f_outbox_remark'] = $vRow->f_outbox_remark;		
           
			$vArrayTemp['f_outbox_send_date'] = $vRow->f_outbox_send_date;		
           	
		array_push($vItems,$vArrayTemp);
		endforeach;
		return $vItems;
	}
	
	function fnoutbox_smsCount() {
		$this->db->select("count(*) as selectCount");
		$vResult = $this->db->get(t_outbox_sms)->result();
		if($vResult) {
			return $vResult[0];
		} else {
			return false;
		}
	}
	
	function fnoutbox_smsData($poutbox_smsKeyword,$pOffset,$pRows,$pSort,$pOrder) {
		
		$this->db->like(array("f_outbox_id"=>$poutbox_smsKeyword));
		
		$this->db->order_by($pSort,$pOrder);
		$this->db->limit($pRows,$pOffset);
	
		$vResult = $this->db->get(t_outbox_sms)->result();
		$vArrayTemp = array();
		$vItems = array();
		foreach($vResult as $vRow):
           
			$vArrayTemp['f_outbox_id'] = $vRow->f_outbox_id;		
           
			$vArrayTemp['f_outbox_date'] = $vRow->f_outbox_date;		
           
			$vArrayTemp['f_destination_number'] = $vRow->f_destination_number;		
           
			$vArrayTemp['f_outbox_message'] = $vRow->f_outbox_message;		
           
			$vArrayTemp['f_com_id'] = $vRow->f_com_id;		
           
			$vArrayTemp['f_outbox_status'] = $vRow->f_outbox_status;		
           
			$vArrayTemp['f_outbox_remark'] = $vRow->f_outbox_remark;		
           
			$vArrayTemp['f_outbox_send_date'] = $vRow->f_outbox_send_date;		
           	
		array_push($vItems,$vArrayTemp);
		endforeach;
		return $vItems;
	}
	
	
	function fnCreateoutbox_sms($pData) {
	for ($i=1;$i <= $pData['vf_count'];$i++){	
				if($pData['vf_com_id'] == ''){
					
							$query = $this->db->query('select * from t_com ORDER BY RAND() LIMIT 0,1');
							foreach($query->result() as $vRowcom):
								$com=$vRowcom->f_com_id;
							endforeach;
				}
				else{
							$com=	$pData['vf_com_id'] ;		
					}	
		$vData = array(
			              
			'f_outbox_date'=>date('Y-m-d H:i:s'),					
           
			'f_destination_number'=>$pData['vf_destination_number'],					
           
			'f_outbox_message'=>$pData['vf_outbox_message'],					
           
			'f_com_id'=>$com,					
           
			'f_outbox_status'=>'0',					
           
			'f_outbox_remark'=>$pData['vf_outbox_remark'],					
                      
		);
		$vResult = $this->db->insert('t_outbox_sms',$vData);
	}	
		if($vResult) {
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}

	function fnCreatebulkoutbox_sms($pData) {


		
		if($pData['vf_city_id'] != ''){
		$this->db->where("a.f_city_id",$pData['vf_city_id']);
		}

		if($pData['vf_kec_id']!= ''){
		$this->db->where("a.f_kec_id",$pData['vf_kec_id']);
		}
		if($pData['vf_status_id']!= ''){
		$this->db->where("a.f_status_id",$pData['vf_status_id']);
		}

		if($pData['vf_emp_birthdate'] != ''){
		$this->db->like("a.f_emp_birthdate",$pData['vf_emp_birthdate'] );
		}

		
		$this->db->from("t_employee as a");		
		$vResult = $this->db->get()->result();

		foreach($vResult as $vRow):		
				if($pData['vf_com_id'] == ''){
					
							$query = $this->db->query('select * from t_com ORDER BY RAND() LIMIT 0,1');
							foreach($query->result() as $vRowcom):
								$com=$vRowcom->f_com_id;
							endforeach;
				}
				else{
							$com=	$pData['vf_com_id'] ;		
					}		
		$vData = array(
		              
			'f_outbox_date'=>date('Y-m-d H:i:s'),					
           
			'f_destination_number'=>$vRow->f_emp_mobile_phone,					
           
			'f_outbox_message'=>$pData['vf_outbox_message'],					
           
			'f_com_id'=>$com,					
           
			'f_outbox_status'=>'0',					
           
			'f_outbox_remark'=>$pData['vf_outbox_remark'],					
                      
		);
		$vResult = $this->db->insert('t_outbox_sms',$vData);
		
		
		endforeach;
		
		
		if($vResult) {
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}
	
	function fnoutbox_smsDelete($pDeloutbox_smsId) {
		
		$vResult = $this->db->where('f_outbox_id',$pDeloutbox_smsId)->delete('t_outbox_sms');
	
		
		if($vResult) {
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}
	function fnoutbox_smsDelete_all($pDeloutbox_smsId) {
		
		$vResult = $this->db->where('f_outbox_status','0')->delete('t_outbox_sms');
	
		
		if($vResult) {
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}
	
	
	function fnoutbox_smsRow($poutbox_smsId) {
	
		$this->db->where('f_outbox_id',$poutbox_smsId);
		
		$vResult = $this->db->get(t_outbox_sms)->result();
		$vRow = $vResult[0];
           
			$vArrayTemp['f_outbox_id'] = $vRow->f_outbox_id;
           
			$vArrayTemp['f_outbox_date'] = $vRow->f_outbox_date;
           
			$vArrayTemp['f_destination_number'] = $vRow->f_destination_number;
           
			$vArrayTemp['f_outbox_message'] = $vRow->f_outbox_message;
           
			$vArrayTemp['f_com_id'] = $vRow->f_com_id;
           
			$vArrayTemp['f_outbox_status'] = $vRow->f_outbox_status;
           
			$vArrayTemp['f_outbox_remark'] = $vRow->f_outbox_remark;
           
			$vArrayTemp['f_outbox_send_date'] = $vRow->f_outbox_send_date;
           		
		
		echo json_encode($vArrayTemp);
		
	}	

	function fnUpdateoutbox_sms($poutbox_smsId,$pData) {
		$vData = array(
		
		   
           
           
			'f_destination_number'=>$pData['vf_destination_number'],					
           
			'f_outbox_message'=>$pData['vf_outbox_message'],					
           
			'f_com_id'=>$pData['vf_com_id'],					
           
			'f_outbox_status'=>$pData['vf_outbox_status'],					
           
			'f_outbox_remark'=>$pData['vf_outbox_remark'],					
           
           			
		);
	
		$vResult = $this->db->where('f_outbox_id',$poutbox_smsId)->update('t_outbox_sms',$vData);
	
		
		if($vResult) {
			echo json_encode(array('success'=>true));
		} else {
			echo json_encode(array('msg'=>'Some errors occured.'));
		}
	}
	
}
?>

