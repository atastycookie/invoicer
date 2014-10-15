<?php

/**
 * This file is part of Deskmine.
 *
 * (c) Deskmine
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Sessions\Validators;

use Validator;

class SessionValidator {

	public function getValidator($input)
	{
		return Validator::make($input, array(
			'email'    => 'required',
			'password' => 'required'
			)
		);
	}
}