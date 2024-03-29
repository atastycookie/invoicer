<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Invoices\Validators;

use Validator;

class InvoiceTaxRateValidator {

	public function getValidator($input)
	{
		return Validator::make($input, array(
			'tax_rate_id'         => 'required|numeric|min:1',
			'include_item_tax'    => 'required'
			)
		);
	}
}