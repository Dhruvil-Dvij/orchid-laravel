<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $coinData = Cache::remember('coin_metadata_all', 86400, function () {
                $allCoins = [];
                for ($page = 1; $page <= 4; $page++) {
                    $response = Http::get('https://api.coingecko.com/api/v3/coins/markets', [
                        'vs_currency' => 'usd',
                        'order' => 'market_cap_desc',
                        'per_page' => 250,
                        'page' => $page,
                        'sparkline' => false,
                    ]);

                    if ($response->failed()) {
                        Log::error("CoinGecko API failed on page $page at " . now());
                        break;
                    }

                    $allCoins = array_merge($allCoins, $response->json());
                }

                return $allCoins;
            });

            if (empty($coinData)) {
                Log::warning("CoinGecko returned empty data at " . now());
            }

            $coinMap = collect($coinData)->mapWithKeys(function ($coin) {
                return [
                    strtoupper($coin['symbol']) => [
                        'name' => $coin['name'],
                        'logo' => $coin['image'],
                        'market_cap' => $coin['market_cap'],
                    ],
                ];
            });
        } catch (\Exception $e) {
            Log::error('Exception fetching CoinGecko data: ' . $e->getMessage());
            $coinMap = collect();
        }

        // return view('vendor.platform.home', ['coinMap' => $coinMap]);
        return view('layout.home', ['coinMap' => $coinMap]);
    }

    public function coinDetail($symbol)
    {
        $symbol = strtoupper($symbol);
        // get coin symbol and attach with USDT id it's not stable coin
        if (!in_array($symbol, ['USDT'])) {
            $symbol = $symbol . 'USDT';
        } else {
            $symbol = $symbol . 'USD';
        }
        return view('layout.coin_detail', ['symbol' => $symbol]);
    }

    public function markets()
    {
        try {
            $coinData = Cache::remember('coin_metadata_all', 86400, function () {
                $allCoins = [];
                for ($page = 1; $page <= 4; $page++) {
                    $response = Http::get('https://api.coingecko.com/api/v3/coins/markets', [
                        'vs_currency' => 'usd',
                        'order' => 'market_cap_desc',
                        'per_page' => 250,
                        'page' => $page,
                        'sparkline' => false,
                    ]);

                    if ($response->failed()) {
                        Log::error("CoinGecko API failed on page $page at " . now());
                        break;
                    }

                    $allCoins = array_merge($allCoins, $response->json());
                }

                return $allCoins;
            });

            if (empty($coinData)) {
                Log::warning("CoinGecko returned empty data at " . now());
            }

            $coinMap = collect($coinData)->mapWithKeys(function ($coin) {
                return [
                    strtoupper($coin['symbol']) => [
                        'name' => $coin['name'],
                        'logo' => $coin['image'],
                        'market_cap' => $coin['market_cap'],
                    ],
                ];
            });
        } catch (\Exception $e) {
            Log::error('Exception fetching CoinGecko data: ' . $e->getMessage());
            $coinMap = collect();
        }

        // return view('vendor.platform.home', ['coinMap' => $coinMap]);
        return view('layout.markets', ['coinMap' => $coinMap]);
    }

    // public function getCoins()
    // {
    //     $allCoins = [];

    //     for ($page = 1; $page <= 3; $page++) {
    //         $response = Http::get("https://api.coingecko.com/api/v3/coins/markets", [
    //             'vs_currency' => 'usd',
    //             'order' => 'market_cap_desc',
    //             'per_page' => 250,
    //             'page' => $page,
    //             'sparkline' => false
    //         ]);

    //         if ($response->failed()) {
    //             return response()->json([
    //                 'error' => 'Failed to fetch from CoinGecko',
    //                 'status' => $response->status()
    //             ], 500);
    //         }

    //         $allCoins = array_merge($allCoins, $response->json());
    //     }

    //     return $allCoins;
    // }

    public function getCoins()
    {
        return Cache::remember('all_coins', now()->addMinutes(2), function () {

            $allCoins = [];

            for ($page = 1; $page <= 3; $page++) {

                $response = Http::retry(3, 200)
                    ->get("https://api.coingecko.com/api/v3/coins/markets", [
                        'vs_currency' => 'usd',
                        'order' => 'market_cap_desc',
                        'per_page' => 250,
                        'page' => $page,
                        'sparkline' => false
                    ]);

                if ($response->failed()) {
                    throw new \Exception("CoinGecko failed with status ". $response->status());
                }

                $allCoins = array_merge($allCoins, $response->json());
            }

            return $allCoins;
        });
    }
}
