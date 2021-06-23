import * as React from 'react';
import {HashRouter, Switch, Route} from "react-router-dom";
import Dashboard from "./components/pages/dashboard/Dashboard";
import PrivateRoute from "./PrivateRoute";
import Category from "./components/pages/category/Category";
import Product from "./components/pages/product/Product";


const  App = () => {
    return (
       <div>
           <HashRouter >
                   <Switch>
                       <PrivateRoute exact path="/" component={Dashboard} />
                       <PrivateRoute exact path="/categories" component={Category} />
                       <PrivateRoute exact path="/products" component={Product} />
                   </Switch>
           </HashRouter>
       </div>
    );
}

export default App;


