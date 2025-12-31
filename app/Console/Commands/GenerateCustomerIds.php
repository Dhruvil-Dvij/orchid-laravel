<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateCustomerIds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:generate-customer-ids';

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
        $this->info('Generating customer IDs...');

        User::chunk(100, function ($users) {
            foreach ($users as $user) {

                do {
                    $numbersCount = rand(2, 3);
                    $lettersCount = 6 - $numbersCount;

                    if ($lettersCount > 3) {
                        $lettersCount = 3;
                        $numbersCount = 3;
                    }

                    $numbers = collect(range(0, 9))->random($numbersCount)->implode('');
                    $letters = collect(range('A', 'Z'))->random($lettersCount)->implode('');

                    $customerId = collect(str_split($numbers . $letters))
                        ->shuffle()
                        ->implode('');
                } while (User::where('customer_id', $customerId)->exists());

                $user->update([
                    'customer_id' => $customerId
                ]);
            }
        });

        $this->info('Done ✅');
    }
}
