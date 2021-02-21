import React, { Component } from 'react';
import axios from '../../axios';

import Hotel from '../Hotel/Hotel';

class HotelsByCountry extends Component {
  state = { data: null, error: null, loading: true };

  componentDidMount() {
    let data, error;
    axios
      .get(axios.defaults.baseURL, {
        params: { iso_country_id: this.props.iso_country_id },
      })
      .then((response) => {
        data = response.data.data;
        error = response.data.error;
      })
      .catch((err) => {
        error = `Something went wrong: ${err.message}`;
      })
      .finally(() =>
        this.setState({ data: data, error: error, loading: false })
      );
  }

  render() {
    let average_score, hotels, error;
    const error_msg = this.state.error;
    const data = this.state.data;

    if (error_msg) {
      error = <p>{error_msg}</p>;
    }

    if (data) {
      hotels = data.top_hotels;
      if (hotels) {
        average_score = <p>Average score: {data.average_score}</p>;
        hotels = hotels.map((hotel) => (
          <Hotel key={hotel.id} name={hotel.name} score={hotel.score} />
        ));
      }
    }

    const hotels_info = (
      <div>
        {error}
        {average_score}
        {hotels}
      </div>
    );

    const loading = this.state.loading ? <p>Loading...</p> : null;

    return (
      <div>
        <h2>
          Top hotels in {this.props.country} ({this.props.iso_country_id})
        </h2>
        {loading}
        {hotels_info}
      </div>
    );
  }
}

export default HotelsByCountry;
