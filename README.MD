# Insly Fullstack Test Asignment

![Insly logo](https://insly.com/en/wp-content/themes/Bonamore/img/logo.svg)
- Test it online [https://insly-car-api.herokuapp.com](https://insly-car-api.herokuapp.com)
- Fontend [https://github.com/melmartinez-dev/insly-car-ui](https://github.com/melmartinez-dev/insly-car-ui)
## Task

Build a calculator logic in PHP using OOP, following good practices and try to use design patterns.

- a. Base price of policy is 11% from entered car value, except every Friday 15-20 o’clock (user time) when it is 13%

- b. Commission is added to base price (17%)

- c. Tax is added to base price (user entered)

- d. Calculate different payments separately (if number of payments are larger than 1)

- e. Installment sums must match total policy sum

- f. Output is rounded to two decimal places

### Local Deploy

To deploy locally follow the steps:

```
composer install
cd public/
php -S localhost:8000
```
Server will be listening at port 8000

### Example Request

```
curl --location --request POST 'http://localhost:8000/calculate' \
--header 'Content-Type: application/json' \
--data-raw '{
    "carValue": 10000,
    "taxPercentage": 10,
    "policyInstallments": 2,
    "userTime": "2022-04-01T22:58:24.562Z"
}'
```

### Tests

``` 
./vendor/bin/phpunit --testdox
```
