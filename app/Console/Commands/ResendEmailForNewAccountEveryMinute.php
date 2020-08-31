<?php
/**
 * This method will be used to 
 * Resend Email confirming account  
 * opening for a customer
 *
 * PHP version 5
 *
 */

namespace App\Console\Commands;

use App\Jobs\AccountCreationSendEmailJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResendEmailForNewAccountEveryMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resend_email:every_minute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if there are still Jobs in the Job table still waiting for execution and dispatch them';

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
        $failedJobs = DB::table('jobs')->get();
        if ($failedJobs) {
           foreach($failedJobs as $failed) {
               dispatch(new AccountCreationSendEmailJob($failed));
           }
        }
    }
}
