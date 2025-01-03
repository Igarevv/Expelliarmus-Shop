<?php

declare(strict_types=1);

namespace Modules\Product\Http\Actions\Product\Retrieve;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Product\Http\Service\ProductImagesService;
use Modules\Product\Models\Category;
use Modules\Product\Models\Product;

class GetProductsByRootCategoryAction
{
    public function __construct(
        private ProductImagesService $imagesService
    ) {
    }

    public function handle(Category $category): LengthAwarePaginator
    {
        $categories = $category->descendants()
            ->whereDoesntHave('children')
            ->pluck('id');

        $products = Product::query()
            ->whereIn('category_id', $categories)
            ->paginate(15, [
                'id',
                'slug',
                'title',
                'images',
                'category_id',
                'created_at'
            ]);

        $products->getCollection()->transform(function (Product $product) {
            $product->preview_image = $this->imagesService->getResizedImage($product, 400, 500);

            return $product;
        });

        return $products;
    }
}