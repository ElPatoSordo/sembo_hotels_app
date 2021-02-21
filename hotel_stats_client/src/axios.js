import axios from 'axios';

const instance = axios.create({
  baseURL: 'http://localhost/sembo_hotels_app/hotel_stats_api/src/',
});

export default instance;
