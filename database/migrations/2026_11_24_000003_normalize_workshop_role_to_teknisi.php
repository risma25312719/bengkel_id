<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class NormalizeWorkshopRoleToTeknisi extends Migration
{
    public function up()
    {
        DB::table('users')
            ->where('role', 'pemilik_bengkel')
            ->update(['role' => 'teknisi']);
    }

    public function down()
    {
        // The merged role cannot be safely split back into owners and technicians.
    }
}
