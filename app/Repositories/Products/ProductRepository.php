<?php
/**
 * Created by PhpStorm.
 * User: hamza
 * Date: 8/2/18
 * Time: 1:35 PM
 */

namespace App\Repositories\Products;


use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements \App\Contracts\Products\ProductInterface
{

    protected function getModelClass(): string
    {
        return \App\Entities\Products\Order::class;
    }
}