<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Agency;
use App\Models\AgentDetail;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //Agency

        $agency = Agency::create([
            'agency_name'=>'Private',
            'about_summary'=>'Agent operates in their private capacity.',
            'disclosures'=>'Disclosures as per agent private resume & accreditations.',
        ]);

        //create vouchers

        $voucher = Voucher::create([
            'max_uses' => '5',
            'active' => '1',
            'currency' => 'ZAR',
            'max_amount' => '400',
            'description' => 'Test voucher description',
            'voucher_key' => 'Test A',
        ]);


        $voucherb = Voucher::create([
            'max_uses' => '5',
            'active' => '1',
            'currency' => 'ZAR',
            'max_amount' => '450',
            'description' => 'Test voucher description b',
            'voucher_key' => 'Test B',
        ]);


        //create test users

        $admin = User::create([
            'first_name' => 'Henry',
            'last_name' => 'Faul',
            'cell_no' => '0731008213',
            'email' => 'admin@impii.co.za',
            'primary_role' => 'admin',
            'password' => Hash::make('test1234'),
        ]);

        $admin_agent_detail = AgentDetail::create([
            'user_id'=>$admin->id
        ]);


        $agent = User::create([
            'first_name' => 'Justin',
            'last_name' => 'Booysen',
            'cell_no' => '0731008213',
            'email' => 'justin@impii.co.za',
            'primary_role' => 'agent',
            'password' => Hash::make('test1234'),
        ]);

        $agent_agent_detail = AgentDetail::create([
            'user_id'=>$agent->id
        ]);

        $client = User::create([
            'first_name' => 'Henry',
            'last_name' => 'Faul',
            'cell_no' => '0731008213',
            'email' => 'cient@impii.co.za',
            'primary_role' => 'client',
            'password' => Hash::make('test1234'),
        ]);

        //create roles

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAgent = Role::create(['name' => 'agent']);
        $roleClient = Role::create(['name' => 'client']);

        //create permissions

        $permissionAssign = Permission::create(['name' => 'assign agents']);
        $permissionPayment = Permission::create(['name' => 'process payments']);


        //Franchise permissions

        $permissionFranchisePE = Permission::create(['name' => 'franchise_P.E']);
        $permissionFranchiseHeidelberg = Permission::create(['name' => 'franchise_Heidelberg']);


        //assign permissions to the roles

        $roleAdmin->givePermissionTo($permissionAssign);
        $roleAdmin->givePermissionTo($permissionPayment);

        $roleAdmin->givePermissionTo($permissionFranchisePE);
        $roleAgent->givePermissionTo($permissionFranchisePE);

        //assign roles to users

        //admin all
        $admin->assignRole($roleAdmin->name);
        $admin->assignRole($roleAgent->name);
        $admin->assignRole($roleClient->name);

        //agent
        $agent->assignRole($roleAgent->name);
        $agent->assignRole($roleClient->name);

        //client

        $client->assignRole($roleClient->name);



       /* $account = Account::create(['name' => 'Acme Corporation']);

        User::factory()->create([
            'account_id' => $account->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'password' => 'secret',
            'owner' => true,
        ]);

        User::factory(5)->create(['account_id' => $account->id]);

        $organizations = Organization::factory(100)
            ->create(['account_id' => $account->id]);

        Contact::factory(100)
            ->create(['account_id' => $account->id])
            ->each(function ($contact) use ($organizations) {
                $contact->update(['organization_id' => $organizations->random()->id]);
            });*/
    }
}
