<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\InvoiceGroups\Controllers;

use App;
use BaseController;
use Input;
use Redirect;
use View;

class InvoiceGroupController extends BaseController {

	/**
	 * Invoice group repository
	 * @var InvoiceGroupRepository
	 */
	protected $invoiceGroup;

	/**
	 * Invoice group validator
	 * @var InvoiceGroupValidator
	 */
	protected $validator;

	public function __construct()
	{
		$this->invoiceGroup = App::make('InvoiceGroupRepository');
		$this->validator    = App::make('InvoiceGroupValidator');
	}

	/**
	 * Display paginated list
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$invoiceGroups = $this->invoiceGroup->getPaged();

		return View::make('invoice_groups.index')
		->with('invoiceGroups', $invoiceGroups);
	}

	/**
	 * Display form for new record
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return View::make('invoice_groups.form')
		->with('editMode', false);
	}

	/**
	 * Validate and handle new record form submission
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		$input = Input::all();

		$validator = $this->validator->getValidator($input);

		if ($validator->fails())
		{
			return Redirect::route('invoiceGroups.create')
			->with('editMode', false)
			->withErrors($validator)
			->withInput();
		}

		$this->invoiceGroup->create($input);
		
		return Redirect::route('invoiceGroups.index')
		->with('alertSuccess', trans('fi.record_successfully_created'));
	}

	/**
	 * Display form for existing record
	 * @param  int $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$invoiceGroup = $this->invoiceGroup->find($id);
		
		return View::make('invoice_groups.form')
		->with(array('editMode' => true, 'invoiceGroup' => $invoiceGroup));
	}

	/**
	 * Validate and handle existing record form submission
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		$input = Input::all();

		$validator = $this->validator->getValidator($input);

		if ($validator->fails())
		{
			return Redirect::route('invoiceGroups.edit', array($id))
			->with('editMode', true)
			->withErrors($validator)
			->withInput();
		}

		$this->invoiceGroup->update($input, $id);

		return Redirect::route('invoiceGroups.index')
		->with('alertInfo', trans('fi.record_successfully_updated'));
	}

	/**
	 * Delete a record
	 * @param  int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$this->invoiceGroup->delete($id);

		return Redirect::route('invoiceGroups.index')
		->with('alert', trans('fi.record_successfully_deleted'));
	}

}