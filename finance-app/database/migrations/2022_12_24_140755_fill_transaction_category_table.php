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
                ['name' => 'Family', 'code' => 'FAM','type' => 'expense', 'mdi_icon' => ''],
                ['name' => 'Health', 'code' => 'HEALTH','type' => 'expense', 'mdi_icon' => ''] ,
                ['name' => 'Groceries', 'code' => 'GROCERIES','type' => 'expense', 'mdi_icon' => ''],
                ['name' => 'Health', 'code' => 'HEALTH','type' => 'expense', 'mdi_icon' => ''] ,
                ['name' => 'Restaurant', 'code' => 'RESTAURANT','type' => 'expense', 'mdi_icon' => ''],
                ['name' => 'Free time', 'code' => 'FREE_TIME','type' => 'expense', 'mdi_icon' => ''] ,
                ['name' => 'Commute', 'code' => 'COMMUTE','type' => 'expense', 'mdi_icon' => ''],
                ['name' => 'Gifts', 'code' => 'GIFTS','type' => 'expense', 'mdi_icon' => ''] ,
                ['name' => 'Shopping', 'code' => 'SHOPPING','type' => 'expense', 'mdi_icon' => ''] ,
                ['name' => 'Income', 'code' => 'INCOME','type' => 'income', 'mdi_icon' => '']
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
