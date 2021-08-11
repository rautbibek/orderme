import * as React  from 'react';
import {useDropzone} from 'react-dropzone';
import HttpClient from "../../HttpClient";
import {uploadMediaFiles} from "../../createUrls";
import CancelIcon from '@material-ui/icons/Cancel';
import * as _ from "lodash";
import {projectStorage} from "../../utils/firebaseConfig";
import { v4 as uuidv4 } from 'uuid';

const thumbsContainer = {
    display: 'flex',
    flexDirection: 'row',
    flexWrap: 'wrap',
    marginTop: 16,
    border: '2px dashed #79301d',
    height: 130,
    padding: 15,

} as React.CSSProperties;

const thumb = {
    display: 'inline-flex',
    borderRadius: 2,
    border: '1px solid #eaeaea',
    marginBottom: 8,
    marginRight: 8,
    width: 100,
    height: 100,
    padding: 4,
    boxSizing: 'border-box',
    position: "relative",
    justifyContent:"center"
} as React.CSSProperties;

const thumbInner = {
    display: 'flex',
    minWidth: 0,
    overflow: 'hidden'
} as React.CSSProperties;

const img = {
    display: 'block',
    width: 'auto',
    height: '100%'
} as React.CSSProperties;

interface ImageDropZoneProps {
    onChange: any
    media: any[],
    multiple?:boolean
}
const ImageDropZone: React.FC<ImageDropZoneProps> = ({onChange, media, multiple}) => {
    const [files, setFiles] = React.useState([]);

    const uploadMedia = async (uploadFile) => {
        // console.log(uploadFile)
        const formData = []
        await Promise.all(
            uploadFile.map(async (f) => {
                const id = uuidv4()
                const storageref = await projectStorage.ref(`${id}-${f.name}`)
                 await storageref.put(f).then(async snapshot => {
                    await snapshot.ref.getDownloadURL().then(url => {
                        formData.push(url)
                    } )
                })

            })
        )

        return formData

    }
    const onDrop = async (acceptedFiles: any, rejectedFiles: any) => {

        const response = await uploadMedia(acceptedFiles)
        if(!multiple){
            onChange([...response])
        }else{
            onChange([...media, ...response])
        }

    }
    const { getRootProps, getInputProps, isDragActive } = useDropzone({
        onDrop,
        multiple: multiple,
        accept: 'image/jpeg, image/png',
    })

    const thumbs = (media || [])
        .map((m, index: number) => {
            return (
                <div style={thumb} key={index}>
                    <div style={thumbInner}>
                        <img
                            src={m}
                            style={img}
                        />
                    </div>
                    <span style={{position: "absolute", marginLeft: 80, marginTop: -10, cursor: "pointer", zIndex: 999}} onClick={e => {
                        e.stopPropagation()
                        removeImage(m)
                    }}><CancelIcon fontSize={"small"} color={"secondary"} /></span>
                </div>
            )
        })



    React.useEffect(() => () => {
        // Make sure to revoke the data uris to avoid memory leaks
        files.forEach(file => URL.revokeObjectURL(file.preview));
    }, [files]);

    const removeImage = async(fileId) => {
            const currentMedia = _.filter(media, f => f !== fileId)
            onChange(currentMedia)
    }

    return (
        <section style={{margin:'30px 30px'}}>
            <div {...getRootProps({className: 'dropzone'})}>
                <aside style={thumbsContainer}>
                    <input {...getInputProps()} />
                    {media.length < 1 && (<p>Drag 'n' drop some files here, or click to select files</p>)}
                    {thumbs}
                </aside>
            </div>
        </section>
    );
}
export default ImageDropZone
