<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PurchaseVoucher Entity
 *
 * @property int $id
 * @property int $voucher_no
 * @property int $supplier_ledger_id
 * @property int $purchase_ledger_id
 * @property \Cake\I18n\FrozenDate $transaction_date
 * @property string $narration
 * @property int $company_id
 *
 * @property \App\Model\Entity\SupplierLedger $supplier_ledger
 * @property \App\Model\Entity\PurchaseLedger $purchase_ledger
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\AccountingEntry[] $accounting_entries
 * @property \App\Model\Entity\PurchaseVoucherRow[] $purchase_voucher_rows
 */
class PurchaseVoucher extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
