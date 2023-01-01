<?php

namespace App\Interfaces;

interface ITransactionRepository
{
    public function getCategories();
    public function saveTransaction($transaction);
    public function getTransactionsByUserId($id);
    public function getTransactionsByDate($filter);
    public function listTransactions($filter);
    public function getBalance($filter);
    public function getAverage($id);
    public function getDaily($filter);
    public function editTransaction($data);
    public function deleteTransaction($id);
}
