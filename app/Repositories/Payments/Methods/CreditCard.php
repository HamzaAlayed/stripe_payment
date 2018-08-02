<?php

namespace App\Repositories\Payments\Methods;


use App\Contracts\Payments\GatewayInterface;
use App\Contracts\Payments\MethodInterface;

class CreditCard implements MethodInterface
{
    /**
     * @var GatewayInterface
     */
    private $gateway;

    /**
     * CreditCard constructor.
     * @param GatewayInterface $gateway
     */
    function __construct(GatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param $id
     * @param $amount
     * @return mixed
     */
    public function pay($id, $amount)
    {
        return $this->gateway->charge($id,$amount, []);
    }

    public function add()
    {
        // TODO: Implement add() method.
    }

    /**
     * Update payment method
     * @return mixed
     */
    public function update()
    {
        // TODO: Implement update() method.
    }

    /**
     * Delete payment method
     * @return mixed
     */
    public function delete()
    {
        // TODO: Implement delete() method.
    }

    /**
     * Get list of payment method
     * @param $limit
     * @return mixed
     */
    public function list($limit = 10)
    {
        // TODO: Implement list() method.
    }
}