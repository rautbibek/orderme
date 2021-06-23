import * as React from 'react'
import './sidebar.css'
import {Category, Dashboard, LocalOffer} from "@material-ui/icons";
import {Link} from 'react-router-dom'


const Sidebar = () => {
    return (
        <div className='sidebar'>
            <div className='sidebarWraper'>
                <div className='sidebarMenu'>
                    <ul className='sidebarList'>
                        <li >
                            <Link exact to="/" className='sidebarListItem active'>
                                <Dashboard className='sidebarIcon'/>
                                Dashboard
                            </Link>
                        </li>
                        <li>
                            <Link exact to="/categories" className='sidebarListItem'>
                                <Category className='sidebarIcon'/>
                                Category
                            </Link>
                        </li>
                        <li>
                            <Link exact to="/products" className='sidebarListItem'>
                                <LocalOffer className='sidebarIcon'/>
                                Product
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    )
}

export default Sidebar
