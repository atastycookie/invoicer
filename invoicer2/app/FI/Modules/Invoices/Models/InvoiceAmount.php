<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Invoices\Models;

use Eloquent;
use FI\Libraries\CurrencyFormatter;
use FI\Libraries\NumberFormatter;

class InvoiceAmount extends Eloquent {

	/**
	 * Guarded properties
	 * @var array
	 */
	protected $guarded = array('id');

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
   
    public function invoice()
    {
    	return $this->belongsTo('FI\Modules\Invoices\Models\Invoice');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

	public function getFormattedItemSubtotalAttribute()
	{
		return CurrencyFormatter::format($this->attributes['item_subtotal'], $this->invoice->currency_code);
	}

	public function getFormattedItemTotalAttribute()
	{
		return CurrencyFormatter::format($this->attributes['item_subtotal'] + $this->attributes['item_tax_total']);
	}

	// Returns the item level tax
	public function getFormattedItemTaxTotalAttribute()
	{
		return CurrencyFormatter::format($this->attributes['item_tax_total']);
	}

	// Returns the invoice level tax
	public function getFormattedTaxTotalAttribute()
	{
		return CurrencyFormatter::format($this->attributes['tax_total']);
	}

	// Returns the entire amount of tax for the invoice (formatted as currency)
	public function getFormattedTotalTaxAttribute()
	{
		return CurrencyFormatter::format($this->attributes['item_tax_total'] + $this->attributes['tax_total'], $this->invoice->currency_code);
	}

	// Returns the entire amount of tax for the invoice
	public function getTotalTaxAttribute()
	{
		return NumberFormatter::format($this->attributes['item_tax_total'] + $this->attributes['tax_total']);
	}

	public function getFormattedTotalAttribute()
	{
		return CurrencyFormatter::format($this->attributes['total'], $this->invoice->currency_code);
	}

	public function getFormattedPaidAttribute()
	{
		return CurrencyFormatter::format($this->attributes['paid'], $this->invoice->currency_code);
	}

	public function getFormattedBalanceAttribute()
	{
		return CurrencyFormatter::format($this->attributes['balance'], $this->invoice->currency_code);
	}

	public function getFormattedNumericBalanceAttribute()
	{
		return NumberFormatter::format($this->attributes['balance']);
	}

}