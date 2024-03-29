<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Payments\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider {

	public function register()
	{
        $this->app->bind('PaymentRepository', 'FI\Modules\Payments\Repositories\PaymentRepository');
        $this->app->bind('PaymentValidator', 'FI\Modules\Payments\Validators\PaymentValidator');

        $this->app->bind('PaymentMailer', 'FI\Modules\Payments\Mail\PaymentMailer');
	}

}