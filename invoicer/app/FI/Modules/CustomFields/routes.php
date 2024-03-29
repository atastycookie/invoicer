<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(array('before' => 'auth', 'namespace' => 'FI\Modules\CustomFields\Controllers'), function()
{
	Route::get('custom_fields', array('uses' => 'CustomFieldController@index', 'as' => 'customFields.index'));
	Route::get('custom_fields/create', array('uses' => 'CustomFieldController@create', 'as' => 'customFields.create'));
	Route::get('custom_fields/{customField}/edit', array('uses' => 'CustomFieldController@edit', 'as' => 'customFields.edit'));
	Route::get('custom_fields/{customField}/delete', array('uses' => 'CustomFieldController@delete', 'as' => 'customFields.delete'));

	Route::post('custom_fields', array('uses' => 'CustomFieldController@store', 'as' => 'customFields.store'));
	Route::post('custom_fields/{customField}', array('uses' => 'CustomFieldController@update', 'as' => 'customFields.update'));
});