import React from 'react'
import {Grid} from "@material-ui/core";
import {Field} from "react-final-form";
import {FormGroup, Input, Label} from "reactstrap";

const Textfield = ({name, disabled = false, label, type='text'}) => {
    return (
        <div className={'col-md-12'}>
            <Field name={`${name}`} >
                {({ input, meta }) => {

                    return (
                        <FormGroup>
                            <Label>{label}</Label>
                            <Input disabled={disabled} type={type} name={name} {...input} placeholder={label} />
                            {meta.touched && meta.error && <span>{meta.error}</span>}
                        </FormGroup>
                    )
                }}
            </Field>
        </div>
    )
}

export default Textfield
