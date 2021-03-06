<?php $this->set('title', 'Add Invoice'); ?>
<style>
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

.hide { display:none; }
</style>
<?= $this->Form->create($invoice,['id'=>'form_3']) ?>
<div style="width:100%;margin:auto;border:solid 1px;font-family: serif;background-color: #FFF;" class="maindiv">
	
	
	<div align="center" style="padding: 5px 0px;border-top: solid 1px;border-bottom: solid 1px;background-color: #c4151c;font-size:18px;color: #FFF;"><b>TAX INVOICE</b></div>
	<div>
		<table width="100%">
			<tr>
				<td style="border-right:solid 1px;padding:5px;" width="50%" valign="top">
					<table>
						<tr>
							<td><div><b>Invoice Type</b></div></br></td>
							<td><div>&nbsp;:&nbsp;</div></br></td>
							<td>
								<div class="radio-list">
									<label class="radio-inline">
									<div class="radio" id="uniform-optionsRadios25"><span class="checked"><input type="radio" name="invoicetype" id="invoicetype" value="Cash"checked></span></div> Cash </label>
								</div></br>
							</td>
						</tr>
						<tr>
							<td style='width: 21%;padding-bottom: 5px;'><b> Last Invoice No : </b></td>
							<td style='padding-bottom: 5px;'>&nbsp;:&nbsp;</td>
							<td style='padding-bottom: 5px;'><b> <?php echo $invoice_no; ?> </b></td>
						</tr>
						<tr>
							<td><b>Invoice Date</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $this->Form->control('transaction_date',['label'=>false,'placeholder'=>'dd-mm-yyyy','type'=>'text','class'=>'date-picker form-control input-sm','data-date-format'=>'dd-mm-yyyy','value'=>date('d-m-Y')]); ?></td>
							<td class="hide"><b>Vehicle No.</b></td>
							<td class="hide" style="padding:5px;">&nbsp;:&nbsp;</td>
							<td class="hide" style="padding:5px;"><?php echo $this->Form->control('reference_no',['label'=>false,'placeholder'=>'Reference no','class'=>'form-control input-sm']); ?></td>
							<td><b>Delievery Date</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td><?php echo $this->Form->control('delievery_date',['label'=>false,'placeholder'=>'dd-mm-yyyy','type'=>'text','class'=>'date-picker form-control input-sm','data-date-format'=>'dd-mm-yyyy','value'=>date('d-m-Y')]); ?></td>
						</tr>
						<tr>
							<td ><b>State</b></td>
							<td style="padding:5px;">&nbsp;:&nbsp;</td>
							<td style="padding:5px;"><?php echo $this->Form->control('state',['label'=>false,'placeholder'=>'State ','class'=>'form-control input-sm']); ?></td>
							<td ><b>Code</b></td>
							<td style="padding:5px;">&nbsp;:&nbsp;</td>
							<td style="padding:5px;"><?php echo $this->Form->control('state_code',['label'=>false,'placeholder'=>'code ','class'=>'form-control input-sm']); ?></td>
						</tr>
						<tr >
							<td> <span class='hide'> <b>Sales Account</b> </span> </td>
							<td><span class='hide'>&nbsp;:&nbsp; </span></td>
							<td><?php echo $this->Form->control('sales_ledger_id',['label'=>false,'autofocus','class'=>'form-control input-sm hide','options'=>$salesLedgers]); ?></td>
						</tr>
					</table>
				</td>
				<td style="padding:5px;" >
					<table width="100%">
						
						<tr id='cashshow'>
							<td style='padding-bottom: 5px;'><b>Bill to Party Name</b></td>
							<td style='padding-bottom: 5px;'>&nbsp;:&nbsp;</td>
							<td class="form-group" style='padding-bottom: 5px;'><?php echo $this->Form->control('customer_name',['label'=>false,'class'=>'form-control input-sm ']); ?></td>
							<td style='padding-bottom: 5px;'><b>Mobile No.</b></td>
							<td style='padding-bottom: 5px;'>&nbsp;:&nbsp;</td>
							<td class="form-group" style='padding-bottom: 5px;'><?php echo $this->Form->control('mobile_no',['type'=>'text','label'=>false,'class'=>'form-control input-sm']); ?></td>
						</tr>
						<tr id='cashshow' >
							<td style='padding-bottom: 5px;'><b>Consumer No.</b></td>
							<td style='padding-bottom: 5px;'>&nbsp;:&nbsp;</td>
							<td class="form-group" style='padding-bottom: 5px;'><?php echo $this->Form->control('consumerno',['type'=>'text','label'=>false,'class'=>'form-control input-sm']); ?></td>
							<td style='padding-bottom: 5px;'><b>SV No.</b></td>
							<td style='padding-bottom: 5px;'>&nbsp;:&nbsp;</td>
							<td class="form-group" style='padding-bottom: 5px;'><?php echo $this->Form->control('su_no',['label'=>false,'class'=>'form-control input-sm']); ?></td>
							
						</tr>
						<tr id='cashshow'>
							<td style='padding-bottom: 5px;'><b>Address</b></td>
							<td style='padding-bottom: 5px;'>&nbsp;:&nbsp;</td>
							<td class="form-group" style='padding-bottom: 5px;' colspan="4"><?php echo $this->Form->control('address',['label'=>false,'class'=>'form-control input-sm']); ?></td>
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
					<th rowspan="2" width="350">Item Description</th>
					<th rowspan="2" width="100" >HSN code</th>
					<th rowspan="2" width="100">Qty</th>
					<th rowspan="2" width="100">Rate</th>
					<th rowspan="2" width="80">Amount</th>
					<th rowspan="2" width="130">Discount Amount </th>
					<th rowspan="2" width="100">Taxable Value</th>
					<th colspan="2">CGST</th>
					<th colspan="2">SGST</th>
					<th colspan="2" class="hide">IGST</th>					
					<th rowspan="2" style="border-right: none;" width="80">Total</th>
				</tr>
				<tr style="background-color: #e4e3e3;">
					<th width="80">Rate</th>
					<th width="80">Amount</th>
					<th width="80">Rate</th>
					<th width="80">Amount</th>
					<th width="80" class="hide">Rate</th>
					<th width="80" class="hide">Amount</th>					
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
				<tr class="hide">
					<td style="text-align:right;" class="hide"><b>Total IGST</b></td>
					<td style="text-align:right;border-right: none;" class="hide">
						<?php echo $this->Form->control('total_igst',['label'=>false,'type'=>'tax','placeholder'=>'0.00','style'=>'width: 65px;border: none;text-align: right;','tabindex'=>'-1']); ?>
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
<?php foreach($items as $item){
		}
	?>
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<script>
$(document).ready(function() {
	var form3 = $('#form_3');
	var error3 = $('.alert-danger', form3);
	var success3 = $('.alert-success', form3);
	form3.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block help-block-error', // default input error message class
		focusInvalid: true, // do not focus the last invalid input
		
		rules: {
			transaction_date : {
				  required: true,
			},
			customer_ledger_id : {
				  required: true,
			},
			quantity:{
				required: true,	
			},
			rate:{
				required: true,	
			},
			discount_amount:{
				required: true,	
			},
			customer_name:{
				required: true,	
			},
			item_id: {
				required: true,
			},
			cgst_ledger_id: {
				required: true,
			},
			sgst_ledger_id: {
				required: true,
			}
		},

		
		errorPlacement: function (error, element) { // render error placement for each input type
			if (element.parent(".input-group").size() > 0) {
				error.insertAfter(element.parent(".input-group"));
			} else if (element.attr("data-error-container")) { 
				error.appendTo(element.attr("data-error-container"));
			} else if (element.parents('.radio-list').size() > 0) { 
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			} else if (element.parents('.radio-inline').size() > 0) { 
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			} else if (element.parents('.checkbox-list').size() > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			} else if (element.parents('.checkbox-inline').size() > 0) { 
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			} else {
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},

		invalidHandler: function (event, validator) { //display error alert on form submit   
			success3.hide();
			error3.show();
			//Metronic.scrollTo(error3, -200);
		},

		highlight: function (element) { // hightlight error inputs
		   $(element)
				.closest('.form-group').addClass('has-error'); // set error class to the control group
		},

		unhighlight: function (element) { // revert the change done by hightlight
			$(element)
				.closest('.form-group').removeClass('has-error'); // set error class to the control group
		},

		success: function (label) {
			label
				.closest('.form-group').removeClass('has-error'); // set success class to the control group
		},

		submitHandler: function (form3) {

			form3[0].submit(); // submit the form
		}

	});
	//--	 END OF VALIDATION
	
	calculation();
	add_row();
	$('.addrow').live("click",function() {
		add_row();
	});
	
	$('.viewThisResult').live("click",function() {
		$(this).closest("tr").remove();
		rename_rows();
		calculation();
	});
	
	function add_row(){
		var tr=$("#sampleTbl tbody tr").clone();
		$("#mainTbl tbody#mainTbody").append(tr);
		$("#mainTbl tbody#mainTbody tr.mainTr:last").find('td:eq(1) input').focus();
		rename_rows();
		calculation();
	}
	
	function rename_rows(){
		var i=0;
		$("#mainTbl tbody#mainTbody tr.mainTr").each(function(){
			$(this).find("td:eq(0) span.sr").html(++i); i--;
			$(this).find("td:nth-child(2) select").select2().attr({name:"invoice_rows["+i+"][item_id]", id:"invoice_rows-"+i+"-item_id"}).rules("add","required");
			$(this).find("td:eq(2) input").attr({name:"invoice_rows["+i+"][hsncode]", id:"invoice_rows-"+i+"-hsncode"}).rules("add","required");
			$(this).find("td:eq(3) input").attr({name:"invoice_rows["+i+"][quantity]", id:"invoice_rows-"+i+"-quantity"}).rules("add","required");
			$(this).find("td:eq(4) input").attr({name:"invoice_rows["+i+"][rate]", id:"invoice_rows-"+i+"-rate"}).rules("add","required");
			$(this).find("td:eq(5) input").attr({name:"invoice_rows["+i+"][amount]", id:"invoice_rows-"+i+"-amount"}).rules("add","required");
			
			$(this).find("td:eq(6) input").attr({name:"invoice_rows["+i+"][discount_amount]", id:"invoice_rows-"+i+"-discount_amount"});
			$(this).find("td:eq(7) input").attr({name:"invoice_rows["+i+"][taxable_value]", id:"invoice_rows-"+i+"-taxable_value"}).rules("add","required");
			$(this).find("td:eq(8) select").attr({name:"invoice_rows["+i+"][cgst_rate]", id:"invoice_rows-"+i+"-cgst_rate"}).rules("add","required");
			$(this).find("td:eq(9) input").attr({name:"invoice_rows["+i+"][cgst_amount]", id:"invoice_rows-"+i+"-cgst_amount"}).rules("add","required");
			$(this).find("td:eq(10) select").attr({name:"invoice_rows["+i+"][sgst_rate]", id:"invoice_rows-"+i+"-sgst_rate"}).rules("add","required");
			$(this).find("td:eq(11) input").attr({name:"invoice_rows["+i+"][sgst_amount]", id:"invoice_rows-"+i+"-sgst_amount"}).rules("add","required");
			$(this).find("td:eq(12) select").attr({name:"invoice_rows["+i+"][igst_ledger_id]", id:"invoice_rows-"+i+"-igst_ledger_id"}).rules("add","required");
			
			$(this).find("td:eq(13) input").attr({name:"invoice_rows["+i+"][igst_amount]", id:"invoice_rows-"+i+"-igst_amount"}).rules("add","required");
			$(this).find("td:eq(14) input").attr({name:"invoice_rows["+i+"][total]", id:"invoice_rows-"+i+"-total"}).rules("add","required");
		i++;
		});
		calculation();
	}
	
	$('.calculate').live("keyup",function() {
		calculation();
	});
	
	$('#mainTbl input').die().live("keyup","blur",function() { 
		calculation();
	});	

	$('#mainTbl select').die().live("change","blur",function() { 
		calculation();
	});		
	
	function calculation(){ 
		var total_amount_before_tax=0;
		var total_cgst=0;
		var total_sgst=0;
		var total_igst=0;
		var total_amount_after_tax=0;
		$("#mainTbl tbody#mainTbody tr.mainTr").each(function(){ 
			var quantity=parseFloat($(this).find("td:eq(3) input").val());
			if(!quantity){ quantity=0; }
			var rate=parseFloat($(this).find("td:eq(4) input").val());
			if(!rate){ rate=0; }
			var amount1 = rate * quantity;
		
			var amount=parseFloat($(this).find("td:eq(5) input").val(amount1.toFixed(2)));
			var discount_amount=parseFloat($(this).find("td:eq(6) input").val());
			if(!discount_amount){ discount_amount=0; }
			var totalvalue=amount1-discount_amount;
			var total=parseFloat($(this).find("td:eq(14) input").val(totalvalue.toFixed(2)));
			if(!total){ total=0; }
			total_amount_after_tax=total_amount_after_tax+totalvalue;
			
			
			var sgst_rate=parseFloat($(this).find("td:eq(10) option:selected").attr('tax_rate'));
			if(!sgst_rate){ sgst_rate=0; }
			var sgst_per=parseFloat(sgst_rate);
			
			var cgst_rate=parseFloat($(this).find("td:eq(8) option:selected").attr('tax_rate'));
			if(!cgst_rate){ cgst_rate=0; }
			var cgst_per=parseFloat(cgst_rate);
			
			var igst_ledger_id=parseFloat($(this).find("td:eq(12) option:selected").attr('tax_rate'));
			if(!igst_ledger_id){ igst_ledger_id=0; }
			var igst_per=parseFloat(igst_ledger_id);
			
			var total_tax=parseFloat(sgst_per)+parseFloat(cgst_per)+parseFloat(igst_per);
			//tax value calculate start
			var taxable_value =  (totalvalue/((total_tax)+100))*100;
			
			$(this).find("td:eq(7) input").val(taxable_value.toFixed(2));
			var cgst_amount = taxable_value * (cgst_per/100);
			$(this).find("td:eq(9) input").val(cgst_amount.toFixed(2));
			total_cgst=parseFloat(total_cgst)+parseFloat(cgst_amount);

			var sgst_amount = taxable_value * (sgst_per/100);
			$(this).find("td:eq(11) input").val(sgst_amount.toFixed(2));
			total_sgst=parseFloat(total_sgst)+parseFloat(sgst_amount);
			
			var igst_amount = taxable_value * (igst_per/100);
			$(this).find("td:eq(13) input").val(igst_amount.toFixed(2));
			total_igst=parseFloat(total_igst)+parseFloat(igst_amount);	
			
			total_amount_before_tax=total_amount_before_tax+taxable_value;			
		});
		$('input[name="total_amount_after_tax"]').val(total_amount_after_tax.toFixed(2));
		$('input[name="total_cgst"]').val(total_cgst.toFixed(2));
		$('input[name="total_sgst"]').val(total_sgst.toFixed(2));
		$('input[name="total_igst"]').val(total_igst.toFixed(2));
		$('input[name="total_amount_before_tax"]').val(total_amount_before_tax.toFixed(2));
	}
	
	//change value on change quantity start
	$(".change_qty").live('keyup',function(){ 
		
			var discount = $(this).closest('tr').find(".discount").val();
			if(!discount){ discount=0; }
			var quantity=parseFloat($(this).val());

			if(!quantity){ quantity=0; }
			var discount=discount*quantity;
			$(this).closest('tr').find(".discount").val(discount.toFixed(2));
		
	calculation();
	});
	//change value on change quantity end
	

	
	
	//$('input[name="party_name"]').focus();

	
	
	myfunc();
	$("input[type='radio']").click(function(){
		myfunc();
    });
	
	function myfunc()
	{
		var radioValue = $("input[name='invoicetype']:checked").val();
		if(radioValue == 'Cash'){
			
			$("#customer-ledger-id").val("");
			
			$('.item').die().live("change",function() { 
			var hsncode = $(this).find('option:selected').attr('hsncode');
			var rate = $(this).find('option:selected').attr('rate');
			var cgst_ledger_id = $(this).find('option:selected').attr('cgst_ledger_id');
			var sgst_ledger_id = $(this).find('option:selected').attr('sgst_ledger_id');
			var igst_ledger_id = $(this).find('option:selected').attr('igst_ledger_id');
			
			if(cgst_ledger_id == 0 || sgst_ledger_id == 0)
			{
				$(this).closest('tr').find('.gst').hide();
				
			}
			else
			{
				$(this).closest('tr').find('.gst').show();
				
			}
			if(igst_ledger_id == 0)
			{
				$(this).closest('tr').find('.igst').hide();
				
			}
			else
			{
				$(this).closest('tr').find('.igst').show();
				
			}			
			
			
				$(this).closest('tr').find('td .hsncode').val(hsncode);
				$(this).closest('tr').find('td .rate').val(rate);
				$(this).closest('tr').find('td .cgst_rate').val(cgst_ledger_id);
				$(this).closest('tr').find('td .sgst_rate').val(sgst_ledger_id);
				$(this).closest('tr').find('td .igst_rate').val(igst_ledger_id);
			calculation();
		});
				
		}
		else{ 
			$("#customer-name").val("");
			$('.item').die().live("change",function() {  
				
				var hsncode = $(this).find('option:selected').attr('hsncode');
				var rate = $(this).find('option:selected').attr('rate');
				var cgst_ledger_id = $(this).find('option:selected').attr('cgst_ledger_id');
				var sgst_ledger_id = $(this).find('option:selected').attr('sgst_ledger_id');
				var igst_ledger_id = $(this).find('option:selected').attr('igst_ledger_id');

				if(cgst_ledger_id == 0 || sgst_ledger_id == 0)
				{
					$(this).closest('tr').find('.gst').hide();
					
				}
				else
				{
					$(this).closest('tr').find('.gst').show();
					
				}
				if(igst_ledger_id == 0)
				{
					$(this).closest('tr').find('.igst').hide();
					
				}
				else
				{
					$(this).closest('tr').find('.igst').show();
					
				}


				$(this).closest('tr').find('td .hsncode').val(hsncode);
				$(this).closest('tr').find('td .rate').val(rate);
				$(this).closest('tr').find('td .cgst_rate').val(cgst_ledger_id);
				$(this).closest('tr').find('td .sgst_rate').val(sgst_ledger_id);
				$(this).closest('tr').find('td .igst_rate').val(igst_ledger_id);

			
				var customer = $(".cstmr").find('option:selected').val();
				var item = $(this).find('option:selected').val();
				var obj = $(this);
				var url="<?php echo $this->Url->build(['controller'=>'Invoices','action'=>'CustomerDiscount']);?>";
				if(customer != '')
				{
					url=url+'/'+customer+'/'+item;
					$.ajax({ 
							url:url,
							type:"GET",
						}).done(function(response){
							obj.closest('tr').find('td .discount').val(response);
							obj.closest('tr').find('td .discountvalue').val(response);
							calculation();
						});
				}
				else{
					alert('Please Select Customer');
					obj.closest('tr').find('td .hsncode').val('');
					obj.closest('tr').find('td .rate').val('');
					obj.closest('tr').find('td .total_cgst').val('');
					obj.closest('tr').find('td .sgst_rate').val('');					
					obj.val('').select2();
					return false;
				}		
			});					
		}
	}
    	
});
</script>

