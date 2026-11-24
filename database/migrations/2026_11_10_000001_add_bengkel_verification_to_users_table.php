<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddBengkelVerificationToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('status_bengkel', 20)->default('approved')->after('role');
            $table->decimal('latitude', 10, 7)->nullable()->after('alamat');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
        });
        // Database lama sebelumnya memakai ENUM yang belum mengenal role admin.
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY role VARCHAR(30) NOT NULL DEFAULT 'pelanggan'");
            // Field identitas bengkel hanya wajib untuk akun pemilik bengkel.
            DB::statement("ALTER TABLE users MODIFY nama_bengkel VARCHAR(255) NULL, MODIFY no_hp VARCHAR(255) NULL, MODIFY alamat VARCHAR(255) NULL");
        }
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['status_bengkel', 'latitude', 'longitude']);
        });
    }
}
