import React, { Component, Fragment } from 'react';
import axios from '../../axios';

import classes from './HotelsByCountry.module.css';
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
      error = <p className={classes.Error}>{error_msg}</p>;
    }

    if (data) {
      hotels = data.top_hotels;
      if (hotels) {
        average_score = (
          <h4 className={classes.Score}>Average score: {data.average_score}</h4>
        );
        hotels = (
          <Fragment>
            <h3 className={classes.Top}>Top hotels</h3>
            <div className={classes.HotelList}>
              {hotels.map((hotel) => (
                <Hotel key={hotel.id} name={hotel.name} score={hotel.score} />
              ))}
            </div>
          </Fragment>
        );
      }
    }

    const loading = this.state.loading ? (
      <p className={classes.Loading}>Loading...</p>
    ) : null;

    const hotels_info = (
      <div className={classes.Info}>
        {loading}
        {error}
        {average_score}
        {hotels}
      </div>
    );

    return (
      <div className={classes.HotelsByCountry}>
        <h2 className={classes.Title}>
          {this.props.country} ({this.props.iso_country_id})
        </h2>
        {hotels_info}
      </div>
    );
  }
}

export default HotelsByCountry;
