<?php

namespace App\Http\Controllers;

use App\Interfaces\ITransactionRepository;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    private ITransactionRepository $transactionRepository;
    public function __construct(ITransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }
    public function getAllTransactionCategories(){
        return response()->json($this->transactionRepository->getCategories());
    }
    public function saveTransaction(Request $request){
        return response()->json($this->transactionRepository->saveTransaction($request));
    }
    public function getTransactionsById(Request $request){
        return response()->json($this->transactionRepository->getTransactionsById($request->get('id')));
    }
    public function getTransactionsByDate(Request $request){
        return response()->json($this->transactionRepository->getTransactionsByDate($request));
    }
    public function getTransactionList(Request $request){
        return response()->json($this->transactionRepository->listTransactions($request));
    }
    public function getBalance(Request $request){
        return response()->json($this->transactionRepository->getBalance($request));
    }
}
