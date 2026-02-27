<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //creation des permissions
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'edit permission']);
        Permission::create(['name' => 'delete permission']);
        Permission::create(['name' => 'create catechesis']);
        Permission::create(['name' => 'edit catechesis']);
        Permission::create(['name' => 'delete catechesis']);
        Permission::create(['name' => 'view catechesis']);
        Permission::create(['name' => 'buy product']);

        $admin = Role::findByName('admin');
        $admin->givePermissionTo(Permission::all());
        $prêtre = Role::findByName('prêtre');
        $prêtre->givePermissionTo(['create catechesis', 'edit catechesis', 'delete catechesis', 'view catechesis']);
        $aroissien = Role::findByName('paroissien');
        $user = Role::findByName('user');
        $user->givePermissionTo(['buy product']);
        $cathecumene = Role::findByName('cathecumene');

    }
}
