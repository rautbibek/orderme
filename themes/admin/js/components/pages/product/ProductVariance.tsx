import * as React from 'react'
import { Field } from 'react-final-form';
import { FieldArray } from "react-final-form-arrays";
import { Grid } from '@material-ui/core';
import CustomTextField from '../../Layout/CustomTextField';
import * as _ from 'lodash'
import useSWR from 'swr';
import HttpClient from '../../../HttpClient';
import { MultipleSelect } from 'react-select-material-ui';
import { IconButton } from '@material-ui/core';
import { Delete } from '@material-ui/icons';


interface productVarianceProps {
    variance: boolean,
    productType?: any,
    optionType?: any
}
const ProductVariance: React.FC<productVarianceProps> = ({ variance, productType, optionType }) => {
    const [selectType, setSelectType] = React.useState([] as any);
    const [selectOption, setSelectOption] = React.useState({} as any);
    const [cartisan, setCartisan] = React.useState([] as any)

    const fetchData = async () => {
        return await HttpClient.get('product-types')
    }

    const { data, error } = useSWR(`${'product-types'}`, fetchData)

    const handleOptions = (item) => {

        setSelectOption({ ...selectOption, ...item })

    }

    const optionCalculator = () => {

        let optionsss = []
        for (const [key, value] of Object.entries(optionType ? optionType : {})) {

            let values = []
            for (const [k, v] of Object.entries(value)) {

                values.push(v)
            }
            optionsss.push(values)
        }

        // const cartesian = (...a) => a.reduce((a, b) => a.flatMap(d => b.map(e => [d, e].flat())));
        const cartesian = (list, n = 0, result = [], current = []) => {
            if (n === list.length) result.push(current)
            else list[n].forEach(item => cartesian(list, n + 1, result, [...current, item]))

            return result
        }

        const blueprint = cartesian(optionsss.reverse())
        setCartisan(blueprint)

    }

    React.useEffect(() => {

        optionCalculator()

    }, [optionType])

    React.useEffect(() => {
        if (!!data) {
            const idea = _.find(data.data, { id: productType });
            const options = [JSON.parse(idea.field)]
            setSelectType(_.map(options[0], 'name'))
        }
    }, [productType, data])


    if (variance && cartisan.length > 0 && selectType.length > 0) {
        return (
            <div>
                <Grid container spacing={3}>
                    <FieldArray name={'options'}  >
                        {({ fields }) =>
                            (selectType || []).map((item, index) => {
                                return (
                                    <Field name={`options.${item}`} key={index}  >
                                        {({ input, meta }) => {

                                            return (

                                                <Grid key={index} item xs={3} style={{ marginBottom: 20 }}>

                                                    <MultipleSelect
                                                        label={item}
                                                        options={input.value || []}
                                                        values={input.value || []}
                                                        onChange={(val) => {
                                                            input.onChange(val)
                                                        }}
                                                        SelectProps={{
                                                            isCreatable: true,
                                                            isClearable: true,
                                                            msgNoOptionsAvailable: `All options  are selected`,
                                                            msgNoOptionsMatchFilter: `No option matches the filter`,
                                                        }}
                                                    />
                                                </Grid>
                                            )
                                        }}
                                    </Field>
                                )
                            })
                        }
                    </FieldArray>
                </Grid>
                <FieldArray name={'variants'}>
                    {({ fields }) =>
                        cartisan.map((name, index) => {
                            return (
                                <Grid key={index} container spacing={1}>

                                    {selectType.map((item, i) => {
                                        return (
                                            <Grid key={i} item xs={1} style={{ marginBottom: 20 }}>
                                                <CustomTextField name={`variants[${index}].${item}`} defaultValue={name[i]} disabled={true} type='text' label={item} />
                                            </Grid>
                                        )
                                    })}
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
                                                let currentCartisian = cartisan
                                                currentCartisian.splice(index, 1)
                                                setCartisan(currentCartisian)
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
                </FieldArray>
            </div>
        )
    }
    return (
        <FieldArray name={'variants[0]'}>
            {({ fields }) =>
            (
                <Grid container spacing={1} >
                    {selectType.map((item, i) => {
                        console.log(item)
                        return (
                            <Grid key={i} item xs={1} style={{ marginBottom: 20 }}>
                                <CustomTextField name={`variants[0].${item}`} type='text' label={item} />
                            </Grid>
                        )
                    })}
                    <Grid item xs={1} style={{ marginBottom: 20 }}>
                        <CustomTextField name={`variants[0].price`} type='text' label='Price' />
                    </Grid>

                    <Grid item xs={1} style={{ marginBottom: 20 }}>
                        <CustomTextField name={`variants[0].old_price`} type='text' label='Old Price' />
                    </Grid>
                    <Grid item xs={1} style={{ marginBottom: 20 }}>
                        <CustomTextField name={`variants[0].code`} type='text' label='SKU' />
                    </Grid>
                    <Grid item xs={1} style={{ marginBottom: 20 }}>
                        <CustomTextField name={`variants[0].quantity`} type='text' label='Quantity' />
                    </Grid>
                </Grid>
            )
            }
        </FieldArray>
    )
}

export default ProductVariance
