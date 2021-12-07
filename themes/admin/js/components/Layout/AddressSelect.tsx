import * as React from 'react'
import { MultipleSelect, SingleSelect } from "react-select-material-ui";
import HttpClient from "../../HttpClient";
import useSWR from "swr";
import { Grid } from "@material-ui/core";
import { Field } from "react-final-form";
import {array} from "yup";


interface AddressSelectProps {
    values?:any
}

const AddressSelect: React.FC<AddressSelectProps> = ({values}) => {

    const fetchData = async () => {
        return await HttpClient.get(`province`)
    }

    const [province, setProvince] = React.useState(values.province)
    const [city, setCity] = React.useState([] as any)

    React.useEffect(() => {
        if(province != null){
            const fetchCity = async () => {
                const cities = await HttpClient.get(`province/${province}`);
                setCity(cities.data.subdivisions)
            }
            fetchCity()
        }
    },[province])

    const { data: data, error } = useSWR(`province`, fetchData, { revalidateOnFocus: false, revalidateOnReconnect: false })
    if(!data?.data){
        return (
            <></>
        )
    }
    // console.log(data)
    const provinces = Object.values(data.data) as any
    const options = provinces.map((item) => ({
        value: item.iso_code,
        label: item.name
    }))

     const optionCity = city?.map((item) => ({
         value: item,
         label: item
     }))

    return (

        <>
            <Field name="province"  >
                {({ input, meta }) => {
                    return (
                        <Grid container spacing={3}>
                            <Grid item xs={12} style={{ marginBottom: 20 }}>
                                <SingleSelect
                                    label={'Province'}
                                    options={options}
                                    value={input.value}
                                    onChange={(item) => {
                                        input.onChange(item)
                                        setCity([])
                                        setProvince(item)
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
            <Field name="city"  >
                {({ input, meta }) => {
                    return (
                        <Grid container spacing={3}>
                            <Grid item xs={12} style={{ marginBottom: 20 }}>
                                <SingleSelect
                                    label={'City'}
                                    options={optionCity}
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
        </>


    )
}

export default AddressSelect
