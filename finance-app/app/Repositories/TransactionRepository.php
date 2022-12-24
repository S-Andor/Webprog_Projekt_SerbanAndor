<?php

namespace App\Repositories;

use App\Interfaces\ITransactionRepository;
use App\Models\TransactionCategory;

class TransactionRepository implements ITransactionRepository
{

    public function getCategories()
    {
        return TransactionCategory::all(['id','name','code']);
    }
}
