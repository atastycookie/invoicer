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

use Validator;
use Illuminate\Support\MessageBag;

abstract class AbstractImporter {

	/**
	 * Instance of MessageBag
	 * @var MessageBag
	 */
	protected $messages;

	public function __construct()
	{
		$this->messages = new MessageBag;
	}

	/**
	 * List the fields available for import
	 * @return array
	 */
	abstract public function getFields();

	/**
	 * Returns validation rules for file mapping validation
	 * @return array
	 */
	abstract public function getMapRules();

	/**
	 * Return an instance of the validator
	 * @param array $input
	 * @return Validator;
	 */
	abstract public function getValidator($input);

	abstract public function importData($input);

	/**
	 * Perform validation on file map
	 * @param  Input $input
	 * @return boolean
	 */
	public function validateMap($input)
	{
		$validator = Validator::make($input, $this->getMapRules());
		
		if ($validator->fails())
		{
			$this->messages->merge($validator->messages()->all());

			return false;
		}

		return true;
	}

	/**
	 * Validate individual records being imported
	 * @param  array $input
	 * @param  string $rules
	 * @return boolean
	 */
	public function validateRecord($input)
	{
		if ($this->getValidator($input)->fails())
		{
			return false;
		}

		return true;
	}

	/**
	 * Read the column names from the import file
	 * @param  string $file
	 * @return array
	 */
	public function getFileFields($file)
	{
		$f = fopen($file, 'r');

		$line = fgets($f);

		fclose($f);

		$fields = str_getcsv($line);

		return array_merge(array('' => ''), $fields);
	}

	/**
	 * Get the file handle
	 * @param  string $file
	 * @return Handle
	 */
	public function getFileHandle($file)
	{
		return fopen($file, 'r');
	}

	public function errors()
	{
		return $this->messages;
	}
}