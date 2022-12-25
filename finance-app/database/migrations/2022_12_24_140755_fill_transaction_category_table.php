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
                ['name' => 'Family', 'code' => 'FAM'],
                ['name' => 'Health', 'code' => 'HEALTH'] ,
                ['name' => 'Groceries', 'code' => 'GROCERIES'],
                ['name' => 'Health', 'code' => 'HEALTH'] ,
                ['name' => 'Restaurant', 'code' => 'RESTAURANT'],
                ['name' => 'Free time', 'code' => 'FREE_TIME'] ,
                ['name' => 'Commute', 'code' => 'COMMUTE'],
                ['name' => 'Gifts', 'code' => 'GIFTS'] ,
                ['name' => 'Shopping', 'code' => 'SHOPPING'] ,
                ['name' => 'Income', 'code' => 'INCOME']
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
