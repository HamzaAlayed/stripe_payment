<?php
/**
 * Created by PhpStorm.
 * User: hamza
 * Date: 8/2/18
 * Time: 1:13 PM
 */

namespace App\Repositories\Payments\Transactions;


use App\Contracts\Payments\MethodInterface;
use App\Contracts\Payments\TransactionInterface;

class Transaction implements TransactionInterface
{


    /**
     * Send payment details for payment gateway
     * @param MethodInterface $method
     * @param $customer_id
     * @param $amount
     * @return mixed
     */
    public function execute(MethodInterface $method, $customer_id, $amount): bool
    {
        return $method->pay($customer_id, $amount);
    }

    /**
     * Save transaction in database
     * @param $method
     * @param $customer_id
     * @param $amount
     * @param $success
     * @return boolean
     */
    public function save(MethodInterface $method, $customer_id, $amount, $success)
    {
        // TODO: Implement save() method.
    }
}