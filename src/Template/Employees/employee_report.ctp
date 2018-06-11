<!-- 
<div class="employees view large-9 medium-8 columns content" >
	<h4><?= __('Attendance Report') ?></h4>
	<table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?php echo $employee->first_name." ".$employee->last_name ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Office Id') ?></th>
            <td><?= h($employee->office_id) ?></td>
        </tr>
    </table>

	<div class="related">
        
        <?php if (!empty($reports)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('S. No.') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('In Time') ?></th>
                
                <th scope="col"><?= __('Out Time') ?></th>
                
                
            </tr>
            <?php $id=1; foreach ($reports as $report): ?>
            <tr>
                <td><?= $this->Number->format($id++) ?></td>
                <td><?php echo $report['in']['date'] ; ?></td>
                <td><?php echo $report['in']['time'] ; ?></td>
                
                <td><?php echo $report['out']['time'] ; ?></td>
                <td><?= $this->Html->link(__('Details'), ['action' => 'view', $report['in']['date'],$employee->id]) ?></td>
               
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div> -->
<?php echo $this->Form->control('',['required'=>true,'label'=>'Employee', 'options' => $months]); ?>