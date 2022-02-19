#!make

include .env
export

create-db:
	mysql -h $(DB_SERVER) -u $(DB_USERNAME) -p -e 'CREATE DATABASE IF NOT EXISTS $(DB_NAME)'

create-table:
	mysql -h $(DB_SERVER) -u $(DB_USERNAME) -p $(DB_NAME) < src/migrations/1_create_viewers_table.sql