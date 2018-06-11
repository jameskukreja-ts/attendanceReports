<?php
use Migrations\AbstractSeed;

/**
 * Employees seed.
 */
class EmployeesSeed extends AbstractSeed
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
                'first_name'=>'Rohan',
                'last_name'=>'Mishra',
                'office_id' => 'A1',
                'machine_generated_id' => 1,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
            [
                'first_name'=>'Nikhil',
                'last_name'=>'Verma',
                'office_id' => 'A2',
                'machine_generated_id' => 2,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
            [
                'first_name'=>'Rakesh',
                'last_name'=>'NA',
                'office_id' => 'A3',
                'machine_generated_id' => 3,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
            [
                'first_name'=>'Sunpreet',
                'last_name'=>'Kaur',
                'office_id' => 'A4',
                'machine_generated_id' => 4,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
            [
                'first_name'=>'Guest',
                'last_name'=>'Guest',
                'office_id' => 'A5',
                'machine_generated_id' => 5,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
            [
                'first_name'=>'Aarti',
                'last_name'=>'Bhardwaj',
                'office_id' => 'A6',
                'machine_generated_id' => 6,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
            [
                'first_name'=>'Manpreet',
                'last_name'=>'Kaur',
                'office_id' => 'A7',
                'machine_generated_id' => 7,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
            [
                'first_name'=>'Kshitiz',
                'last_name'=>'Sikhri',
                'office_id' => 'A8',
                'machine_generated_id' => 8,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
            [
                'first_name'=>'Hriday',
                'last_name'=>'Taneja',
                'office_id' => 'A9',
                'machine_generated_id' => 9,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
             [
                'first_name'=>'James',
                'last_name'=>'Kukreja',
                'office_id' => 'A10',
                'machine_generated_id' => 10,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
             [
                'first_name'=>'Sanjay',
                'last_name'=>'Verma',
                'office_id' => 'A11',
                'machine_generated_id' => 11,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
             [
                'first_name'=>'VishaKha',
                'last_name'=>'Chaudhary',
                'office_id' => 'A12',
                'machine_generated_id' => 12,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
             [
                'first_name'=>'Riya',
                'last_name'=>'Sood',
                'office_id' => 'A13',
                'machine_generated_id' => 13,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
             [
                'first_name'=>'Ravi',
                'last_name'=>'NA',
                'office_id' => 'A14',
                'machine_generated_id' => 14,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
             [
                'first_name'=>'Navneet',
                'last_name'=>'Kaur',
                'office_id' => 'A15',
                'machine_generated_id' => 15,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
             [
                'first_name'=>'Rajita',
                'last_name'=>'Mishra',
                'office_id' => 'A16',
                'machine_generated_id' => 16,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
             [
                'first_name'=>'Anjali',
                'last_name'=>'Tyagi',
                'office_id' => 'A17',
                'machine_generated_id' => 17,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
             [
                'first_name'=>'Abhishek',
                'last_name'=>'Ahuja',
                'office_id' => 'A19',
                'machine_generated_id' => 19,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
            [
                'first_name'=>'Vivek',
                'last_name'=>'Bharti',
                'office_id' => 'A20',
                'machine_generated_id' => 20,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
            [
                'first_name'=>'Saumitra',
                'last_name'=>'Dobhal',
                'office_id' => 'A21',
                'machine_generated_id' => 21,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ],
            [
                'first_name'=>'Rahul',
                'last_name'=>'Mehta',
                'office_id' => 'A22',
                'machine_generated_id' => 22,
                'created'=>date("Y-m-d H:i:s"),
                'modified'=>date("Y-m-d H:i:s")
            ]
        ];

        $table = $this->table('employees');
        $table->insert($data)->save();
    }
}
