<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(array('before' => 'auth', 'namespace' => 'FI\Modules\InvoiceGroups\Controllers'), function()
{
	Route::get('invoice_groups', array('uses' => 'InvoiceGroupController@index', 'as' => 'invoiceGroups.index'));
	Route::get('invoice_groups/create', array('uses' => 'InvoiceGroupController@create', 'as' => 'invoiceGroups.create'));
	Route::get('invoice_groups/{invoiceGroup}/edit', array('uses' => 'InvoiceGroupController@edit', 'as' => 'invoiceGroups.edit'));
	Route::get('invoice_groups/{invoiceGroup}/delete', array('uses' => 'InvoiceGroupController@delete', 'as' => 'invoiceGroups.delete'));

	Route::post('invoice_groups', array('uses' => 'InvoiceGroupController@store', 'as' => 'invoiceGroups.store'));
	Route::post('invoice_groups/{invoiceGroup}', array('uses' => 'InvoiceGroupController@update', 'as' => 'invoiceGroups.update'));
});