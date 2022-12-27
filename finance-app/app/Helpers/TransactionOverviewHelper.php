<?php

namespace App\Helpers;

use App\Models\CategoryInfo;
use App\Models\TransactionCategory;
use App\Models\TransactionsOverview;

class TransactionOverviewHelper
{
        public static function getOverviewExpenseAndIncome($overview,$transactions){

            $income = 0;
            $expense = 0;

            foreach ($transactions as $tran){
                $category = TransactionCategory::query()
                    ->where('id', '=',$tran->transaction_category_id)
                    ->first(['id','type']);
                if ($category->type == 'income'){
                    $income += $tran->amount;
                }else if ($category->type == 'expense'){
                    $expense += $tran->amount;
                }
            }

            $overview->transactions = $transactions;
            $overview->expense = $expense;
            $overview->income = $income;
        }

        public static function calculateCategoryInfo($overview,$transactions){
            $categories = [];
            $total = 0;
            foreach ($transactions as $tran){

                $category = TransactionCategory::query()
                    ->where('id', '=',$tran->transaction_category_id)
                    ->first(['id','name','code']);
                $total++;
                $categoryInfo = new CategoryInfo($category->code,$category->name,1);
                if (array_key_exists($category->code,$categories)){
                    $categories[$category->code]->count += 1;
                }else{
                    $categories[$category->code] = $categoryInfo;
                }
            }

            foreach ($categories as $category){
                $categories[$category->code]->percentage =$categories[$category->code]->count * 100 / $total;
            }
            $overview->categoryInfo = $categories;
        }
}
