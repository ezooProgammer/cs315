<?php

use function PHPSTORM_META\map;

echo "<pre>";
print_r($_POST);
echo "</pre>";

function get_product_at_category(string $category, array $product_list)
{
    if (+$product_list["$category-qty"] === 0)
        return [];
    $product_data = [
        "name" => $product_list["ice-cream-$category"],
        "flavor" => $product_list["ice-$category-flavor"],
        "qty" => $product_list["$category-qty"],
        "price" => $product_list["ice-$category-price"],
    ];
    $product_data["total-price"] = $product_data["price"] * $product_data["qty"];
    return $product_data;
}
echo "<pre>";
print_r(get_product_at_category("corn", $_POST));
echo "</pre>";
