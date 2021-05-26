<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(PermissionSeed::class);
        $this->call(RoleSeed::class);
//        $thisphp artisan db:seed --class=->call(UserSeed::class);
        $this->call(RoleSeedPivot::class);
//        $this->call(UserSeedPivot::class);

    }
}
