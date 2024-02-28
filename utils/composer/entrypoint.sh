#!/bin/sh

composer install \
  --no-interaction \
  --ignore-platform-reqs \
  --ansi \
  --no-scripts \
  --prefer-dist \
  --optimize-autoloader \
  --apcu-autoloader
