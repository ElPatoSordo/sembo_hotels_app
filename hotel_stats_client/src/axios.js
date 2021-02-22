import axios from 'axios';

const instance = axios.create({
  baseURL: 'http://localhost/hotel_stats_api/src/',
});

export default instance;
