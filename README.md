# Okra-php

okra-php is a PHP library for okra core products.

## Installation

Use the package manager [composer](https://getcomposer.org/download/) to install okra-php.

```bash
composer require horlarmeday/okra-php
```

## Usage
okra-php provides the simple access to use [okra](https://okra.ng) core products which includes: Auth, Balance, Identity, Income and Transactions.
To start you need to instantiate the Okra class, and pass your access token. All methods return array as response.
```php
$okra = new Okra(ACCESS_TOKEN);
```
#### 1. Auth
Okra offers a path for a customer to successfully verify their bank. The customer enters their credentials via the widget and are authenticated immediately.

##### i. Get all auth
This retrieves all auth information including bank account and routing numbers associated with a Record's current, savings, and domiciliary accounts.

_Optionally pass a boolean `true` to get a .pdf format_
```php
$okra->getAllAuth();
```

##### ii. Get auth by id
This retrieves auth information by id.
```php
$okra->getAuthById();
```

##### iii. Get auth by customer
This retrieves the auth information by the customer id.
```php
$okra->getAuthByCustomer();
```

##### iv. Get auth by date range
This retrieves the auth information by passing a date range. This method expects four (4) parameters.
`startDate`, `endDate`, `page` and `limit`. However the first two are required while last two are optional.
`page` is stating the page number you wish to return while `limit` is the number of records to return.
```php
$okra->getAuthByDateRange('2020-05-13', '2020-05-20', 1, 20);
```
##### v. Get auth by bank id
This retrieves the auth information by bank id. This method expects three (3) parameters.
`bank_id`, `page` and `limit`. However `page` and `limit` are optional.
```php
$okra->getAuthByBank();
```

##### vi. Get auth by customer id and date
This retrieves the auth information by customer id and date range.
`customer_id`, `startDate` and `endDate` are required.
```php
$okra->getAuthByCustomerDate();
```

## Contact

Mahmud Ajao - [@MahmudAjao1](https://twitter.com/@MahmudAjao1) - ajaomahmud@gmail.com


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://github.com/Horlarmeday/okra-php/blob/main/LICENSE)