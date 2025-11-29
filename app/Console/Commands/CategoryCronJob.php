<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use Rap2hpoutre\FastExcel\FastExcel;

class CategoryCronJob extends Command
{
    // Command signature
    protected $signature = 'process:category_signature';

    // Command description
    protected $description = 'Export all categories to Excel';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Use query for memory-efficient export
        $categories = Category::all();

        // Export to Excel
        $filePath = storage_path('app/exports/categories.xlsx');
        (new FastExcel($categories))->export($filePath);

        \Log::info('Categories exported successfully to Excel', ['path' => $filePath]);
        $this->info("Categories exported successfully to: {$filePath}");

        return 0;
    }
}

