<div  class="main_div" style="border:none">
		<?php echo $this->Html->link( '<i class="fa fa-file-excel-o"></i> Excel', '/Invoices/Customer-date-wise/'.$startdatefrom.'/'.$startdateto.'/'.$customername.'/'.$radioValue.'',['class' =>'btn btn-sm green tooltips pull-right Item-Wise-Excel','target'=>'_blank','escape'=>false,'data-original-title'=>'Download as excel']); ?>
	
<table id="example1" class="table table-bordered  hidetable maindiv  main_table">
	<?php if(!empty($filterdatas))
		{	?>
	<thead style="text-align:center;"  class="maindiv">
		<tr>
			<th scope="col">Sr.</th>
			<th scope="col">Trans. Date</th>
			<th scope="col">Inv. No.</th>
			<th scope="col">Customer</th>
			<th scope="col">Item Name</th>
			<th scope="col">HSN Code</th>
			<th scope="col" style="width:30px;">Qty</th>
			<th scope="col" style="width:50px;">Rate</th>
			<th scope="col">Discount</th>
			<th scope="col">CGST %</th>
			<th scope="col">CGST Amount</th>
			<th scope="col">SGST %</th>
			<th scope="col">SGST Amount</th>
			<th scope="col">Base Amount</th>							
			<th scope="col">Total</th>
			<th scope="col">Rec.Amt</th>
			<th scope="col">Due Amt</th>
			<th scope="col" class="hidden-print">Action</th>
		</tr>
	</thead>
	<tbody class="main_tbody">
		<?php $i=0;
		$cgstamount=0;     $sgstamount=0;    
		$baseamount=0;     $totalamount=0;    $dueamountamount=0;
		$recieveamount=0;   $totalquantity=0;
		foreach ($filterdatas as $filterdata): $i++;  ?>
		<tr class="main_tr">
			<td style="width:5px;"><?php echo $i; ?></td>
			<td style="width:5px;"><?= h($filterdata->transaction_date) ?></td>
			<td><?php echo $filterdata->invoice_no; ?></td>
			<td><?php echo $filterdata->customer_name; ?></td>
			<td colspan="9" style="text-align:right">
				<table class="table table-bordered table-hover">
					<?php 		
					
					foreach($filterdata->invoice_rows as $invoice_row):
					
					?>
					<tr>
						<td style="width:65px;text-align:left">
						<?php
							if(!empty($invoice_row->item_id)) 
							{
								echo $invoice_row->item->name; 
							}else
							{ 
								echo '0';
							}?>
						</td>
						<td style="width:60px;text-align:left">
						<?php
								echo $invoice_row->item->hsn_code; 
						?>
						</td>
						<td style="width:30px;text-align:left">
						<?php
								echo $invoice_row->quantity; 
						$totalquantity=$totalquantity+$invoice_row->quantity;
						?>
						</td>
						<td style="width:50px;text-align:left">
						<?php
								echo $invoice_row->rate; 
						?>
						</td>
						<td style="width:50px;text-align:left">
						<?php
								echo $invoice_row->discount_amount; 
						?>
						</td>
						<td style="width:60px">
						<?php
							if(!empty($invoice_row->cgst)) 
							{
								echo $invoice_row->cgst->name; 
							}else
							{ 
								echo '0';
							}?>
						</td>
						<td style="text-align:right;width:80px">
						<?php 
							echo $invoice_row->cgst_amount;
							$cgstamount = $cgstamount + $invoice_row->cgst_amount; 
						?>
						</td>
						<td style="width:60px">
						<?php if(!empty($invoice_row->sgst)) 
							{
								echo $invoice_row->sgst->name; 
							}else
							{ 
								echo '0';
							} ?>
						</td>
						<td style="text-align:right;width:80px">
						<?php 
							echo $invoice_row->sgst_amount;
							$sgstamount = $sgstamount + $invoice_row->sgst_amount;
						?>
						</td>
						
					</tr>
					<?php  	endforeach;
							
					?>
				</table>		
			</td>
			<td style="text-align:right"><?php echo $filterdata->total_amount_before_tax; ?></td>
			<td style="text-align:right"><?php echo $filterdata->total_amount_after_tax; ?></td>
			<td style="text-align:right"><?php echo $filterdata->recieveamount; ?></td>
			<td style="text-align:right"><?php echo $filterdata->dueamountamount; ?></td>
			<td class="hidden-print"><?= $this->Html->link(__('Edit'), ['action' => 'edit', $filterdata->id]) ?>
			<?= $this->Html->link(__('View'), ['action' => 'view', $filterdata->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $filterdata->id], ['confirm' => __('Are you sure you want to delete # {0}?', $filterdata->id)]) ?>
			</td>
		</tr>
		<?php 
			$baseamount = $baseamount + $filterdata->total_amount_before_tax;
			$totalamount = $totalamount + $filterdata->total_amount_after_tax;
			$recieveamount = $recieveamount + $filterdata->recieveamount;
			$dueamountamount = $dueamountamount + $filterdata->dueamountamount;
			endforeach;
		?>
	</tbody>				
	<tfoot >
		<tr>
			<td colspan="6" style="text-align:right"><b>TOTAL Qty</b></td>
			<td class="totalcgst" style="text-align:right"><b><?php echo $totalquantity; ?></b></td>
			<td colspan="3"  style="text-align:right"><b>TOTAL Amount</b></td>
			<td class="totalcgst" style="text-align:right"><b><?php echo $cgstamount; ?></b></td>
			<td class="totalsgst" colspan="2" style="text-align:right"><b><?php echo $sgstamount; ?></b></td>
			<td class="totalbase" style="text-align:right"><b><?php  echo $baseamount; ?></b></td>
			<td class="totalamount" style="text-align:right"><b><?php echo $totalamount; ?></b></td>
			<td class="recieveamount" style="text-align:right"><b><?php echo $recieveamount; ?></b></td>
			<td class="dueamountamount" style="text-align:right"><b><?php echo $dueamountamount; ?></b></td>
			<td></td>
			
		</tr>
	</tfoot>
		<?php } else{
			echo 'No Data Found';
		}?>
</table>
</div>
