<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::updateOrCreate(
            ['name' => 'admin']
        );

        $role_owner = Role::updateOrCreate(
            ['name' => 'owner']
        );

        $permissions = [
            'orderan.data',
            'pengeluaran.data',
            'pembelian.data',
            'pembelian.edit',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }

        $permission_pengguna = Permission::updateOrCreate(
            ['name' => 'pengguna.data']
        );

        $role_admin->syncPermissions($permissions);
        $role_owner->givePermissionTo($permission_pengguna);

        $users = User::whereIn('level', [1, 2])->get();

        foreach ($users as $user) {
            if ($user->level == 1) {
                $user->assignRole('admin');
            } else if ($user->level == 2) {
                $user->assignRole('owner');
            }
        }
    }
}
