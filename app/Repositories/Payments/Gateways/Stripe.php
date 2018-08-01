<?php

namespace App\Repositories\Payments\Gateways;



use App\Contracts\Payments\GatewayInterface;
use Stripe\Stripe as StripeCore;
use Stripe\Charge;
use Stripe\Customer;

class Stripe implements GatewayInterface
{
    /**
     * Create a new StripeGateway
     *
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        StripeCore::setApiKey($apiKey);
    }

    /**
     * Create a new user on the stripe server
     *
     * @param string $token
     * @param array $properties
     * @return \Stripe\ApiResource
     */
    public function create($token, array $properties = [])
    {
        return Customer::create(array_merge(['source' => $token], $properties));
    }

    /**
     * Create a charge for the customer
     *
     * @param string $id
     * @param int $amount
     * @param array $options
     * @return \Stripe\ApiResource
     */
    public function charge($id, $amount, array $options = [])
    {
        $options['currency'] = $this->getCurrency();
        $options['amount']   = $amount;
        $options['customer'] = $id;

        return Charge::create($options);
    }

    /**
     * Update the credit card attached to the entity
     *
     * @param string $id
     * @param string $token
     * @return \Stripe\StripeObject
     */
    public function updateCard($id, $token)
    {
        $customer = $this->getCustomerFromGateway($id);

        $card = $customer->sources->create(['source' => $token]);

        $customer->default_source = $card->id;

        $customer->save();

        return $customer;
    }

    /**
     * Get the customer from the gateway
     *
     * @param string $id
     * @return \Stripe\StripeObject
     */
    public function getCustomerFromGateway($id)
    {
        return Customer::retrieve($id);
    }

    /**
     * Get the last four credit card digits
     *
     * @param \Stripe\Customer $customer
     * @return string
     */
    public function getLastFourCardDigits($customer)
    {
        return ($customer->default_source) ? $customer->sources->retrieve($customer->default_source)->last4 : null;
    }

    /**
     * Get the credit card brand
     *
     * @param \Stripe\Customer $customer
     * @return string
     */
    public function getCreditCardBrand($customer)
    {
        return ($customer->default_source) ? $customer->sources->retrieve($customer->default_source)->brand : null;
    }

    /**
     * Get the stripe supported currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return 'gbp';
    }

    /**
     * Get the locale for the currency
     *
     * @return string
     */
    public function getCurrencyLocal()
    {
        return 'en_UK';
    }

    /**
     * Get the tax percentage to apply to the subscription
     *
     * @return int
     */
    public function getTaxPercent()
    {
        return 0;
    }

    /**
     * Format the currency for display
     *
     * @param int $amount
     * @return string
     */
    public function formatCurrency($amount)
    {
        return number_format($amount / 100, 2);
    }

    /**
     * Add the currency symbol to the amount
     *
     * @param string $amount
     * @return string
     */
    public function addCurrencySymbol($amount)
    {
        return '£'.$amount;
    }

}