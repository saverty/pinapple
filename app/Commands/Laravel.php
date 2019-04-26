<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Toolbox;
class Laravel extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'generate:laravel {name}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Generate laravel template';

    protected $gitAddress = "https://github.com/laravel/laravel/archive/master.zip";
    protected $folderName = "laravel-master";


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Toolbox::initializePackage($this, $this->gitAddress, $this->folderName);

        $this->task("Copy .env file", function () {
            $path =  getcwd().'/'.$this->argument('name');
            copy($path.'/.env.example', $path.'/.env');
        });

        $this->task("Install dependencies", function () {
            system("php artisan key:generate");
            copy(__DIR__.'/../../sources/composer.phar',getcwd().'/'.$this->argument('name').'/composer.phar');
            chdir(getcwd().'/'.$this->argument('name'));
            system("php composer.phar install");
            system("php artisan serve --port=8008");
            $this->info("Run 'composer install' and 'php artisan serve'");
        });



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
