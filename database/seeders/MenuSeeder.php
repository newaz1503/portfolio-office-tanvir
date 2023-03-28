<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = DB::table('menus')->count();
        if ($count == 0) {
            DB::table('menus')->insert([
                [
                    'parent_id'     => null,
                    'menu_name'     => "Admin",
                    'icon'          => "<i class='fa fa-user'></i>",
                    'route_name'    => "admin.index",
                    'params'        => null,
                    'sorting'       => 49,
                    'show_dasboard' => 0
                ],
                // System Setting ID = 2
                [
                    'parent_id'     => null,
                    'menu_name'     => "System Setting",
                    'icon'          => "<i class='fa fa-cogs'></i>",
                    'route_name'    => null,
                    'params'        => null,
                    'sorting'       => 50,
                    'show_dasboard' => 0
                ],
                // WEBSITE ID = 3
                [
                    'parent_id'     => null,
                    'menu_name'     => "Website",
                    'icon'          => "<i class='fa fa-windows'></i>",
                    'route_name'    => null,
                    'params'        => null,
                    'sorting'       => 2,
                    'show_dasboard' => 0,
                ],
                // CONTENT ID = 4
                [
                    'parent_id'     => 3,
                    'menu_name'     => "Content",
                    'icon'          => "<i class='fa fa-folder text-aqua'></i>",
                    'route_name'    => "content.content",
                    'params'        => null,
                    'sorting'       => 1,
                    'show_dasboard' => 0,
                ],
                // Gallery / Images = 5
                [
                    'parent_id'     => 3,
                    'menu_name'     => "Gallery / Images",
                    'icon'          => "<i class='fa fa-image text-aqua'></i>",
                    'route_name'    => "gallery.galleryImages",
                    'params'        => null,
                    'sorting'       => 2,
                    'show_dasboard' => 0,
                ],
                // Master Setup ID = 6
                [
                    'parent_id'     => null,
                    'menu_name'     => "Master Setup",
                    'icon'          => "<i class='fa fa-cubes'></i>",
                    'route_name'    => null,
                    'params'        => null,
                    'sorting'       => 2,
                    'show_dasboard' => 0
                ],
                [
                    'parent_id'     => 3,
                    'menu_name'     => "News",
                    'icon'          => "<i class='fa fa-newspaper-o text-aqua'></i>",
                    'route_name'    => "news.index",
                    'params'        => null,
                    'sorting'       => 3,
                    'show_dasboard' => 0,
                ],
                [
                    'parent_id'     => 3,
                    'menu_name'     => "Menu List",
                    'icon'          => "<i class='fa fa-list text-aqua'></i>",
                    'route_name'    => "frontMenu.index",
                    'params'        => null,
                    'sorting'       => 4,
                    'show_dasboard' => 0,
                ],
                [
                    'parent_id'     => 2,
                    'menu_name'     => "Role",
                    'icon'          => "<i class='fa fa-list text-aqua'></i>",
                    'route_name'    => "role.index",
                    'params'        => null,
                    'sorting'       => 1,
                    'show_dasboard' => 1
                ],
                [
                    'parent_id'     => 2,
                    'menu_name'     => "Menu List",
                    'icon'          => "<i class='fa fa-list text-aqua'></i>",
                    'route_name'    => "menu.index",
                    'params'        => null,
                    'sorting'       => 2,
                    'show_dasboard' => 0
                ],
                [
                    'parent_id'     => 2,
                    'menu_name'     => "Site Settings",
                    'icon'          => "<i class='fa fa-cog text-aqua'></i>",
                    'route_name'    => "siteSetting.index",
                    'params'        => null,
                    'sorting'       => 4,
                    'show_dasboard' => 1,
                ],
                [
                    'parent_id'     => 2,
                    'menu_name'     => "Module Create",
                    'icon'          => "<i class='fa fa-folder text-aqua'></i>",
                    'route_name'    => "module.create",
                    'params'        => null,
                    'sorting'       => 5,
                    'show_dasboard' => 0,
                ],
                [
                    'parent_id'     => 4,
                    'menu_name'     => "About Us",
                    'icon'          => "<i class='fa fa-tasks'></i>",
                    'route_name'    => "content.create",
                    'params'        => "about-us",
                    'sorting'       => 1,
                    'show_dasboard' => 0,
                ],
                [
                    'parent_id'     => 4,
                    'menu_name'     => "Mission",
                    'icon'          => "<i class='fa fa-tasks'></i>",
                    'route_name'    => "content.create",
                    'params'        => "mission",
                    'sorting'       => 2,
                    'show_dasboard' => 0,
                ],
                [
                    'parent_id'     => 4,
                    'menu_name'     => "Vision",
                    'icon'          => "<i class='fa fa-tasks'></i>",
                    'route_name'    => "content.create",
                    'params'        => "vision",
                    'sorting'       => 2,
                    'show_dasboard' => 0,
                ],
                [
                    'parent_id'     => 5,
                    'menu_name'     => "Sliders",
                    'icon'          => "<i class='fa fa-image'></i>",
                    'route_name'    => "slider.index",
                    'params'        => null,
                    'sorting'       => 1,
                    'show_dasboard' => 1
                ],
                [
                    'parent_id'     => 5,
                    'menu_name'     => "Album",
                    'icon'          => "<i class='fa fa-tags'></i>",
                    'route_name'    => "album.index",
                    'params'        => null,
                    'sorting'       => 2,
                    'show_dasboard' => 1,
                ],
                [
                    'parent_id'     => 5,
                    'menu_name'     => "Images",
                    'icon'          => "<i class='fa fa-file-image-o'></i>",
                    'route_name'    => "photo.index",
                    'params'        => null,
                    'sorting'       => 3,
                    'show_dasboard' => 0,
                ],
                [
                    'parent_id'     => 5,
                    'menu_name'     => "Videos",
                    'icon'          => "<i class='fa fa-file-video-o'></i>",
                    'route_name'    => "video.index",
                    'params'        => null,
                    'sorting'       => 4,
                    'show_dasboard' => 0,
                ],
                [
                    'parent_id'     => null,
                    'menu_name'     => "Users",
                    'icon'          => "<i class='fa fa-users'></i>",
                    'route_name'    => "user.index",
                    'params'        => null,
                    'sorting'       => 48,
                    'show_dasboard' => 0
                ],
                [
                    'parent_id'     => null,
                    'menu_name'     => "Payment History",
                    'icon'          => "<i class='fa fa-money'></i>",
                    'route_name'    => "invoice.index",
                    'params'        => null,
                    'sorting'       => 15,
                    'show_dasboard' => 0
                ],
                [
                    'parent_id'     => null,
                    'menu_name'     => "Activity Log",
                    'icon'          => "<i class='fa fa-history'></i>",
                    'route_name'    => "activityLog.index",
                    'params'        => null,
                    'sorting'       => 200,
                    'show_dasboard' => 0
                ],
                // MASTER SETUP SUB MENU
                [
                    'parent_id'     => 6,
                    'menu_name'     => "Account Head",
                    'icon'          => "<i class='fa fa-tags'></i>",
                    'route_name'    => "accountHead.index",
                    'params'        => null,
                    'sorting'       => 1,
                    'show_dasboard' => 0
                ],
            ]);
        }
    }
}
