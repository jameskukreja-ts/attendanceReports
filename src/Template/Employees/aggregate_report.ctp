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
    

    <?php if($employeeDetails): ?>
        <fieldset>
            <legend><?= __('Aggregate Report : '.$startDate->i18nFormat('dd-MM-yyyy').' to '.$endDate->i18nFormat('dd-MM-yyyy')) ?></legend>
                   
                
                   
                        <table cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:70px;">S. No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" style="width:100px;">Full Days</th>
                                    <th scope="col" style="width:100px;">Half Days</th>
                                    <th scope="col" style="width:100px;">Absent Days</th>
                                    <th scope="col" style="width:100px;">Working Days</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            <?php $s_no=1; foreach($employeeDetails as $row):?>
                            <tr>
                                <td><?=$s_no++?></td>
                                <td><?= $row['name']?></td>
                                <td><?= $row['report']['fulldays']?></td>
                                <td><?= $row['report']['halfdays']?></td>
                                <td><?= $row['report']['absents']?></td>
                                <td><?= $row['report']['workingdays']?></td>
                                
                            
                            </tr>
                            <?php endforeach;?>   
                            </tbody>
                        
                        </table>

                    
        </fieldset> 
    <?php endif;?>
</div>



