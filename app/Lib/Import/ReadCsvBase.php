<?php

namespace App\Lib\Import;

trait ReadCsvBase
{
	protected $csvData;

    public function readFile($filename)
    {
        $filePath = storage_path('app/' . $filename);

        $this->csvData = fopen($filePath, 'r');
    }

    public function processData($skipRows)
	{
        if ($skipRows > 0)
        {
            for ($i = 0; $i < $skipRows ; $i++) 
                fgetcsv($this->csvData);
        }

        while ($row = fgetcsv($this->csvData))
        {
            $this->processRecord($row);
        }
    
        fclose($this->csvData);
	}
}