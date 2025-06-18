#!/bin/sh
set -e

echo "▶ Rodando migrations..."
php artisan migrate --force

echo "▶ Criando link simbólico de storage (se necessário)..."
php artisan storage:link || true

echo "▶ Iniciando servidor..."
exec "$@"
