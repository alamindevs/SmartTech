<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(AttributeSetsTableSeeder::class);
        $this->call(AttributeTableSeeder::class);
        $this->call(AttributeValueTableSeeder::class);
        $this->call(OptionTableSeeder::class);
        $this->call(OptionValueTableSeeder::class);
    }
}
