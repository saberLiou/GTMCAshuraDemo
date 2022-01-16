<?php

use App\AdminMenu;
use Illuminate\Database\Seeder;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maxOrder = AdminMenu::max('order');
        foreach ([
            'categories' => [
                'icon' => 'fa-sitemap',
            ],
            'posts' => [
                'icon' => 'fa-newspaper-o'
            ],
        ] as $uri => $data) {
            AdminMenu::firstOrCreate([
                'uri' => $uri,
            ], array_merge($data, [
                'order' => ++$maxOrder,
                'title' => ucfirst($uri),
            ]));
        }
    }
}
