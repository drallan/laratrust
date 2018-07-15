<?php

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Client::create([
            'name' => 'The Company',
            'email' => 'test@thecompany.com',
            'address' => '123 First Street, Second Avenue',
            'city' => 'Johannesburg',
            'postal_code' => '4321',
            'phone' => '111-111-1111',
            'cell' => '999-999-9999',
        ]);
    }
}
