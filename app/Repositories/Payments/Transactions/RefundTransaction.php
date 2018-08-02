<?php
/**
 * Created by PhpStorm.
 * User: hamza
 * Date: 8/2/18
 * Time: 1:26 PM
 */

namespace App\Repositories\Payments\Transactions;


use App\Contracts\Payments\MethodInterface;

class RefundTransaction extends Transaction
{


    /**
     * Cancel payment from payment gateway
     * @param MethodInterface $method
     * @param $customer_id
     * @param $amount
     * @return mixed
     */
    public function execute(MethodInterface $method, $customer_id, $amount): bool
    {
        // TODO: Implement execute() method.
    }


}