<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\ItemLookups\Validators;

use Validator;

class ItemLookupValidator {
	
	public function getValidator($input)
	{
		return Validator::make($input, array(
			'name'        => 'required',
			'price'       => 'required|numeric'
			)
		);
	}
}