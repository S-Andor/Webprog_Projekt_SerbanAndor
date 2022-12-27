<?php

namespace App\Interfaces;

interface ITransactionRepository
{
    public function getCategories();
    public function saveTransaction($transaction);
    public function getTransactionsById($id);
    public function getTransactionsByDate($filter);
    public function listTransactions($filter);
}
