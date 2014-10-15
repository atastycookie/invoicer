<?php

/**
 * This file is part of Deskmine.
 *
 * (c) Deskmine
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\ItemLookups\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider {

	public function register()
	{
        $this->app->bind('ItemLookupRepository', 'FI\Modules\ItemLookups\Repositories\ItemLookupRepository');
        $this->app->bind('ItemLookupValidator', 'FI\Modules\ItemLookups\Validators\ItemLookupValidator');

        $this->app->bind('ItemLookupController', function($app)
        {
            return new \FI\Modules\ItemLookups\Controllers\ItemLookupController(
                $app->make('ItemLookupRepository'),
                $app->make('ItemLookupValidator')
            );
        });
	}

}