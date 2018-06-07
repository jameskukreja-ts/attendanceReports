
<div class="users form large-10 medium-8 columns content" style="margin:0px 0px 0px 100px;" >
<?= $this->Html->link(__('Attendance Report'), ['controller' => 'Employees', 'action' => 'attendanceReport'],['class'=>'button right']) ?>
<h1>Login</h1>
<?= $this->Form->create() ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('password') ?>
<?= $this->Form->button('Login') ?>

<?= $this->Form->end() ?>
</div>
