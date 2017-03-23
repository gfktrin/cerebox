<?php

use Cerebox\VoteCategory;
use Illuminate\Database\Seeder;

class VoteCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VoteCategory::create([
        	'name' => 'Criatividade'
    	]);

    	VoteCategory::create([
        	'name' => 'Conexão com o tema'
    	]);

    	VoteCategory::create([
        	'name' => 'Arte'
    	]);

    	VoteCategory::create([
    		'name' => 'Interação dos elementos'
		]);
    }
}
