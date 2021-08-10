import * as React from 'react'
import { Field } from 'react-final-form';
import { FieldArray } from "react-final-form-arrays";
import {Button, Grid} from '@material-ui/core';
import CustomTextField from '../../Layout/CustomTextField';
import * as _ from 'lodash'
import useSWR from 'swr';
import HttpClient from '../../../HttpClient';
import AddCircleOutlineIcon from '@material-ui/icons/AddCircleOutline';
import { IconButton } from '@material-ui/core';
import { Delete } from '@material-ui/icons';
import {forEach} from "lodash";


interface productVarianceProps {
    productType?: any,
    optionType?: any,
    push?: any,
    pop?:any
}
const ProductVariance: React.FC<productVarianceProps> = ({ productType, optionType , push, pop}) => {
    const [selectType, setSelectType] = React.useState([] as any);
    const [cartSystem, setCartSystem] = React.useState(false)
    const [varianceCount, setVarianceCount] = React.useState(0)

    const fetchData = async () => {
        return await HttpClient.get('product-types')
    }

    const { data, error } = useSWR(`${'product-types'}`, fetchData)

    React.useEffect(() =>{

    }, [])

    React.useEffect(() => {
        if (!!data) {
            const idea = _.find(data.data, { id: productType });
            const options = [JSON.parse(idea.field)]
            setCartSystem(idea.cart_system)
            setSelectType(options[0])
            for (let i = 0; i <= varianceCount; i++) {
                pop('variants')
            }
            setVarianceCount(0)
        }
    }, [productType, data])

        return (
            <div>
                {cartSystem &&(
                    <Button onClick={() => {
                        push('variants', {})
                        setVarianceCount(varianceCount + 1)
                    }} variant={"contained"} color={'secondary'} style={{marginBottom: 20}}> <AddCircleOutlineIcon fontSize={"small"}/></Button>
                )}
                {!cartSystem && varianceCount < 1 &&(
                    <Button onClick={() => {
                        push('variants', {})
                        setVarianceCount(varianceCount + 1)
                    }} variant={"contained"} color={'secondary'} style={{marginBottom: 20}}> <AddCircleOutlineIcon fontSize={"small"}/></Button>
                )}

                <FieldArray name={'variants'}>
                    {({ fields, meta }) =>
                       <div>
                           {
                               fields.map((name, index) => {
                                       return (
                                           <Grid key={index} container spacing={1}>
                                               <FieldArray name={`variants[${index}]features`}>
                                                   {({fields}) =>
                                                       selectType.map((i, number) => {
                                                           return (
                                                               <Grid key={number} item xs={1} style={{ marginBottom: 20 }}>
                                                                   <CustomTextField name={`variants[${index}]features.${i.name}`} type={i.type} label={i.as} />
                                                               </Grid>
                                                           )
                                                       })
                                                   }
                                               </FieldArray>
                                               <Grid item xs={1} style={{ marginBottom: 20 }}>
                                                   <CustomTextField name={`variants[${index}].price`} type='text' label='Price' />
                                               </Grid>
                                               <Grid item xs={1} style={{ marginBottom: 20 }}>
                                                   <CustomTextField name={`variants[${index}].old_price`} type='text' label='Old Price' />
                                               </Grid>
                                               <Grid item xs={1} style={{ marginBottom: 20 }}>
                                                   <CustomTextField name={`variants[${index}].code`} type='text' label='SKU' />
                                               </Grid>
                                               <Grid item xs={1} style={{ marginBottom: 20 }}>
                                                   <CustomTextField name={`variants[${index}].quantity`} type='text' label='Quantity' />
                                               </Grid>
                                               <Grid item xs={1} style={{ marginBottom: 20 }}>
                                        <span
                                            onClick={() => {
                                                fields.remove(index)
                                                setVarianceCount(varianceCount - 1)
                                            }}
                                            style={{ cursor: "pointer" }}
                                        >
                                            <IconButton color="inherit">
                                                <Delete />
                                            </IconButton>
                                        </span>
                                               </Grid>
                                           </Grid>
                                       )
                                   }
                               )
                           }
                           {meta.touched && meta.error && <span style={{color: 'red'}}>{meta.error}</span>}
                       </div>
                    }
                </FieldArray>
            </div>
        )

}

export default ProductVariance
