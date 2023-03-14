<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */


if (!function_exists('get_user_role')) {
	function get_user_role($type = "", $user_id = '')
	{
		$CI	= &get_instance();
		$CI->load->database();

		$role_id	=	$CI->db->get_where('users', array('id' => $user_id))->row()->role_id;
		$user_role	=	$CI->db->get_where('role', array('id' => $role_id))->row()->name;

		if ($type == "user_role") {
			return $user_role;
		} else {
			return $role_id;
		}
	}
}


if (!function_exists('is_purchased')) {
	function is_purchased($course_id = "")
	{
		$CI	= &get_instance();
		$CI->load->library('session');
		$CI->load->database();
		if ($CI->session->userdata('user_login')) {
			$enrolled_history = $CI->db->get_where('enrol', array('user_id' => $CI->session->userdata('user_id'), 'course_id' => $course_id))->num_rows();
			$bundle = $CI->db->get_where('bundle_payment', array(
				'user_id' => $CI->session->userdata('user_id'),
			))->result_array();
			foreach ($bundle as $b) {
				$bu = $CI->db->get_where('course_bundle', array(
					'id' => $b['bundle_id'],
				))->result_array();
				$limit = $bu[0]['subscription_limit'];
				$data_pay = $b['date_added'];
				$soma = strtotime("+{$limit} days", $data_pay);
				$courses_ids = json_decode($bu[0]['course_ids']);
				$data_now = time();
				if ($soma >= $data_now) {
					if (in_array($course_id, $courses_ids)) {
						$enrolled_history++;
					}
				}				
			}
			
			if ($enrolled_history > 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}

// ------------------------------------------------------------------------
/* End of file user_helper.php */
/* Location: ./system/helpers/user_helper.php */
