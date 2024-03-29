<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Libraries;

class Languages {
	
	/**
	 * Provide a list of the available language translations
	 * @return array
	 */
	static function listLanguages()
	{
		$directories = Directory::listContents(app_path() . '/lang');

		$languages = array();

		foreach ($directories as $directory)
		{
			$languages[$directory] = $directory;
		}

		return $languages;
	}

}