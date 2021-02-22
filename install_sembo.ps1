ren hotel_stats_api/.env.example .env
composer install -d ./hotel_stats_api
cp hotel_stats_api ../hotel_stats_api -Recurse
cd ./hotel_stats_client
npm install
npm run build
cd ..
cp hotel_stats_client/build ../hotel_stats_client -Recurse