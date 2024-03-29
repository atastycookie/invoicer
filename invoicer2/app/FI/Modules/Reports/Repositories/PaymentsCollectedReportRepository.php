<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Reports\Repositories;

use FI\Libraries\CurrencyFormatter;
use FI\Modules\Payments\Models\Payment;

class PaymentsCollectedReportRepository {
	
	/**
	 * Get the report results
	 * @param  string $fromDate
	 * @param  string $toDate
	 * @return array
	 */
	public function getResults($fromDate, $toDate)
	{
		$results = array('payments' => array(), 'total' => 0);

		$payments = Payment::byDateRange($fromDate, $toDate)->get();

		foreach ($payments as $payment)
		{
			$results['payments'][] = array(
				'client_name'    => $payment->invoice->client->name,
				'invoice_number' => $payment->invoice->number,
				'payment_method' => isset($payment->payment_method->name) ? $payment->payment_method->name : '',
				'note'           => $payment->note,
				'date'           => $payment->formatted_paid_at,
				'amount'         => CurrencyFormatter::format($payment->amount / $payment->invoice->exchange_rate)
			);

			$results['total'] += $payment->amount / $payment->invoice->exchange_rate;
		}

		$results['total'] = CurrencyFormatter::format($results['total']);

		return $results;
	}
	
}