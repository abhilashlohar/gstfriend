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
$activeClass = (($active_menu == 'Users.Dashboard')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="icon-home"></i> '.__('Dashboard'), ['controller' => 'Users', 'action' => 'Dashboard'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Invoices.Add')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-list-alt"></i> '.__('Tax Invoice'), ['controller' => 'Invoices', 'action' => 'Add'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'Invoices.AddCashInvoice')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-list-alt"></i> '.__('Tax Invoice Cash'), ['controller' => 'Invoices', 'action' => 'addcashinvoice'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'PurchaseVouchers.Add')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-list-alt"></i> '.__('Purchase Invoice'), ['controller' => 'PurchaseVouchers', 'action' => 'Add'], ['escape' => false]), $activeClass); 


$activeClass = (($active_menu == 'Invoices.Index')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-book"></i> '.__('Sales Register'), ['controller' => 'Invoices', 'action' => 'Index'], ['escape' => false]), $activeClass);

$activeClass = (($active_menu == 'PurchaseVouchers.Index')?['class' => 'active']:[]);
echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-book"></i> '.__('Purchase Register'), ['controller' => 'PurchaseVouchers', 'action' => 'Index'], ['escape' => false]), $activeClass);






echo $this->Html->tag('li', $this->Html->link('<i class="fa fa-power-off"></i> '.__('Log Out'), ['controller' => 'Users', 'action' => 'logout'], ['escape' => false]));
?>