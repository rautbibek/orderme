import * as React from 'react'
import {Avatar, Box, CardContent, Grid, LinearProgress, Paper, Typography, makeStyles, Icon} from "@material-ui/core";


interface CardProps {
    title: any,
    count: number,
    progress: number,
    color?: any
    Icon?: any
}
const useStyles = makeStyles((theme) => ({
    paperStyle: {
        padding: theme.spacing(2),
        height: "75%"
    },
    avatarStyle: {
        backgroundColor: "#e53935",
        height: "46px",
        width: "46px",
        marginRight: "auto"
    },
    footer: {
        display: "flex",
        justify: "space-between",
        marginTop: "16px"
    },
    typographyStyle: {
        fontSize: "14px",
        fontWeight: "bold",
        marginRight: "70px"
    }
}));

const Card:React.FC<CardProps> = ({title, count, progress, color, Icon}) => {
    const classes = useStyles();
    return (
            <Grid item xs={4}>
                <Paper elevation={3} className={classes.paperStyle}>
                    <CardContent>
                        <Grid item container style={{justifyContent:'space-between'}} >
                            <Grid item>
                                <Typography
                                    className={classes.typographyStyle}
                                    gutterBottom={true}
                                >
                                    {title}
                                </Typography>
                                <Typography className={classes.typographyStyle}>
                                    {count}
                                </Typography>
                            </Grid>
                            <Grid item>
                                <Avatar className={classes.avatarStyle}>
                                    {Icon}
                                </Avatar>
                            </Grid>
                        </Grid>
                        <br/>
                        {/*<Box  className={classes.footer}>*/}
                        {/*    <GridArrowDownwardIcon style={{ color: "red" }} />*/}
                        {/*    /!*<Typography style={{ marginRight: "8px" }}>12%</Typography>*!/*/}
                        {/*    /!*<Typography>Since Last Month</Typography>*!/*/}
                        {/*</Box>*/}
                    </CardContent>
                </Paper>
            </Grid>
    )
}

export default Card
