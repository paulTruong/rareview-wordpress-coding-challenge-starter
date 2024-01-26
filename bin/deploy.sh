#!/usr/bin/env bash

# Download & run the Composer installer.
curl -s https://getcomposer.org/installer | php

# Install production dependencies.
php composer.phar install --no-dev --prefer-dist --optimize-autoloader
php composer.phar install --no-dev --prefer-dist --optimize-autoloader --working-dir=wp-content/themes/rareview

# Clean up.
rm composer.phar

# Activate default plugins
wp theme activate rareview

# Setup the Permalinks
wp rewrite structure '/%postname%/'
wp rewrite flush
