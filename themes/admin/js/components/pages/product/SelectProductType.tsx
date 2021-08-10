import * as React from 'react'
import HttpClient from "../../../HttpClient";
import useSWR, { mutate } from "swr";
import { Grid } from "@material-ui/core";
import { SingleSelect } from "react-select-material-ui";
import { Field } from "react-final-form";
import * as _ from 'lodash'

interface SelectProductTypeProps {
    onSelect?: any
    disabled?: boolean
}
const SelectProductType: React.FC<SelectProductTypeProps> = ({ onSelect, disabled }) => {

    const fetchData = async () => {
        return await HttpClient.get('product-types')
    }

    const { data: data, error } = useSWR(`${'product-types'}`, fetchData, {revalidateOnFocus: false, revalidateOnReconnect: false})

    const options = data?.data.map((item) => ({
        value: item.id,
        label: item.title,
    }))

    const handleSelect = (item) => {

        const idea = _.find(data.data, { id: item });
        onSelect([JSON.parse(idea.field)])
    }

    return (
        <Field name={`product_type_id`}  >
            {({ input, meta }) => {
                return (
                    <Grid container spacing={3}>
                        <Grid item xs={12} style={{ marginBottom: 20 }}>
                            <SingleSelect
                                disabled={!!disabled}
                                label={'Select Product Type'}
                                options={options}
                                value={input.value}
                                onChange={(item) => {
                                    input.onChange(item)
                                    handleSelect(item)
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

export default SelectProductType
