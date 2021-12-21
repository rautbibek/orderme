import React from 'react'

const Layout = ({show, children}) => {
    return (
        <div className={ show ? 'layout-front shrink' : 'layout-front'}>{children}</div>
    )
}

export default Layout;
