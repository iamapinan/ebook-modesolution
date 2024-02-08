<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('d/m/Y');
        $stamp = date('dmY');

        for($x=1701;$x<=1800;$x++) {
            $password = '@'.str_random(6);
            $user = [
                    'name' => 'User '.$x,
                    'email' => 'user_'.$x.'@learning21.com',
                    'password' => bcrypt($password),
                    'organization' => 'pasee_x',
                    'birthday' => $date,
                    'email_verification_token' => '',
                    'email_verified' => 1,
                    'email_verified_at' => now(),
            ];

            DB::table('users')->insert($user);
            $str = "pasee_x $x,user_$x@learning21.com,$password\n";
            echo $str;
            file_put_contents( env('API_FILE_DIR').'/generated_user_'.$stamp.'.txt', $str, FILE_APPEND );
        }
    }
}
