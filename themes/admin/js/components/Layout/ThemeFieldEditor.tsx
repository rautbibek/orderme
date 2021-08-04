import * as React from 'react'
import {Grid, InputLabel, TextField, withStyles} from "@material-ui/core";
import { Field } from "react-final-form";
import ImageDropZone from "./ImageDropZone";
import SelectTable from "./SelectTable";

interface ThemeFieldEditorProps {
    label: string;
    name: string;
    type: string
    options?: any
}

const CssTextField = withStyles({
    root: {
        '& label.Mui-focused': {
            color: 'grey',
        },
        '& .MuiInput-underline': {

        },
        '& .MuiInput-underline:after': {
            borderBottomColor: '#2684FF',
        },
        '& .MuiOutlinedInput-root': {
            '& fieldset': {
                borderColor: 'grey',
            },
            '&:hover fieldset': {
                borderColor: 'grey',
            },
            '&.Mui-focused fieldset': {
                borderColor: 'grey',
            },
        },
    },
})(TextField);

const ThemeFieldEditor: React.FC<ThemeFieldEditorProps> = ({ label, type, name, options  }) => {
    if(type === 'image'){
        return (
            <Field name={name}>
                {({ input, meta }) => (
                    <div style={{width: '100%'}}>
                        <InputLabel>{label}</InputLabel>
                        <ImageDropZone onChange={images => input.onChange(images)} media={input.value} />
                    </div>
                )}
            </Field>
        )
    }
    if(type === 'collection_select'){
        return (
            <SelectTable name={name} label={label} table={'collections'} isMultiple={options.multiple}/>
        )
    }
    return (
        <Field name={`${name}`}  >
            {({ input, meta }) => (

                <CssTextField size={'small'} type={`${type}`} multiline={type === 'textarea'} {...input}  id="standard-basic" label={`${label}`}  fullWidth />

            )}
        </Field>
    )
}

export default ThemeFieldEditor
