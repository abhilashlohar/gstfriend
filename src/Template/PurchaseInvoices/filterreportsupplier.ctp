<?php $i=0;
foreach ($filterdatas as $filterdata):
		$i++;   ?>
<tr class="main_tr">
	<td><?php echo  $i; ?></td>
	<td><?= h($filterdata->transaction_date) ?></td>
	<td><?php echo $filterdata->supplier_ledger->name; ?></td>
	<td><?= h($filterdata->invoice_no) ?></td>
	<td align="right"><?= $this->Number->format($filterdata->total) ?></td>
	<td align="right"><?= $this->Number->format($filterdata->total_cgst) ?></td>
	<td align="right"><?= $this->Number->format($filterdata->total_sgst) ?></td>
	<td align="right"><?= $this->Number->format($filterdata->total_igst) ?></td>
	<td align="right"><?= $this->Number->format($filterdata->base_amount) ?></td>
	<td class="actions">
		<?= $this->Html->link(__('Edit'), ['action' => 'edit', $filterdata->id]) ?>
		<?= $this->Html->link(__('View'), ['action' => 'view', $filterdata->id]) ?>
		<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $filterdata->id], ['confirm' => __('Are you sure you want to delete # {0}?', $filterdata->id)]) ?>
	</td>
</tr>
<?php endforeach; ?>