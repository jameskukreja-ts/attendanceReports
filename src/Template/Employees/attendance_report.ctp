<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee[]|\Cake\Collection\CollectionInterface $employees
 */
?>

<div class="employees form large-9 medium-8 columns content" style="margin:0px 0px 0px 140px;">
   <!--  <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Attendance Report') ?></legend>
        <?php
            echo $this->Form->control('office_id',['required'=>true,'label'=>'Office Id','type'=>'text']);
            //echo $this->Form->control('start_date',['label'=>'Start Date','type'=>'date']);
           // echo $this->Form->control('end_date',['label'=>'End Date','type'=>'date']);
            echo '<label><strong>Start Date</strong></label><input type="date" name="start_date" required>';
            echo '<label><strong>End Date</strong></label><input type="date" name="end_date" required>';
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?> -->
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
                   
                        <table cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">Employee Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($report as $row): ?>
                                <tr>
                                    <td><?= h($row->employee->office_id)?></td>
                                    <td><?= h($row->employee->first_name)?></td>
                                    <td><?php $timestamp = strtotime($row->log_timestamp);
                                              echo date('d-m-Y' ,$timestamp) ; ?></td>
                                    <td><?php echo date('H-i-s' ,$timestamp) ; ?></td>
                                
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    
        </fieldset> 
    <?php endif;?>
</div>


