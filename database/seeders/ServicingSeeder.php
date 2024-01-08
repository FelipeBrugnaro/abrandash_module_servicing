<?php

namespace Modules\Servicing\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\{Menu, Permission};

class ServicingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $servicing = Menu::create([
            'title'  => 'servicing::lang',
            'pai'    => 4,
            'code'   => 'site_servicing',
            'route'  => 'admin.site_servicing.index',
            'icon'   => 'globe',
            'module' => 'Servicing',
            'order'  => 5,
            'status' => true
        ]);

        $permission = Permission::insert([
            ['title' => 'CREATE_SERVICING', 'module' => 'Servicing'],
            ['title' => 'EDIT_SERVICING', 'module' => 'Servicing'],
            ['title' => 'DELETE_SERVICING', 'module' => 'Servicing'],
        ]);
    }
}
