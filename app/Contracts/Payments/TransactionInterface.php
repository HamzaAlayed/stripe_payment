<?php
/**
 * Created by PhpStorm.
 * User: hamza
 * Date: 8/2/18
 * Time: 1:13 PM
 */

namespace App\Contracts\Payments;


interface TransactionInterface
{
    /**
     * Send payment details for payment gateway
     * @param MethodInterface $method
     * @param $customer_id
     * @param $amount
     * @return boolean
     */
    public function execute(MethodInterface $method, $customer_id, $amount);

    /**
     * Save transaction in database
     * @param $method
     * @param $customer_id
     * @param $amount
     * @param $success
     * @return boolean
     */
    public function save(MethodInterface $method, $customer_id, $amount, $success );
}