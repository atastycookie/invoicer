<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\CustomFields\Models;

use Eloquent;

class QuoteCustom extends Eloquent {

	/**
	 * The table name
	 * @var string
	 */
	protected $table = 'quotes_custom';

	/**
	 * The primary key
	 * @var string
	 */
	protected $primaryKey = 'quote_id';

	/**
	 * Guarded properties
	 * @var array
	 */
	protected $guarded = array();

}