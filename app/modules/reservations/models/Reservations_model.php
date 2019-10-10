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
		$reservation = $this->join('customers', 'customer_id = reservation_customer_id', 0)
							->where('customer_deleted', 0)
							->where('reservation_deleted', 0)
							->find_by('reservation_reference_no', $ref_no);

		return $reservation;
	}
}