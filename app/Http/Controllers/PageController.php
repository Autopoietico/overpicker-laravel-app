<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class PageController extends BaseController
{
    public function about()
    {
        $seo = [
            'title'          => 'OverPicker - About',
            'keywords'       => 'overpicker, about, about us, overwatch tools, hero picker, composition builder, about the project',
            'description'    => 'Learn more about OverPicker, the ultimate Overwatch composition builder tool. Find counters, synergies, and build better teams.',
            'og_title'       => 'OverPicker - About Us',
            'og_description' => 'Learn more about OverPicker, the ultimate Overwatch composition builder tool. Find counters, synergies, and build better teams.',
            'og_url'         => 'https://overpicker.com/about',
        ];

        return view('about', ['title' => ' - About', 'dates' => $this->DATES, 'seo' => $seo]);
    }

    public function privacy()
    {
        $seo = [
            'title'          => 'OverPicker - Privacy Policy',
            'keywords'       => 'overpicker, privacy, privacy policy, data policy, cookies, tracking',
            'description'    => 'Read the privacy policy for OverPicker. Learn how we handle your data and protect your privacy.',
            'og_title'       => 'OverPicker - Privacy Policy',
            'og_description' => 'Read the privacy policy for OverPicker. Learn how we handle your data and protect your privacy.',
            'og_url'         => 'https://overpicker.com/privacy',
        ];

        return view('privacy', ['title' => ' - Privacy Policy', 'dates' => $this->DATES, 'seo' => $seo]);
    }

    public function trackers()
    {
        $seo = [
            'title'          => 'OverPicker - Trackers',
            'keywords'       => 'overpicker, trackers, overwatch trackers, player trackers, stats, overwatch stats',
            'description'    => 'Track your Overwatch progress with recommended trackers and stats tools. Find the best resources to improve your gameplay.',
            'og_title'       => 'OverPicker - Trackers',
            'og_description' => 'Track your Overwatch progress with recommended trackers and stats tools. Find the best resources to improve your gameplay.',
            'og_url'         => 'https://overpicker.com/trackers',
        ];

        return view('trackers', ['title' => ' - Trackers', 'dates' => $this->DATES, 'seo' => $seo]);
    }

    public function sitemap()
    {
        $urls = [
            ['loc' => 'https://overpicker.com/',          'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => 'https://overpicker.com/tiers',     'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => 'https://overpicker.com/heroes',    'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => 'https://overpicker.com/counters',  'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => 'https://overpicker.com/synergies', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => 'https://overpicker.com/maps',      'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => 'https://overpicker.com/about',     'priority' => '0.5', 'changefreq' => 'monthly'],
            ['loc' => 'https://overpicker.com/privacy',   'priority' => '0.3', 'changefreq' => 'yearly'],
            ['loc' => 'https://overpicker.com/trackers',  'priority' => '0.3', 'changefreq' => 'monthly'],
        ];

        $heroes_obj = json_decode(file_get_contents(storage_path('/api/hero-data/hero-info.json')), true);
        foreach ($heroes_obj as $hero) {
            $urls[] = [
                'loc'        => 'https://overpicker.com/heroes/' . Str::slug($hero['name']),
                'priority'   => '0.8',
                'changefreq' => 'weekly',
            ];
        }

        return response()->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
