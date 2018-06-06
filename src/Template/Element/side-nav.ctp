<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Upload CSV'), ['controller' => 'Employees','action' => 'syncAttendance']) ?></li>
        <li><?= $this->Html->link(__('User Management'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Employee Management'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Attendance Report'), ['controller' => 'Employees', 'action' => 'attendanceReport']) ?></li>
    </ul>
</nav>