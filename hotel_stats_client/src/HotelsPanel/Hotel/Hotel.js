import classes from './Hotel.module.css';

const hotel = (props) => (
  <div className={classes.Hotel}>
    <h3 className={classes.Name}>{props.name}</h3>
    <div className={classes.Score}>
      <span>Score: {props.score}</span>
    </div>
  </div>
);

export default hotel;
