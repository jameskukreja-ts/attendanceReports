<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>

<div class="employees view large-9 medium-8 columns content" style="margin:0px 0px 0px 140px;">
    <!-- <h3><?= h($employee->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($employee->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($employee->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Office Id') ?></th>
            <td><?= h($employee->office_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($employee->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Machine Generated Id') ?></th>
            <td><?= $this->Number->format($employee->machine_generated_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($employee->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($employee->modified) ?></td>
        </tr>
    </table> -->
    
       
        <?php if (!empty($details)): ?>
         <h4><?= __('Attendance Logs') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col">S. No.</th>
                <th scope="col">Time</th>
                <th scope="col">Mode</th>
                
            </tr>
            <?php $i=1; foreach ($details as $detail): ?>
            <tr>
                <td><?php echo $i++ ; ?></td>
                <td><?= h($detail['time']) ?></td>
                <td><?= h($detail['mode']) ?></td>
                
               
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    
</div>
