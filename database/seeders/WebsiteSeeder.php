<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = DB::table('front_menus')->count();
        if ($count == 0) {
            DB::table('front_menus')->insert([
                // About US menu id = 1
                [
                    'parent_id'         => null,
                    'content_id'        => null,
                    'menu_look_type'    => "normal",
                    'position'          => "header",
                    'type'              => "content",
                    'url'               => null,
                    'title'             => "About us",
                    'slug'              => 'about-us',
                    'params'            => null,
                    'sorting'           => 1
                ],
                // Media Center menu id = 2
                [
                    'parent_id'         => null,
                    'content_id'        => null,
                    'menu_look_type'    => "normal",
                    'position'          => "header",
                    'type'              => "content",
                    'url'               => null,
                    'title'             => "Media Center",
                    'slug'              => "media-center",
                    'params'            => null,
                    'sorting'           => 1
                ],
                // Services menu id = 3
                [
                    'parent_id'         => null,
                    'content_id'        => null,
                    'menu_look_type'    => "normal",
                    'position'          => "header",
                    'type'              => "content",
                    'url'               => null,
                    'title'             => "Services",
                    'slug'              => "services",
                    'params'            => null,
                    'sorting'           => 1
                ],
                // Products menu id = 4
                [
                    'parent_id'         => null,
                    'content_id'        => null,
                    'menu_look_type'    => "normal",
                    'position'          => "header",
                    'type'              => "content",
                    'url'               => null,
                    'title'             => "Products",
                    'slug'              => 'products',
                    'params'            => null,
                    'sorting'           => 1
                ],
                // Contact US menu id = 5
                [
                    'parent_id'         => null,
                    'content_id'        => null,
                    'menu_look_type'    => "normal",
                    'position'          => "header",
                    'type'              => "external_link",
                    'url'               => "contact-us",
                    'title'             => "Contact us",
                    'slug'              => "contact-us",
                    'params'            => null,
                    'sorting'           => 2
                ],

                // About us child menu id = 1
                [
                    'parent_id'         => 1,
                    'content_id'        => 1,
                    'menu_look_type'    => "normal",
                    'position'          => "header",
                    'type'              => "content",
                    'url'               => "about-us",
                    'title'             => "About Company",
                    'slug'              => "about-company",
                    'params'            => null,
                    'sorting'           => 1
                ],
                [
                    'parent_id'         => 1,
                    'content_id'        => 2,
                    'menu_look_type'    => "normal",
                    'position'          => "header",
                    'type'              => "content",
                    'url'               => "mission",
                    'title'             => "Mission",
                    'slug'              => "mission",
                    'params'            => null,
                    'sorting'           => 2
                ],
                [
                    'parent_id'         => 1,
                    'content_id'        => 3,
                    'menu_look_type'    => "normal",
                    'position'          => "header",
                    'type'              => "content",
                    'url'               => "vision",
                    'title'             => "Vision",
                    'slug'              => "vision",
                    'params'            => null,
                    'sorting'           => 3
                ],

                // Media Center child menu id = 2
                [
                    'parent_id'         => 2,
                    'content_id'        => null,
                    'menu_look_type'    => "normal",
                    'position'          => "header",
                    'type'              => "external_link",
                    'url'               => "front.news",
                    'title'             => "News",
                    'slug'              => "news",
                    'params'            => null,
                    'sorting'           => 1
                ],
                [
                    'parent_id'         => 2,
                    'content_id'        => null,
                    'menu_look_type'    => "normal",
                    'position'          => "header",
                    'type'              => "external_link",
                    'url'               => "front.photoGallery",
                    'title'             => "Photo Gallery",
                    'slug'              => "photo-gallery",
                    'params'            => null,
                    'sorting'           => 2
                ],
                [
                    'parent_id'         => 2,
                    'content_id'        => null,
                    'menu_look_type'    => "normal",
                    'position'          => "header",
                    'type'              => "external_link",
                    'url'               => "front.videoGallery",
                    'title'             => "Video Gallery",
                    'slug'              => "video-gallery",
                    'params'            => null,
                    'sorting'           => 3
                ],

                // Services child menu id = 3
                [
                    'parent_id'         => 3,
                    'content_id'        => null,
                    'menu_look_type'    => "normal",
                    'position'          => "header",
                    'type'              => "external_link",
                    'url'               => "front.videoGallery",
                    'title'             => "Software & ERP Solutions",
                    'slug'              => "software-erp-solutions",
                    'params'            => null,
                    'sorting'           => 1
                ],

                // Products child menu id = 4
                [
                    'parent_id'         => 4,
                    'content_id'        => null,
                    'menu_look_type'    => "normal",
                    'position'          => "header",
                    'type'              => "external_link",
                    'url'               => "front.videoGallery",
                    'title'             => "Point of Sale",
                    'slug'              => "point-of-sale",
                    'params'            => null,
                    'sorting'           => 1
                ],
            ]);
        }
    }
}
