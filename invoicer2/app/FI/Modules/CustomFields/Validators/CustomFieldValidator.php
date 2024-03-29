<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\CustomFields\Validators;

use Validator;

class CustomFieldValidator {

	public function getValidator($input)
	{
		return Validator::make($input, array(
			'table_name'  => 'required',
			'field_label' => 'required',
			'field_type'  => 'required'
		));
	}

	public function getUpdateValidator($input)
	{
		return Validator::make($input, array(
			'field_label' => 'required',
			'field_type'  => 'required'
		));
	}

}