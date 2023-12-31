<?php

namespace App\lib;

class Validation
{
	private static $rules = array(
		'site' => [
			'check_order' => [
				"saloon" => 'required',
				"address" => 'required',
				"fullName" => 'required',
				"email" => "required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i",
				"phone" => "required|numeric|regex:/^[0-9]+$/u",
			],
			'subscribe' => [
				"email" => "required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i|unique:subscribe,email",
			],
			'partners' => [
				"name" => 'required',
				"business_type" => 'required',
				"restaurent_salon_name" => 'required',
				"email" => "required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i|unique:partners,email",
				"phone" => 'required|numeric',
				"address" => 'required',
				"state" => 'required',
				"pincode" => 'required',
			],
			'check_coupon' => [
				"coupon" => "required",
			],
			'contactus' => [
				"name" => "required",
				"email" => "required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i",
				"subject" => "required|max:100",
				"message" => "required",
			],
		],
		"user" => [
			'signup' => [
				"first_name" => "required|regex:/(^([a-zA-z]+)(\d+)?$)/i",
				"last_name" => "required|regex:/(^([a-zA-z]+)(\d+)?$)/i",
				"email" => "required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i|unique:user,email",
				"password" => "required|min:6|max:16",
				"confirm_password" => "required|same:password",
				"is_accept" => 'required'
			],
			'login' => [
				'email' => 'required|email',
				'password' => 'required',
			],
			'forgot-password' => [
				'email' => "required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i"
			],
			'forgot_pass' => [
				'password'  => 'required|min:6|max:15|regex:/^[a-zA-Z0-9@_-]+$/i',
				'confirm_password' => 'required|same:password',
			],
			'update_profile' => [
				"firstname" => "required|regex:/(^([a-zA-z]+)(\d+)?$)/i",
				"lastname" => "required|regex:/(^([a-zA-z]+)(\d+)?$)/i",
				"profileImage"  => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000"
			],
			'update_user_password' => [
				"newPassword" => "required",
				"confirmNewPassword" => "required",
			],
			'add_help_user' => [
				"help" => "required",
			],
		],
		"admin" => [
			'login' => [
				'email' => 'required|email',
				'password' => 'required'
			],
			'forgot_password' => [
				'email' => 'required|email',
			],
			'reset_password' => [
				'new_password' => 'required|min:6',
				'confirm_password' => 'required|same:new_password'
			],
			'change_password' => [
			],
			'delete-item' => [
				'delete_id' => 'required',
				'type' => 'required',
			],
			'add_faq' => [
				"query" => "required",
				"content" => "required",
				"sort_order" => "required",
			],
			'update-restaurant-food' => [
				"restaurant_id" => "required",
				"category" => "required",
				"restaurant_price" => "required|numeric",
				"price" => "required|numeric",
				'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:5000'
			],

			"site_content" => [
				'site_page' => 'required|string|min:3|max:30',
				'site_content' => 'required|string|min:3',
			],
			'get_content' => [
				'site_page' => 'nullable|string|min:3|exists:site_contents,name',
			],
			'add-saloon' => [
				"name" => 'required|regex:/^[a-zA-Z ]+$/',
				"email" => 'required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i|unique:saloon,email',
				"phone_number" => 'required|numeric|digits:10',
				'address' => 'required',
				'password' => 'required|min:6|max:16',
				"state" => 'required',
				"pincode" => 'required',
				'confirm_password' => 'required|same:password',
				'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:5000'
			],
			"site_content" => [
				'site_page' => 'required|string|min:3|max:30',
				'site_content' => 'required|string|min:3',
			],
			'change_admin_password' => [
				'old_password' => 'required',
				'new_password' => 'required|min:6|max:16',
				'confirm_password' => 'required|same:new_password'
			],
			'update_profile' => [
				'admin_name' => 'required',
				'admin_email' => 'required|email',
			],
			'add-partner' => [
				'name' => 'required',
				"logo" => 'required|image'
			],
			"faq" => [
				'sorting_id' => 'required|numeric|unique:faq,sorting_id',
				'question' => 'required|min:3|max:255',
				'answer' => 'required|min:3',
			],

		],
		"api" => [
			"login" => [
				"email" => "required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i|exists:drivers,email",
				"password" => "required|min:3|max:50",
			],
			"change_password" => [
				"user_id" => "required",
				"old_password" => "required",
				"new_password" => "required",
				"confirm_password" => "required",
			],
			"change_order_status" => [
				"order_id" => "required",
				"status" => "required",
			],
			"order_detail" => [
				"order_id" => "required",
			],
			"notification_filter" => [
				"itemPerPage" => "required",
				"currentPage" => "required",
			],
			"delete_notification" => [
				"delete_id" => "required",
			],
			"query" => [
				"query" => "required|max:500",
			],
			"update_profile" => [
				"driver_id" => "required",
				"username" => "required",
				"gender" => "required",
				"dob" => "required",
				"phone_number" => "required|numeric|digits:10"
			],
			'forgot-password' => [
				'email' => "required|email|regex:/^[a-zA-Z0-9._-]+@[a-zA-Z.]+\.[a-zA-Z]{2,10}$/i"
			],
		],
	);

	public static function get_rules($type, $rules_name)
	{
		if (isset(self::$rules[$type][$rules_name]))
			return self::$rules[$type][$rules_name];
		return array();
	}

	public static function validate($type, $rule_name, $custom_msg = [], $args_param = [], $niceNames = [])
	{

		$rules = self::get_rules($type, $rule_name);

		if (count($args_param) > 0) {
			$param = $args_param;
		} else {
			$param = \Input::all();
		}

		if (count($custom_msg) > 0) {
			$validator = \Validator::make($param, $rules, $custom_msg);
		} else {
			$validator = \Validator::make($param, $rules);
		}
		$validator->setAttributeNames($niceNames);

		if ($validator->fails()) {
			$error = $validator->messages()->all();
			$msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
			$json = \General::error_res($msg);
			$json['data'] = [$msg];
			return $json;
		}

		return \General::success_res();
	}

	public static function custom_validate($param, $rules, $custom_msg = [], $custom_names = [], $sometimes = [])
	{
		$json = [];
		if (count($custom_msg) > 0) {
			$validator = \Validator::make($param, $rules, $custom_msg);
		} else {
			$validator = \Validator::make($param, $rules);
		}
		if (!empty($sometimes)) {
			foreach ($sometimes as $some) {
				if (isset($some['field']) && isset($some['rules']) && isset($some['callback'])) {
					$validator->sometimes($some['field'], $some['rules'], $some['callback']);
				}
			}
		}

		if (!empty($custom_names)) {
			$validator->setAttributeNames($custom_names);
		}
		if ($validator->fails()) {
			$error = $validator->messages()->all();
			$msg = isset($error[0]) ? $error[0] : "Please fill in the required field.";
			$json = \General::validation_error_res($msg);
			$json['data'] = [$msg];
			return $json;
		}
		$json = \General::success_res();
		return  $json;
	}
}
