<?php
namespace App\Helpers;

class ArrayHelper
{

	public static function cleanForSave($data)
	{
		$records = [];

		if (is_array($data))
		{
        	foreach ($data as $key => $value)
        	{
            	$records[] = $value;
        	}
        }
        return $records;
	}
}