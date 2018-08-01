<?php

namespace App\Contracts\Payments;

interface GatewayInterface
{
    /**
     * Create a new user on the stripe server
     *
     * @param string $token
     * @param array $properties
     * @return \Stripe\Customer
     */
    public function create($token, array $properties = []);

    /**
     * Create a charge for the customer
     *
     * @param string $id
     * @param int    $amount
     * @param array  $options
     * @return \Stripe\Charge
     * @throws \Stripe\Error\Card
     */
    public function charge($id, $amount, array $options = []);

    /**
     * Update the credit card attached to the entity
     *
     * @param string $id
     * @param string $token
     * @return \Stripe\Customer
     */
    public function updateCard($id, $token);

    /**
     * Get the customer from the gateway
     *
     * @param string $id
     * @return \Stripe\Customer
     */
    public function getCustomerFromGateway($id);

    /**
     * Get the last four credit card digits
     *
     * @param \Stripe\Customer $customer
     * @return string
     */
    public function getLastFourCardDigits($customer);

    /**
     * Get the credit card brand
     *
     * @param \Stripe\Customer $customer
     * @return string
     */
    public function getCreditCardBrand($customer);

    /**
     * Get the stripe supported currency
     *
     * @return string
     */
    public function getCurrency();

    /**
     * Get the locale for the currency
     *
     * @return string
     */
    public function getCurrencyLocal();

    /**
     * Get the tax percentage to apply to the subscription
     *
     * @return int
     */
    public function getTaxPercent();

    /**
     * Format the currency for display
     *
     * @param int $amount
     * @return string
     */
    public function formatCurrency($amount);

    /**
     * Add the currency symbol to the amount
     *
     * @param string $amount
     * @return string
     */
    public function addCurrencySymbol($amount);

}