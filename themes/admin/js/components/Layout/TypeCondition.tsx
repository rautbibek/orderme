import { Grid } from '@material-ui/core'
import * as React from 'react'
import { Field } from 'react-final-form'
import { SingleSelect } from 'react-select-material-ui'

const TypeCondition = () => {

    const options = [
        {
            value: 'new',
            label: 'New'
        },
        {
            value: 'old',
            label: 'Old'
        },
        {
            value: 'refurbish',
            label: 'Refurbish'
        }
    ]

    return (
    <Field name="condition"  >
                {({ input, meta }) => {
                    return (
                        <Grid container spacing={3}>
                            <Grid item xs={12} style={{ marginBottom: 20 }}>
                                <SingleSelect
                                    label={'Condition'}
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

export default TypeCondition;