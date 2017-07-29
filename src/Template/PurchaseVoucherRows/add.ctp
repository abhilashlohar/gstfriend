<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Purchase Voucher Rows'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Purchase Vouchers'), ['controller' => 'PurchaseVouchers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Purchase Voucher'), ['controller' => 'PurchaseVouchers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Items'), ['controller' => 'Items', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item'), ['controller' => 'Items', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchaseVoucherRows form large-9 medium-8 columns content">
    <?= $this->Form->create($purchaseVoucherRow) ?>
    <fieldset>
        <legend><?= __('Add Purchase Voucher Row') ?></legend>
        <?php
            echo $this->Form->control('purchase_voucher_id', ['options' => $purchaseVouchers]);
            echo $this->Form->control('item_id', ['options' => $items]);
            echo $this->Form->control('quantity');
            echo $this->Form->control('rate_per');
            echo $this->Form->control('amount');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
