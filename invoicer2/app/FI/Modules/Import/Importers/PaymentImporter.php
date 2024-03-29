<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Import\Importers;

use App, Config;

class PaymentImporter extends AbstractImporter {

	public function getFields()
	{
		return array(
			'paid_at'           => '* ' . trans('fi.date'),
			'invoice_id'        => '* ' . trans('fi.invoice_number'),
			'amount'            => '* ' . trans('fi.amount'),
			'payment_method_id' => '* ' . trans('fi.payment_method'),
			'note'              => trans('fi.note')
			);
	}

	public function getMapRules()
	{
		return array(
			'paid_at'           => 'required',
			'invoice_id'        => 'required',
			'amount'            => 'required',
			'payment_method_id' => 'required'
			);
	}

	public function getValidator($input)
	{
		return App::make('PaymentValidator')->getValidator($input);
	}

	public function importData($input)
	{
		$payment       = App::make('PaymentRepository');
		$invoice       = App::make('InvoiceRepository');
		$paymentMethod = App::make('PaymentMethodRepository');

		$row = 1;

		$fields = array();

		foreach ($input as $field => $key)
		{
			if (is_numeric($key))
			{
				$fields[$key] = $field;
			}
		}

		try
		{
			$handle = fopen(Config::get('fi.uploadPath') . '/payments.csv', 'r');
		}

		catch (\ErrorException $e)
		{
			$this->messages->add('error', 'Could not open the file');
			return false;
		}

		while (($data = fgetcsv($handle, 1000, ',')) !== false)
		{
			if ($row !== 1)
			{
				$record = array();

				foreach ($fields as $key => $field)
				{
					$record[$field] = $data[$key];
				}

				// Attempt to format the date, otherwise use today
				if (strtotime($record['paid_at']))
				{
					$record['paid_at'] = date('Y-m-d', strtotime($record['paid_at']));
				}
				else
				{
					$record['paid_at'] = date('Y-m-d');
				}

				// Transform the invoice number to the id
				$record['invoice_id'] = $invoice->findIdByNumber($record['invoice_id']);

				// Transform the payment method to the id
				if ($record['payment_method_id'] <> 'NULL')
				{
					$record['payment_method_id'] = $paymentMethod->firstOrCreate($record['payment_method_id'])->id;
				}
				else
				{
					$record['payment_method_id'] = $paymentMethod->firstOrCreate('Other')->id;
				}

				if (!isset($record['note']))
				{
					$record['note'] = '';
				}

				if ($this->validateRecord($record))
				{
					$payment->create($record);
				}
			}
			$row++;
		}

		fclose($handle);

		return true;
	}
}