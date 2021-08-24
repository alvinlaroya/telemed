<?php

namespace App\Console\Commands;

use Excel;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ImportExcel extends Command
{
    public $seeder = [
        'doctors' => \App\Imports\DoctorsImport::class,
        'schedule' => \App\Imports\ScheduleImport::class,
        'services' => \App\Imports\ServicesImport::class,
        'centers' => \App\Imports\CentersImport::class,
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:excel {entity} {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import excel template';

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
        $filesystem = new Filesystem;
        $entity = $this->argument('entity');
        $path = $this->option('path') ?: null;
        $seeder = $this->seeder[$entity] ?? null;

        abort_if(!$seeder, 404);

        if (! $filesystem->exists(storage_path($path))) {
            $this->info('File does not exists!');
            return;
        }

        if ($this->confirm('Do you wish to continue? [yes|no]')) {
            $this->output->title('Starting import');
            Excel::import(new $seeder, storage_path($path));
            $this->output->success('Import successful');
        }
    }
}
