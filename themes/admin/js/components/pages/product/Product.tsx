import * as React from 'react'
import { listProduct } from '../../../createUrls';
import DataTablesPaginate from "../../Layout/DatatablesPaginate";

const columns = [

    { field: 'title', headerName: 'Title', flex: 1 },
    {
        field: 'image',
        headerName: 'Image',
        renderCell: (params) => (
            <div style={{display: "flex", justifyContent: "center", width: '100%'}}>
                <img src={!!params.value && params.value.length > 0 ? params.value[0] : '/no-image.jpg'} alt="" style={{height: 50}}/>
            </div>
        ),
        width: 150

    },
];

const Product = () => {
    return (
        <DataTablesPaginate newButtonToolbar url={listProduct} columns={columns} title={'products'} />
    )
}

export default Product
