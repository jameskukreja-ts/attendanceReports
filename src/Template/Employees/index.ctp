<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee[]|\Cake\Collection\CollectionInterface $employees
 */
?>

<div class="employees index large-12 medium-8 columns content">
    <?= $this->Html->link(__('Add Employee'), ['controller' => 'Employees', 'action' => 'add'],['class'=>'button right']) ?>
    <h3><?= __('Employees') ?></h3>
    
    <table id="employees">
        <thead>
            <tr>
                <th><?= 'S. No.' ?></th>
                <th><?= 'First Name' ?></th>
                <th><?= 'Last Name' ?></th>
                <th><?= 'Office ID' ?></th>
                <th><?= 'Machine Generated ID' ?></th>
                <th ><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $id=1; foreach ($employees as $key=>$employee): ?>
            <tr>
                <td><?= $this->Number->format($key+1) ?></td>
                <td><?= h($employee->first_name) ?></td>
                <td><?= h($employee->last_name) ?></td>
                <td><?= h($employee->office_id) ?></td>
                <td><?= $this->Number->format($employee->machine_generated_id) ?></td>
                <td >
                    <!-- <button id="myBtn">Open Modal</button> -->
                    <a title = "Employee Attendance" onclick = "displayModal('<?= $employee->office_id ?>')"><i class="fa fa-eye fa-lg" id="myBtn"></i></a>

                    
                    
                    <!--<?= $this->Html->link(__('  '), ['action' => 'employeeReport', $employee->id],['class'=>'fa fa-eye fa-lg']) ?>-->
                    <?= $this->Html->link(__('  '), ['action' => 'edit', $employee->id],['class'=>'fa fa-edit fa-lg']) ?>
                    <?= $this->Form->postLink(__(''), ['action' => 'delete', $employee->id],['class'=>'fa fa-trash fa-lg','confirm' => __('Are you sure you want to delete # {0}?', $employee->id)]) ?>

                    
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
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2></h2>
    </div>
    <div class="modal-body" style="">
        
        <?= $this->Form->create(null, ['url' => ['controller'=>'Employees','action' => 'attendanceReport']]) ?>
        <?php echo $this->Form->control('office_id',['required'=>true,'id' =>"emplyeeOfficeId",'type'=>'hidden' ])?>
        <?php echo '<label><strong>Start Date</strong></label><input type="date" name="start_date" required>';?>
        <?php echo '<label><strong>End Date</strong></label><input type="date" name="end_date" required>';?>
         <?= $this->Form->button(__('Submit')) ?>
         <?= $this->Form->end() ?>
    
    </div>
    <!-- <div class="modal-footer">
      <h3></h3>
    </div> -->
  </div>

</div>
 <script>
//     $(document).ready( function () {
//         console.log('here');
//     $('#employees').DataTable();
//     } );

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
function displayModal(employeeId) {
    modal.style.display = "block";
    $('#emplyeeOfficeId').val(employeeId);

}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
