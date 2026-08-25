<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class HeroController extends BaseController
{
    public function heroes()
    {
        $TOP_RANK_INDEX = 0;

        $heroes_obj = json_decode(file_get_contents(storage_path('/api/hero-data/hero-info.json')), true);
        $tiers_data = json_decode(file_get_contents(storage_path('/api/hero-data/hero-tiers.json')), true);
        $img_obj    = json_decode(file_get_contents(storage_path('/api/hero-data/hero-img.json')), true);

        $topRankName = $tiers_data[$TOP_RANK_INDEX]['name'];
        $tiers_obj   = $tiers_data[$TOP_RANK_INDEX]['hero-tiers'];

        $hero_images = [];
        foreach ($img_obj as $img) {
            $hero_images[$img['name']] = $img['profile-img'];
        }

        $tierMap = [
            45 => ['letter' => 'S', 'text' => 'text-emerald-400', 'border' => 'border-emerald-500/70'],
            35 => ['letter' => 'A', 'text' => 'text-lime-400',    'border' => 'border-lime-500/70'],
            25 => ['letter' => 'B', 'text' => 'text-sky-400',     'border' => 'border-sky-500/70'],
            15 => ['letter' => 'C', 'text' => 'text-amber-400',   'border' => 'border-amber-500/70'],
             5 => ['letter' => 'D', 'text' => 'text-rose-400',    'border' => 'border-rose-500/70'],
        ];

        $roles = [
            'Tank'    => ['icon' => 'images/assets/tank.webp',    'ring' => 'group-hover:ring-sky-500/50'],
            'Damage'  => ['icon' => 'images/assets/damage.webp',  'ring' => 'group-hover:ring-red-500/50'],
            'Support' => ['icon' => 'images/assets/support.webp', 'ring' => 'group-hover:ring-emerald-500/50'],
        ];

        $roleGroups = [];
        foreach (array_keys($roles) as $roleName) {
            $heroes = [];
            foreach ($heroes_obj as $hero) {
                if ($hero['general_rol'] !== $roleName) continue;
                $value = $tiers_obj[$hero['name']] ?? 5;
                $heroes[] = [
                    'name'  => $hero['name'],
                    'img'   => $hero_images[$hero['name']] ?? null,
                    'value' => $value,
                    'tier'  => $tierMap[$value] ?? $tierMap[5],
                    'slug'  => Str::slug($hero['name']),
                ];
            }
            usort($heroes, fn($a, $b) => $b['value'] <=> $a['value']);
            $roleGroups[$roleName] = array_merge($roles[$roleName], ['heroes' => $heroes]);
        }

        $seo = [
            'title'          => 'Overwatch Heroes – All Heroes by Role',
            'keywords'       => 'overwatch heroes list, overwatch all heroes, overwatch hero guide, overwatch competitive heroes, overwatch hero rankings, overwatch tanks, overwatch damage heroes, overwatch support heroes',
            'description'    => 'Browse all Overwatch heroes by role. Click any hero to see their full guide including counters, synergies, best maps, and tier by rank.',
            'og_title'       => 'Overwatch Heroes – All Heroes by Role',
            'og_description' => 'Browse all Overwatch heroes by role. Click any hero for counters, synergies, best maps, and tier by rank.',
            'og_url'         => 'https://overpicker.com/heroes',
        ];

        return view('heroes', [
            'title'       => ' - Heroes',
            'dates'       => $this->DATES,
            'roleGroups'  => $roleGroups,
            'topRankName' => $topRankName,
            'seo'         => $seo,
        ]);
    }

    public function heroDetail(string $hero)
    {
        $heroes_obj = json_decode(file_get_contents(storage_path('/api/hero-data/hero-info.json')), true);
        $tiers_data = json_decode(file_get_contents(storage_path('/api/hero-data/hero-tiers.json')), true);
        $img_obj    = json_decode(file_get_contents(storage_path('/api/hero-data/hero-img.json')), true);

        // Find hero by slug
        $heroInfo = null;
        foreach ($heroes_obj as $h) {
            if (Str::slug($h['name']) === $hero) {
                $heroInfo = $h;
                break;
            }
        }
        if (!$heroInfo) {
            abort(404);
        }

        $heroName = $heroInfo['name'];
        $heroSlug = Str::slug($heroName);

        // Images
        $heroImg       = null;
        $allHeroImages = [];
        foreach ($img_obj as $img) {
            $allHeroImages[$img['name']] = $img;
            if ($img['name'] === $heroName) {
                $heroImg = $img;
            }
        }

        // Tier per rank (competitive ranks)
        $rankIcons = [
            'GrandMaster' => 'images/ranks/grand-master-icon.svg',
            'Master'      => 'images/ranks/master-icon.svg',
            'Diamond'     => 'images/ranks/diamond-icon.svg',
            'Emerald'     => 'images/ranks/emerald-icon.svg',
            'Platinum'    => 'images/ranks/platinum-icon.svg',
            'Gold'        => 'images/ranks/gold-icon.svg',
            'Silver'      => 'images/ranks/silver-icon.svg',
            'Bronze'      => 'images/ranks/bronze-icon.svg',
        ];
        $tierMap = [
            45 => ['letter' => 'S', 'color' => 'text-emerald-400'],
            35 => ['letter' => 'A', 'color' => 'text-lime-400'],
            25 => ['letter' => 'B', 'color' => 'text-sky-400'],
            15 => ['letter' => 'C', 'color' => 'text-amber-400'],
             5 => ['letter' => 'D', 'color' => 'text-rose-400'],
        ];

        $tiersByRank = [];
        foreach ($tiers_data as $rankData) {
            $rankName = $rankData['name'];
            if (!isset($rankIcons[$rankName])) continue;
            $val = $rankData['hero-tiers'][$heroName] ?? 5;
            $tiersByRank[] = [
                'rankName'   => $rankName,
                'rankIcon'   => $rankIcons[$rankName],
                'tierLetter' => $tierMap[$val]['letter'],
                'tierColor'  => $tierMap[$val]['color'],
            ];
        }

        // Synergies
        $topSynergiesList = [];
        foreach ($heroInfo['best_synergies'] ?? [] as $entry) {
            $name = $entry['name'];
            $topSynergiesList[] = ['name' => $name, 'img' => $allHeroImages[$name]['profile-img'] ?? null, 'score' => $entry['score'], 'slug' => Str::slug($name)];
        }
        $antiSynergiesList = [];
        foreach ($heroInfo['worst_synergies'] ?? [] as $entry) {
            $name = $entry['name'];
            $antiSynergiesList[] = ['name' => $name, 'img' => $allHeroImages[$name]['profile-img'] ?? null, 'score' => $entry['score'], 'slug' => Str::slug($name)];
        }

        // Counters
        $heroCountersList = [];
        foreach ($heroInfo['counters'] ?? [] as $entry) {
            $name = $entry['name'];
            $heroCountersList[] = ['name' => $name, 'img' => $allHeroImages[$name]['profile-img'] ?? null, 'score' => $entry['score'], 'slug' => Str::slug($name)];
        }
        $counteredByList = [];
        foreach ($heroInfo['countered_by'] ?? [] as $entry) {
            $name = $entry['name'];
            $counteredByList[] = ['name' => $name, 'img' => $allHeroImages[$name]['profile-img'] ?? null, 'score' => $entry['score'], 'slug' => Str::slug($name)];
        }

        // Maps
        $bestMaps  = $heroInfo['best_maps']  ?? [];
        $worstMaps = $heroInfo['worst_maps'] ?? [];

        $roleLabel = $heroInfo['general_rol'];
        $seo = [
            'title'          => "{$heroName} Overwatch Guide – Counters, Synergies, Tiers & Maps",
            'keywords'       => "{$heroName} counters overwatch, {$heroName} synergies overwatch, {$heroName} tier list overwatch, best heroes with {$heroName}, {$heroName} best maps overwatch, how to counter {$heroName}, {$heroName} overwatch guide, {$heroName} overwatch competitive, {$heroName} {$roleLabel} overwatch",
            'description'    => "Complete {$heroName} guide for Overwatch: best counters, synergies, tier by rank, and best maps. Find out how to play {$heroName} in competitive.",
            'og_title'       => "{$heroName} Overwatch Guide – Counters, Synergies & Tier List",
            'og_description' => "Find the best counters, synergies, and maps for {$heroName} in Overwatch competitive play.",
            'og_url'         => "https://overpicker.com/heroes/{$heroSlug}",
            'og_image'       => $heroImg ? ('https://overpicker.com/' . $heroImg['art-img']) : null,
        ];

        return view('hero', [
            'title'         => " - {$heroName}",
            'dates'         => $this->DATES,
            'heroInfo'      => $heroInfo,
            'heroImg'       => $heroImg,
            'heroSlug'      => $heroSlug,
            'tiersByRank'   => $tiersByRank,
            'topSynergies'  => $topSynergiesList,
            'antiSynergies' => $antiSynergiesList,
            'heroCounters'  => $heroCountersList,
            'counteredBy'   => $counteredByList,
            'bestMaps'      => $bestMaps,
            'worstMaps'     => $worstMaps,
            'seo'           => $seo,
        ]);
    }
}