<table id="sampleTbl" style="display:none;">
	<tbody>
		<tr class="mainTr">
			<td style="text-align:center;border-left: none;">
				<span class="sr"></span>
				<button type="button" class="btn btn-xs red viewThisResult" role="button"><i class="fa fa-times"></i></button>
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('item_id',['empty'=>"----select----",'options'=>$items,'label'=>false,'style'=>'width: 100%;resize: none;','class'=>'form-control input-sm item ']); ?>
			</td>
			<td class="form-group">
				<?php echo $this->Form->control('hsncode',['label'=>false,'placeholder'=>'HSN code','style'=>'width: 100%;','class'=>'form-control input-sm hsncode','id'=>'hsncode','readonly']); ?>
			</td>
			<td style="text-align:center;" class="form-group">
				<?php echo $this->Form->control('quantity',['label'=>false,'placeholder'=>'Qty','style'=>'width: 100%;text-align: center;','class'=>'form-control input-sm change_qty','value'=>1]); ?>
			</td>
			<td style="text-align:right;" class="form-group">
				<?php echo $this->Form->control('rate',['label'=>false,'placeholder'=>'Rate','style'=>'width: 100%;text-align: right;','class'=>'calculate rate form-control input-sm']); ?>
			</td>
			<td style="text-align:right;" class="form-group">
				<?php echo $this->Form->control('amount',['label'=>false,'placeholder'=>'Amount','style'=>'width: 100%;text-align: right;border: none;','tabindex'=>'-1','class'=>'form-control input-sm']); ?>
			</td>
			<td style="text-align:right;" class="form-group">
				<?php echo $this->Form->control('discount_amount',['label'=>false,'placeholder'=>'0.00','style'=>'width: 100%;text-align: right;border: none;','class'=>'form-control discount input-sm']); ?>
				<?php echo $this->Form->control('dicountvalue',['label'=>false,'placeholder'=>'0.00','type'=>'hidden','style'=>'width: 100%;text-align: right;border: none;','class'=>'form-control discountvalue input-sm']); ?>
			</td>
			<td style="text-align:right;" class="form-group">
				<?php echo $this->Form->control('taxable_value',['label'=>false,'placeholder'=>'Taxable Value','style'=>'width: 100%;text-align: right;border: none;','tabindex'=>'-1','class'=>'form-control input-sm']); ?>
			</td>
			<td style="text-align:right;" class="form-group ">
				<?php echo $this->Form->control('cgst_rate',['empty' => "---Select---",'label'=>false,'class'=>'form-control input-sm cgst_rate gst','style'=>'width: 80px;border: none;text-align: right;','options'=>$taxs_CGST]); ?>
			</td>
			<td style="text-align:right;" class="form-group ">
				<?php echo $this->Form->control('cgst_amount',['label'=>false,'placeholder'=>'0.00','style'=>'width: 100%;text-align: right;border: none;','tabindex'=>'-1','class'=>'form-control input-sm gst']); ?>
			</td>
			<td style="text-align:right;" class="form-group ">
				<?php echo $this->Form->control('sgst_rate',['empty' => "---Select---",'label'=>false,'class'=>'form-control input-sm sgst_rate gst','style'=>'width: 80px;border: none;text-align: right;','options'=>$taxs_SGST]); ?>
			</td>
			<td style="text-align:right;" class="form-group ">
				<?php echo $this->Form->control('sgst_amount',['label'=>false,'placeholder'=>'0.00','style'=>'width: 100%;text-align: right;border: none;','tabindex'=>'-1','class'=>'form-control gst input-sm']); ?>
			</td>
			<td style="text-align:right;" class="form-group hide">
				<?php echo $this->Form->control('igst_ledger_id',['empty' => "---Select---",'label'=>false,'class'=>'form-control input-sm igst igst_rate','style'=>'width: 80px;border: none;text-align: right;','options'=>$taxs_IGST]); ?>
			</td>
			<td style="text-align:right;" class="form-group hide">
				<?php echo $this->Form->control('igst_amount',['label'=>false,'placeholder'=>'0.00','style'=>'width: 100%;text-align: right;border: none;','tabindex'=>'-1','class'=>'form-control igst input-sm']); ?>
			</td>
			<td style="text-align:right;border-right: none;">
				<?php echo $this->Form->control('total',['label'=>false,'placeholder'=>'Total','style'=>'width: 100%;text-align: right;','class'=>'revCalculate','class'=>'form-control  input-sm']); ?>
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
<?php echo $this->Html->script('/assets/global/plugins/jquery-validation/js/jquery.validate.min.js'); ?>
<?php echo $this->Html->script('/assets/admin/pages/scripts/form-validation.js'); ?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php echo $this->Html->script('/assets/admin/pages/scripts/components-pickers.js', ['block' => 'PAGE_LEVEL_SCRIPTS_ComponentsPickers']); ?>
<?php echo $this->Html->script('/assets/admin/pages/scripts/components-dropdowns.js', ['block' => 'PAGE_LEVEL_SCRIPTS_ComponentsDropdowns']); ?>
<!-- END PAGE LEVEL SCRIPTS -->
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-select/bootstrap-select.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php echo $this->Html->script('/assets/global/plugins/select2/select2.min.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php echo $this->Html->script('/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js', ['block' => 'PAGE_LEVEL_PLUGINS_ComponentsDropdowns']); ?>
<?php echo $this->Html->css('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css', ['block' => 'cssComponentsDropdowns']); ?>
<?php echo $this->Html->css('/assets/global/plugins/select2/select2.css', ['block' => 'cssComponentsDropdowns']); ?>
<?php echo $this->Html->css('/assets/global/plugins/jquery-multi-select/css/multi-select.css', ['block' => 'cssComponentsDropdowns']); ?>
<script>
	jQuery(document).ready(function() {
		// initiate layout and plugins
		Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		QuickSidebar.init(); // init quick sidebar
		Demo.init(); // init demo features
		ComponentsPickers.init();
		ComponentsDropdowns.init();
		FormValidation.init();
	});   
</script>
