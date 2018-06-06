
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
        
        <?php if (!empty($attendanceLogs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Time') ?></th>
                <!-- <th scope="col"><?= __('Employee Id') ?></th> -->
                <th scope="col"><?= __('Mode Id') ?></th>
                <!-- <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th> -->
                
            </tr>
            <?php foreach ($attendanceLogs as $attendanceLog): ?>
            <tr>
                <td><?= h($attendanceLog->id) ?></td>
                <td><?php $timestamp = strtotime($attendanceLog->log_timestamp);
                          echo date('d-m-Y' ,$timestamp) ; ?></td>
                <td><?= h(date('H-i-s' ,$timestamp))?></td>
                <!-- <td><?= h($attendanceLogs->employee_id) ?></td> -->
                <td><?= h($attendanceLog->mode_id) ?></td>
                <!-- <td><?= h($attendanceLogs->created) ?></td>
                <td><?= h($attendanceLogs->modified) ?></td> -->
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>