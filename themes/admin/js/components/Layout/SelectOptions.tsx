import * as React from 'react'
import { MultipleSelect, SingleSelect } from "react-select-material-ui";
import HttpClient from "../../HttpClient";
import useSWR from "swr";
import { Grid } from "@material-ui/core";
import { Field } from "react-final-form";

interface SelectOptionsProps {
    label: string;
    name: string;
    isCreateable?: boolean,
    helperText?: string,
    table?: string,
    optionValue?:any
}



const SelectOptions: React.FC<SelectOptionsProps> = ({ label, isCreateable, helperText, name, optionValue }) => {

    const options = optionValue.map((item) => ({
        value: item.id,
        label: item.name ?? item.title
    }))

    const createOption = (val) => {

    }

    return (

        <Field name={`${name}`}  >
            {({ input, meta }) => {
                return (
                    <Grid container spacing={3}>
                        <Grid item xs={12} style={{ marginBottom: 20 }}>
                            <SingleSelect
                                label={label}
                                options={options}
                                value={input.value}
                                helperText={helperText ?? ''}
                                onChange={(item) => {
                                    input.onChange(item)
                                    createOption(item)
                                }}


                                SelectProps={{
                                    isCreatable: true,
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

export default SelectOptions
