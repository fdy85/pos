<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $rol1 = Role::create(['name' => 'SuperAdmin']);
        $rol2 = Role::create(['name' => 'Cajero']);
        $rol3 = Role::create(['name' => 'Cliente']);

    /*//ADMIN - DASHBOARD
        Permission::create(['name' => 'admin.index',
                            'desc' => 'Panel de Control para Administradores'])->syncRoles([$rol1]);

     //ADMIN - PROFILE
        Permission::create(['name' => 'admin.profile',
                            'desc' => 'Ver las opciones de perfil de usuario'])->assignRole([$rol1, $rol2]); */

    //COMPANIES
        Permission::create(['name' => 'admin.companies.destroy',
                            'desc' => 'Deshabilitar una Empresa',
                            'category' => '.companies'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.companies.index',
                            'desc' => 'Ver Listado de Empresas',
                            'category' => '.companies'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.companies.edit',
                            'desc' => 'Editar una Empresa',
                            'category' => '.companies'])->assignRole([$rol1]);
    
    //BRANCHOFFICES
        Permission::create(['name' => 'admin.branchoffices.index',
                            'desc' => 'Ver Listado de Sucursales',
                            'category' => '.branchoffices'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.branchoffices.create',
                            'desc' => 'Crear una Sucursal',
                            'category' => '.branchoffices'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.branchoffices.edit',
                            'desc' => 'Editar una Sucursal',
                            'category' => '.branchoffices'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.branchoffices.destroy',
                            'desc' => 'Deshabilitar una Sucursal',
                            'category' => '.branchoffices'])->assignRole([$rol1]);

    //USERS
        Permission::create(['name' => 'admin.users.index',
                            'desc' => 'Ver Listado de Usuarios',
                            'category' => '.users'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.users.create',
                            'desc' => 'Crear un Usuario',
                            'category' => '.users'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.users.edit',
                            'desc' => 'Editar un Usuario',
                            'category' => '.users'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.users.destroy',
                            'desc' => 'Deshabilitar un Usuario',
                            'category' => '.users'])->assignRole([$rol1]);
        /* Users Dashboard */
        Permission::create(['name' => 'admin.users.active',
                            'desc' => 'Activar usuarios para utilizar la plataforma',
                            'category' => '.users'])->assignRole([$rol1]);

    //ROLES
        Permission::create(['name' => 'admin.roles.index',
                            'desc' => 'Ver Listado de Roles',
                            'category' => '.roles'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.roles.create',
                            'desc' => 'Crear un Role',
                            'category' => '.roles'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.roles.edit',
                            'desc' => 'Editar un Role',
                            'category' => '.roles'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.roles.destroy',
                            'desc' => 'Deshabilitar un Role',
                            'category' => '.roles'])->assignRole([$rol1]);

    //CLIENTS
        Permission::create(['name' => 'admin.clients.index',
                            'desc' => 'Ver Listado de Clientes',
                            'category' => '.clients'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.clients.create',
                            'desc' => 'Crear un Cliente',
                            'category' => '.clients'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.clients.edit',
                            'desc' => 'Editar un Cliente',
                            'category' => '.clients'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.clients.destroy',
                            'desc' => 'Deshabilitar un Cliente',
                            'category' => '.clients'])->assignRole([$rol1]);

    //PROVIDERS
        Permission::create(['name' => 'admin.providers.index',
                            'desc' => 'Ver Listado de Proveedores',
                            'category' => '.providers'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.providers.create',
                            'desc' => 'Crear un Proveedor',
                            'category' => '.providers'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.providers.edit',
                            'desc' => 'Editar un Proveedor',
                            'category' => '.providers'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.providers.destroy',
                            'desc' => 'Deshabilitar un Proveedor',
                            'category' => '.providers'])->assignRole([$rol1]);

    //BRANDS
        Permission::create(['name' => 'admin.brands.index',
                            'desc' => 'Ver Listado de Marcas',
                            'category' => '.brands'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.brands.create',
                            'desc' => 'Crear una Marca',
                            'category' => '.brands'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.brands.edit',
                            'desc' => 'Editar una Marca',
                            'category' => '.brands'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.brands.destroy',
                            'desc' => 'Deshabilitar una Marca',
                            'category' => '.brands'])->assignRole([$rol1]);

    //CATEGORIES
        Permission::create(['name' => 'admin.categories.index',
                            'desc' => 'Ver Listado de Categorías',
                            'category' => '.categories'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.categories.create',
                            'desc' => 'Crear una Categoría',
                            'category' => '.categories'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.categories.edit',
                            'desc' => 'Editar una Categoría',
                            'category' => '.categories'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.categories.destroy',
                            'desc' => 'Deshabilitar una Categoría',
                            'category' => '.categories'])->assignRole([$rol1]);
                
    //SUBCATEGORIES
        /* Permission::create(['name' => 'admin.subcategories.index',
                            'desc' => 'Ver Listado de Subcategorías',
                            'category' => '.subcategories'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.subcategories.create',
                            'desc' => 'Crear una Subcategoría',
                            'category' => '.subcategories'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.subcategories.edit',
                            'desc' => 'Editar una Subcategoría',
                            'category' => '.subcategories'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.subcategories.destroy',
                            'desc' => 'Deshabilitar una Subcategoría',
                            'category' => '.subcategories'])->assignRole([$rol1]); */

    //PRODUCTS
        Permission::create(['name' => 'admin.products.index',
                            'desc' => 'Ver Listado de Productos',
                            'category' => '.products'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.products.create',
                            'desc' => 'Crear un Producto',
                            'category' => '.products'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.products.edit',
                            'desc' => 'Editar un Producto',
                            'category' => '.products'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.products.destroy',
                            'desc' => 'Deshabilitar un Producto',
                            'category' => '.products'])->assignRole([$rol1]);
                
    //CASH REGISTERS
        Permission::create(['name' => 'admin.cashregisters.index',
                            'desc' => 'Ver Listado de Cajas Registradoras',
                            'category' => '.cashregisters'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.cashregisters.create',
                            'desc' => 'Crear una Caja Registradora',
                            'category' => '.cashregisters'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.cashregisters.edit',
                            'desc' => 'Editar una Caja Registradora',
                            'category' => '.cashregisters'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.cashregisters.destroy',
                            'desc' => 'Deshabilitar una Caja Registradora',
                            'category' => '.cashregisters'])->assignRole([$rol1]);

    //CASHOUTS
        Permission::create(['name' => 'admin.cashouts.index',
                            'desc' => 'Ver Listado de Cortes de caja',
                            'category' => '.cashouts'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.cashouts.create',
                            'desc' => 'Crear un Corte de Caja',
                            'category' => '.cashouts'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.cashouts.edit',
                            'desc' => 'Editar un Corte de Caja',
                            'category' => '.cashouts'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.cashouts.destroy',
                            'desc' => 'Eliminar un Corte de Caja',
                            'category' => '.cashouts'])->assignRole([$rol1]);

    //POS

    //SALES
        Permission::create(['name' => 'admin.sales.index',
                            'desc' => 'Ver Listado de Ventas',
                            'category' => '.sales'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.sales.find',
                            'desc' => 'Buscar una venta',
                            'category' => '.sales'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.sales.search',
                            'desc' => 'Buscar ventas con rango de fechas',
                            'category' => '.sales'])->assignRole([$rol1]);
        Permission::create(['name' => 'admin.sales.destroy',
                            'desc' => 'Cancelar una Venta',
                            'category' => '.sales'])->assignRole([$rol1]);
    
    }
    
}