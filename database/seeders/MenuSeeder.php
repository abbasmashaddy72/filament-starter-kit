<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Header Menu
        $headerMenu = new Menu([
            'location' => 'header',
            'items' => [
                'en' => [
                    [
                        'title' => 'Home',
                        'url' => '/home',
                        'blank' => false,
                    ],
                    [
                        'title' => 'Contact Us',
                        'url' => '/contact',
                        'blank' => false,
                    ],
                ],
                'fr' => [
                    [
                        'title' => 'Accueil',
                        'url' => '/home',
                        'blank' => false,
                    ],
                    [
                        'title' => 'Contactez-nous',
                        'url' => '/contact',
                        'blank' => false,
                    ],
                ],
                'ar' => [
                    [
                        'title' => 'الصفحة الرئيسية',
                        'url' => '/home',
                        'blank' => false,
                    ],
                    [
                        'title' => 'اتصل بنا',
                        'url' => '/contact',
                        'blank' => false,
                    ],
                ],
            ],
            'activated' => true,
        ]);

        $headerMenu->save();

        // Footer1 Menu
        $footer1Menu = new Menu([
            'location' => 'footer1',
            'items' => [
                'en' => [
                    [
                        'title' => 'Contact',
                        'url' => '/contact',
                        'blank' => false,
                    ]
                ],
                'fr' => [
                    [
                        'title' => 'Contact',
                        'url' => '/contact',
                        'blank' => false,
                    ]
                ],
                'ar' => [
                    [
                        'title' => 'اتصل بنا',
                        'url' => '/contact',
                        'blank' => false,
                    ]
                ],
            ],
            'activated' => true,
        ]);

        $footer1Menu->save();

        // Footer2 Menu
        $footer2Menu = new Menu([
            'location' => 'footer2',
            'items' => [
                'en' => [
                    [
                        'title' => 'Privacy Policy',
                        'url' => '/privacy-policy',
                        'blank' => false,
                    ]
                ],
                'fr' => [
                    [
                        'title' => 'Politique de confidentialité',
                        'url' => '/privacy-policy',
                        'blank' => false,
                    ]
                ],
                'ar' => [
                    [
                        'title' => 'سياسة الخصوصية',
                        'url' => '/privacy-policy',
                        'blank' => false,
                    ]
                ],
            ],
            'activated' => true,
        ]);

        $footer2Menu->save();
    }
}
