<?php
//Host
define("PROD_HOST_URL", "https://api.okra.ng/v1/");
define("DEV_HOST_URL", "https://api.okra.ng/sandbox/v1/");

//Balances
define("ALL_BALANCES", "products/balances");
define("PERIODIC_BALANCE", "products/balance/periodic");
define("BALANCE_BY_CUSTOMER_ID", "balance/getByCustomer");
define("BALANCE_BY_ACCOUNT", "balance/getByAccount");
define("BALANCE_BY_TYPE", "balance/getByType");
define("BALANCE_BY_DATE_RANGE", "balance/getByDate");
define("BALANCE_BY_CUSTOMER_DATE", "balance/getByCustomerDate");

// Transactions
define("ALL_TRANSACTIONS", "products/transactions");
define("PERIODIC_TRANSACTIONS", "products/transactions/periodic");
define("TRANSACTIONS_BY_ID", "transactions/getById");
define("TRANSACTIONS_BY_OPTIONS", "transactions/byOptions");
define("TRANSACTIONS_BY_CUSTOMER", "transactions/getByCustomer");
define("TRANSACTIONS_BY_ACCOUNT", "transactions/getByAccount");
define("TRANSACTIONS_BY_DATE_RANGE", "transactions/getByDate");
define("TRANSACTIONS_BY_BANK", "transactions/getByBank");
define("TRANSACTIONS_BY_SPENDING_PATTERN", "products/transactions/spending-pattern");
define("TRANSACTIONS_BY_CUSTOMER_DATE", "transactions/getByCustomerDate");

// Auth
define("ALL_AUTH", "products/auths");
define("AUTH_BY_ID", "auth/getById");
define("AUTH_BY_CUSTOMER", "auth/getByCustomer");
define("AUTH_BY_DATE_RANGE", "auth/getByDate");
define("AUTH_BY_BANK", "auth/getByBank");
define("AUTH_BY_CUSTOMER_DATE", "auth/getByCustomerDate");

// Income
define("ALL_INCOME", "products/income/get");
define("PROCESS_CUSTOMER_INCOME", "products/income/process");
define("INCOME_BY_ID", "income/getById");
define("INCOME_BY_CUSTOMER", "income/getByCustomer");
define("INCOME_BY_CUSTOMER_DATE", "income/getByCustomerDate");

// Identity
define("ALL_IDENTITIES", "products/identities");
define("IDENTITY_BY_ID", "identity/getById");
define("IDENTITY_BY_OPTIONS", "identity/byOptions");
define("IDENTITY_BY_CUSTOMER", "identity/getByCustomer");
define("IDENTITY_BY_DATE_RANGE", "identity/getByDate");
define("IDENTITY_BY_CUSTOMER_DATE", "identity/getByCustomerDate");

