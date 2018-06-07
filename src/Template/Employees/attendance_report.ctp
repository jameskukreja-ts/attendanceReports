<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee[]|\Cake\Collection\CollectionInterface $employees
 */
?>

<div class="employees form large-9 medium-8 columns content" style="margin:0px 0px 0px 140px;">
   
<?= $this->Form->create() ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
                <td>
                    <?php echo $this->Form->control('office_id',['required'=>true,'label'=>'Office Id','type'=>'text']); ?></td>
                <td>
                    <?php echo '<label><strong>Start Date</strong></label><input type="date" name="start_date" required>';?></td>
                <td>
                    <?php echo '<label><strong>End Date</strong></label><input type="date" name="end_date" required>';?>
                </td>
                <td>
                    <?= $this->Form->button(__('Submit')) ?>
                </td>
            
        </tr>
    </table>
    
<?= $this->Form->end() ?>
    

    <?php if($report):?>
        <fieldset>
                <legend><?= __('Attendance Report') ?></legend>
                <table class="vertical-table">
                    <tr>
                        <th scope="row"><?= __('Name') ?></th>
                        <td><?php echo $employee->first_name." ".$employee->last_name ?></td>
                        <th scope="row"><?= __('Office Id') ?></th>
                        <td><?= h($employee->office_id) ?></td>
                    </tr>
                    
                </table>
                   
                        <table cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">S. No.</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">In Time</th>
                                    <th scope="col">Out Time</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;
                                 foreach ($report as $row): ?>
                                <tr>
                                    <td><?php echo $i++ ; ?></td>
                                    <td><?php  echo $row['in']['date'] ; ?></td>
                                    <td><?php echo $row['in']['time'] ; ?></td>
                                    <td><?php echo $row['out']['time'] ; ?></td>
                                    <td><?= $this->Html->link(__('Details'), ['action' => 'view', $row['in']['date'],$employee->id]) ?></td>
                                
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    
        </fieldset> 
    <?php endif;?>
</div>


