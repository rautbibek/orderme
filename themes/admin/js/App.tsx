import * as React from 'react';
import { HashRouter, BrowserRouter, Switch } from "react-router-dom";
import Dashboard from "./components/pages/dashboard/Dashboard";
import PrivateRoute from "./PrivateRoute";
import Category from "./components/pages/category/Category";
import Product from "./components/pages/product/Product";
import Customer from './components/pages/customer/Customer';
import EditCustomer from './components/pages/customer/EditCustomer';
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
import Menu from "./components/pages/menu/Menu";
import AddMenu from "./components/pages/menu/AddMenu";
import EditMenu from "./components/pages/menu/EditMenu";
import Brands from "./components/pages/brands/brands";
import AddBrand from "./components/pages/brands/AddBrand";
import EditBrand from "./components/pages/brands/EditBrand";
import Order from "./components/pages/order/Order";
import EditOrder from "./components/pages/order/EditOrder";
import Service from "./components/pages/service/Service"
import AddService from "./components/pages/service/AddService";
import EditService from "./components/pages/service/EditService";
import Invoice from "./components/pages/order/Invoice";
import Expert from "./components/pages/service/Expert";
import AddExpert from "./components/pages/service/AddExpert";
import EditExpert from "./components/pages/service/EditExpert";

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
                        <PrivateRoute exact path="/customers" component={Customer} />
                        <PrivateRoute exact path="/customers/edit/:id" component={EditCustomer} />
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
                        <PrivateRoute exact path="/menus" component={Menu} />
                        <PrivateRoute exact path="/menus/new" component={AddMenu} />
                        <PrivateRoute exact path="/menus/edit/:id" component={EditMenu} />
                        <PrivateRoute exact path="/brands" component={Brands} />
                        <PrivateRoute exact path="/brands/new" component={AddBrand} />
                        <PrivateRoute exact path="/brands/edit/:id" component={EditBrand} />
                        <PrivateRoute exact path="/orders" component={Order} />
                        <PrivateRoute exact path="/orders/edit/:id" component={EditOrder} />
                        <PrivateRoute exact path="/services" component={Service} />
                        <PrivateRoute exact path="/services/new" component={AddService} />
                        <PrivateRoute exact path="/services/edit/:id" component={EditService} />
                        <PrivateRoute exact path="/orders/invoice/:id" component={Invoice} />
                        <PrivateRoute exact path="/experts" component={Expert} />
                        <PrivateRoute exact path="/experts/new" component={AddExpert} />
                        <PrivateRoute exact path="/experts/edit/:id" component={EditExpert} />

                    </Switch>
                </Layout>
            </HashRouter>
        </div>
    );
}

export default App;


