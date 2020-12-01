<?php


namespace App;


use App\Exceptions\CustomException;
use App\Helper\GuzzleFetch;
use App\Helper\OkraInterface;

class Okra
{
    protected $guzzle;
    protected $access_token;
    protected $baseUrl;

    public function __construct($accessToken = "", $env = "prod")
    {
        $this->access_token = $accessToken;
        $this->guzzle = new GuzzleFetch($this->access_token);

        if ($env == "prod")
            $this->baseUrl = PROD_HOST_URL;
        else
            $this->baseUrl = DEV_HOST_URL;

    }

    /***********************
     * BALANCE
     **********************
     * @param bool $pdf
     * @return array
     */
    public function getBalance($pdf = false):array {
        $url = $this->baseUrl . ALL_BALANCES;

        $data = [
            'pdf' => $pdf,
        ];

        return $this->guzzle->post($url, $data);
    }

    /**
     * @param {string} $customer_id
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getBalanceByCustomer($customer_id, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array
    {
        if (empty($customer_id)) throw new CustomException('customer id is required');

        $url = $this->baseUrl . BALANCE_BY_CUSTOMER_ID;

        $data = [
            'customer' => $customer_id,
            'page' => $page,
            'limit' => $limit,
        ];

        return $this->guzzle->post($url, $data);
    }

    /**
     * @param {string} $account_id
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getBalanceByAccount($account_id, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array
    {
        if (empty($account_id)) throw new CustomException('account id is required');

        $url = $this->baseUrl . BALANCE_BY_ACCOUNT;

        $data = [
            'account' => $account_id,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($url, $data);
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getBalanceByDateRange($startDate, $endDate, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array
    {
        if (empty($startDate) && empty($endDate)) throw new CustomException('start date and end date are required');

        $url = $this->baseUrl . BALANCE_BY_DATE_RANGE;

        $data = [
            'from' => $startDate,
            'to' => $endDate,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($url, $data);
    }

    /**
     * @param $type
     * @param $amount
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getBalanceByType($type, $amount, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array
    {
        if (empty($type) && empty($amount)) throw new CustomException('type and amount are required!');

        $url = $this->baseUrl . BALANCE_BY_TYPE;

        $data = [
            'type' => $type,
            'amount' => $amount,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($url, $data);
    }

    /**
     * @param $customer_id
     * @param $startDate
     * @param $endDate
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getBalanceByCustomerDate($customer_id, $startDate, $endDate, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array
    {
        if ((empty($customer_id) && empty($startDate)) && (empty($endDate))) throw new CustomException('either customer id, or start date or end date is missing!');

        $url = $this->baseUrl . BALANCE_BY_CUSTOMER_DATE;

        $data = [
            'customer' => $customer_id,
            'from' => $startDate,
            'to' => $endDate,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($url, $data);
    }

    /**
     * @param {string} $account_id
     * @param {string} $record_id
     * @param string $currency
     * @return array
     * @throws CustomException
     */
    public function getPeriodicBalance($account_id, $record_id, $currency = 'NGN'):array
    {
        if (empty($account_id) && empty($record_id)) throw new CustomException('account id and record id are required');

        $url = $this->baseUrl . PERIODIC_BALANCE;

        $data = [
            'account_id' => $account_id,
            'record_id' => $record_id,
            'currency' => $currency
        ];

        return $this->guzzle->post($url, $data);
    }

    /***********************
     * TRANSACTIONS
     **********************/

