<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run Seeder
     * @return void
     */

     public function run()
     {
         //Reset Cached Roles and Permissions for fresh seeding
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         //Create the various permissions

         //Contest Permissions
         Permission::create(['name' => 'view_contest']);
         Permission::create(['name' => 'edit_contest']);
         Permission::create(['name' => 'delete_contest']);
         Permission::create(['name' => 'create_contest']);
         

         //participant Permissions
         Permission::create(['name' => 'view_participant']);
         Permission::create(['name' => 'edit_participant']);
         Permission::create(['name' => 'delete_participant']);
         Permission::create(['name' => 'create_participant']);

         //vote Permissions
         Permission::create(['name' => 'view_vote']);

         //finance Permissions
         Permission::create(['name' => 'view_finance']);
         Permission::create(['name' => 'withdraw_finance']);
       

         //User Permissions
         Permission::create(['name' => 'view_user']);
         Permission::create(['name' => 'edit_user']);
         Permission::create(['name' => 'delete_user']);
         Permission::create(['name'=> 'create_user']);

         
          //staff Roles
            Role::create(['name' => 'staff'])->givePermissionTo(['view_contest', 'view_participant', 'view_vote']);
        //admin roles
            Role::create(['name' => 'admin'])->givePermissionTo(['view_contest', 'edit_contest', 'delete_contest', 'view_participant', 'edit_participant', 'view_vote', 'view_finance', 'withdraw_finance']);
        //superadmin roles
            Role::create(['name' => 'superadmin'])->givePermissionTo(['view_contest', 'edit_contest', 'create_contest', 'delete_contest', 'view_participant', 'edit_participant', 'create_participant', 'delete_participant', 'view_vote', 'view_finance', 'withdraw_finance', 'view_user', 'edit_user', 'delete_user', 'create_user']);
        
        $webeffective = User::where('email', 'webeffect94@gmail.com')->first();
        $webeffective->assignRole('superadmin');

        $shosa = User::where('email', 'shosaempire@gmail.com')->first();
        $shosa->assignRole('superadmin');

        $godmode = User::where('email', 'playersrebirth@gmail.com')->first();
        $godmode->assignRole('superadmin');
   }
}