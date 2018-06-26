<?php
use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {   
        $hasher = new DefaultPasswordHasher();
        $data = [
            'first_name'=> 'admin',
            'last_name'=> 'admin',
            'username'=>'admin',
            'password'   =>$hasher->hash('12345678'),
            'email'=> 'admin@admin.com',
            'role_id' => 1,
            'created'=>date("Y-m-d H:i:s"),
            'modified'=>date("Y-m-d H:i:s")
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
