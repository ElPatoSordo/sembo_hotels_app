import classes from './App.module.css';

import HotelsPanel from './HotelsPanel/HotelsPanel';

const app = () => (
  <div className={classes.App}>
    <header className={classes.Header}>
      <h1 className={classes.Title}>Hotel stats loader</h1>
    </header>
    <HotelsPanel />
  </div>
);

export default app;
