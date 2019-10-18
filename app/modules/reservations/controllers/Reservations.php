<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Reservations Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Robert Christian Obias <robert.obias@digify.com.ph>
 * @copyright 	Copyright (c) 2018, Digify, Inc.
 * @link		http://www.digify.com.ph
 */

use Defuse\Crypto\Key;
use Defuse\Crypto\Crypto;

class Reservations extends MX_Controller {

	public function __construct()
	{
		parent::__construct();

        $this->load->model('reservations/reservations_model');
        $this->load->model('customers/customers_model');
		$this->load->model('website/pages_model');
		$this->load->model('website/partials_model');
		$this->load->model('website/metatags_model');
		$this->load->model('payments/payments_model');
    }

    public function index()
    {
        redirect(site_url());
    }
	private function key($key)
	{
		return Key::loadFromAsciiSafeString($key);
	}
	public function decode()
	{
		$encoded= explode(" ",'PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48U2VydmljZVJlc3BvbnNlV1BGIHhtbG5zOnhzZD0iaHR0cDovL3d3dy53My5vcmcvMjAwMS9YTUxTY2hlbWEiIHhtbG5zOnhzaT0iaHR0cDovL3d3dy53My5vcmcvMjAwMS9YTUxTY2hlbWEtaW5zdGFuY2UiPjxhcHBsaWNhdGlvbj48bWVyY2hhbnRpZD4wMDAwMDAwMzAxMTk5RThEQjgwQjwvbWVyY2hhbnRpZD48cmVxdWVzdF9pZD4xMTM2MzI2PC9yZXF1ZXN0X2lkPjxyZXNwb25zZV9pZD4xNDQzOTg5Mzg5MTg5MjM2NTU0NTwvcmVzcG9uc2VfaWQ PHRpbWVzdGFtcD4yMDE5LTEwLTE4VDA5OjAxOjAwLjAwMDAwMCswODowMDwvdGltZXN0YW1wPjxyZWJpbGxfaWQgLz48c2lnbmF0dXJlPmEyODE4ZDM4ZDUwZDRlNDM3ZDI1M2I2ZDk1NDgxMzU5ZjMwMzkyMmUyZmM2Mzg1ZGY1ZTcxOTczYjE2ZjhkOTM1MTQzMGI0MDgyYTU2NzE5MmQyZWU0MzBhZTdmODdiZTUxMzFlNGFmNTExYjcyNTMxNTY3YTE2YmIxZTRhOWM0PC9zaWduYXR1cmU PHB0eXBlIC8 PC9hcHBsaWNhdGlvbj48cmVzcG9uc2VTdGF0dXM PHJlc3BvbnNlX2NvZGU R1IwNTM8L3Jlc3BvbnNlX2NvZGU PHJlc3BvbnNlX21lc3NhZ2U VHJhbnNhY3Rpb24gY2FuY2VsbGVkIGJ5IHVzZXIuPC9yZXNwb25zZV9tZXNzYWdlPjxyZXNwb25zZV9hZHZpc2U VGhlIHRyYW5zYWN0aW9uIHdhcyBjYW5jZWxsZWQgYnkgdGhlIHVzZXIuPC9yZXNwb25zZV9hZHZpc2U PHByb2Nlc3Nvcl9yZXNwb25zZV9pZCAvPjxwcm9jZXNzb3JfcmVzcG9uc2VfYXV0aGNvZGUgLz48L3Jlc3BvbnNlU3RhdHVzPjxzdWJfZGF0YSAvPjx0cmFuc2FjdGlvbkhpc3Rvcnk PHRyYW5zYWN0aW9uIC8 PC90cmFuc2FjdGlvbkhpc3Rvcnk PC9TZXJ2aWNlUmVzcG9uc2VXUEY ');


		$strxml = "";
		for ($i=0; $i < count($encoded); $i++) { 
			$decoded = base64_decode($encoded[$i]);
			$count = count($encoded) - 1;
			$strxml .= $decoded.($count == $i ?'' : '>');
		}

		$xml = simplexml_load_string($strxml);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);
		$a = array();
		foreach ($array as $key ) {
			foreach ($key as $k => $val) {
				$a[$k] = $val;
			}	
		}
		extract($a);
		echo '<pre>';
		print_r($a);
		echo '</pre>';
		$data = array(
			'payment_reservation_id' => $request_id,
			'payment_paynamics_no' => $response_id,
			'payment_encoded_details'=> 'test',//$this->input->post('paymentresponse'),
			'payment_status' => $response_message,
			'payment_type' => (isset($ptype)  ? (is_array($ptype) ? 'N/A': $ptype) : 'N/A')
				
			);
		$this->payments_model->insert($data);
	} 

    public function form($ref_no = null)
	{
		$data['page_heading'] = 'reservation';
		$data['page_subhead'] = lang('index_subhead');
		$data['page_layout'] = 'full_width';
		$key = getenv('KEY');
		$key  =	$this->Key($key);

		
		if ($this->input->post())
		{
			if($this->submit())
			{
				
				$this->template->set_template('template_reservation');
				$this->template->add_css(module_css('reservations', 'reservation_form'), 'embed');
				$this->template->add_js(module_js('reservations', 'reservation_form'), 'embed');
				$this->template->write_view('content', 'reservation_view',$data);
				$this->template->render();

				//echo 'success';
			}
			else
			{

				$reservations = $this->reservations_model->get_reservation($ref_no);
				
				$array = array();
				if(!$reservations)
				{
					redirect(base_url().'page-not-found');	
				}

				foreach ($reservations as $k => $value) {
						if (strpos($k, 'customer') !== false) {
							$array[$k] =  Crypto::decrypt($value,$key);
						}
						else
						{
							$array[$k] =  $value;
						}	
				}

				$ref_no	= ['reservation_reference_no' => $this->input->post('reference_no')]; 
				//$data['reservations'] = (object) $ref_no;	
				$data['reservations'] = (object) $array;
	
				$this->template->set_template('template_reservation');
				$this->template->add_css(module_css('reservations', 'reservation_form'), 'embed');
				$this->template->add_js(module_js('reservations', 'reservation_form'), 'embed');
				$this->template->write_view('content', 'reservation_view',$data);
				$this->template->render();
				
			}
		}
		else
		{

		

				$reservations = $this->reservations_model->get_reservation($ref_no);
				
				$array = array();
				if(!$reservations)
				{
					redirect(base_url().'page-not-found');	
				}

				foreach ($reservations as $k => $value) {
						if (strpos($k, 'customer') !== false) {
							$array[$k] =  Crypto::decrypt($value,$key);
						}
						else
						{
							$array[$k] =  $value;
						}	
				}				


				$data['reservations'] = (object) $array;
				
				$this->template->set_template('template_reservation');
				$this->template->add_css(module_css('reservations', 'reservation_form'), 'embed');
				$this->template->add_js(module_js('reservations', 'reservation_form'), 'embed');
				$this->template->write_view('content', 'reservation_view',$data);
				$this->template->render();
		}
		
		
	}

	Public function getUserIpAddr(){

    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

	Public function accept_terms() {

    if (isset($_POST['agreement'])) return true;
   	 $this->form_validation->set_message('agreement', 'Please read and accept our terms and conditions.');
   	 return false;
	}

	Public function submit()
	{
		//PERSONAL DETAILS
		
		// $this->form_validation->set_rules('firstname', 'First Name', 'required');
		// $this->form_validation->set_rules('lastname', 'Last Name', 'required');
		// $this->form_validation->set_rules('phonenumber', 'Phone Number', 'required');
		// $this->form_validation->set_rules('mobilenumber', 'Mobile Number', 'required');
		// $this->form_validation->set_rules('email', 'Email Address', 'required');
		// $this->form_validation->set_rules('idtype', 'ID Type', 'required');
		// $this->form_validation->set_rules('idnumber', 'ID Number', 'required');
		// $this->form_validation->set_rules('country', 'Country', 'required');
		// $this->form_validation->set_rules('house_no', 'House Number', 'required');
		// $this->form_validation->set_rules('street', 'Street', 'required');
		// $this->form_validation->set_rules('city', 'Cityr', 'required');
		// $this->form_validation->set_rules('barangay', 'Barangay', 'required');
		// $this->form_validation->set_rules('postal_zip', 'Zip Postal Code', 'required');
		// //PROPERTY RESERVATION DETAILS
		// $this->form_validation->set_rules('project', 'Project', 'required');
		// $this->form_validation->set_rules('sellers_group', 'Sellers_Group', 'required');
		// $this->form_validation->set_rules('allocation', 'Allocation', 'required');
		// $this->form_validation->set_rules('unit_details', 'unit_details', 'required');
		// $this->form_validation->set_rules('reservation_fee', 'Reservation Fee', 'required');
		// $this->form_validation->set_rules('notes', 'Notes', 'required');
		// //BILLING ADDRESS DETAILS
		$this->form_validation->set_rules('billing_country', 'Country', 'required');
		$this->form_validation->set_rules('billing_house_no', 'House Number', 'required');
		$this->form_validation->set_rules('billing_street', 'Billing Street', 'required');
		$this->form_validation->set_rules('billing_city', 'Billing City', 'required');
		$this->form_validation->set_rules('billing_barangay', 'Billing Barangay', 'required');
		$this->form_validation->set_rules('billing_postal_zip', 'Zip Postal Code', 'required');

		$this->form_validation->set_message('required', 'This field is required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		$this->form_validation->set_rules('agreement', '...', 'callback_accept_terms');

		if ($this->form_validation->run($this) == FALSE)
		{
			
			return FALSE;
		}
		
	$data['mid'] 			= "0000000301199E8DB80B"; 
	$data['requestid'] 	= $this->input->post('reference_no');
	$data['ipaddress'] 	= $this->getUserIpAddr();
	$data['noturl'] 	= base_url('reservations/notif'); // url where response is posted
	$data['resurl'] 	= base_url('reservations/return'); //url of merchant landing page
	$data['cancelurl'] 	= base_url('reservations/cancel'); //url of merchant landing page
	$data['fname'] 		= $this->input->post('firstname'); 
	// $data['mname'] 		= "d"; 
	$data['lname'] 		= $this->input->post('lastname');
	//$data['addr1'] 		= $this->input->post('house_no') .' '.$this->input->post('street');
	//$data['addr2'] 		= $this->input->post('barangay'); 
	//$data['city'] 		=  $this->input->post('city'); 
	$data['state'] 		= ""; 
	//$data['country'] 		= $this->input->post('country'); 
	//$data['zip'] 			= $this->input->post('postal_zip'); 
	$data['sec3d'] 		= "enabled"; 
	if($this->input->post('biller_email'))
	{
		$data['email'] 		= $this->input->post('biller_email'); 
	}
	else
	{
		$data['email'] 		= $this->input->post('email');
	}
	
	$data['phone'] 		= $this->input->post('phonenumber');  
	$data['mobile'] 		= $this->input->post('mobilenumber'); 
	$data['clientip']		= $_SERVER['REMOTE_ADDR'];
	$data['amount'] 		= $this->input->post('reservation_fee'); // set this to the total amount of the transaction. Set the amount to 2 decimal point before generating signature.
	$data['currency'] = "PHP"; //PHP or USD
	//Billing Details
	$data['country'] =  $this->input->post('billing_country'); 
	$data['billing_house_no'] =  $this->input->post('billing_house_no');
	$data['billing_street'] =  $this->input->post('billing_street');
	$data['addr1'] = $this->input->post('billing_house_no') .' '.$this->input->post('billing_street');
	$data['addr2'] = $this->input->post('billing_barangay');
	$data['city'] =  $this->input->post('billing_city');
	$data['barangay'] =  $this->input->post('billing_barangay');
	$data['zip'] =  $this->input->post('billing_postal_zip');
	$data['project'] =  $this->input->post('project');
	 // echo '<pre>';
	 // print_r($data);
	 // echo '</pre>';
	 // exit;
	extract($data);
      $forSign = $mid . $requestid . $ipaddress . $noturl . $resurl .  $fname . $lname . $addr1 . $addr2 . $city . $state . $country . $zip . $email . $phone . $clientip . $amount . $currency . $sec3d;
			$cert = "FD2CE586D02AEC25B87D392AF95D69DB"; 

			// $_mid . "<hr />";
			//echo $cert . "<hr />";
			//echo $forSign . "<hr />";


      $_sign = hash("sha512", $forSign.$cert);
		      
      $xml = $this->create_xml($_sign,$data);
// echo '<pre>';
// 	print_r($_sign);
// 	echo '</pre>';
// 	exit;
		$form = '<form name="paygate_frm" method="POST" action="https://testpti.payserv.net/webpayment/default.aspx">';
        $form .= '<input type="hidden" name="paymentrequest" value="' . $xml . '">';
        $form .= '</form>';
        $form .= '<script>document.paygate_frm.submit();</script>';
        echo $form;
	 
	}
	public function cancel()
	{	
		$data['page_heading'] = 'Payment Cancelled';
		$data['page_subhead'] = lang('index_subhead');
		$data['page_layout'] = 'full_width';

		if($this->input->get())
		{
			$requestid  = base64_decode($this->input->get('requestid'));
			$responseid = base64_decode($this->input->get('responseid'));
			$data['details'] = $this->payments_model->select('payment_reservation_id as ref_no,payment_paynamics_no as paynamics_ref_no,reservation_fee')
				->join('reservations','reservations.reservation_reference_no = payment_reservation_id','LEFT')
				->find_by(['payment_paynamics_no' => $responseid]);
			if(!$data['details'])
			{
				redirect(base_url().'page-not-found');
			}
		}
		else	
		{
			redirect(base_url().'page-not-found');
		}
	
		
		$this->template->set_template('template_reservation');
		$this->template->add_css(module_css('reservations', 'reservation_form'), 'embed');
		$this->template->add_js(module_js('reservations', 'reservation_form'), 'embed');
		$this->template->write_view('content', 'reservation_cancel',$data);
		$this->template->render();
	}
	public function notif()
	{

		$encoded = explode(" ",$this->input->post('paymentresponse'));
		$strxml = "";
		for ($i=0; $i < count($encoded); $i++) { 
			$decoded = base64_decode($encoded[$i]);
			$count = count($encoded) - 1;
			$strxml .= $decoded.($count == $i ?'' : '>');
		}

		$xml = simplexml_load_string($strxml);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);
		$a = array();
		foreach ($array as $key ) {
			foreach ($key as $k => $val) {
				$a[$k] = $val;
			}	
		}
		extract($a);

		$data = array(
			'payment_reservation_id' => $request_id,
			'payment_paynamics_no' => $response_id,
			'payment_encoded_details'=> $this->input->post('paymentresponse'),
			'payment_status' => $response_message,
			'payment_type' => (isset($ptype)  ? (is_array($ptype) ? 'N/A': $ptype) : 'N/A')
				
			);
		$this->payments_model->insert($data);
	}
	public function return()
	{	
		
		$data['page_subhead'] = lang('index_subhead');
		$data['page_layout'] = 'full_width';

		if($this->input->get())
		{
			$requestid  = base64_decode($this->input->get('requestid'));
			$responseid = base64_decode($this->input->get('responseid'));
			$data['details'] = $this->payments_model->select('payment_reservation_id as ref_no,payment_paynamics_no as paynamics_ref_no,reservation_fee,payment_status as status')
				->join('reservations','reservations.reservation_reference_no = payment_reservation_id','LEFT')
				->find_by(['payment_paynamics_no' => $responseid]);
			if(!$data['details'])
			{
				redirect(base_url().'page-not-found');
			}
		}
		else	
		{
			redirect(base_url().'page-not-found');
		}
	
		$data['page_heading'] = $data['details']->status;

		$this->template->set_template('template_reservation');
		$this->template->add_css(module_css('reservations', 'reservation_form'), 'embed');
		$this->template->add_js(module_js('reservations', 'reservation_form'), 'embed');
		$this->template->write_view('content', 'reservation_success',$data);
		$this->template->render();
		 
	}
	Public function create_xml($_sign,$data)
	{
				$xmlstr = "";
		      
			    $strxml = "";
		      $data = (object) $data;
		      $strxml = $strxml . "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
		      $strxml = $strxml . "<Request>";
		      $strxml = $strxml . "<orders>";
		      $strxml = $strxml . "<items>";
		      $strxml = $strxml . "<Items>";
		      $strxml = $strxml . "<itemname>".$data->project."</itemname><quantity>1</quantity><amount>" . $data->amount . "</amount>"; 
		      $strxml = $strxml . "</Items>";
		      $strxml = $strxml . "</items>";
		      $strxml = $strxml . "</orders>";
		      $strxml = $strxml . "<mid>" . $data->mid . "</mid>";
		      $strxml = $strxml . "<request_id>" . $data->requestid . "</request_id>";
		      $strxml = $strxml . "<ip_address>" . $data->ipaddress . "</ip_address>";
		      $strxml = $strxml . "<notification_url>" . $data->noturl . "</notification_url>";
		      $strxml = $strxml . "<response_url>" . $data->resurl . "</response_url>";
		      $strxml = $strxml . "<cancel_url>" . $data->cancelurl . "</cancel_url>";
		      $strxml = $strxml . "<mtac_url>https://www.google.com</mtac_url>"; // pls set this to the url where your terms and conditions are hosted
		    
		      $strxml = $strxml . "<fname>" . $data->fname . "</fname>";
		      $strxml = $strxml . "<lname>" . $data->lname . "</lname>";
		      //$strxml = $strxml . "<mname>" . $data->mname . "</mname>";
		      $strxml = $strxml . "<address1>" . $data->addr1 . "</address1>";
		      $strxml = $strxml . "<address2>" . $data->addr2 . "</address2>";
		      $strxml = $strxml . "<city>" . $data->city . "</city>";
		      $strxml = $strxml . "<state>" . $data->state . "</state>";
		      $strxml = $strxml . "<country>" . $data->country . "</country>";
		      $strxml = $strxml . "<zip>" . $data->zip . "</zip>";
		      $strxml = $strxml . "<secure3d>" . $data->sec3d . "</secure3d>";
		      $strxml = $strxml . "<trxtype>sale</trxtype>";
		      $strxml = $strxml . "<email>" . $data->email . "</email>";
		      $strxml = $strxml . "<phone>" . $data->phone . "</phone>";
		      $strxml = $strxml . "<mobile>" . $data->mobile . "</mobile>";
		      $strxml = $strxml . "<client_ip>" . $data->clientip . "</client_ip>";
		      $strxml = $strxml . "<amount>" . $data->amount . "</amount>";
		      $strxml = $strxml . "<currency>" . $data->currency . "</currency>";
		      $strxml = $strxml . "<mlogo_url>https://assets.ortigas.com.ph/data/images/ortigaslogo.png</mlogo_url>";// pls set this to the url where your logo is hosted
		      $strxml = $strxml . "<pmethod></pmethod>";
		      $strxml = $strxml . "<signature>" . $_sign . "</signature>";
		      $strxml = $strxml . "</Request>";
		      $b64string =  base64_encode($strxml);
				
			
		return $b64string;
				
	}
}
