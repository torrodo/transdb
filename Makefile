.PHONY: install clean

install:
	composer install
	mysql -u root < ./data/sql/init_db.sql

clean:
	php data/psr/php-cs-fixer fix ./src
