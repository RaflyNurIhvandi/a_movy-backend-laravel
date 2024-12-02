<?php

namespace Database\Seeders;

use App\Models\Roles;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Roles::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['name' => "Admin"],
            ['name' => "Petugas"],
            ['name' => "User"],
        ];

        foreach ($data as $v) {
            Roles::insert([
                'name' => $v['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
