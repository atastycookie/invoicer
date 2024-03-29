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

class InvoiceItem extends Eloquent {

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
   
    public function amount()
    {
        return $this->hasOne('FI\Modules\Invoices\Models\InvoiceItemAmount', 'item_id');
    }

    public function invoice()
    {
        return $this->belongsTo('FI\Modules\Invoices\Models\Invoice');
    }

    public function taxRate()
    {
        return $this->belongsTo('FI\Modules\TaxRates\Models\TaxRate');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedQuantityAttribute()
    {
    	return NumberFormatter::format($this->attributes['quantity']);
    }

    public function getFormattedNumericPriceAttribute()
    {
    	return NumberFormatter::format($this->attributes['price']);
    }

    public function getFormattedPriceAttribute()
    {
    	return CurrencyFormatter::format($this->attributes['price']);
    }

    public function getFormattedDescriptionAttribute()
    {
        return nl2br($this->attributes['description']);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeByDateRange($query, $from, $to)
    {
        return $query->whereIn('invoice_id', function($query) use ($from, $to) {
            $query->select('id')
            ->from('invoices')
            ->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to);
        });
    }

}