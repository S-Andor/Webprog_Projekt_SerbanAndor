<?php

namespace App\Repositories;

use App\Interfaces\ITransactionRepository;
use App\Models\Transaction;
use App\Models\TransactionCategory;
use DateTime;
use DateTimeZone;

class TransactionRepository implements ITransactionRepository
{

    public function getCategories()
    {
        return TransactionCategory::all(['id','name','code','type']);
    }
    public function saveTransaction($transaction)
    {
        $date = new DateTime('now',new DateTimeZone('UTC'));
        return Transaction::query()->insert(
            [
                'transaction_category_id' => $transaction->get('category_id'),
                'user_id' => $transaction->get('user_id'),
                'date' => $transaction->get('date'),
                'amount' => $transaction->get('amount'),
                'created_at' => $date,
                'updated_at' => $date,
            ],
        );
    }
}
