<?php

namespace App\Helpers;

use App\Models\CategoryInfo;
use App\Models\TransactionCategory;

class TransactionOverviewHelper
{

        public static function calculateCategoryInfo($overview,$transactions){
            $categories = [];
            $total = 0;
            foreach ($transactions as $tran){

                $category = TransactionCategory::query()
                    ->where('id', '=',$tran->transaction_category_id)
                    ->first(['id','name','code','mdi_icon']);
                $total+= $tran->amount;
                $categoryInfo = new CategoryInfo($category->code,$category->name, $category->mdi_icon);
                if (array_key_exists($category->code,$categories)){
                    $categories[$category->code]->amount += $tran->amount;
                }else{
                    $categories[$category->code] = $categoryInfo;
                    $categories[$category->code]->amount = $tran->amount;
                }
            }

            foreach ($categories as $category){
                $categories[$category->code]->percentage =$categories[$category->code]->amount * 100 / $total;
            }
            $overview->categoryInfo = $categories;
        }
}
