install:
	git clone https://github.com/openapitools/openapi-generator
	chmod -R 777 ./openapi-generator
	mvn -f ./openapi-generator -DskipTests clean package
gen:
	java -jar ./openapi-generator/modules/openapi-generator-cli/target/openapi-generator-cli.jar generate \
	   -i ./openapi.yaml \
	   -o ./../ \
	   -g php-laravel
	chmod -R 777 ./packages