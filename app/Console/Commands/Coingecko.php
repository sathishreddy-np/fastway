<?php

namespace App\Console\Commands;

use App\Models\Bitcoin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Coingecko extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:coingecko';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Is Used To Store Data from Coingecko API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->fetchData();
    }

    private function fetchData()
    {
        try {
            $coins = Http::get("https://api.coingecko.com/api/v3/coins/list?include_platform=true")->json();
            $bar = $this->output->createProgressBar(count($coins));
            $bar->start();
            foreach ($coins as $coin) {
                # This will avoid storing duplicates in table.
                $exists = Bitcoin::select('bitcoin_id')->where('bitcoin_id', $coin['id'])->exists();
                if (!$exists) {
                    $bitcoin = new Bitcoin();
                    $bitcoin->bitcoin_id = $coin['id'];
                    $bitcoin->symbol = $coin['symbol'];
                    $bitcoin->name = $coin['name'];
                    foreach ($coin["platforms"] as $name => $token) {
                        $bitcoin->platform = $name; # Nullable Column
                        $bitcoin->token = $token; # Nullable Column
                    }
                    $bitcoin->save();
                }

                $bar->advance();
            }
            $bar->finish();
        } catch (\Exception $e) {
            # This will Log the message if the command scheduled.
            Log::error("Coingecko Command Error : " . $e->getMessage());
            # This will echo the message if you run the command manually.
            dump($e->getMessage());
        }
    }
}
