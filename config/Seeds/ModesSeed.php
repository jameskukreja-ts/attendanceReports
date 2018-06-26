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
            [
                'name'=>'Biometric',
                'description' => 'Employee uses Biometrics on the machine setup inside the office.',
                'machine_mode_id' => 1,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
            [
                'name'=>'Internal RFID',
                'description' => 'Employee uses RFID card on the machine setup inside the office.',
                'machine_mode_id' => 4,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
            [
                'name'=>'External RFID',
                'description' => 'Employee uses RFID card on the machine setup outside the office.',
                'machine_mode_id' => 104,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ]
        ];

        $table = $this->table('modes');
        $table->insert($data)->save();
    }
}
