<?php

/**
 * This file is part of HubPay.
 *
 * (c) HubPay
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Statuses;

abstract class AbstractStatuses {

    public static function statuses()
    {
        return static::$statuses;
    }

    /**
     * Returns an array of statuses to populate dropdown list
     * @return array
     */
    public static function lists()
    {
    	$statuses = static::$statuses;

    	unset($statuses[0]);

        foreach ($statuses as $key=>$status)
        {
            $statuses[$key] = trans('fi.' . $status);
        }

    	return $statuses;
    }

    /**
     * Returns the status key
     * @param  string $value
     * @return integer
     */
    public static function getStatusId($value)
    {
        return array_search($value, static::$statuses);
    }

}