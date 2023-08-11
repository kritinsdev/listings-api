<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Kristaps Ritins',
            'email' => 'kritinsdev@gmail.com',
            'password' => Hash::make('BigLebowski1994@$'),
        ]);

        $token = $user->createToken('api_token')->plainTextToken;

        echo $token;
    }
}
