<?php

namespace App;

use Exception;
use Carbon\Carbon;

class Date {

	/**
     * Day constants
     */
    const SUNDAY = 0;
    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;

    const LAST_DAY_MONTH = 'last_day_month';

    /**
     * Names of days of the week.
     *
     * @var array
     */
    public static $days = array(
        self::SUNDAY => 'Sunday',
        self::MONDAY => 'Monday',
        self::TUESDAY => 'Tuesday',
        self::WEDNESDAY => 'Wednesday',
        self::THURSDAY => 'Thursday',
        self::FRIDAY => 'Friday',
        self::SATURDAY => 'Saturday',
    );

    public static $dayShort = array(
        self::SUNDAY => 'SUN',
        self::MONDAY => 'M',
        self::TUESDAY => 'T',
        self::WEDNESDAY => 'W',
        self::THURSDAY => 'TH',
        self::FRIDAY => 'F',
        self::SATURDAY => 'S',
    );

	public static $months = array(
	    1 => 'Jan',
	    2 => 'Feb',
	    3 => 'Mar',
	    4 => 'Apr',
	    5 => 'May',
	    6 => 'Jun',
	    7 => 'Jul',
	    8 => 'Aug',
	    9 => 'Sep',
	    10 => 'Oct',
	    11 => 'Nov',
	    12 => 'Dec',
	);

    public static $monthsWithLeadingZero = array(
        '01' => 'Jan',
        '02' => 'Feb',
        '03' => 'Mar',
        '04' => 'Apr',
        '05' => 'May',
        '06' => 'Jun',
        '07' => 'Jul',
        '08' => 'Aug',
        '09' => 'Sep',
        '10' => 'Oct',
        '11' => 'Nov',
        '12' => 'Dec',
    );

    public static $weeks = array(
        2 => 'Monday',
        3 => 'Tuesday',
        4 => 'Wednesday',
        5 => 'Thursday',
        6 => 'Friday',
        7 => 'Saturday',
        1 => 'Sunday',
    );

	public static $quarters = array(
		1 => '1st quarter',
		2 => '2nd quarter',
		3 => '3rd quarter',
		4 => '4th quarter',
	);

	public static $quarterMonths = array(
		1 => [1, 2, 3],
		2 => [4, 5, 6],
		3 => [7, 8, 9],
		4 => [10, 11, 12],
	);

	public static function getMonth($index)
	{
		return isset(self::$months[$index]) ? self::$months[$index] : null;
	}

    public static function getMonthIndex($month) 
    {
        return array_search($month, static::$months) ?: 1;
    }

	public static function getQuarter($index)
	{
		return isset(self::$quarters[$index]) ? self::$quarters[$index] : null;
	}

	public static function getQuarterMonths($quarter)
	{
		if (!isset(self::$quarterMonths[$quarter])) {
			throw new Exception("Quarter is invalid");
		}
		return self::$quarterMonths[$quarter];
	}

    public static function getYearList($yearCap, $yearList, $direction)
    {
        $currentYear = Carbon::now()->year;
        if ($direction == 'increment') {
            for ($i = $currentYear; $i <= $yearCap; $i++) {
                array_push($yearList, $i);
            }
        } else {
            for ($i = $currentYear; $i >= $yearCap; $i--) {
                array_push($yearList, $i);
            }
        }

        $yearList = array_unique(array_sort($yearList, function ($value) {
            return $value;
        }));

        return $yearList;
    }

}