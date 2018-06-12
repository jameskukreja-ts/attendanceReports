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
                        <th scope="row"><?= __('Working Days') ?></th>
                        <td id="workingDays"></td>
                    </tr>
                    <!-- <tr>
                        <th scope="row"><?= __('Full Days') ?></th>
                        <td id="fullDays"></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Half Days') ?></th>
                        <td id="halfDays"></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Absent Days') ?></th>
                        <td id="absentDays"></td>
                    </tr> -->
                    
                </table>
                   
                        <table cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">S. No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Full Days</th>
                                    <th scope="col">Half Days</th>
                                    <th scope="col">Absent Days</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php   $s_no=1;
                                        $date = $startDate;
                                        foreach($report as $employee):
                                        $halfdays=0;
                                        $workingdays=0;
                                        $absents=0;
                                        $fulldays=0;
                                        $data= [];
                                        while($date <= $endDate):
                                            
                                            $in="-";
                                            $out="-";
                                            $duration="-";
                                            $status="";
                                            $weekEnd=date('l',strtotime($date));
                                            if(isset($report[$date->i18nFormat('dd-MM-yyyy')])){
                                                $in=$report[$date->i18nFormat('dd-MM-yyyy')]['in']['time'];
                                                $out=$report[$date->i18nFormat('dd-MM-yyyy')]['out']['time'];
                                                $duration=$report[$date->i18nFormat('dd-MM-yyyy')]['duration'];
                                                if($duration<8&&$duration>=4){
                                                    $status='Halfday';
                                                    $halfdays++;
                                                }elseif($duration<4){
                                                    $status='Absent';
                                                    $absents++;
                                                }else{
                                                     $status='Fullday';
                                                     $fulldays++;
                                                }
                                            }
                                            if(isset($holidays[$date->i18nFormat('dd-MM-yyyy')])){
                                                $status='Holiday';    
                                            }elseif($weekEnd=='Saturday'||$weekEnd=='Sunday'){
                                                $status='Weekend';
                                            }elseif(!isset($report[$date->i18nFormat('dd-MM-yyyy')])){
                                                $status='Absent';
                                                $absents++;
                                            }
                                    ?>


                            <?php 
                                $date = $date->modify('+1 day');
                                endwhile; 
                                $workingdays=$halfdays+$fulldays+$absents;
                                $data[]=[
                                    'absent'=>$absents,
                                    'fullDays'=>$fulldays,
                                    'halfDays'=>$halfdays

                                ];

                               
                            ?>
                            <tr>
                                <td><?=$s_no++?></td>
                                <td><?= $date->i18nFormat('dd-MM-yyyy') ?></td>
                                <td><?= $in ?></td>
                                <td><?= $out ?></td>
                                <td><?=$duration?></td>
                                <td><?=$status?></td>
                            
                            </tr>
                               
                            </tbody>
                        <?php endforeach?>
                        </table>

                    
        </fieldset> 
    <?php endif;?>
</div>
 <script>
 var workingdays=<?php echo $workingdays?>;
 $('#workingDays').html(workingdays);
 var halfdays=<?php echo $halfdays?>;
 $('#halfDays').html(halfdays);
 var fulldays=<?php echo $fulldays?>;
 $('#fullDays').html(fulldays);
 var absentdays=<?php echo $absents?>;
 $('#absentDays').html(absentdays);            
                                       
</script>


