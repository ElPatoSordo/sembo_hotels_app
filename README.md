# sembo_hotels_app

This project is an exercise that is part of a candidate selection process. It has two parts: the [client](https://github.com/ElPatoSordo/sembo_hotels_app/tree/main/hotel_stats_client) and the [server application](https://github.com/ElPatoSordo/sembo_hotels_app/tree/main/hotel_stats_api).

## The client

This is a browser application. It is made with [React](https://reactjs.org/) using [create-react-app](https://github.com/facebook/create-react-app). When the app loads, it makes requests to the server to retrieve hotels and the average score once per country listed in the [Countries.js](https://github.com/ElPatoSordo/sembo_hotels_app/blob/main/hotel_stats_client/src/Countries.js) file. Then it loads several components to display the information. To add styling, I've used [CSS modules](https://github.com/css-modules/css-modules) as it is explained in the [create-react-app's docs](https://create-react-app.dev/docs/adding-a-css-modules-stylesheet/).

## The Server Application

The server application is made with PHP. Using cURL library, the app makes a call to the Sembo's API to get the hotel list depending on the iso_country_id parameter. Then it sorts the list, get the average score and the top 3 hotels and returns it to the client.

## Requirements:
* A web server (I've been using [XAMPP](https://www.apachefriends.org/es/index.html)) with PHP (I used version 8.0.2) and cURL support enabled (I had version 7.74.0)
* [Node >= 10.16 and npm >= 5.6](https://nodejs.org/en/)
* [Composer](https://getcomposer.org/)

## Installation

1. Clone this repository in the root folder of the server (htdocs or www)
2. In the hotel_stats_api folder, edit properties of the .env.example file:
    * RAW_API_KEY should be the API key before aplying the SHA1 hash.
    * HOST 
    * URL should be the URL to the Sembo's API (until the "/" before the iso parameter)
3. In the axios.js folder of the client, feel free to edit the baseURL property. It should be the url to the API in the server (the folder that contains index.php). I used 'http://localhost/hotel_stats_api/src/' because I haven't changed the Apache configuration and haven't configured the hosts.
4. After the previoues steps, execute the install_sembo.ps1 script.
5. Start the Server and the client should work.

Alternative if the script does not work:

1. Clone this repository in the root folder of the server (htdocs or www)
2. In the hotel_stats_api folder, rename the .env.example file to .env and edit its properties:
    * RAW_API_KEY should be the API key before aplying the SHA1 hash.
    * HOST 
    * URL should be the URL to the Sembo's API (until the "/" before the iso parameter)
3. In the axios.js folder of the client, feel free to edit the baseURL property. It should be the url to the API in the server (the folder that contains index.php). I used 'http://localhost/hotel_stats_api/src/' because I haven't changed the Apache configuration and haven't configured the hosts.
4. Move the hotel_stats_api folder to www/ or htdocs/ if using XAMPP. Then, in the hotel_stats_api folder, run `composer install`.
5. In the client folder, run `npm install`. Then, run `npm run build`.
6. Copy the contents of the build folder to www/hotel_stats_client/ or htdocs/hotel_stats_client/ if using XAMPP.
7. Start the server and the client should work.
