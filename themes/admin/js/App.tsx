import * as React from 'react';
import { HashRouter, BrowserRouter, Switch } from "react-router-dom";
import Dashboard from "./components/pages/dashboard/Dashboard";
import PrivateRoute from "./PrivateRoute";
import Category from "./components/pages/category/Category";
import Product from "./components/pages/product/Product";
import Layout from './components/Layout/Layout';
import AddCategory from "./components/pages/category/AddCategory";
import EditCategory from "./components/pages/category/EditCategory";
import AddProduct from './components/pages/product/AddProduct';
import EditProduct from './components/pages/product/EditProduct';
import Themes from "./components/pages/themes/Themes";
import AddTheme from "./components/pages/themes/AddTheme";
import EditTheme from "./components/pages/themes/EditTheme";
import ThemeConfig from "./components/pages/themes/ThemeConfig";
import Collection from "./components/pages/collection/Collection";
import AddCollection from "./components/pages/collection/AddCollection";
import EditCollection from "./components/pages/collection/EditCollection";
import Page from "./components/pages/pages/Page";
import AddPages from "./components/pages/pages/AddPages";
import EditPages from "./components/pages/pages/EditPages";

const App = () => {
    return (
        <div>
            <HashRouter >
                <Layout>
                    <Switch>
                        <PrivateRoute exact path="/" component={Dashboard} />
                        <PrivateRoute exact path="/categories" component={Category} />
                        <PrivateRoute exact path="/categories/new" component={AddCategory} />
                        <PrivateRoute exact path="/categories/edit/:id" component={EditCategory} />
                        <PrivateRoute exact path="/products" component={Product} />
                        <PrivateRoute exact path="/products/new" component={AddProduct} />
                        <PrivateRoute exact path="/products/edit/:id" component={EditProduct} />
                        <PrivateRoute exact path="/themes" component={Themes} />
                        <PrivateRoute exact path="/themes/new" component={AddTheme} />
                        <PrivateRoute exact path="/themes/edit/:id" component={EditTheme} />
                        <PrivateRoute exact path="/themes/config/:id" component={ThemeConfig} />
                        <PrivateRoute exact path="/collections" component={Collection} />
                        <PrivateRoute exact path="/collections/new" component={AddCollection} />
                        <PrivateRoute exact path="/collections/edit/:id" component={EditCollection} />
                        <PrivateRoute exact path="/pages" component={Page} />
                        <PrivateRoute exact path="/pages/new" component={AddPages} />
                        <PrivateRoute exact path="/pages/edit/:id" component={EditPages} />

                    </Switch>
                </Layout>
            </HashRouter>
        </div>
    );
}

export default App;


