<?php

namespace Database\Seeders;

use App\Exceptions\MissingAdminCredentialsException;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Exceptions\RoleDoesNotExist;

class AdminSeeder extends Seeder
{
    /**
     * Seed the admin user of the application
     * This information should be stored in the .env file
     *
     * @throws MissingAdminCredentialsException
     */
    public function run(): void
    {

        // First check we have credentials in the .env file
        if (config('admin.admin_name')) {

            // Start a DB transaction, so we can roll back if something goes wrong
            DB::transaction(function () {

                // Create the admin user model in the database
                $admin = User::create([
                    'name' => config('admin.admin_name'),
                    'email' => config('admin.admin_email'),
                    'password' => Hash::make(config('admin.admin_password')),
                    'email_verified_at' => now(),
                ]);

                // Attempt to assign the super admin role to the user
                try {
                    // Assign the super admin role
                    $admin->assignRole('super admin');
                } catch (RoleDoesNotExist $e) {
                    // Rollback the transaction and throw an exception with an error message
                    throw new RoleDoesNotExist('Failed to create super user, try seeding roles DB:  '.$e->getMessage());
                }

                return $admin;
            });
        } else {
            // If the admin credentials are not set in the .env file, throw an exception
            throw new MissingAdminCredentialsException();
        }

    }
}
