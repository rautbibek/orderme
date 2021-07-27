import * as React  from 'react';
import {useDropzone} from 'react-dropzone';
import HttpClient from "../../HttpClient";
import {uploadMediaFiles} from "../../createUrls";
import CancelIcon from '@material-ui/icons/Cancel';
import * as _ from "lodash";

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
    media: any
}
const ImageDropZone: React.FC<ImageDropZoneProps> = ({onChange, media}) => {
    const [files, setFiles] = React.useState([]);

    const uploadMedia = async (uploadFile, fields= {}) => {
        console.log(uploadFile)
        const formData = new FormData()
        uploadFile.forEach(f => {
            formData.append('files[]', f)
        })

        for (const property in fields) {
            formData.append(property, fields[property])
        }

        return await HttpClient.post(uploadMediaFiles, formData)

    }
    const onDrop = async (acceptedFiles: any, rejectedFiles: any) => {

        // uploadMedia(acceptedFiles)
        const response = await uploadMedia(acceptedFiles)
        if (response.status !== 200) {
            return null
        }
        // console.log(response);
        onChange([...(media ?? []), ...response.data])

    }
    const { getRootProps, getInputProps, isDragActive } = useDropzone({
        onDrop,
        multiple: true,
        accept: 'image/jpeg, image/png',
    })

    const thumbs = (media || [])
        .map((m) => {
            return (
                <div style={thumb} key={m.url}>
                    <div style={thumbInner}>
                        <img
                            src={m.url}
                            style={img}
                        />
                    </div>
                    <span style={{position: "absolute", marginLeft: 80, marginTop: -10, cursor: "pointer", zIndex: 999}} onClick={e => {
                        e.stopPropagation()
                        removeImage(m.ref)
                    }}><CancelIcon fontSize={"small"} color={"secondary"} /></span>
                </div>
            )
        })



    React.useEffect(() => () => {
        // Make sure to revoke the data uris to avoid memory leaks
        files.forEach(file => URL.revokeObjectURL(file.preview));
    }, [files]);

    const removeImage = async(fileId) => {
        const res = await HttpClient.get(`media/remove/${fileId}`)
        if(res.status === 200){
            const currentMedia = _.filter(media, f => f.ref !== fileId)
            onChange(currentMedia)
        }
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
