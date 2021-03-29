import { Switch, Route } from 'react-router-dom'
import Dashboard from './Dashboard'

const Main = () => (
  <main>
    <Switch>
      <Route exact path='/' component={Dashboard}/>
    </Switch>
  </main>
)

export default Main;