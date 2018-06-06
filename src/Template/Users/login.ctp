
<div class="users form large-10 medium-8 columns content" style="margin:0px 0px 0px 100px;" >
<h1>Login</h1>
<?= $this->Form->create() ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('password') ?>
<?= $this->Form->button('Login') ?>
<?= $this->Form->end() ?>
</div>
