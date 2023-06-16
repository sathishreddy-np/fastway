<?php

namespace App\Console\Commands;

use App\Models\Bitcoin;
use App\Models\BitToken;
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
            $total_coins = count($coins);
            # This is used to show progress bar while processing.
            $bar = $this->output->createProgressBar($total_coins);
            $bar->start();
            if ($total_coins > 0) {
                collect($coins)->chunk(100)->each(function ($chunkedCoins) use ($bar) {
                    $chunkedCoins->each(function ($coin) {
                        # Check if the coin already exists in the database to avoid duplicates
                        $exists = Bitcoin::select('coin_id')->where('coin_id', $coin['id'])->exists();
                        if (!$exists) {
                            $bitcoin = new Bitcoin();
                            $bitcoin->coin_id = $coin['id'];
                            $bitcoin->symbol = $coin['symbol'];
                            $bitcoin->name = $coin['name'];
                            $bitcoin->save();
                            # Store Platform Names and Tokens
                            if (count($coin["platforms"]) > 0) {
                                foreach ($coin["platforms"] as $name => $token) {
                                    $bit_token = new BitToken();
                                    $bit_token->bitcoin_id = $bitcoin->id;
                                    $bit_token->platform = $name;
                                    $bit_token->token = $token; # Nullable Column
                                    $bit_token->save();
                                }
                            }
                        }
                    });
                    $bar->advance(count($chunkedCoins));
                });
            }
            $bar->finish();
        } catch (\Exception $e) {
            # Log the error message if the command is scheduled
            Log::error("Coingecko Command Error: " . $e->getMessage());
            # Display the error message if the command is run manually
            dump($e->getMessage());
        }
    }
}
