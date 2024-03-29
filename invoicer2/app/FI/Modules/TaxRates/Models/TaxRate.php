<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\TaxRates\Models;

use Eloquent;
use FI\Libraries\NumberFormatter;

class TaxRate extends Eloquent {

	/**
	 * Guarded properties
	 * @var array
	 */
	protected $guarded = array('id');

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */
   
	public function getFormattedPercentAttribute()
	{
		return NumberFormatter::format($this->attributes['percent'], null, 3) . '%';
	}

	public function getFormattedNumericPercentAttribute()
	{
		return NumberFormatter::format($this->attributes['percent'], null, 3);
	}

}