<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Currencies\Libraries;

use FI\Libraries\YQL;

class YQLCurrencyConverter extends YQL {

	/**
	 * Returns the currency conversion rate
	 * @param  string $from
	 * @param  string $to
	 * @return decimal
	 */
	public function convert($from, $to)
	{
		$response = json_decode($this->getQueryResults(urlencode('select * from yahoo.finance.xchange where pair in ("' . $from . $to . '")') . '&env=http://datatables.org/alltables.env'));

		return $response->query->results->rate->Rate;
	}

}