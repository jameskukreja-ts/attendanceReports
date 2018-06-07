<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>

<div class="employees view large-9 medium-8 columns content" style="margin:0px 0px 0px 140px;">
       
        <?php if (!empty($details)): ?>
         <h4><?= __('Attendance Logs') ?><?= h(": ".$date) ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col">S. No.</th>
                <th scope="col">Time</th>
                <th scope="col">Mode</th>
                
            </tr>
            <?php $i=1; foreach ($details as $detail): ?>
            <tr>
                <td><?php echo $i++ ; ?></td>
                <td><?= h($detail['time']) ?></td>
                <td><?= h($detail['mode']) ?></td>
                
               
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    
</div>
