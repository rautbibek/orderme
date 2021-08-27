import * as React from 'react'
import { CKEditor } from '@ckeditor/ckeditor5-react';
import * as ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {FormLabel, Grid, makeStyles} from "@material-ui/core";
import {Field} from "react-final-form";
import {projectStorage} from "../../utils/firebaseConfig";
import { v4 as uuidv4 } from 'uuid';

interface CkTextFieldProps {
    name: string
    label: string
}
class MyUploadAdapter {
    loader ;
    constructor( loader ) {
        // The file loader instance to use during the upload.
        this.loader = loader;
    }

    // Starts the upload process.
    upload() {

        // Return a promise that will be resolved when the file is uploaded.
        return this.loader.file
            .then( async(file) => {
                const id = uuidv4()
                const storageref =  projectStorage.ref(`${id}-${file.name}`)
                 const res = await storageref.put(file).then(async snapshot => {
                    return await snapshot.ref.getDownloadURL().then(url => {
                        return url
                    } )
                })
                return {default: res}
            } );
    }

    // Aborts the upload process.
    abort() {
        // Reject the promise returned from the upload() method.
    }
}
const useStyles = makeStyles(() => ({
    richTextEditor: {
        "& .ck-editor__main > .ck-editor__editable": {
            minHeight: "200px"
        }
    }
}));

const CkTextfield: React.FC<CkTextFieldProps> = ({name, label}) => {
    const classes = useStyles();
    return(
        <Field name={`${name}`} >
            {({ input, meta }) => {

                return (
                    <Grid container spacing={3} className={classes.richTextEditor}>
                        <Grid item xs={12} style={{ marginBottom: 20 }}>
                            <FormLabel>{label}</FormLabel>
                            <br/><br/>
                            <CKEditor

                                editor={ ClassicEditor }
                                data={input.value}
                                onChange={ ( event, editor ) => {
                                    input.onChange(editor.getData())
                                } }
                                onReady={(editor)=>{
                                    editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
                                        return  new MyUploadAdapter(loader);
                                    };
                                }}

                            />
                        </Grid>
                    </Grid>
                )
            }}
        </Field>

    )
}

export default CkTextfield
