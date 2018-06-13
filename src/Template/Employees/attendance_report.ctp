<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee[]|\Cake\Collection\CollectionInterface $employees
 */
?>

<div class="employees form large-10 medium-8 columns content" style="margin:0px 0px 0px 100px;">
   
<?= $this->Form->create('') ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
                <td>
                    <?php
                     if(empty($employees)){
                        echo $this->Form->control('office_id',['required'=>true,'label'=>'Office Id','type'=>'text']); 
                     }else{
                        echo $this->Form->control('office_id',['required'=>true,'label'=>'Employee', 'options' => $employees]); 
                     }
                    ?>
                </td>
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
            <legend><?= __('Attendance Report : '.$startDate->i18nFormat('dd-MM-yyyy').' to '.$endDate->i18nFormat('dd-MM-yyyy')) ?></legend>
               
                <table class="vertical-table">
                    <tr>
                        <th scope="row"><?= __('Name') ?></th>
                        <td><?php echo $employee->first_name." ".$employee->last_name ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Office Id') ?></th>
                        <td><?= h($employee->office_id) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Working Days') ?></th>
                        <td id="workingDays"><?=$details['workingdays']?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Full Days') ?></th>
                        <td id="fullDays"><?=$details['fulldays']?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Half Days') ?></th>
                        <td id="halfDays"><?=$details['halfdays']?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Absent Days') ?></th>
                        <td id="absentDays"><?=$details['absents']?></td>
                    </tr>
                    
                </table>
                   
                        <table cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">S. No.</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">In Time</th>
                                    <th scope="col">Out Time</th>
                                    <th scope="col">Duration(hrs.)</th>
                                    <th scope="col">Status</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sNo=1;
                                 foreach ($report as $key=>$row): ?>   

                                <tr>
                                    <td><?=$sNo++?></td>
                                    <td><?= $row['date']?></td>
                                    <td><?= $row['in'] ?></td>
                                    <td><?= $row['out'] ?></td>
                                    <td><?=$row['duration']?></td>
                                    <td><?=$row['status']?></td>
                                    <td>
                                    <?php if($row['in']!='-'):?>
                                    <a title = "Attendance logs" onclick = "displayModal('<?= $employee->id ?>','<?= $row['date'] ?>')"><i title="Details" class="fa fa-info-circle fa-lg" id="myBtn"></i></a>
                                    <?php endif?>
                                    </td>
                                    

                                </tr>
                                <?php endforeach; ?>

                               
                            </tbody>
                        </table>

                    
        </fieldset> 
    <?php endif;?>
</div>
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2></h2>
    </div>
    <div class="modal-body" style="">
            <h4 id="modalDate" class='right'>
                
            </h4>
            <h4 style="color: #b30000;">
                <?= h( $employee->first_name." ".$employee->last_name) ?>
            </h4>
            
            <table id="logTable" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">S. No.</th>
                        <th scope="col">Time</th>
                        <th scope="col">Mode</th>
                        
                    </tr>
                </thead>
                <tbody id="dailyDetails">
        
                </tbody>
            </table>

    </div>
    <!-- <div class="modal-footer">
      <h3></h3>
    </div> -->
    </div>

</div>
 <script>
            
                                       
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
function displayModal(employeeId,date) {
    modal.style.display = "block";
    console.log(employeeId+','+date)
    $('#modalDate').html(date);
    $.ajax({  
            url: 'http://localhost/attendanceReports/api/Employees/getLogsByDate/'+employeeId+'/'+date,
            headers: { 'Accept': 'application/json', 'content-type': 'application/json' },
            type: 'GET', 
            success: function(result) {
                var details=result.details;
                $("#dailyDetails").empty();
                var table = document.getElementById("dailyDetails");
                
                console.log(details);
                for(var i=0; i<details.length;i++){
                    var d = details[i].time;
                    //var time = datetime.toLocaleTimeString();
                    var row = table.insertRow(i);
                    var sno = row.insertCell(0);
                    var time = row.insertCell(1);
                    var mode = row.insertCell(2);
                    sno.innerHTML = i+1;
                    time.innerHTML=d;//.toLocaleTimeString();
                    mode.innerHTML =details[i].mode.name;
                }
                // console.log(result);
            } 
        }); 
    
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


