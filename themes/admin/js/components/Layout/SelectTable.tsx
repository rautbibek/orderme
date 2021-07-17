import * as React from 'react'
import {MultipleSelect, SingleSelect} from "react-select-material-ui";
import HttpClient from "../../HttpClient";
import useSWR from "swr";
import {Grid} from "@material-ui/core";
import {Field} from "react-final-form";
import _ from 'lodash'

interface SelectTableProps {
    label: string;
    name: string;
    isMultiple?: boolean,
    isCreateable?: boolean,
    helperText?: string,
    table?: string,
}



const SelectTable: React.FC<SelectTableProps> = ({isMultiple, label, isCreateable, helperText, name, table}) => {

    const fetchData = async () => {
        return await HttpClient.get(table)
    }

    const { data: data, error } = useSWR(`${table}`, fetchData )

    const options = data?.data.map((item) =>  ({
        value: item.id,
        label: item.name
    }))

    if(!!isMultiple){
        return (
            <Field name={`${name}`}  >
                {({ input, meta }) => (
                    <Grid container spacing={3}>
                        <Grid item xs={12} style={{marginBottom: 20}}>
                            <MultipleSelect
                                label={label}
                                multiline={true}
                                options={options}
                                value={input.value}
                                helperText={helperText ?? ''}
                                onChange={(item) => input.onChange(item)}
                                SelectProps={{
                                    isCreatable: !!isCreateable,
                                    msgNoOptionsAvailable:`All options  are selected`,
                                    msgNoOptionsMatchFilter: `No option matches the filter`,
                                }}
                            />
                        </Grid>
                    </Grid>
                )}
            </Field>
        )
    }
    return (

        <Field name={`${name}`}  >
            {({ input, meta }) => {
                return (
                    <Grid container spacing={3}>
                        <Grid item xs={12} style={{marginBottom: 20}}>
                            <SingleSelect
                                label={label}
                                options={options}
                                value={input.value}
                                helperText={helperText ?? ''}
                                onChange={(item) => {
                                    input.onChange(item)
                                }}
                                SelectProps={{
                                    msgNoOptionsAvailable:`No options available`,
                                    msgNoOptionsMatchFilter: `No options matches the filter`,
                                }}
                            />
                        </Grid>
                    </Grid>
                )
            }}
        </Field>

    )
}

export default SelectTable
