###
## motion.tool specific things
###

cd $APACHE_WORKDIR
sudo -u $WORKINGUSER composer global require hirak/prestissimo
sudo -u $WORKINGUSER composer install --prefer-dist
