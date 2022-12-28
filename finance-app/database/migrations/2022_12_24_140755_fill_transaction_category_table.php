<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('transactions_categories')
            ->insert([
                ['name' => 'Family', 'code' => 'FAM','type' => 'expense', 'mdi_icon' => 'human-male-female-child'],
                ['name' => 'Health', 'code' => 'HEALTH','type' => 'expense', 'mdi_icon' => 'bottle-tonic-plus-outline'] ,
                ['name' => 'Groceries', 'code' => 'GROCERIES','type' => 'expense', 'mdi_icon' => 'basket-outline'],
                ['name' => 'Restaurant', 'code' => 'RESTAURANT','type' => 'expense', 'mdi_icon' => 'silverware-fork-knife'],
                ['name' => 'Free time', 'code' => 'FREE_TIME','type' => 'expense', 'mdi_icon' => 'filmstrip'] ,
                ['name' => 'Commute', 'code' => 'COMMUTE','type' => 'expense', 'mdi_icon' => 'train-car'],
                ['name' => 'Gifts', 'code' => 'GIFTS','type' => 'expense', 'mdi_icon' => 'gift'] ,
                ['name' => 'Shopping', 'code' => 'SHOPPING','type' => 'expense', 'mdi_icon' => 'shopping-outline'] ,
                ['name' => 'Income', 'code' => 'INCOME','type' => 'income', 'mdi_icon' => 'credit-card-plus']
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
