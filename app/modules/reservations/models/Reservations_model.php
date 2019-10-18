<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Reservations_model Class
 *
 * @package		Codifire
 * @version		1.0
 * @author 		Robert Christian Obias <robert.obias@digify.com.ph>
 * @copyright 	Copyright (c) 2019, Digify, Inc.
 * @link		http://www.digify.com.ph
 */

use Defuse\Crypto\Key;
use Defuse\Crypto\Crypto;

class Reservations_model extends BF_Model {

	protected $table_name			= 'reservations';
	protected $key					= 'reservation_id';
	protected $date_format			= 'datetime';
	protected $log_user				= TRUE;

	protected $set_created			= TRUE;
	protected $created_field		= 'reservation_created_on';
	protected $created_by_field		= 'reservation_created_by';

	protected $set_modified			= TRUE;
	protected $modified_field		= 'reservation_modified_on';
	protected $modified_by_field	= 'reservation_modified_by';

	protected $soft_deletes			= TRUE;
	protected $deleted_field		= 'reservation_deleted';
	protected $deleted_by_field		= 'reservation_deleted_by';

	public function get_reservation($ref_no)
	{

		

				$fields = array(
					'customer_fname',
					'customer_lname',
					'customer_telno',
					'customer_mobileno',
					'customer_email',
					'customer_id_type',
					'customer_id_details',
					'customer_mailing_country',
					'customer_mailing_house_no',
					'customer_mailing_street',
					'customer_mailing_city',
					'customer_mailing_brgy',
					'customer_mailing_zip_code',
					'customer_billing_country',
					'customer_billing_house_no',
					'customer_billing_street',
					'customer_billing_city',
					'customer_billing_brgy',
					'customer_billing_zip_code',
					'reservation_reference_no',
					'reservation_project',
					'reservation_property_specialist',
					'reservation_sellers_group',
					'reservation_unit_details',
					'reservation_allocation',
					'reservation_fee',
					'reservation_notes'	

				);		

		$reservation = $this->select($fields)->join('customers', 'customer_id = reservation_customer_id', 0)
							->where('customer_deleted', 0)
							->where('reservation_deleted', 0)
							->find_by('reservation_reference_no', $ref_no);

		return $reservation;
	}

}