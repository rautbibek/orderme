import * as React from 'react'
import {Form} from "react-final-form";
import CustomTextField from "../../Layout/CustomTextField";
import SelectTable from "../../Layout/SelectTable";
import {Button, makeStyles} from "@material-ui/core";
import {useHistory} from 'react-router-dom'
import CustomCheckBox from "../../Layout/CustomCheckBox";


const useStyles = makeStyles((theme) => ({
    root: {
        display: 'flex',
        flexWrap: 'wrap',
    },
    form: {
        width: '100%',
    },
    buttonWrapper: {
        display: 'flex',
        marginTop: 20,
        marginButtom: 5,
        '& Button': {
            marginRight: 10
        }
    }
}));

interface ThemeEditComponentProps {
    onSubmit: any,
    theme?:any
}
const ThemeEditComponent: React.FC<ThemeEditComponentProps> = ({onSubmit, theme}) => {
    const classes = useStyles();
    const history = useHistory()
    return (
        <Form
            onSubmit={onSubmit}
            initialValues={{
                ...theme
            }}
            render={({ handleSubmit, values }) => (
                <form onSubmit={handleSubmit} className={classes.form}>
                    <CustomTextField name="name" type={'text'} label={'Name'}/>
                    <CustomCheckBox name={'active'} color={'secondary'} checked={values.active} label={'Active'}/>
                    <div className={classes.buttonWrapper}>
                        <Button variant={"contained"}  color="primary" type="submit">Submit</Button>
                        <Button variant={"contained"}  color="secondary" onClick={() => history.push('/themes')}>Back</Button>
                    </div>
                </form>
            )}
        />
    )
}

export default ThemeEditComponent
