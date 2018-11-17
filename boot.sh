###
## motion.tool specific things
###

cd $APACHE_WORKDIR
if [ ! -f .env ]; then
    sudo -u$WORKINGUSER cp .env.example .env
fi
sudo -u $WORKINGUSER composer install --prefer-dist

export DOWNTIME=$(date +"%T")
