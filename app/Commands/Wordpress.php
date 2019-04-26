<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Toolbox;

class Wordpress extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'generate:wordpress {name}';

    protected $wpAddress = "https://fr.wordpress.org/latest-fr_FR.zip";
    protected $folderName = "wordpress";
    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Generate wordpress template';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Toolbox::initializePackage($this, $this->wpAddress, $this->folderName);
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
