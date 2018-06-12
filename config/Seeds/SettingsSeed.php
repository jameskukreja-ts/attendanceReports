<?php
use Migrations\AbstractSeed;

/**
 * Settings seed.
 */
class SettingsSeed extends AbstractSeed
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
                'name'=>'Half',
                'value'=>'4',
                'label'=>'half_day_hours',
                'description'=>'Duration between 4 and 8 hours',
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
            [
                'name'=>'Full',
                'value'=>'8',
                'label'=>'full_day_hours',
                'description'=>'Duration more than 8 hours',
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ]
        ];

        $table = $this->table('settings');
        $table->insert($data)->save();
    }
}
