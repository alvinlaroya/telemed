# Economy Telemedicine

# Deploying
	
	ssh -i ./sytian.pem ubuntu@ec2-13-213-44-21.ap-southeast-1.compute.amazonaws.com
	cd /var/www/telemedicine
	git pull origin main
	composer install --no-interaction --prefer-dist --optimize-autoloader
	php artisan migrate --force
	php artisan queue:restart