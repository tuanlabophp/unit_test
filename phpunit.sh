#!/bin/bash

php artisan migrate
phpunit --coverage-html coverage
