<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Import\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider {

	public function register()
	{
        $this->app->bind('ImportValidator', 'FI\Modules\Import\Validators\ImportValidator');
        $this->app->bind('ClientImportValidator', 'FI\Modules\Import\Validators\ClientImportValidator');
        $this->app->bind('QuoteImportValidator', 'FI\Modules\Import\Validators\QuoteImportValidator');
	}

}