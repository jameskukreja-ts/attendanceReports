<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>

<div class="employees form large-9 medium-8 columns content">
    <?= $this->Form->create($attendanceCsv, ['class' => 'form-horizontal', 'enctype'=>"multipart/form-data"]) ?>
    <fieldset>
    
    <?= $this->Form->input('file_name', ['label' => false,'required' => true,['class' => 'form-control'],'type' => "file",'id'=>'imgChange']); ?>
        
    <?= $this->Form->button(__('Submit')) ?>
    </fieldset>
<?php echo $this->Form->end(); ?>

</div>
