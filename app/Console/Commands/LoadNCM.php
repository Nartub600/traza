<?php

namespace App\Console\Commands;

use App\Imports\NCMImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class LoadNCM extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:ncm {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa el NCM a partir de un archivo Excel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Excel::import(new NCMImport, $this->argument('file'));
        $this->info('NCM importado con éxito');
    }
}
