import * as React from 'react'
import {FormControlLabel, Grid, Switch, TextField, withStyles} from "@material-ui/core";
import { Field } from "react-final-form";

interface CustomCheckBoxProps {
    name: string;
    color: any
    checked: boolean
    label: string
}



const CustomCheckBox: React.FC<CustomCheckBoxProps> = ({ name, color, checked, label }) => {

    return (
        <Field name={`${name}`} defaultValue={false}  >
            {({ input, meta }) => (
                <Grid container spacing={3}>
                    <Grid item xs={12} style={{ marginBottom: 20 }}>
                        <FormControlLabel
                            control={
                                <Switch
                                    checked={checked || false}
                                    onChange={() => input.onChange(!checked)}
                                    color={color}
                                    name={name}
                                    inputProps={{ 'aria-label': 'primary checkbox' }}
                                />
                            }
                            label={label}
                        />

                        {meta.touched && meta.error && <span>{meta.error}</span>}
                    </Grid>
                </Grid>
            )}
        </Field>
    )
}

export default CustomCheckBox
