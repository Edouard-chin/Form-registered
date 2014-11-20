#!/bin/bash
php app/console assets:install --symlink

if [[ $1 = "dev" ]] || [[ -z $1 ]]
	then php app/console cache:clear --env=dev
elif [[ $1 = "prod" ]]
	then
	php app/console cache:clear --env=dev
	php app/console assetic:dump --env=prod --no-debug
fi
