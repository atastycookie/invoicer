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
use FI\Libraries\NumberFormatter;
use FI\Modules\Invoices\Models\InvoiceItem;

class ItemSalesReportRepository {
	
	/**
	 * Get the report results
	 * @param  string $fromDate
	 * @param  string $toDate
	 * @return array
	 */
	public function getResults($fromDate, $toDate)
	{
		$results = array();

		$items = InvoiceItem::byDateRange($fromDate, $toDate)->orderBy('name')->get();

		foreach ($items as $item)
		{
			$results[$item->name]['items'][] = array(
				'client_name'    => $item->invoice->client->name,
				'invoice_number' => $item->invoice->number,
				'date'           => $item->invoice->formatted_created_at,
				'price'          => CurrencyFormatter::format($item->price / $item->invoice->exchange_rate),
				'quantity'       => $item->formatted_quantity,
				'total'          => CurrencyFormatter::format($item->amount->total / $item->invoice->exchange_rate)
			);

			if (isset($results[$item->name]['totals']))
			{
				$results[$item->name]['totals']['quantity'] += $item->quantity;
				$results[$item->name]['totals']['total']    += $item->amount->total / $item->invoice->exchange_rate;
			}
			else
			{
				$results[$item->name]['totals']['quantity'] = $item->quantity;
				$results[$item->name]['totals']['total']    = $item->amount->total / $item->invoice->exchange_rate;
			}
		}

		foreach ($results as $key => $result)
		{
			$results[$key]['totals']['quantity'] = NumberFormatter::format($results[$key]['totals']['quantity']);
			$results[$key]['totals']['total']    = CurrencyFormatter::format($results[$key]['totals']['total']);
		}

		return $results;
	}

}