<?php

use App\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Schema::disableForeignKeyConstraints();
    	// restart table
    	Brand::truncate();

        Brand::insert([
        	[
        		'name' =>'Apple',
        		'slug' =>str_slug('Apple'),
        	],
        	[
        		'name' =>'Samsung',
        		'slug' =>str_slug('Samsung'),
        	],
        	[
        		'name' =>'Google',
        		'slug' =>str_slug('Google'),
        	],
        	[
        		'name' =>'Sony',
        		'slug' =>str_slug('Sony'),
        	],
        	[
        		'name' =>'HTC',
        		'slug' =>str_slug('HTC'),
        	],
        	[
        		'name' =>'Karbonn',
        		'slug' =>str_slug('Karbonn'),
        	],
        	[
        		'name' =>'LG',
        		'slug' =>str_slug('LG'),
        	],
        	[
        		'name' =>'Micromax',
        		'slug' =>str_slug('Micromax'),
        	],
        	[
        		'name' =>'Microsoft',
        		'slug' =>str_slug('Microsoft'),
        	],
        	[
        		'name' =>'Nokia',
        		'slug' =>str_slug('Nokia'),
        	],
        	[
        		'name' =>'OnePlus',
        		'slug' =>str_slug('OnePlus'),
        	],
        	[
        		'name' =>'OPPO',
        		'slug' =>str_slug('OPPO'),
        	],
        	[
        		'name' =>'Xiaomi',
        		'slug' =>str_slug('Xiaomi'),
        	],
        	[
        		'name' =>'Blackberry',
        		'slug' =>str_slug('Blackberry'),
        	],
        	[
        		'name' =>'Dell',
        		'slug' =>str_slug('Dell'),
        	],
        	[
        		'name' =>'Acer',
        		'slug' =>str_slug('Acer'),
        	],
        	[
        		'name' =>'HP',
        		'slug' =>str_slug('hp'),
        	],
        	[
        		'name' =>'InFocus',
        		'slug' =>str_slug('InFocus'),
        	],
        	[
        		'name' =>'Lenovo',
        		'slug' =>str_slug('Lenovo'),
        	],
        	[
        		'name' =>'AOC',
        		'slug' =>str_slug('AOC'),
        	],
        	[
        		'name' =>'Adidas',
        		'slug' =>str_slug('Adidas'),
        	],
        	[
        		'name' =>'Bata',
        		'slug' =>str_slug('bata'),
        	],
        	[
        		'name' =>'Appex',
        		'slug' =>str_slug('Appex'),
        	],
        	[
        		'name' =>'BMW',
        		'slug' =>str_slug('BMW'),
        	],
        	[
        		'name' =>'Intel',
        		'slug' =>str_slug('Intel'),
        	],
        	[
        		'name' =>'Honda',
        		'slug' =>str_slug('Honda'),
        	],
        	[
        		'name' =>'eBay',
        		'slug' =>str_slug('eBay'),
        	],
        	[
        		'name' =>'Canon',
        		'slug' =>str_slug('Canon'),
        	],
        	[
        		'name' =>'Nissan',
        		'slug' =>str_slug('Nissan'),
        	],
        	[
        		'name' =>'Siemens',
        		'slug' =>str_slug('Siemens'),
        	],
        	[
        		'name' =>'Huawei',
        		'slug' =>str_slug('Huawei'),
        	],
        ]);
    }
}
