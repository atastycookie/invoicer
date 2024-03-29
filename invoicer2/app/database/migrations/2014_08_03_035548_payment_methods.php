<?php

use FI\Modules\PaymentMethods\Models\PaymentMethod;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaymentMethods extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// If this is a new install, no payment methods will exist, so let's 
		// create some.
		
		if (PaymentMethod::count() == 0)
		{
			PaymentMethod::create(array('name' => trans('fi.cash')));
			PaymentMethod::create(array('name' => trans('fi.credit_card')));
			PaymentMethod::create(array('name' => trans('fi.online_payment')));
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
