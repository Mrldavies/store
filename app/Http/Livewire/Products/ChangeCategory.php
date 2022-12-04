<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use Illuminate\Http\Request;

/**
 * Models
 */

use App\Models\Category;
use App\Models\Product;

/**
 * Carbon
 */

use Carbon\Carbon;

/**
 * Facades
 */

use Illuminate\Support\Facades\Cache;


class ChangeCategory extends Component
{
    public $categories;
    public $child;
    public $categoryId;
    public $currentCategory;
    public $selectCategory;
    public $product;
    public $edit;
    public $productId;

    public function __construct()
    {
        $this->categoryId;
    }

    /**
     * Gets top level categories
     *
     * @return object
     */
    private function topLevelCategories(): object
    {
        $expire = Carbon::now()->addYear(1);

        $categories = Cache::remember('categories', $expire, function () {
            return Category::withDepth()->having('depth', '=', 0)->get();
        });

        return $categories;
    }

    /**
     * Gets current category  structure for product
     * 
     * @param integer $id
     * @return object
     */
    private function currentProductCategory(int $id): object
    {
        return Category::defaultOrder()->ancestorsAndSelf($id);
    }

    /**
     * Gets child categories by id
     *
     * @param integer $id
     * @return object
     */
    private function getchildrenByid(int $id): object
    {
        return Category::descendantsAndSelf($id);
    }

    private function findProduct($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Update product category
     *
     * @param integer $id
     * @return void
     */
    public function updateCategory(int $id)
    {
        $product = $this->findProduct($this->productId);

        $product->category_id = $id;
        $product->save();

        $this->currentCategory = $this->currentProductCategory($id);
    }

    /**
     * Update category list
     *
     * @param int $id
     * @return void
     */
    public function childCategory(int $id)
    {
        $this->categories = $this->getchildrenByid($id);
        $this->child = true;
    }

    /**
     * reset category tree
     *
     * @return void
     */
    public function resetTree()
    {
        $this->child = false;
        $this->categories = $this->topLevelCategories();
    }

    public function edit()
    {
        $this->edit = !$this->edit;
    }

    /**
     * pass data to component
     *
     * @return void
     */
    public function mount(Request $request)
    {

        $this->productId = $request->route('product');
        $this->edit = false;
        $this->child = false;
        $this->categoryId = $this->findProduct($this->productId)->category_id;
        $this->currentCategory = $this->currentProductCategory($this->categoryId);
        $this->categories = $this->topLevelCategories();
    }

    /**
     * Render component
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.products.change-category');
    }
}
