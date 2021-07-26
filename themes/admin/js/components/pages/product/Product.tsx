import * as React from 'react'
import Datatables from '../../Layout/Datatables';
import { listProduct } from '../../../createUrls';

const columns = [
    { field: 'title', headerName: 'Title', flex: 1 },
];

const Product = () => {
    return (
        <Datatables url={listProduct} columns={columns} title={'products'} />
    )
}

export default Product
