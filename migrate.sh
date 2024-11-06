#!/bin/bash

# Executa php artisan migrate diretamente dentro do contêiner
docker exec sistema-compra-moedas-app-1 sh -c "php artisan migrate"
