<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class downloadAPIData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:download-api-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download the api data in the resources folder';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $url_heroes = "https://api.overpicker.win/hero-info";
        $url_tiers = "https://api.overpicker.win/hero-tiers";
        $url_img = "https://api.overpicker.win/hero-img";
        $url_version = "https://api.overpicker.win/version";

        $heroes_data = Http::get($url_heroes)->body();
        $tiers_data = Http::get($url_tiers)->body();
        $img_data = Http::get($url_img)->body();
        $version_data = Http::get($url_version)->body();

        if ($heroes_data) {
            $hero_file = storage_path('/api/hero-data/hero-info.json');
            file_put_contents($hero_file, $heroes_data);
            $this->info('Hero Info donwloaded succesfully in: ' . $hero_file);
        } else {
            $this->error('Error getting the Hero Info data');
        }

        if ($tiers_data) {
            $tiers_file = storage_path('/api/hero-data/hero-tiers.json');
            file_put_contents($tiers_file, $tiers_data);
            $this->info('Tiers Info donwloaded succesfully in: ' . $tiers_file);
        } else {
            $this->error('Error getting the Tiers Info data');
        }

        if ($img_data) {
            $img_file = storage_path('/api/hero-data/hero-img.json');
            file_put_contents($img_file, $img_data);
            $this->info('HeroIMG Info donwloaded succesfully in: ' . $img_file);
        } else {
            $this->error('Error getting the HeroIMG Info data');
        }

        if ($version_data) {
            $version_file = storage_path('/api/version.json');
            file_put_contents($version_file, $version_data);
            $this->info('Version Info donwloaded succesfully in: ' . $img_file);
        } else {
            $this->error('Error getting the Version Info data');
        }
    }
}
