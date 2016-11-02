<?php

namespace Immoclick\Admin\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'immoclick:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the immoclick migrations';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->info('Checking Database Schema');

        $this->call('immoclick:check-schema');

        $this->info('Running migrations');

        $this->call('immoclick:run-migrations');

        $this->info('immoclick has been successfully installed');
    }
}
