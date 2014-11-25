#!/bin/bash

if [[ $1 = "dev" ]] || [[ -z $1 ]]
	then
	php app/console doctrine:schema:drop --force --env=dev
	php app/console doctrine:schema:update --force --env=dev
	php app/console doctrine:fixtures:load -n
elif [[ $1 = "prod" ]]
	then
	php app/console doctrine:schema:drop --force --env=prod
	php app/console doctrine:schema:update --force --env=prod
	php app/console doctrine:fixtures:load -n
fi
