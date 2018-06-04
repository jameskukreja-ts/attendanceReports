<?php
use Migrations\AbstractSeed;

/**
 * Modes seed.
 */
class ModesSeed extends AbstractSeed
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
        $data = [
            ['name'=>'biometric',
            'description' => 'Biometric Attendance',
            'created'=>date("Y-m-d H:i:s"),
            'modified'=>date("Y-m-d H:i:s")
            ],
            ['name'=>'Internal RFID',
            'description' => 'Internal Card Exit',
            'created'=>date("Y-m-d H:i:s"),
            'modified'=>date("Y-m-d H:i:s")
            ],
            ['name'=>'External RFID',
            'description' => 'External Card Entry',
            'created'=>date("Y-m-d H:i:s"),
            'modified'=>date("Y-m-d H:i:s")
            ]
        ];

        $table = $this->table('modes');
        $table->insert($data)->save();
    }
}
