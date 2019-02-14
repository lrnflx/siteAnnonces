.PHONY: phpunit phpmetrics phpcs

phpunit:
	bin/phpunit --coverage-html=var/phpunitest

phpmetrics:
	vendor/bin/phpmetrics --report-html=var/build ./src

phpcs:
	vendor/bin/phpcs --standard=PSR2 src