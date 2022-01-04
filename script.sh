#!/bin/bash

php bin/console app:stock-check aapl &&
php bin/console app:stock-check bb &&
php bin/console app:stock-check uwmc &&
php bin/console app:stock-check tsla &&
php bin/console app:stock-check gme