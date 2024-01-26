#!/usr/bin/env bash
set -e

if [ ! -f "./wp-config.php" ]; then
	cp wp-config.local.php wp-config.php
fi

if [ ! -d "./wp-admin" ]; then
	wp core download
fi
