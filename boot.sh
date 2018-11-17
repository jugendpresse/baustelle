###
## motion.tool specific things
###

cd $APACHE_WORKDIR
if [ ! -f .env ]; then
    cp .env.example .env
fi
sudo -u $WORKINGUSER composer global require hirak/prestissimo
sudo -u $WORKINGUSER composer install --prefer-dist
