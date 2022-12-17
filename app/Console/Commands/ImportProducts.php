<?php

namespace App\Console\Commands;

use App\Jobs\ProductImport;
use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\Dispatcher;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Wrights products';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return app(Dispatcher::class)->dispatch(new ProductImport());
    }
}
