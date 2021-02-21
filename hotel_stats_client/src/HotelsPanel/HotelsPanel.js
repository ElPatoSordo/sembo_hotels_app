import React, { Component } from 'react';

import HotelsByCountry from './HotelsByCountry/HotelsByCountry';
import countries from '../Countries';

class HotelsPanel extends Component {
  state = {
    countries: countries,
  };

  render() {
    const list_hotels_country = this.state.countries.map((country) => (
      <HotelsByCountry
        key={country.id}
        iso_country_id={country.id}
        country={country.name}
      />
    ));
    return <div>{list_hotels_country}</div>;
  }
}

export default HotelsPanel;
