<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(){[
            'name' => 'Navegar usuarios',
            'slug' => 'usuario.index'
        ]};
        Permission::create(){[
            'name' => 'Crear usuarios',
            'slug' => 'usuario.crear'
        ]};
        Permission::create(){[
            'name' => 'Editar usuarios',
            'slug' => 'usuario.editar'
        ]};
        Permission::create(){[
            'name' => 'ver usuarios',
            'slug' => 'usuario.ver'
        ]};
        Permission::create(){[
            'name' => 'Activar usuarios',
            'slug' => 'usuario.activar'
        ]};
        Permission::create(){[
            'name' => 'Desactivar usuarios',
            'slug' => 'usuario.desactivar'
        ]};
        Permission::create(){[
            'name' => 'Navegar roles',
            'slug' => 'roles.index'
        ]};
    }
}
