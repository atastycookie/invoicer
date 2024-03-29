<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Import\Validators;

use Validator;

class ImportValidator {

	public function getUploadValidator($input)
	{
		return Validator::make($input, array(
			'import_type' => 'required',
			'import_file' => 'mimes:txt'
			)
		);
	}
}