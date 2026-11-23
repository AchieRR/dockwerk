#!/bin/sh
set -eu

: "${APP_KEY:?Set APP_KEY in the Vercel project environment variables.}"

mkdir -p "$LARAVEL_STORAGE_PATH/framework/cache/data" \
    "$LARAVEL_STORAGE_PATH/framework/cache/locks" \
    "$LARAVEL_STORAGE_PATH/framework/sessions" \
    "$LARAVEL_STORAGE_PATH/framework/views" \
    "$LARAVEL_STORAGE_PATH/logs" \
    "$LARAVEL_STORAGE_PATH/app/private" \
    "$LARAVEL_STORAGE_PATH/app/public"

exec frankenphp run --config /etc/caddy/Caddyfile
