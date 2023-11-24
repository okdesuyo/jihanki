<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    \DB::table('companies')->insert([
      [
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => null,
        'company_name' => 'A社',
        'street_address' => 'a県a市',
        'representative_name' => '相原',
      ],
      [
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => null,
        'company_name' => 'B社',
        'street_address' => 'b県b市',
        'representative_name' => '井上',
      ],
      [
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => null,
        'company_name' => 'C社',
        'street_address' => 'c県c市',
        'representative_name' => '上田',
      ],
      [
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => null,
        'company_name' => 'D社',
        'street_address' => 'd県d市',
        'representative_name' => '衛藤',
      ],
    ]);
  }
}
