<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

final class CreateEmailCodesTable extends Migration
{
    public function up(): void
    {
        Schema::create('email_codes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('serial')->nullable(false)->unique();
            $table->string('email', 128)->nullable(false);
            $table->char('code', 6)->nullable(false);
            $table->timestamp('created_at')->nullable(false)->useCurrent();
            $table->timestamp('updated_at')->nullable()->default(null);
            $table->timestamp('deleted_at')->nullable()->default(null);

            $table->index(['email', 'code']);
        });

        DB::statement('ALTER TABLE email_codes MODIFY serial BIGINT UNSIGNED NOT NULL UNIQUE AUTO_INCREMENT');
    }

    public function down(): void
    {
        Schema::dropIfExists('email_codes');
    }
}
