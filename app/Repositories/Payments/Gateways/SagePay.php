<?php

namespace App\Repositories\Payments\Gateways;



use App\Contracts\Payments\GatewayInterface;
use Stripe\Stripe as StripeCore;
use Stripe\Charge;
use Stripe\Customer;

class SagePay implements GatewayInterface
{


    /**
     * Create a new user on the stripe server
     *
     * @param string $token
     * @param array $properties
     */
    public function create($token, array $properties = [])
    {
        // TODO: Implement create() method.
    }

    /**
     * Create a charge for the customer
     *
     * @param string $id
     * @param int $amount
     * @param array $options
     */
    public function charge($id, $amount, array $options = [])
    {
        // TODO: Implement charge() method.
    }

    /**
     * Update the credit card attached to the entity
     *
     * @param string $id
     * @param string $token
     */
    public function updateCard($id, $token)
    {
        // TODO: Implement updateCard() method.
    }

    /**
     * Get the customer from the gateway
     *
     * @param string $id
     */
    public function getCustomerFromGateway($id)
    {
        // TODO: Implement getCustomerFromGateway() method.
    }

    /**
     * Get the last four credit card digits
     *
     * @param \Stripe\Customer $customer
     * @return string
     */
    public function getLastFourCardDigits($customer)
    {
        // TODO: Implement getLastFourCardDigits() method.
    }

    /**
     * Get the credit card brand
     * @param $customer
     * @return string
     */
    public function getCreditCardBrand($customer)
    {
        // TODO: Implement getCreditCardBrand() method.
    }

    /**
     * Get the stripe supported currency
     *
     * @return string
     */
    public function getCurrency()
    {
        // TODO: Implement getCurrency() method.
    }

    /**
     * Get the locale for the currency
     *
     * @return string
     */
    public function getCurrencyLocal()
    {
        // TODO: Implement getCurrencyLocal() method.
    }

    /**
     * Get the tax percentage to apply to the subscription
     *
     * @return int
     */
    public function getTaxPercent()
    {
        // TODO: Implement getTaxPercent() method.
    }

    /**
     * Format the currency for display
     *
     * @param int $amount
     * @return string
     */
    public function formatCurrency($amount)
    {
        // TODO: Implement formatCurrency() method.
    }

    /**
     * Add the currency symbol to the amount
     *
     * @param string $amount
     * @return string
     */
    public function addCurrencySymbol($amount)
    {
        // TODO: Implement addCurrencySymbol() method.
    }
}