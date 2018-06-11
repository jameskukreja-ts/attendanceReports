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
                    </tr><tr>
                        <th scope="row"><?= __('Office Id') ?></th>
                        <td><?= h($employee->office_id) ?></td>
                    </tr>
                    </tr><tr>
                        <th scope="row"><?= __('Absents') ?></th>
                        <td><?php $id=1;
                        echo 23-sizeof($report) ?></td>
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
                                <?php   $s_no=1;
                                        $date = $startDate;
                                        while($date != $endDate):
                                            
                                            $in="-";
                                            $out="-";
                                            $duration="-";
                                            $holidays='';
                                            if(isset($report[$date->i18nFormat('dd-MM-yyyy')])){
                                                $in=$report[$date->i18nFormat('dd-MM-yyyy')]['in']['time'];
                                                $out=$report[$date->i18nFormat('dd-MM-yyyy')]['out']['time'];
                                                $duration=$report[$date->i18nFormat('dd-MM-yyyy')]['duration'];
                                            }else{
                                                    
                                                    
                                            }
                                                 
                                            
                                ?>

                                <tr>
                                    <td><?=$s_no++?></td>
                                    <td><?= $date->i18nFormat('dd-MM-yyyy') ?></td>
                                    <td><?= $in ?></td>
                                    <td><?= $out ?></td>
                                    <td><?=$duration?></td>
                                    <td></td>
                                    <td>
                                    <?php if(isset($report[$date->i18nFormat('dd-MM-yyyy')])):?>
                                    <a title = "Attendance logs" onclick = "displayModal('<?= $employee->id ?>','<?= $date->i18nFormat('dd-MM-yyyy') ?>')"><i title="Details" class="fa fa-info-circle fa-lg" id="myBtn"></i></a>
                                    <?php endif?>
                                    </td>
                                    

                                </tr>

                            <?php 
                                $date = $date->modify('+1 day');
                                endwhile; 
                            ?>
                               <!--  <?php $s_no=1;
                                    $year=date('Y',strtotime($dates['start_date']));
                                    $start_month=date('m',strtotime($dates['start_date']));
                                    $start_month=ltrim($start_month,'0');
                                    $end_month=date('m',strtotime($dates['end_date']));
                                    $end_month=ltrim($end_month,'0');
                                for ($i=$start_month; $i<=$end_month; $i++): ?>
                                    <?php
                                    $days=$months[$i];
                                    
                                    for ($j=1; $j<=$days; $j++): ?>
                                       <tr>
                                        
                                        <?php 
                                                $z=1;
                                                $date=date_create($year."-".$i."-".$j);
                                                $date=date_format($date,'d-m-Y');

                                                if((strtotime($dates['start_date'])<=strtotime($date))&&(strtotime($dates['end_date'])>=strtotime($date))){
                                                     echo '<td>'.$s_no++.'</td>';
                                                    echo '<td>'.$date.'</td>';

                                                }
                                                     
                                                 ?>
                                       </tr>
                                    <?php endfor; ?>
                                <?php endfor; ?> -->

                                <!--<?php $i=1; $date=null;
                                 foreach ($report as $row): ?>
                                <tr>
                                    <td><?php echo $i++ ; ?></td>
                                    <td><?php  echo $row['in']['date'] ; ?></td>
                                    <td><?php echo $row['in']['time'] ; ?></td>
                                    <td><?php echo $row['out']['time'] ; ?></td>
                                    <td><?php echo $row['duration'] ?></td>
                                    <td><!--<?= $this->Html->link(__('Details'), ['action' => 'view', $row['in']['date'],$employee->id]) ?>-->
                        <!--            <?php $date= $row['in']['date']; ?>
                                    <a title = "Attendance logs" onclick = "displayModal('<?= $employee->id ?>','<?= $row['in']['date'] ?>')"><i title="Details" class="fa fa-info-circle fa-lg" id="myBtn"></i></a>
                                    </td>
                                
                                </tr>
                                <?php endforeach; ?>-->
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


