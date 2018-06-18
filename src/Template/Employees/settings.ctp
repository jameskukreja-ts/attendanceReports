<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>

<div class="employees form large-9 medium-8 columns content">
    <?= $this->Form->create(null,['id'=>"setting"]) ?>
    <fieldset>
        <legend><?= __('Settings') ?></legend>
        <?php
            echo $this->Form->control('half_day_hours',['id'=>'half','value'=>$settingValue['Half']]);
            echo $this->Form->control('full_day_hours',['id'=>'full','value'=>$settingValue['Full']]);
            
            
        ?>

    </fieldset>

    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
