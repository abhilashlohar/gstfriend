<?php
/**
 * @Author: PHP Poets IT Solutions Pvt. Ltd.
 */
if(!isset($active_menu))
{
    $active_menu = '';
}
?>
<?php
$activeClass = (($active_menu == 'Items.Add')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('Add Item'), ['controller' => 'Items', 'action' => 'Add'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Items.Index')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('List Items'), ['controller' => 'Items', 'action' => 'Index'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Suppliers.Add')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('Add Supplier'), ['controller' => 'Suppliers', 'action' => 'Add'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Suppliers.Index')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('List Suppliers'), ['controller' => 'Suppliers', 'action' => 'Index'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Customers.Add')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('Add Customer'), ['controller' => 'Customers', 'action' => 'Add'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Customers.Index')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('List Customers'), ['controller' => 'Customers', 'action' => 'Index'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'LedgerAccounts.Add')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('Add LedgerAccounts'), ['controller' => 'LedgerAccounts', 'action' => 'Add'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'LedgerAccounts.Index')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-plus-square"></i> '.__('List LedgerAccounts'), ['controller' => 'LedgerAccounts', 'action' => 'Index'], ['escape' => false]), $activeClass);





?>