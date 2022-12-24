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
}
