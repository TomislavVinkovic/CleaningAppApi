<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach(Role::$roles as $role){
            try {
                Role::updateOrCreate(['name' => $role], ['name' => $role]);
            } catch (\Exception $exception) {
                throw $exception;
            }
        }
    }
}
