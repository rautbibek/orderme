import * as React from 'react'
import {Select, MenuItem, FormControl, InputLabel} from "@material-ui/core";


// interface CustomTextFieldProps {
// label: String;
// type: String;
// name: String;
// }

const SelectTable = () => {
    return (
        <FormControl variant="outlined" fullWidth size={'small'} >
            <InputLabel htmlFor="outlined-age-native-simple">Age</InputLabel>
            <Select
                native
                // value={state.age}
                // onChange={handleChange}
                label="Age"
                inputProps={{
                    name: "age",
                    id: "outlined-age-native-simple"
                }}
            >
                <option aria-label="None" value="" />
                <option value={10}>Tn</option>
                <option value={20}>Twenty</option>
                <option value={30}>Thirty</option>
            </Select>
        </FormControl>
    )
}

export default SelectTable
