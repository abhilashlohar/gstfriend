<?php
$this->set('title', 'Edit');
?>
<div class="portlet light bordered  col-md-6" >
	<div class="portlet-body-form"  >
		<div class="portlet-title">
			<div class="caption" >
				<legend><?= __('Edit Item') ?></legend>
			</div>
		</div>
		<?= $this->Form->create($item) ?>
		<fieldset>
			<div class="form-body" >
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">Name <span class="required" aria-required="true">*</span></label>
							<?php echo $this->Form->control('name' , ['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Item Name']); ?>
						</div>
						<div class="form-group">
							<label class="control-label">Hsn No.</label>
							<?php echo $this->Form->control('hsn_code',['label' => false,'class' => 'form-control input-sm firstupercase','placeholder'=>'Enter HSN No.']); ?> 
						</div>
						<div class="form-group">
							<label class="control-label">Item Price</label>
							<?php echo $this->Form->control('price',['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Price']); ?> 
						</div>
						<div class="form-group">
							<label class="control-label">GST Type</label>
							<?php echo $this->Form->control('tax_type_id', ['options' => $taxtypes,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Enter Item Name','value'=>$item->tax_type_id]); ?>
						</div>
						<div class="form-group">
							<?php echo $this->Form->control('freezed'); ?>
						</div>
					</div>
				</div> 
			</div>
		</fieldset>
		<div>
			<button type="submit" class="btn btn-primary">Submit
		</div>
		<?= $this->Form->end() ?>
	</div>
</div>    