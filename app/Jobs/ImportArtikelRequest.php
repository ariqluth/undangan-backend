<?php

namespace App\Jobs;

use App\Imports\ArtikelImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KbliPerusahaanImport;

class ImportArtikelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pathToFile;

    public function __construct($pathToFile)
    {
        $this->pathToFile = $pathToFile;
    }

    public function handle()
    {
        // Instantiate a new instance of the KbliPerusahaanImport class
        $import = new ArtikelImport;

        // Use the Excel facade to import data from the Excel file
        Excel::import($import, $this->pathToFile);
    }
}
