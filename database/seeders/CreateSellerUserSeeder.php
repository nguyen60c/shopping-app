<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateSellerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            "name" => "Seller_test",
            'email' => 'seller_test@gmail.com',
            'username' => 'seller_test',
            'password' => 'seller123'
        ]);
        $role = Role::create(['name' => 'seller']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
//        $user->assignRole("seller");
    }
}
