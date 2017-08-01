<?php $this->set('title', 'Add Invoice'); ?>
<style>

@media print{
	.maindiv{
		width:100% !important;
	}	
	.hidden-print{
		display:none;
	}
	body {
      -webkit-print-color-adjust: exact;
   }
}
@page {
    size: auto;   /* auto is the initial value */
    margin: 0 5px 0 20px;  /* this affects the margin in the printer settings */
}

p{
	margin-bottom: 0;
}

.tbl td, .tbl th {
    border: 1px solid black;
}
.nbtbl td, .nbtbl th {
    border: none;
}
.tbl th {
    text-align:center;
}
.tbl td {
    padding:3px;
}
</style>
<?= $this->Form->create($invoice) ?>
<div style="width:100%;margin:auto;border:solid 1px;font-family: serif;background-color: #FFF;" class="maindiv">
	
	
	<div align="center" style="padding: 5px 0px;border-top: solid 1px;border-bottom: solid 1px;background-color: #c4151c;font-size:18px;color: #FFF;"><b>TAX INVOICE</b></div>
	<div>
		<table width="100%">
			<tr>
				<td style="border-right:solid 1px;padding:5px;" width="50%" valign="top">
					<table>
						<tr>
							<td><b>Invoice No.</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td>-</td>
						</tr>
						<tr>
							<td><b>Invoice Date</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $this->Form->control('transaction_date',['label'=>false,'placeholder'=>'dd-mm-yyyy','type'=>'text','class'=>'date-picker','data-date-format'=>'dd-mm-yyyy','value'=>date('d-m-Y')]); ?></td>
						</tr>
						<tr>
							<td><b>Sales Account</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $this->Form->control('sales_ledger_id',['label'=>false,'autofocus']); ?></td>
						</tr>
					</table>
				</td>
				<td style="padding:5px;" valign="top">
					<table width="100%">
						<tr>
							<td colspan="3"><b>Bill to Party</b></td>
						</tr>
						<tr>
							<td><b>Name</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $this->Form->control('customer_ledger_id',['label'=>false]); ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
	<div align="center" style="border:none;">
		<table width="100%" class="tbl" id="mainTbl">
			<thead>
				<tr style="background-color: #e4e3e3;">
					<th rowspan="2" style="border-left: none;">Sr. No.</th>
					<th rowspan="2" width="30%">Item Description</th>
					<th rowspan="2" width="80">HSN code</th>
					<th rowspan="2" width="40">Qty</th>
					<th rowspan="2" width="80">Rate</th>
					<th rowspan="2" width="80">Amount</th>
					<th colspan="2">Discount</th>
					<th rowspan="2" width="80">Taxable Value</th>
					<th colspan="2">CGST</th>
					<th colspan="2">SGST</th>
					<th rowspan="2" style="border-right: none;" width="80">Total</th>
				</tr>
				<tr style="background-color: #e4e3e3;">
					<th width="80">Rate</th>
					<th width="80">Amount</th>
					<th width="80">Rate</th>
					<th width="80">Amount</th>
					<th width="80">Rate</th>
					<th width="80">Amount</th>
				</tr>
			</thead>
			<tbody id="mainTbody">
				
			</tbody>
		</table>
		<table width="100%" class="tbl">
			<tbody>
				<tr>
					<td rowspan="4" style="border-left: none;border-top: none;border-bottom: none;" width="70%" valign="top">
						<button type="button" class="btn blue-hoki  btn-xs addrow"><i class="fa fa-plus"></i> Add row</button>
					</td>
					<td style="text-align:right;border-top: none;"><b>Total Amount before Tax</b></td>
					<td style="text-align:right;border-right: none;border-top: none;" width="80">
						<?php echo $this->Form->control('total_amount_before_tax',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 80px;border: none;text-align: right;','tabindex'=>'-1']); ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Total CGST</b></td>
					<td style="text-align:right;border-right: none;">
						<?php echo $this->Form->control('total_cgst',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 80px;border: none;text-align: right;','tabindex'=>'-1']); ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Total SGST</b></td>
					<td style="text-align:right;border-right: none;">
						<?php echo $this->Form->control('total_sgst',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 80px;border: none;text-align: right;','tabindex'=>'-1']); ?>
					</td>
				</tr>
				<tr>
					<td style="text-align:right;border-bottom: none;"><b>Total Amount after Tax</b></td>
					<td style="text-align:right;border-right: none;border-bottom: none;">
						<?php echo $this->Form->control('total_amount_after_tax',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 80px;text-align: right;border: none;','tabindex'=>'-1']); ?>	
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div align="center"><?= $this->Form->button(__('Generate Invoice'),['class'=>'btn green']) ?></div>
<?= $this->Form->end() ?>

<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() {
	add_row();
	$('.addrow').live("click",function() {
		add_row();
	});
	
	$('.viewThisResult').live("click",function() {
		$(this).closest("tr").remove();
		rename_rows();
	});
	
	function add_row(){
		var tr=$("#sampleTbl tbody tr").clone();
		$("#mainTbl tbody#mainTbody").append(tr);
		$("#mainTbl tbody#mainTbody tr.mainTr:last").find('td:eq(1) input').focus();
		rename_rows();
	}
	
	function rename_rows(){
		var i=0;
		$("#mainTbl tbody#mainTbody tr.mainTr").each(function(){
			$(this).find("td:eq(0) span.sr").html(++i); i--;
			$(this).find("td:eq(1) select").attr({name:"invoice_rows["+i+"][item_id]", id:"invoice_rows-"+i+"-item_id"});
			$(this).find("td:eq(2) input").attr({name:"invoice_rows["+i+"][hsn_code]", id:"invoice_rows-"+i+"-hsn_code"});
			$(this).find("td:eq(3) input").attr({name:"invoice_rows["+i+"][quantity]", id:"invoice_rows-"+i+"-quantity"});
			$(this).find("td:eq(4) input").attr({name:"invoice_rows["+i+"][rate]", id:"invoice_rows-"+i+"-rate"});
			$(this).find("td:eq(5) input").attr({name:"invoice_rows["+i+"][amount]", id:"invoice_rows-"+i+"-amount"});
			$(this).find("td:eq(6) input").attr({name:"invoice_rows["+i+"][discount_rate]", id:"invoice_rows-"+i+"-discount_rate"});
			$(this).find("td:eq(7) input").attr({name:"invoice_rows["+i+"][discount_amount]", id:"invoice_rows-"+i+"-discount_amount"});
			$(this).find("td:eq(8) input").attr({name:"invoice_rows["+i+"][taxable_value]", id:"invoice_rows-"+i+"-taxable_value"});
			$(this).find("td:eq(9) input").attr({name:"invoice_rows["+i+"][cgst_rate]", id:"invoice_rows-"+i+"-cgst_rate"});
			$(this).find("td:eq(10) input").attr({name:"invoice_rows["+i+"][cgst_amount]", id:"invoice_rows-"+i+"-cgst_amount"});
			$(this).find("td:eq(11) input").attr({name:"invoice_rows["+i+"][sgst_rate]", id:"invoice_rows-"+i+"-sgst_rate"});
			$(this).find("td:eq(12) input").attr({name:"invoice_rows["+i+"][sgst_amount]", id:"invoice_rows-"+i+"-sgst_amount"});
			$(this).find("td:eq(13) input").attr({name:"invoice_rows["+i+"][total]", id:"invoice_rows-"+i+"-total"});
		i++;
		});
		calculation();
	}
	
	$('.calculate').live("keyup",function() {
		calculation();
	});
	
	function calculation(){
		var total_amount_before_tax=0;
		var total_cgst=0;
		var total_sgst=0;
		var total_amount_after_tax=0;
		$("#mainTbl tbody#mainTbody tr.mainTr").each(function(){
			var quantity=parseFloat($(this).find("td:eq(3) input").val());
			if(!quantity){ quantity=0; }
			var rate=parseFloat($(this).find("td:eq(4) input").val());
			if(!rate){ rate=0; }
			var amount=parseFloat(quantity*rate).toFixed(2);
			$(this).find("td:eq(5) input").val(amount);
			
			var discount_rate=parseFloat($(this).find("td:eq(6) input").val());
			if(!discount_rate){ discount_rate=0; }
			var discount_amount=parseFloat(amount*discount_rate/100).toFixed(2);
			
			$(this).find("td:eq(7) input").val(discount_amount);
			
			var taxable_value=parseFloat(amount-discount_amount);
			$(this).find("td:eq(8) input").val(taxable_value);
			
			total_amount_before_tax=total_amount_before_tax+taxable_value;
			
			var cgst_rate=parseFloat($(this).find("td:eq(9) input").val());
			if(!cgst_rate){ cgst_rate=0; }
			var cgst_amount=parseFloat(taxable_value*cgst_rate/100).toFixed(2);
			total_cgst=parseFloat(total_cgst)+parseFloat(cgst_amount);
			
			$(this).find("td:eq(10) input").val(cgst_amount);
			
			var sgst_rate=parseFloat($(this).find("td:eq(11) input").val());
			if(!sgst_rate){ sgst_rate=0; }
			var sgst_amount=parseFloat(taxable_value*sgst_rate/100).toFixed(2);
			total_sgst=parseFloat(total_sgst)+parseFloat(sgst_amount);
			
			$(this).find("td:eq(12) input").val(sgst_amount);
			
			var total=parseFloat(taxable_value)+parseFloat(cgst_amount)+parseFloat(sgst_amount);
			$(this).find("td:eq(13) input").val(total.toFixed(2));
			total_amount_after_tax=total_amount_after_tax+total;
			
		});
		$('input[name="total_amount_before_tax"]').val(total_amount_before_tax.toFixed(2));
		$('input[name="total_cgst"]').val(total_cgst.toFixed(2));
		$('input[name="total_sgst"]').val(total_sgst.toFixed(2));
		$('input[name="total_amount_after_tax"]').val(total_amount_after_tax.toFixed(2));
	}
	
	$('.revCalculate').live("keyup",function() {
		reverseCalculation();
	});
	
	function reverseCalculation(){
		var total_amount_before_tax=0;
		var total_cgst=0;
		var total_sgst=0;
		var total_amount_after_tax=0;
		$("#mainTbl tbody#mainTbody tr.mainTr").each(function(){
			var total=parseFloat($(this).find("td:eq(13) input").val());
			if(!total){ total=0; }
			
			var cgst_rate=parseFloat($(this).find("td:eq(9) input").val());
			if(!cgst_rate){ cgst_rate=0; }
			
			var sgst_rate=parseFloat($(this).find("td:eq(11) input").val());
			if(!sgst_rate){ sgst_rate=0; }
			
			var to_be_divide=parseFloat(cgst_rate)+parseFloat(sgst_rate)+100;
			
			var taxable_value=(total/to_be_divide)*100;
			
			$(this).find("td:eq(8) input").val(taxable_value.toFixed(2));
			
			var discount_rate=parseFloat($(this).find("td:eq(6) input").val());
			if(!discount_rate){ discount_rate=0; }
			
			var to_be_divide_for_discount=100-parseFloat(discount_rate);
			var amount=(taxable_value/to_be_divide_for_discount)*100;
			
			$(this).find("td:eq(5) input").val(amount.toFixed(2));
			
			var quantity=parseFloat($(this).find("td:eq(3) input").val());
			if(!quantity){ quantity=0; }
			
			var rate=amount/quantity;
			$(this).find("td:eq(4) input").val(rate.toFixed(2));
			
			var discount_amount=(amount*discount_rate)/100;
			$(this).find("td:eq(7) input").val(discount_amount.toFixed(2));
			
			var cgst_amount=(taxable_value*cgst_rate)/100;
			$(this).find("td:eq(10) input").val(cgst_amount.toFixed(2));
			
			var sgst_amount=(taxable_value*sgst_rate)/100;
			$(this).find("td:eq(12) input").val(sgst_amount.toFixed(2));
			
			total_amount_before_tax=total_amount_before_tax+taxable_value;
			total_cgst=parseFloat(total_cgst)+parseFloat(cgst_amount);
			total_sgst=parseFloat(total_sgst)+parseFloat(sgst_amount);
			total_amount_after_tax=total_amount_after_tax+total;
		});
		$('input[name="total_amount_before_tax"]').val(total_amount_before_tax.toFixed(2));
		$('input[name="total_cgst"]').val(total_cgst.toFixed(2));
		$('input[name="total_sgst"]').val(total_sgst.toFixed(2));
		$('input[name="total_amount_after_tax"]').val(total_amount_after_tax.toFixed(2));
	}
	
	$('input[name="party_name"]').focus();
});
</script>
<style>
.mainTr:hover .viewThisResult { display: block; }
.mainTr:hover .sr { display: none; }
.viewThisResult { display: none; }
</style>
<table id="sampleTbl" style="display:none;">
	<tbody>
		<tr class="mainTr">
			<td style="text-align:center;border-left: none;">
				<span class="sr"></span>
				<button type="button" class="btn btn-xs red viewThisResult" role="button"><i class="fa fa-times"></i></button>
			</td>
			<td>
				<?php echo $this->Form->control('item_id',['label'=>false,'style'=>'width: 100%;resize: none;']); ?>
			</td>
			<td>
				<?php echo $this->Form->control('hsn_code',['label'=>false,'placeholder'=>'HSN code','style'=>'width: 100%;']); ?>
			</td>
			<td style="text-align:center;">
				<?php echo $this->Form->control('quantity',['label'=>false,'placeholder'=>'Qty','style'=>'width: 100%;text-align: center;']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('rate',['label'=>false,'placeholder'=>'Rate','style'=>'width: 100%;text-align: right;','class'=>'calculate']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('amount',['label'=>false,'placeholder'=>'Amount','style'=>'width: 100%;text-align: right;border: none;','tabindex'=>'-1']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('discount_rate',['label'=>false,'placeholder'=>'%','style'=>'width: 100%;text-align: right;','class'=>'revCalculate']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('discount_amount',['label'=>false,'placeholder'=>'0.00','style'=>'width: 100%;text-align: right;border: none;','tabindex'=>'-1']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('taxable_value',['label'=>false,'placeholder'=>'Taxable Value','style'=>'width: 100%;text-align: right;border: none;','tabindex'=>'-1']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('cgst_rate',['label'=>false,'placeholder'=>'%','value'=>'6','style'=>'width: 100%;text-align: right;','class'=>'revCalculate']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('cgst_amount',['label'=>false,'placeholder'=>'0.00','style'=>'width: 100%;text-align: right;border: none;','tabindex'=>'-1']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('sgst_rate',['label'=>false,'placeholder'=>'%','value'=>'6','style'=>'width: 100%;text-align: right;','class'=>'revCalculate']); ?>
			</td>
			<td style="text-align:right;">
				<?php echo $this->Form->control('sgst_amount',['label'=>false,'placeholder'=>'0.00','style'=>'width: 100%;text-align: right;border: none;','tabindex'=>'-1']); ?>
			</td>
			<td style="text-align:right;border-right: none;">
				<?php echo $this->Form->control('total',['label'=>false,'placeholder'=>'Total','style'=>'width: 100%;text-align: right;','class'=>'revCalculate']); ?>
			</td>
		</tr>
	</tbody>
</table>
<!-- BEGIN PAGE LEVEL STYLES -->
<?php echo $this->Html->css('/assets/global/plugins/clockface/css/clockface.css', ['block' => 'cssComponentsPickers']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css', ['block' => 'cssComponentsPickers']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css', ['block' => 'cssComponentsPickers']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css', ['block' => 'cssComponentsPickers']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css', ['block' => 'cssComponentsPickers']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css', ['block' => 'cssComponentsPickers']); ?>
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/clockface/js/clockface.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/moment.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsPickers']); ?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js', ['block' => 'PAGE_LEVEL_SCRIPTS_ComponentsPickers']); ?>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
	jQuery(document).ready(function() {  
		// initiate layout and plugins
		Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		QuickSidebar.init(); // init quick sidebar
		Demo.init(); // init demo features
		ComponentsPickers.init();
	});   
</script>