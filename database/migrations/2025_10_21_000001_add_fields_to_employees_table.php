<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('birth_place')->after('name');
            $table->date('birth_date')->after('birth_place');
            $table->unsignedSmallInteger('age')->after('birth_date');
            $table->string('nis', 50)->unique()->after('age');
            $table->text('address')->nullable()->after('nis');
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['birth_place', 'birth_date', 'age', 'nis', 'address']);
        });
    }
};

