<?php

declare(strict_types=1);

namespace Modules\Product\Http\DTO;

use Illuminate\Support\Collection;
use Modules\Product\Http\Requests\ProductCreateRequest;
use Spatie\LaravelData\Data;

class CreateProductDto extends Data
{
    public function __construct(
        public readonly string $title,
        public readonly string $titleDesc,
        public readonly string $mainDesc,
        public readonly int $categoryId,
        public readonly int $brandId,
        /**@var Collection<int, ProductAttributeVariationsDto> */
        public readonly Collection $attributesVariations,
        public readonly ?array $images = null,
    ) {
    }

    public static function fromRequest(ProductCreateRequest $request): CreateProductDto
    {
        $attributeVariations = $request->relation('product_variations')->map(function (array $variation) {
            return ProductAttributeVariationsDto::from([
                'skuName' => $variation['sku'],
                'quantity' => $variation['quantity'],
                'attributes' => AttributeValueDto::collect($variation['attributes'])
            ]);
        });

        return new self(
            title: $request->title,
            titleDesc: $request->title_description,
            mainDesc: $request->main_description,
            categoryId: $request->relation('category')['id'],
            brandId: $request->relation('brand')['id'],
            attributesVariations: $attributeVariations
        );
    }
}