    /**
     * @param bool $pdf
     * @return array
     */
    public function getTransactions($pdf = false):array {
        $url = $this->baseUrl . ALL_TRANSACTIONS;

        $data = [
            'pdf' => $pdf
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param {string} $id
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getTransactionsById($id, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if (empty($id)) throw new CustomException('transactions id is required');

        $url = $this->baseUrl . TRANSACTIONS_BY_ID;

        $data = [
            'id' => $id,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param {object} $options can be {"first_name": "Peter", "last_name": "Johnson"}
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getTransactionsByOptions($options, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if (empty($options)) throw new CustomException('options parameter is required');

        $url = $this->baseUrl . TRANSACTIONS_BY_OPTIONS;

        $data = [
            'options' => $options,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param {string} $customer_id
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getTransactionsByCustomer($customer_id, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if (empty($customer_id)) throw new CustomException('customer id is required');

        $url = $this->baseUrl . TRANSACTIONS_BY_CUSTOMER;

        $data = [
            'customer' => $customer_id,
            'page' => $page
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param {string} $account_id
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getTransactionsByAccount($account_id, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if (empty($customer_id)) throw new CustomException('account id is required');

        $url = $this->baseUrl . TRANSACTIONS_BY_ACCOUNT;

        $data = [
            'account' => $account_id,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getTransactionsByDateRange($startDate, $endDate, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if (empty($startDate) && empty($endDate)) throw new CustomException('start date and end date are required');

        $url = $this->baseUrl . TRANSACTIONS_BY_DATE_RANGE;

        $data = [
            'from' => $startDate,
            'to' => $endDate,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param {string} $bank_id
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getTransactionsByBank($bank_id, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if (empty($customer_id)) throw new CustomException('bank id is required');

        $url = $this->baseUrl . TRANSACTIONS_BY_BANK;

        $data = [
            'bank' => $bank_id,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param {string} $customer_id
     * @return array
     * @throws CustomException
     */
    public function getSpendingPatternByCustomer($customer_id):array {
        if (empty($customer_id)) throw new CustomException('customer id is required');

        $url = $this->baseUrl . TRANSACTIONS_BY_SPENDING_PATTERN;

        $data = [
            'customer_id' => $customer_id,
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param $customer_id
     * @param $startDate
     * @param $endDate
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getTransactionsByCustomerDate($customer_id, $startDate, $endDate, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if ((empty($customer_id) && empty($startDate)) && (empty($endDate))) throw new CustomException('either customer id or start date or end date is missing!');

        $url = $this->baseUrl . TRANSACTIONS_BY_CUSTOMER_DATE;

        $data = [
            'customer_id' => $customer_id,
            'from' => $startDate,
            'to' => $endDate,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param {string} $account_id
     * @param {string} $record_id
     * @param string $currency
     * @return array
     * @throws CustomException
     */
    public function getPeriodicTransactions($account_id, $record_id, $currency = 'NGN'):array {
        if (empty($account_id) && empty($record_id)) throw new CustomException('account id and record id are required!');

        $url = $this->baseUrl . PERIODIC_TRANSACTIONS;

        $data = [
            'account_id' => $account_id,
            'record_id' => $record_id,
            'currency' => $currency
        ];

        return $this->guzzle->post($data, $url);
    }

    /***********************
     * AUTH
     ***********************/
    /**
     * @param bool $pdf
     * @return array
     */
    public function getAllAuth($pdf = false):array {
        $url = $this->baseUrl . ALL_AUTH;

        $data = [
            'pdf' => $pdf
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param {string} $id
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getAuthById($id, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if (empty($id)) throw new CustomException('auth id is required');

        $url = $this->baseUrl . AUTH_BY_ID;

        $data = [
            'id' => $id,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param {string} $customer_id
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getAuthByCustomer($customer_id, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if (empty($customer_id)) throw new CustomException('customer id is required');

        $url = $this->baseUrl . AUTH_BY_CUSTOMER;

        $data = [
            'customer' => $customer_id,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getAuthByDateRange($startDate, $endDate, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if ((empty($startDate) && empty($endDate))) throw new CustomException('start date and end date are required');

        $url = $this->baseUrl . AUTH_BY_DATE_RANGE;

        $data = [
            'from' => $startDate,
            'to' => $endDate,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param {string} $bank_id
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getAuthByBank($bank_id, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if (empty($bank_id)) throw new CustomException('bank id is required');

        $url = $this->baseUrl . AUTH_BY_BANK;

        $data = [
            'bank' => $bank_id,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param $customer_id
     * @param $startDate
     * @param $endDate
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getAuthByCustomerDate($customer_id, $startDate, $endDate, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if ((empty($customer_id) && empty($startDate)) && (empty($endDate))) throw new CustomException('either customer id or start date or end date is missing!');

        $url = $this->baseUrl . AUTH_BY_CUSTOMER_DATE;

        $data = [
            'customer' => $customer_id,
            'from' => $startDate,
            'to' => $endDate,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /***********************
     * INCOME
     ***********************/

    /**
     * @param bool $pdf
     * @return array
     */
    public function getIncomes($pdf = false):array {
        $url = $this->baseUrl . ALL_INCOME;

        $data = [
            'pdf' => $pdf
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param {string} $id
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getIncomeById($id, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if (empty($id)) throw new CustomException('income id is required');

        $url = $this->baseUrl . INCOME_BY_ID;

        $data = [
            'id' => $id,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param {string} $customer_id
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getIncomeByCustomer($customer_id, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if (empty($customer_id)) throw new CustomException('customer id is required');

        $url = $this->baseUrl . INCOME_BY_CUSTOMER;

        $data = [
            'customer' => $customer_id,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param {string} $customer_id
     * @return array
     * @throws CustomException
     */
    public function processCustomerIncome($customer_id) {
        if (empty($customer_id)) throw new CustomException('customer id is required');

        $url = $this->baseUrl . PROCESS_CUSTOMER_INCOME;

        $data = [
            'customer_id' => $customer_id
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param $customer_id
     * @param $startDate
     * @param $endDate
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getIncomeByCustomerDate($customer_id, $startDate, $endDate, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if ((empty($customer_id) && empty($startDate)) && (empty($endDate))) throw new CustomException('either customer id or start date or end date is missing');

        $url = $this->baseUrl . INCOME_BY_CUSTOMER_DATE;

        $data = [
            'customer' => $customer_id,
            'from' => $startDate,
            'to' => $endDate,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /***********************
     * IDENTITY
     ***********************/

    /**
     * @param bool $pdf
     * @return array
     */
    public function getIdentities($pdf = false):array {
        $url = $this->baseUrl . ALL_IDENTITIES;

        $data = [
            'pdf' => $pdf
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param {string} $id
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getIdentityById($id, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if (empty($id)) throw new CustomException('identity id is required');

        $url = $this->baseUrl . IDENTITY_BY_ID;

        $data = [
            'id' => $id,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param {string} $customer_id
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getIdentityByCustomer($customer_id, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if (empty($customer_id)) throw new CustomException('customer id is required');

        $url = $this->baseUrl . IDENTITY_BY_CUSTOMER;

        $data = [
            'customer' => $customer_id,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param {object} $options can be {"first_name": "Peter", "last_name": "Johnson"}
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getIdentityByOptions($options, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if (empty($options)) throw new CustomException('options parameter is required');

        $url = $this->baseUrl . IDENTITY_BY_OPTIONS;

        $data = [
            'options' => $options,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getIdentityByDateRange($startDate, $endDate, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if ((empty($startDate) && empty($endDate))) throw new CustomException('start date and end date are required');

        $url = $this->baseUrl . IDENTITY_BY_DATE_RANGE;

        $data = [
            'from' => $startDate,
            'to' => $endDate,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }

    /**
     * @param $customer_id
     * @param $startDate
     * @param $endDate
     * @param int $page
     * @param int $limit
     * @return array
     * @throws CustomException
     */
    public function getIdentityByCustomerDate($customer_id, $startDate, $endDate, $page = OkraInterface::PAGE, $limit = OkraInterface::LIMIT):array {
        if ((empty($customer_id) && empty($startDate)) && (empty($endDate))) throw new CustomException('either customer id or start date or end date is missing');

        $url = $this->baseUrl . INCOME_BY_CUSTOMER_DATE;

        $data = [
            'customer_id' => $customer_id,
            'from' => $startDate,
            'to' => $endDate,
            'page' => $page,
            'limit' => $limit
        ];

        return $this->guzzle->post($data, $url);
    }
}