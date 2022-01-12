import { Grid } from '@material-ui/core';
import * as React from 'react'
import { Field } from 'react-final-form';
import { SingleSelect } from 'react-select-material-ui';
import CustomTextField from './CustomTextField';

interface VariantTypeSelectProps {
    name: string,
    type: string,
    label: string
}
const VariantTypeSelect: React.FC<VariantTypeSelectProps> = ({name, type, label}) => {
    switch(type) {
        case 'text':
          return(
              <CustomTextField name={name} type={type} label={label} />   
          )
        case 'landType':
          return(
              <LandTypeVariance name={name} label={label}/>
          )
        default:
          return (<div></div>)
      }
}

export default VariantTypeSelect

interface LandTypeVarianceProps{
    name: string,
    label: string
}
const LandTypeVariance:React.FC<LandTypeVarianceProps> = ({name, label}) => {

    const options = [
        {
            value: 'rent',
            label: 'Rent'
        },
        {
            value: 'sell',
            label: 'Sell'
        }
    ]

    return(
        <Field name={name}  >
        {({ input, meta }) => {
            return (
                <Grid container spacing={3}>
                    <Grid item xs={12} style={{ marginBottom: 20 }}>
                        <SingleSelect
                            label={'Type'}
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