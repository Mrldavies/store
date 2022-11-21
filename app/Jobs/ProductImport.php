<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Facades
 */

use Maatwebsite\Excel\Facades\Excel;

/**
 * Imports
 */

use App\Imports\ProductImport as ExcelImport;

/**
 * Models
 */

use App\Models\Category;
use App\Models\Prodct;
use App\Models\Product;

class ProductImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $timeout = 0;
    public $tries = 1;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    private function createCategoriesArray(string $categories): array
    {
        return  array_values(array_filter(array_unique(explode(",", $categories))));
    }

    private function createNode(string $name, $parent = null): object
    {
        return Category::create(['name' => $name], $parent);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $rows = Excel::toArray(new ExcelImport(), storage_path('app/full-import.xlsx'));
        foreach ($rows[0] as $row) {

            $categories = $this->createCategoriesArray($row['categories']);

            if (!$categories) {
                continue;
            }

            $parent = [];

            $node = Category::query()
                ->where('name', $categories[0])
                ->whereNull('parent_id')
                ->first();

            if (!$node) {
                $node = $this->createNode($categories[0]);
            }

            array_push($parent, $node);

            foreach ($categories as $index => $category) {
                if ($index < 1) continue;

                $parentNode = $parent[$index - 1];

                $node = Category::query()
                    ->where('name', $category)
                    ->where('parent_id', $parentNode->id)
                    ->first();

                if (!$node) {
                    $node = $this->createNode($category, $parentNode);
                }
                array_push($parent, $node);
            }

            $category = end($parent);

            Product::create([
                'category_id' => $category->id ?? 69,
                'name' => trim($row['description']),
                'sku' => trim($row['sku']),
                'price' => trim($row['price']),
                'description' => trim($row['name']),
            ]);
        }
    }
}
