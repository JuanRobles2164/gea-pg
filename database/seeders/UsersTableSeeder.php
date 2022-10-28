<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'id' => 1,
            'name' => 'Admin Admin',
            'email' => 'admin@argon.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'identificacion' => '01010101',
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 2,
            'name' => 'Gabriel Alexander Castro',
            'email' => 'gcastro3@udi.edu.co',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'identificacion' => '1007673757',
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 3,
            'name' => 'Marly Alexandra Acosta',
            'email' => 'macosta3@udi.edu.co',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'identificacion' => '1005163114',
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 4,
            'name' => 'Juan Esteban Robles',
            'email' => 'jrobles@udi.edu.co',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'identificacion' => '1005109076',
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 5,
            'name' => 'Angie Nurley',
            'email' => 'nacosta1@udi.edu.co',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'identificacion' => '1005336798',
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 6,
            'name' => 'Rafael Ricardo Mantilla',
            'email' => 'rmantillaDocente@udi.edu.co',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'identificacion' => '1003978351',
            'estado' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]]);
    }
}
