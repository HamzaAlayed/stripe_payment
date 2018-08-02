<?php

namespace App\Contracts\Payments;

interface GatewayInterface
{
    /**
     * Create a new user on the gateway server
     *
     * @param string $token
     * @param array $properties

     */
    public function create($token, array $properties = []);

    /**
     * Create a charge for the customer
     *
     * @param string $id
     * @param int    $amount
     * @param array  $options
     */
    public function charge($id, $amount, array $options = []);

    /**
     * Update the credit card attached to the entity
     *
     * @param string $id
     * @param string $token
     */
    public function updateCard($id, $token);

    /**
     * Get the customer from the gateway
     *
     * @param string $id
     */
    public function getCustomerFromGateway($id);

    /**
     * Get the last four credit card digits
     *
     * @param $customer
     * @return string
     */
    public function getLastFourCardDigits($customer);

    /**
     * Get the credit card brand
     * @param $customer
     * @return string
     */
    public function getCreditCardBrand($customer);

    /**
     * Get supported currency
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