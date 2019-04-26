<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\File;
use App\Toolbox;
class Bootstrap extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'generate:bootstrap {name}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Bootstrap template';

    protected $gitAddress = "https://github.com/saverty/Bootstrap/archive/master.zip";
    protected $folderName = "Bootstrap-master";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Toolbox::initializePackage($this, $this->gitAddress, $this->folderName);
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
