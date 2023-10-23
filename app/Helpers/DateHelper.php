<?php
namespace App\Helpers;

use Carbon\Carbon;
use Carbon\CarbonInterval;

class DateHelper
{
	public static function today($format = null)
	{
		if ($format)
		{
			return Carbon::today()->format($format);
		}
		return Carbon::today()->toDateString();
	}

	public static function todayWithTime()
	{
		return Carbon::today()->toDateTimeString();
	}

	public static function addDaysToToday($days)
	{
		$days = (int)$days;
		return Carbon::today()->addDays($days)->toDateString();
	}

	public static function weekNumberInMonth($date)
	{
		try
		{
			return Carbon::parse($date)->weekNumberInMonth;
		}
		catch (\Throwable $th)
		{
			return 0;
		}
	}

	public static function dayName($date)
	{
		$dias = [
			0 => 'Domingo',
			1 => 'Lunes',
			2 => 'Martes',
			3 => 'Miercoles',
			4 => 'Jueves',
			5 => 'Viernes',
			6 => 'Sabado'
		];

		if ($date instanceof Carbon)
			$fecha = $date;
		else
			$fecha = Carbon::parse($date);


		return [
			'name' => $dias[$fecha->dayOfWeek],
			'day'  => $fecha->dayOfWeek,
		];
	}

	public static function object($date = null)
	{
		if ($date == null)
		{
			return Carbon::today();
		}
		return Carbon::parse($date);
	}

	public static function addMonthsToToday(int $months)
	{
		return Carbon::today()->addMonths($months)->toDateString();
	}

	public static function addMonths(int $months, $date)
	{
		return Carbon::parse($date)->addMonths($months)->toDateString();
	}

	public static function fromFormatTo($from, $value, $to)
	{
		try
		{
			return Carbon::createFromFormat($from, $value)->format($to);
		}
		catch (\Throwable $th)
		{
			return '';
		}
	}

	public static function toFormat($value, $format)
	{
		try
		{
			return Carbon::parse($value)->format($format);
		}
		catch (\Throwable $th)
		{
			return '';
		}
	}

	public static function toMonthYearFormat($value)
	{
		try
		{
			$periodo = self::object($value);

            return "{$periodo->locale('es')->monthName} {$periodo->year}";
		}
		catch (\Throwable $th)
		{
			return '';
		}
	}

	public static function greatToday($fecha)
	{
		try
		{
			$compare = Carbon::parse($fecha);

			return $compare > Carbon::today();
		}
		catch (\Throwable $th)
		{
			return false;
		}
	}

	public static function lessToday($fecha)
	{
		try
		{
			$compare = Carbon::parse($fecha);
			return $compare < Carbon::today();	
		}
		catch (\Throwable $th)
		{
			return false;
		}
	}

	public static function age($dateOfBirth)
	{
		try
		{
			return Carbon::parse($dateOfBirth)->age;
		}
		catch (\Throwable $th)
		{
			return 0;	
		}
	}

	public static function diffInMinutes($from, $to)
	{
		try
		{
			$from = Carbon::parse($from);
			$to   = Carbon::parse($to);

			return $from->diffInMinutes($to);
		}
		catch (\Throwable $th)
		{
			return 0;
		}
	}

	public static function diffInMonths($from, $to = null)
	{
		try
		{
			$from = Carbon::parse($from);
			$to   = ($to)
				? Carbon::parse($to)
				: Carbon::today();
	
			return $from->diffInMonths($to);	
		}
		catch (\Throwable $th)
		{
			return 0;
		}
	}

	public static function timeOfDate($date) : CarbonInterval
	{
		try
		{
			return CarbonInterval::createFromFormat('H:i:s', $date->format('H.i:s'));
		}
		catch (\Throwable $th)
		{
			return '';
		}
		
	}

	public static function addTime($date, $time)
	{
		try
		{
			$timeParts = explode(':', $time);

			if (! $date instanceof Carbon)
				$date = Carbon::parse($date);
	
			$date->addHours((int)$timeParts[0]);
	
			$date->addMinutes((int)$timeParts[1]);
		}
		catch (\Throwable $th)
		{
			//throw $th;
		}
		
		return $date;
	}

 	public static function addMinutes($date, $minutes)
	{
		try
		{
			if (! $date instanceof Carbon)
				$date = Carbon::parse($date);

			$date->addMinutes((int)$minutes);	
		}
		catch (\Throwable $th)
		{
			//throw $th;
		}

		return $date;
	}
}