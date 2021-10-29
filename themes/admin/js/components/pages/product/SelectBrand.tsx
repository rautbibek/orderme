import * as React from 'react'
import HttpClient from "../../../HttpClient";
import useSWR, { mutate } from "swr";
import { Grid } from "@material-ui/core";
import { SingleSelect } from "react-select-material-ui";
import { Field } from "react-final-form";
import * as _ from 'lodash'

interface SelectBrandProps {
    productType?: any,
    value?: any
}
const SelectBrand: React.FC<SelectBrandProps> = ({ productType, value }) => {

    const fetchData = async () => {
        return await HttpClient.get(`brands-by-product/${productType}`)
    }

    const { data: data, error } = useSWR(`brands-by-product/${productType}`, fetchData, {revalidateOnFocus: false, revalidateOnReconnect: false})

    const options = data?.data.map((item) => ({
        value: item.id,
        label: item.name,
    }))

    if(!!options && options.length === 0){
        return(
            <></>
        )
    }

    return (
        <Field name={`brand_id`}  >
            {({ input, meta }) => {
                return (
                    <Grid container spacing={3}>
                        <Grid item xs={12} style={{ marginBottom: 20 }}>
                            <SingleSelect
                                label={'Select Brand'}
                                options={options}
                                value={input.value}
                                onChange={(item) => {
                                    input.onChange(item)
                                }}
                                SelectProps={{
                                    msgNoOptionsAvailable: `No options available`,
                                    msgNoOptionsMatchFilter: `No options matches the filter`,
                                }}
                            />
                            {meta.touched && meta.error && <span style={{color: 'red'}}>{meta.error}</span>}
                        </Grid>
                    </Grid>
                )
            }}
        </Field>
    )
}

export default SelectBrand
