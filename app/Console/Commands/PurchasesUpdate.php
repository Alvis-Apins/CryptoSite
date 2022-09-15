<?php

namespace App\Console\Commands;

use App\Models\Purchase;
use Illuminate\Console\Command;

class PurchasesUpdate extends Command
{
    protected $signature = 'quote:purchases_update';
    protected $description = 'Updates purchases sell values';

    public function handle(Purchase $purchase)
    {
        $purchase->updatePurchases();
        $this->info('purchases database has been updated');
    }
}
