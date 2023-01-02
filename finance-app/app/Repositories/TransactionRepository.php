<?php

namespace App\Repositories;

use App\Interfaces\ITransactionRepository;
use App\Models\Transaction;
use App\Models\TransactionCategory;
use App\Models\TransactionsOverview;
use DateTime;
use DateTimeZone;
use App\Helpers\TransactionOverviewHelper;

class TransactionRepository implements ITransactionRepository
{

    public function getCategories()
    {
        return TransactionCategory::all(['id','name','code','type']);
    }
    public function saveTransaction($transaction)
    {
        $date = new DateTime('now', new DateTimeZone('UTC'));
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

    public function getTransactionsByUserId($id)
    {
        return Transaction::query()
            ->where('user_id','=',$id)
            ->get(['id','transaction_category_id','date', 'amount']);
    }

    public function getTransactionsByDate($filter)
    {
        $transactions = Transaction::query()
            ->where('user_id','=',$filter->get('id'))
            ->where('date','>=',$filter->get('fromDate'))
            ->where('date','<=',$filter->get('toDate'))
            ->groupBy(['date','transaction_category_id'])
            ->selectRaw('id, transaction_category_id, date, SUM(amount) AS amount')
            ->get();

        $overview = new TransactionsOverview();
        $overview->transactions = $transactions;
        TransactionOverviewHelper::calculateCategoryInfo($overview,$transactions);

        return $overview;
    }
    public function listTransactions($filter){
        $transactions = Transaction::query()
            ->where('user_id','=',$filter->get('id'))
            ->where('date','>=',$filter->get('fromDate'))
            ->where('date','<=',$filter->get('toDate'))
            ->join('transactions_categories', 'transactions.transaction_category_id', '=', 'transactions_categories.id')
            ->orderBy('date', 'desc')
            ->selectRaw('transactions.id, transactions_categories.name, date, amount, transactions_categories.mdi_icon AS icon, type,transaction_category_id')
            ->get();
        return $transactions;
    }

    public function getBalance($filter)
    {
        $balances = Transaction::query()
        ->where('user_id','=',$filter->get('id'))
        ->where('date','>=',$filter->get('fromDate'))
        ->where('date','<=',$filter->get('toDate'))
        ->join('transactions_categories', 'transactions.transaction_category_id', '=', 'transactions_categories.id')
        ->groupBy('type')
        ->selectRaw('SUM(amount) AS amount ,type')
        ->get();
        return $balances;
    }
    public function getAverage($id){
        $sums = Transaction::query()
            ->where('user_id','=',$id)
            ->where('transactions_categories.type','<>','income')
            ->join('transactions_categories', 'transactions.transaction_category_id', '=', 'transactions_categories.id')
            ->groupBy('date')
            ->selectRaw('SUM(amount) AS amount ')
            ->get();
        $total = 0;
        $count = 0;
        foreach ($sums as $tranSum){
            $total += $tranSum->amount;
            $count++;
        }
        return $total/$count;

    }

    public function getDaily($filter)
    {
        return Transaction::query()
            ->where('user_id','=',$filter->get('id'))
            ->where('date','=',$filter->get('date'))
            ->where('transactions_categories.type','<>','income')
            ->join('transactions_categories', 'transactions.transaction_category_id', '=', 'transactions_categories.id')
            ->selectRaw('SUM(amount) as amount')
            ->get();
    }

    public function editTransaction($data)
    {
        $date = new DateTime('now', new DateTimeZone('UTC'));
        Transaction::query()
            ->where('id','=',$data->get('id'))
            ->update([
                'date' => $data->get('date'),
                'amount' => $data->get('amount'),
                'transaction_category_id' => $data->get('transaction_category_id'),
                'updated_at' => $date
            ]);
        return $date;
    }

    public function deleteTransaction($id)
    {
        return Transaction::query()
            ->where('id','=',$id)
            ->delete();
    }
}
