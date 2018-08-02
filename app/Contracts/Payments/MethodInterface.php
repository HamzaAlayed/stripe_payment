<?php

namespace App\Contracts\Payments;

interface MethodInterface
{
    /**
     * @param $id
     * @param $amount
     * @return mixed
     */
    public function pay($id, $amount);

    /**
     * Add new payment method
     * @return mixed
     */
    public function add();

    /**
     * Update payment method
     * @return mixed
     */
    public function update();

    /**
     * Delete payment method
     * @return mixed
     */
    public function delete();

    /**
     * Get list of payment method
     * @param $limit
     * @return mixed
     */
    public function list($limit=10);


}
