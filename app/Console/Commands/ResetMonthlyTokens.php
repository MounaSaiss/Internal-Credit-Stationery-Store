<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;


class ResetMonthlyTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-monthly-tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::query()->update(['token' => 1000]);
        $this->info('Tokens reset');
    }
}
