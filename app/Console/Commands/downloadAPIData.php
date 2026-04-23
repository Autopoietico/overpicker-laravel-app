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

        $url_heroes = "https://api.overpicker.com/hero-info";
        $url_tiers = "https://api.overpicker.com/hero-tiers";
        $url_img = "https://api.overpicker.com/hero-img";
        $url_version = "https://api.overpicker.com/version";
        $url_synergies = "https://api.overpicker.com/hero-synergies";
        $url_counters = "https://api.overpicker.com/hero-counters";
        $url_maps = "https://api.overpicker.com/hero-maps";
        $url_map_info = "https://api.overpicker.com/map-info";
        $url_map_type = "https://api.overpicker.com/map-type";

        $heroes_data = Http::get($url_heroes)->body();
        $tiers_data = Http::get($url_tiers)->body();
        $img_data = Http::get($url_img)->body();
        $version_data = Http::get($url_version)->body();
        $synergies_data = Http::get($url_synergies)->body();
        $counters_data = Http::get($url_counters)->body();
        $maps_data = Http::get($url_maps)->body();
        $map_info_data = Http::get($url_map_info)->body();
        $map_type_data = Http::get($url_map_type)->body();

        if ($heroes_data) {
            $hero_file = storage_path('/api/hero-data/hero-info.json');
            file_put_contents($hero_file, $heroes_data);
            $this->info('Hero Info downloaded succesfully in: ' . $hero_file);
        } else {
            $this->error('Error getting the Hero Info data');
        }

        if ($tiers_data) {
            $tiers_file = storage_path('/api/hero-data/hero-tiers.json');
            file_put_contents($tiers_file, $tiers_data);
            $this->info('Tiers Info downloaded succesfully in: ' . $tiers_file);
        } else {
            $this->error('Error getting the Tiers Info data');
        }

        if ($img_data) {
            $img_file = storage_path('/api/hero-data/hero-img.json');
            file_put_contents($img_file, $img_data);
            $this->info('HeroIMG Info downloaded succesfully in: ' . $img_file);
        } else {
            $this->error('Error getting the HeroIMG Info data');
        }

        if ($version_data) {
            $version_file = storage_path('/api/version.json');
            file_put_contents($version_file, $version_data);
            $this->info('Version Info downloaded succesfully in: ' . $version_file);
        } else {
            $this->error('Error getting the Version Info data');
        }

        if ($synergies_data) {
            $synergies_file = storage_path('/api/hero-data/hero-synergies.json');
            file_put_contents($synergies_file, $synergies_data);
            $this->info('Hero Synergies downloaded succesfully in: ' . $synergies_file);
        } else {
            $this->error('Error getting the Hero Synergies data');
        }

        if ($counters_data) {
            $counters_file = storage_path('/api/hero-data/hero-counters.json');
            file_put_contents($counters_file, $counters_data);
            $this->info('Hero Counters downloaded succesfully in: ' . $counters_file);
        } else {
            $this->error('Error getting the Hero Counters data');
        }

        if ($maps_data) {
            $maps_file = storage_path('/api/hero-data/hero-maps.json');
            file_put_contents($maps_file, $maps_data);
            $this->info('Hero Maps downloaded succesfully in: ' . $maps_file);
        } else {
            $this->error('Error getting the Hero Maps data');
        }

        if ($map_info_data) {
            $map_info_file = storage_path('/api/map-data/map-info.json');
            if (!is_dir(dirname($map_info_file))) {
                mkdir(dirname($map_info_file), 0755, true);
            }
            file_put_contents($map_info_file, $map_info_data);
            $this->info('Map Info downloaded succesfully in: ' . $map_info_file);
        } else {
            $this->error('Error getting the Map Info data');
        }

        if ($map_type_data) {
            $map_type_file = storage_path('/api/map-data/map-type.json');
            file_put_contents($map_type_file, $map_type_data);
            $this->info('Map Type downloaded succesfully in: ' . $map_type_file);
        } else {
            $this->error('Error getting the Map Type data');
        }
    }
}
