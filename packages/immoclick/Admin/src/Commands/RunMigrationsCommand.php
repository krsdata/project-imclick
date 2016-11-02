<?php

namespace Immoclick\Admin\Commands;

use Illuminate\Console\Command;

class RunMigrationsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'immoclick:run-migrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the immoclick migrations';

    /**
     * Execute the command.
     */
    public function fire()
    {
        $this->call('migrate', [
            '--path' => 'packages/immoclick/Admin/src/migrations',
        ]);
    }
}
 