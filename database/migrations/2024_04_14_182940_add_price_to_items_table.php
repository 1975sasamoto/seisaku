<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->decimal('price', 8,0)->nullable(); // 価格カラムを追加します（小数点以下2桁まで、最大8桁の整数部分を許容）  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
        $table->dropColumn('price'); // マイグレーションのロールバック時に価格カラムを削除します
        });
    }
};
