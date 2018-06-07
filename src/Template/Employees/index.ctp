<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee[]|\Cake\Collection\CollectionInterface $employees
 */
?>

<div class="employees index large-12 medium-8 columns content">
    <?= $this->Html->link(__('Add Employee'), ['controller' => 'Employees', 'action' => 'add'],['class'=>'button right']) ?>
    <h3><?= __('Employees') ?></h3>
    
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= 'S. No.' ?></th>
                <th scope="col"><?= 'First Name' ?></th>
                <th scope="col"><?= 'Last Name' ?></th>
                <th scope="col"><?= 'Office ID' ?></th>
                <th scope="col"><?= 'Machine Generated ID' ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $id=1; foreach ($employees as $employee): ?>
            <tr>
                <td><?= $this->Number->format($id++) ?></td>
                <td><?= h($employee->first_name) ?></td>
                <td><?= h($employee->last_name) ?></td>
                <td><?= h($employee->office_id) ?></td>
                <td><?= $this->Number->format($employee->machine_generated_id) ?></td>
                <td class="actions">
                    
                    <?= $this->Html->link(__('  '), ['action' => 'employeeReport', $employee->id],['class'=>'fa fa-eye fa-lg']) ?>
                    <?= $this->Html->link(__('  '), ['action' => 'edit', $employee->id],['class'=>'fa fa-edit fa-lg']) ?>
                    <?= $this->Form->postLink(__(''), ['action' => 'delete', $employee->id],['class'=>'fa fa-trash fa-lg'], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id)]) ?>
                    
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
