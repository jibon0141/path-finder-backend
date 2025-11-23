<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class TestCronJob extends Command
{

    protected $signature = 'process:test_signature';


    protected $description = 'test signature description';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
       $selectCategory=Category::all();
       dd($selectCategory);
    }
}