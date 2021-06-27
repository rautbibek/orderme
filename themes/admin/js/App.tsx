import * as React from 'react';
import { HashRouter,BrowserRouter, Switch } from "react-router-dom";
import Dashboard from "./components/pages/dashboard/Dashboard";
import PrivateRoute from "./PrivateRoute";
import Category from "./components/pages/category/Category";
import Product from "./components/pages/product/Product";
import Layout from './components/Layout/Layout';

const App = () => {
    return (
        <div>
            <HashRouter >
                <Layout>
                    <Switch>
                        <PrivateRoute exact path="/" component={Dashboard} />
                        <PrivateRoute exact path="/categories" component={Category} />
                        <PrivateRoute exact path="/products" component={Product} />
                    </Switch>
                </Layout>
            </HashRouter>
        </div>
    );
}

export default App;


