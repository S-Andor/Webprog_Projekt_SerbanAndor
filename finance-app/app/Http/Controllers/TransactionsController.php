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
    public function getTransactionsByDate(Request $request){
        return response()->json($this->transactionRepository->getTransactionsByDate($request));
    }
    public function getTransactionList(Request $request){
        return response()->json($this->transactionRepository->listTransactions($request));
    }
    public function getBalance(Request $request){
        return response()->json($this->transactionRepository->getBalance($request));
    }
    public function getAverage(Request $request){
        return response()->json($this->transactionRepository->getAverage($request->get('id')));
    }
    public function getTransactionsByUserId(Request $request){
        return response()->json($this->transactionRepository->getTransactionsByUserId($request->get('id')));
    }
    public function getThisDaySpend(Request $request){
        return response()->json($this->transactionRepository->getDaily($request));
    }
    public function editTransaction(Request $request){
        return response()->json($this->transactionRepository->editTransaction($request));
    }
    public function deleteTransaction(Request $request){
        return response()->json($this->transactionRepository->deleteTransaction($request->get('id')));
    }
}
