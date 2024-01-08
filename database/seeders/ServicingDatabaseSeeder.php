<?php

namespace Modules\Servicing\database\seeders;

use Illuminate\Database\Seeder;

class ServicingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            ServicingSeeder::class
        ]);
    }
}
