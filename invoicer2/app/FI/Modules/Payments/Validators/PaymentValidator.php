<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Payments\Validators;

use FI\Libraries\NumberFormatter;

use Validator;

class PaymentValidator {

	public function getValidator($input)
	{
		return Validator::make($input, array(
			'invoice_id'        => 'required',
			'paid_at'           => 'required',
			'amount'            => 'required|numeric',
			'payment_method_id' => 'required'
			)
		);
	}
}