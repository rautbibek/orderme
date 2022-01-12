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
import TypeCondition from '../../Layout/TypeCondition';
import AddressSelect from '../../Layout/AddressSelect';
import VariantTypeSelect from '../../Layout/VariantTypeSelect';


interface productVarianceProps {
    productType?: any,
    optionType?: any,
    push?: any,
    pop?:any,
    values: any,
}
const ProductVariance: React.FC<productVarianceProps> = ({ productType, optionType , push, pop, values}) => {
    const [selectType, setSelectType] = React.useState([] as any);
    const [cartSystem, setCartSystem] = React.useState(false)

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

        }
    }, [productType, data])
    if(!cartSystem){
        return(
            <>
            <FieldArray name={'variants'}>
                {({ fields, meta }) =>{
                    return (
                        <div>
                            <Grid container spacing={1}>
                                <FieldArray name={`variants[${0}]features`}>
                                    {({fields}) =>
                                        selectType.map((i, number) => {
                                            return (
                                                <Grid key={number} item xs={1} style={{ marginBottom: 20 }}>
                                                    <VariantTypeSelect name={`variants[${0}]features.${i.name}`} type={i.type} label={i.as} />
                                                </Grid>
                                            )
                                        })
                                    }
                                </FieldArray>
                                <Grid item xs={1} style={{ marginBottom: 20 }}>
                                    <CustomTextField name={`variants[${0}].price`} type='text' label='Price' />
                                </Grid>
                                <Grid item xs={2} style={{ marginBottom: 20 }}>
                                    <CustomTextField name={`variants[${0}].old_price`} type='text' label='Old Price' />
                                </Grid>
                                <Grid item xs={1} style={{ marginBottom: 20 }}>
                                    <CustomTextField name={`variants[${0}].code`} type='text' label='SKU' />
                                </Grid>
                                <Grid item xs={1} style={{ marginBottom: 20 }}>
                                    <CustomTextField name={`variants[${0}].quantity`} type='text' label='Qty' />
                                </Grid>

                            </Grid>

                        </div>
                    )
                }

                }
            </FieldArray>
            <AddressSelect values={values} />
            </>
        )
    }

        return (
            <div>
                    <Button onClick={() => {
                        push('variants', {})
                    }} variant={"contained"} color={'secondary'} style={{marginBottom: 20}}> <AddCircleOutlineIcon fontSize={"small"}/></Button>

                <FieldArray name={'variants'}>
                    {({ fields, meta }) =>{
                        return (
                            <div>
                                {
                                    fields.map((name, index) => {
                                            return (
                                                <Grid container key={index} spacing={1}>
                                                    <FieldArray name={`variants[${index}]features`}>
                                                        {({fields}) =>
                                                            selectType.map((i, number) => {
                                                                return (
                                                                    <Grid key={number} item xs={2} style={{ marginBottom: 20 }}>
                                                                        <CustomTextField name={`variants[${index}]features.${i.name}`} type={i.type} label={i.as} />
                                                                    </Grid>
                                                                )
                                                            })
                                                        }
                                                    </FieldArray>
                                                    <Grid item xs={1} style={{ marginBottom: 20 }}>
                                                        <CustomTextField name={`variants[${index}].price`} type='text' label='Price' />
                                                    </Grid>
                                                    <Grid item xs={2} style={{ marginBottom: 20 }}>
                                                        <CustomTextField name={`variants[${index}].old_price`} type='text' label='Old Price' />
                                                    </Grid>
                                                    <Grid item xs={1} style={{ marginBottom: 20 }}>
                                                        <CustomTextField name={`variants[${index}].code`} type='text' label='SKU' />
                                                    </Grid>
                                                    <Grid item xs={1} style={{ marginBottom: 20 }}>
                                                        <CustomTextField name={`variants[${index}].quantity`} type='text' label='Qty' />
                                                    </Grid>
                                                    <Grid item xs={1} style={{ marginBottom: 20 }}>
                                        <span
                                            onClick={() => {
                                                fields.remove(index)
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
                            </div>
                        )
                    }

                    }
                </FieldArray>
                <TypeCondition/>
                
            </div>
        )

}

export default ProductVariance
