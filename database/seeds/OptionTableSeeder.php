<?php


use App\Option;
use Illuminate\Database\Seeder;

class OptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
    	Option::truncate();
    	
        Option::insert([
            [
                'name' => 'Size',
                'type' => 'radio'
            ],
            [
	            'name' => 'Color',
	            'type' => 'radio'
	        ]
        ]);
    }
}
