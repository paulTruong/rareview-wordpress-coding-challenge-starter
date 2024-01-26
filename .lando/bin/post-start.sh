#!/usr/bin/env bash
set -e

# If WordPress is not installed, run the installation.
if ! $(wp core is-installed); then
	wp core install --url=rareview.local --title="Rareview Coding Challenge" --admin_user=lando --admin_password=password --admin_email=lando@rareview.local --skip-email
fi

# Activate theme
wp theme activate rareview

# Activate dev plugins
wp plugin activate debug-bar query-monitor

# Activate plugins

wp rewrite structure '/%postname%/'
wp rewrite flush
