<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Attendance Logs'), ['controller' => 'AttendanceLogs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Attendance Log'), ['controller' => 'AttendanceLogs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="employees form large-9 medium-8 columns content">
    <?= $this->Form->create($attendanceCsv, ['class' => 'form-horizontal', 'enctype'=>"multipart/form-data"]) ?>
    <fieldset>
    
    <?= $this->Form->input('file_name', ['label' => false,'required' => true,['class' => 'form-control'],'type' => "file",'id'=>'imgChange']); ?>
        
    <?= $this->Form->button(__('Submit')) ?>
    </fieldset>
<?php echo $this->Form->end(); ?>

</div>
