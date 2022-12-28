<?php

namespace App\Repositories;

use App\Interfaces\ITransactionRepository;
use App\Models\CategoryInfo;
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

    public function getTransactionsById($id)
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
            ->get(['id','transaction_category_id','date', 'amount']);

        $overview = new TransactionsOverview();
        TransactionOverviewHelper::getOverviewExpenseAndIncome($overview,$transactions);
        TransactionOverviewHelper::calculateCategoryInfo($overview,$transactions);


        return $overview;
    }
    public function listTransactions($filter){
        $transactions = Transaction::query()
            ->where('user_id','=',$filter->get('id'))
            ->where('date','>=',$filter->get('fromDate'))
            ->where('date','<=',$filter->get('toDate'))
            ->join('transactions_categories', 'transactions.transaction_category_id', '=', 'transactions_categories.id')
            ->groupBy(['date','name'])
            ->orderBy('date', 'desc')
            ->selectRaw('transactions.id, transactions_categories.name, date, SUM(amount) AS amount , transactions_categories.mdi_icon AS icon, type')
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
}
