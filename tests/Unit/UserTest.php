<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserTest extends TestCase
{
    public function test_user_can_login()
    {
        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => 'Asd,car21',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }

    public function testCreateUser()
    {
        $data = [
            'user_fname' => 'John',
            'user_mname' => 'Doe',
            'user_lname' => 'John',
            'user_gender' => 'Male',
            'user_room' => 'Rose 105',
            'polyid' => 'PL-001',
            'username' => 'andrew',
            'password' => bcrypt('Asd,car21'),
            'level' => 'R001',
            'email' => 'test123@gmail.com',
        ];
        $user = new User();
        $user->fill($data);
        $user->save();

        $this->assertEquals('andrew', $user->username);
    }

    public function testUpdateUserAccount()
    {  
        $user = User::find('20230009');
        $user->username = 'andrew123';
        $user->update();
        $this->assertEquals('andrew123', $user->username);
    }

    public function testDeleteUser()
    {
        $user = User::find('20230009');
        $user->delete();
        $this->assertDatabaseMissing('users', ['userid' => '20230009']);
    }

}
