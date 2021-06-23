import * as React from 'react'
import './sidebar.css'
import { Category, Dashboard, LocalOffer } from "@material-ui/icons";
import { Link, useLocation } from 'react-router-dom'


const Sidebar = () => {
    const location = useLocation()
    return (
        <div className='sidebar'>
            <div className='sidebarWraper'>
                <div className='sidebarMenu'>
                    <ul className='sidebarList'>
                        <li >
                            <Link to="/" className={`sidebarListItem ${'/' === location.pathname ? 'active' : ''}`}>
                                <Dashboard className='sidebarIcon' />
                                Dashboard
                            </Link>
                        </li>
                        <li>
                            <Link to="/categories" className={`sidebarListItem ${location.pathname.includes('categories') ? 'active' : ''}`}>
                                <Category className='sidebarIcon' />
                                Categories
                            </Link>
                        </li>
                        <li>
                            <Link to="/products" className={`sidebarListItem ${location.pathname.includes('products') ? 'active' : ''}`}>
                                <LocalOffer className='sidebarIcon' />
                                Products
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    )
}

export default Sidebar
