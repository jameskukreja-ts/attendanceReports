<?php
use Migrations\AbstractMigration;

class ChangeValueInSettings extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $settings = $this->table('settings');
        $settings->changeColumn('value', 'float')
              ->save();
    }
}
