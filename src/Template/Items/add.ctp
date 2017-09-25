<?php
$this->set('title', 'Add');

?>
<div class="portlet light bordered  col-md-6" >
	<div class="portlet-body-form"  >
		<?= $this->Form->create($item) ?>
		<fieldset>
			<legend><?= __('Add Item') ?></legend>
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
							<label class="control-label">Sale Price </label>
							<?php echo $this->Form->control('price',['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Sale Price']); ?>
							<label class="control-label">Purchase Price </label>
							<?php echo $this->Form->control('purchase_price',['label' => false,'type'=>'text','class' => 'form-control input-sm firstupercase','placeholder'=>'Enter Purchase Price']); ?>		
						</div>
						<div class="form-group">
							<label class="control-label">GST Type</label>
							<?php echo $this->Form->control('tax_type_id', ['options' => $taxtypes,'label' => false,'class' => 'form-control input-sm select2me','placeholder'=>'Enter Item Name']); ?>
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