<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\CustomFields\Repositories;

use FI\Modules\CustomFields\Models\QuoteCustom;

class QuoteCustomRepository {

	/**
	 * Save the record
	 * @param  array $input
	 * @param  int $quoteId
	 * @return QuoteCustom
	 */
	public function save($input, $quoteId)
	{
		$record = (QuoteCustom::find($quoteId)) ?: new QuoteCustom;

		$record->quote_id = $quoteId;
		
		$record->fill($input);

		$record->save();

		return $record;
	}

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		QuoteCustom::destroy($id);
	}

}