<?php
/**
 * Created by PhpStorm.
 * User: hamza
 * Date: 8/2/18
 * Time: 1:35 PM
 */

namespace App\Repositories\Products;


use App\Contracts\Payments\MethodInterface;
use App\Contracts\Payments\TransactionInterface;
use App\Entities\Products\Product;
use App\Repositories\BaseRepository;
use Illuminate\Container\Container as App;
use phpDocumentor\Reflection\Types\Boolean;

class OrderRepository extends BaseRepository implements \App\Contracts\Products\OrderInterface
{
    /**
     * @var TransactionInterface
     */
    private $transaction;
    /**
     * @var \Auth
     */
    private $user;

    /**
     * OrderRepository constructor.
     * @param App $app
     * @param TransactionInterface $transaction
     * @param \Auth $user
     */
    function __construct(App $app, TransactionInterface $transaction, \Auth $user)
    {
        parent::__construct($app);
        $this->app = $app;
        $this->transaction = $transaction;
        $this->user = $user;
    }

    protected function getModelClass(): string
    {
        return \App\Entities\Products\Order::class;
    }

    /**
     * Do purchase
     * @param Product $products
     * @param MethodInterface $method
     * @param null $customer_id
     * @return bool
     */
    function Purchase(Product $products, MethodInterface $method, $customer_id = null): Boolean
    {
        if (!$customer_id) {
            $customer_id = $this->user->id;
        }

        $amount = 0;

        foreach ($products as $product) {
            $amount = $product->amount;
        }

        $transaction=$this->transaction->execute($method, $customer_id, $amount);

        $this->transaction->save($method, $customer_id, $amount, $transaction);
    }
}