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
		$this->load->model('countries_model');
    }

	public function pdf()
	{
		$data['page_heading'] = 'PDF';
	
		$this->load->view('../../modules/reservations/views/pdf', $data);
		
	}

    public function index()
    {
       
		$data['page_heading'] = 'reservation';
		$data['page_subhead'] = lang('index_subhead');
		$data['page_layout'] = 'full_width';
		$key = getenv('KEY');
		$key  =	$this->Key($key);

	    $data['countries'] = $this->countries_model->where('country_deleted',0)->order_by('country_name', 'ASC')
				->format_dropdown('country_name', 'country_name', TRUE);
		if ($this->input->post())
		{
			if($this->submit_form())
			{
				
				
				
				$this->template->set_template('template_reservation');
				$this->template->add_css(module_css('reservations', 'reservation_form'), 'embed');
				$this->template->add_js(module_js('reservations', 'reservation_form'), 'embed');
				$this->template->write_view('content', 'reservation_blank_view',$data);
				$this->template->render();

				//echo 'success';
			}
			else
			{

				$data['reservations'] = (object) array
										(
											
											'firstname'		=> $this->input->post('firstname'),
											'lastname'		=> $this->input->post('lastname'),
											'phonenumber'		=> $this->input->post('phonenumber'),
											'mobilenumber'		=> $this->input->post('mobilenumber'),
											'email'		=> $this->input->post('email'),
											'idtype'		=> $this->input->post('idtype'),
											'idnumber'		=> $this->input->post('idnumber'),
											'country'		=> $this->input->post('country'),
											'house_no'		=> $this->input->post('house_no'),
											'street'		=> $this->input->post('street'),
											'city'		=> $this->input->post('city'),
											'barangay'		=> $this->input->post('barangay'),
											'postal_zip'		=> $this->input->post('postal_zip'),
											'billing_country'		=> $this->input->post('billing_country'),
											'billing_house_no'		=> $this->input->post('billing_house_no'),
											'billing_street'		=> $this->input->post('billing_street'),
											'billing_city'		=> $this->input->post('billing_city'),
											'billing_barangay'		=>  $this->input->post('billing_barangay'),
											'billing_postal_zip'		=> $this->input->post('billing_postal_zip'),

									
											'project'		=> $this->input->post('project'),
											'property_specialist'		=> $this->input->post('property_specialist'),
											'sellers_group'		=> $this->input->post('sellers_group'),
											'unit_details'		=> $this->input->post('unit_details'),
											'allocation'		=> $this->input->post('allocation'),
											'fee'		=> $this->input->post('reservation_fee'),
											'notes'		=> $this->input->post('notes'),									
		
										);


				$this->template->set_template('template_reservation');
				$this->template->add_css(module_css('reservations', 'reservation_form'), 'embed');
				$this->template->add_js(module_js('reservations', 'reservation_form'), 'embed');
				$this->template->write_view('content', 'reservation_blank_view',$data);
				$this->template->render();
				
			}
		}
		else
		{

		

				
				$this->template->set_template('template_reservation');
				$this->template->add_css(module_css('reservations', 'reservation_form'), 'embed');
				$this->template->add_js(module_js('reservations', 'reservation_form'), 'embed');
				$this->template->write_view('content', 'reservation_blank_view',$data);
				$this->template->render();
		}
		
    }

	Public function submit_form()
	{
		//personal
		$this->form_validation->set_rules('firstname', 'First Name', 'required|max_length[50]');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required|max_length[50]');
		$this->form_validation->set_rules('phonenumber', 'Phone Number', 'required|max_length[50]');
		$this->form_validation->set_rules('mobilenumber', 'Mobile Number', 'required|max_length[50]');
		$this->form_validation->set_rules('email', 'Email Address', 'required|max_length[50]');
		$this->form_validation->set_rules('idtype', 'ID Type', 'required|max_length[50]');
		$this->form_validation->set_rules('idnumber', 'ID Number', 'required|max_length[50]');
		//mailing
		$this->form_validation->set_rules('country', 'Country', 'required|max_length[50]');
		$this->form_validation->set_rules('house_no', 'House Number', 'required|max_length[50]');
		$this->form_validation->set_rules('street', 'Street', 'required|max_length[50]');
		$this->form_validation->set_rules('city', 'City', 'required|max_length[50]');
		$this->form_validation->set_rules('barangay', 'Barangay', 'required|max_length[50]');
		$this->form_validation->set_rules('postal_zip', 'Zip Code', 'required|max_length[50]');
		
		//Project Details
		$this->form_validation->set_rules('project', 'Project', 'required|max_length[50]');
		$this->form_validation->set_rules('sellers_group', 'Seller Group', 'required|max_length[50]');
		$this->form_validation->set_rules('allocation', 'Allocation', 'required|max_length[50]');
		$this->form_validation->set_rules('property_specialist', 'Property Specialist', 'required|max_length[50]');
		$this->form_validation->set_rules('unit_details', 'Unit Details', 'required|max_length[50]');
		$this->form_validation->set_rules('reservation_fee', 'Reservation Fee', 'required|max_length[50]|numeric');
		$this->form_validation->set_rules('notes', 'Notes', 'required|max_length[50]');
		//Billing Details
		$this->form_validation->set_rules('billing_country', 'Country', 'required|max_length[50]');
		$this->form_validation->set_rules('billing_house_no', 'House Number', 'required|max_length[50]');
		$this->form_validation->set_rules('billing_street', 'Billing Street', 'required|max_length[50]');
		$this->form_validation->set_rules('billing_city', 'Billing City', 'required|max_length[50]');
		$this->form_validation->set_rules('billing_barangay', 'Billing Barangay', 'required|max_length[50]');
		$this->form_validation->set_rules('billing_postal_zip', 'Zip Postal Code', 'required|max_length[50]');
	

		$this->form_validation->set_message('required', 'This field is required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if ($this->form_validation->run($this) == FALSE)
		{
			
			return FALSE;
		}

		$key = getenv('KEY');
		$key  =	$this->Key($key);

		$data = array(
			'customer_fname'		=> Crypto::encrypt($this->input->post('firstname'), $key),
			'customer_lname'		=> Crypto::encrypt($this->input->post('lastname'), $key),
			'customer_telno'		=> Crypto::encrypt($this->input->post('phonenumber'), $key),
			'customer_mobileno'		=> Crypto::encrypt($this->input->post('mobilenumber'), $key),
			'customer_email'		=> Crypto::encrypt($this->input->post('email'), $key),
			'customer_id_type'		=> Crypto::encrypt($this->input->post('idtype'), $key),
			'customer_id_details'		=> Crypto::encrypt($this->input->post('idnumber'), $key),
			'customer_mailing_country'		=> Crypto::encrypt($this->input->post('country'), $key),
			'customer_mailing_house_no'		=> Crypto::encrypt($this->input->post('house_no'), $key),
			'customer_mailing_street'		=> Crypto::encrypt($this->input->post('street'), $key),
			'customer_mailing_city'		=> Crypto::encrypt($this->input->post('city'), $key),
			'customer_mailing_brgy'		=> Crypto::encrypt($this->input->post('barangay'), $key),
			'customer_mailing_zip_code'		=> Crypto::encrypt($this->input->post('postal_zip'), $key),
			'customer_billing_country'		=> Crypto::encrypt($this->input->post('billing_country'), $key),
			'customer_billing_house_no'		=> Crypto::encrypt($this->input->post('billing_house_no'), $key),
			'customer_billing_street'		=> Crypto::encrypt($this->input->post('billing_street'), $key),
			'customer_billing_city'		=> Crypto::encrypt($this->input->post('billing_city'), $key),
			'customer_billing_brgy'		=>  Crypto::encrypt($this->input->post('billing_barangay'), $key),
			'customer_billing_zip_code'		=> Crypto::encrypt($this->input->post('billing_postal_zip'), $key),

			 
		);

		$customer_id = $this->customers_model->insert($data);

		$reservation_data = array(
			'reservation_customer_id'		=>$customer_id,
			'reservation_reference_no'		=> rand(10000,99999).$customer_id,
			'reservation_project'		=> $this->input->post('project'),
			'reservation_property_specialist'		=> $this->input->post('property_specialist'),
			'reservation_sellers_group'		=> $this->input->post('sellers_group'),
			'reservation_unit_details'		=> $this->input->post('unit_details'),
			'reservation_allocation'		=> $this->input->post('allocation'),
			'reservation_fee'		=> number_format($this->input->post('reservation_fee'), 2, '.', ''),
			'reservation_notes'		=> $this->input->post('notes'),
		);

	$id =	$this->reservations_model->insert($reservation_data);

	return $id;
	}
	private function key($key)
	{
		return Key::loadFromAsciiSafeString($key);
	}

	

    public function form($ref_no = null)
	{
		$data['page_heading'] = 'reservation';
		$data['page_subhead'] = lang('index_subhead');
		$data['page_layout'] = 'full_width';
		$key = getenv('KEY');
		$key  =	$this->Key($key);
		 $data['countries'] = $this->countries_model->where('country_deleted',0)->order_by('country_name', 'ASC')
				->format_dropdown('country_name', 'country_name', TRUE);
	
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
							if($value == '')
							{
								$array[$k] =  $value;
							}
							else
							{
								$array[$k] =  Crypto::decrypt($value,$key);
							}
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
							if($value == '')
							{
								$array[$k] =  $value;
							}
							else
							{
								$array[$k] =  Crypto::decrypt($value,$key);
							}
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

	Public function getUserIpAddr()
	{

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


	Public function submit()
	{
		
		$this->form_validation->set_rules('billing_country', 'Country', 'required|max_length[50]');
		$this->form_validation->set_rules('billing_house_no', 'House Number', 'required|max_length[50]');
		$this->form_validation->set_rules('billing_street', 'Billing Street', 'required|max_length[50]');
		$this->form_validation->set_rules('billing_city', 'Billing City', 'required|max_length[50]');
		$this->form_validation->set_rules('billing_barangay', 'Billing Barangay', 'required|max_length[50]');
		$this->form_validation->set_rules('billing_postal_zip', 'Zip Postal Code', 'required|max_length[50]');



		$this->form_validation->set_message('required', 'This field is required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if ($this->form_validation->run($this) == FALSE)
		{
			
			return FALSE;
		}
		
	$data['mid'] 			= getenv('MID'); 
	$data['requestid'] 	= $this->input->post('reference_no');
	$data['ipaddress'] 	= $this->getUserIpAddr();
	$data['noturl'] 	= base_url('/reservations/notif'); // url where response is posted
	$data['resurl'] 	= base_url('/reservations/payment_callback'); //url of merchant landing page
	$data['cancelurl'] 	= base_url('/reservations/payment_cancel'); //url of merchant landing page
	$data['mtac_url']	= base_url('/payment-terms-and-conditions');
	$data['fname'] 		= $this->input->post('firstname'); 

	$data['lname'] 		= $this->input->post('lastname');
	
	$data['state'] 		= ""; 
	//$data['sec3d'] 		= "try3d"; 
	$data['sec3d'] = "enabled";
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

	extract($data);
      $forSign = $mid . $requestid . $ipaddress . $noturl . $resurl .  $fname . $lname . $addr1 . $addr2 . $city . $state . $country . $zip . $email . $phone . $clientip . $amount . $currency . $sec3d;
			$cert = getenv('CERT'); 

			

      $_sign = hash("sha512", $forSign.$cert);
		      
      $xml = $this->create_xml($_sign,$data);

		$form = '<form name="paygate_frm" method="POST" action="'.getenv('PAYMENT_URL').'">';
        $form .= '<input type="hidden" name="paymentrequest" value="' . $xml . '">';
        $form .= '</form>';
        $form .= '<script>document.paygate_frm.submit();</script>';
        echo $form;
	 
	}
	public function payment_cancel()
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
	public function payment_callback()
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
		      $strxml = $strxml . "<mtac_url>". $data->mtac_url."</mtac_url>"; // pls set this to the url where your terms and conditions are hosted
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
		      $strxml = $strxml . "<mlogo_url>https://assets.ortigas.com.ph/data/images/ortigasland.svg</mlogo_url>";// pls set this to the url where your logo is hosted
		      $strxml = $strxml . "<pmethod></pmethod>";
		      $strxml = $strxml . "<signature>" . $_sign . "</signature>";
		      $strxml = $strxml . "</Request>";
		      $b64string =  base64_encode($strxml);
				
			
		return $b64string;
				
	}
}
