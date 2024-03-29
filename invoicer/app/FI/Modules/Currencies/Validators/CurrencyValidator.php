<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Currencies\Validators;

use Validator;

class CurrencyValidator {

	public function getValidator($input)
	{
		return Validator::make($input, array(
			'name'      => 'required',
			'code'      => 'required|unique:currencies',
			'symbol'    => 'required',
			'placement' => 'required'
			)
		);
	}

	public function getUpdateValidator($input, $id)
	{
		return Validator::make($input, array(
			'name'      => 'required',
			'code'      => 'required|unique:currencies,code,' . $id,
			'symbol'    => 'required',
			'placement' => 'required'
			)
		);
	}

}