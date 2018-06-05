<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Employee'), ['action' => 'edit', $employee->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Employee'), ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Attendance Logs'), ['controller' => 'AttendanceLogs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Attendance Log'), ['controller' => 'AttendanceLogs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="employees view large-9 medium-8 columns content">
    <h3><?= h($employee->id) ?></h3>
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
    </table>
    <div class="related">
        <h4><?= __('Related Attendance Logs') ?></h4>
        <?php if (!empty($employee->attendance_logs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Log Timestamp') ?></th>
                <th scope="col"><?= __('Employee Id') ?></th>
                <th scope="col"><?= __('Mode Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($employee->attendance_logs as $attendanceLogs): ?>
            <tr>
                <td><?= h($attendanceLogs->id) ?></td>
                <td><?= h($attendanceLogs->log_timestamp) ?></td>
                <td><?= h($attendanceLogs->employee_id) ?></td>
                <td><?= h($attendanceLogs->mode_id) ?></td>
                <td><?= h($attendanceLogs->created) ?></td>
                <td><?= h($attendanceLogs->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AttendanceLogs', 'action' => 'view', $attendanceLogs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AttendanceLogs', 'action' => 'edit', $attendanceLogs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AttendanceLogs', 'action' => 'delete', $attendanceLogs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attendanceLogs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
