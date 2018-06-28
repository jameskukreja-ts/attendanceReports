<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>

<div class="employees form large-9 medium-8 columns content">
    <?= $this->Form->create($employee) ?>
    <fieldset>
        <legend><?= __('Edit Employee') ?></legend>
        <?php
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('office_id',['label'=>'Office Id','type'=>'text']);
            echo $this->Form->control('machine_generated_id',['label'=>'Machine Generated Id','type'=>'text']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
