<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>

<div class="employees form large-9 medium-8 columns content">
    <?= $this->Form->create($attendanceCsv, ['class' => 'form-horizontal', 'enctype'=>"multipart/form-data"]) ?>
    
    
    <?= $this->Form->input('file_name', ['label' => false,'required' => true,['class' => 'form-control'],'type' => "file",'id'=>'imgChange','onchange'=>"checkfile(this);"]); ?>
        
    <?= $this->Form->button(__('Submit'),['class'=>'left'],array('onlcick' => '')) ?>
   
<?php echo $this->Form->end(); ?>

</div>
<script type="text/javascript" language="javascript">
function checkfile(sender) {
    
    var validExts = new Array(".dat", ".csv");
    var fileExt = sender.value;
    fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
    if (validExts.indexOf(fileExt) < 0) {
      alert("Invalid file selected, valid files are of " +
               validExts.toString() + " types.");
      return false;
    }
    else return true;
}
</script>
