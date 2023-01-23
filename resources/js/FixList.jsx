import {Link} from 'react-router-dom';
import {useState,useEffect} from 'react';

//navigation
import BottomNavigation from "@mui/material/BottomNavigation";
import BottomNavigationAction from "@mui/material/BottomNavigationAction";
import RestoreIcon from "@mui/icons-material/Restore";
import FavoriteIcon from "@mui/icons-material/Favorite";
import LocationOnIcon from "@mui/icons-material/LocationOn";
import Button from '@mui/material/Button';
import Box from '@mui/material/Box';
import QuizIcon from '@mui/icons-material/Quiz';
import AddIcon from '@mui/icons-material/Add';
import ListAltIcon from '@mui/icons-material/ListAlt';

//list
import Table from '@mui/material/Table';
import TableBody from '@mui/material/TableBody';
import TableCell from '@mui/material/TableCell';
import TableContainer from '@mui/material/TableContainer';
import TableHead from '@mui/material/TableHead';
import TableRow from '@mui/material/TableRow';
import Paper from '@mui/material/Paper';

//tab
import Tab from '@mui/material/Tab';
import TabContext from '@mui/lab/TabContext';
import TabList from '@mui/lab/TabList';
import TabPanel from '@mui/lab/TabPanel';
import { countBy } from 'lodash';


export default function FixList(){

    const serverUrl=import.meta.env.VITE_SERVER_API_ADDRESS;


    const [totalList,setTotalList]=useState({fixedList:[],unfixedList:[]});
    const [tabValue, setTabValue] = useState("1");
    const [navigation]=useState(3);

    useEffect(()=>{
        const url=serverUrl+"/fixList";

        fetch(url)
            .then(response=>response.json())
            .then(data=>{
                setTotalList(data);
            });
    },[]);

    //タブ切り替え
    const onChangeTab = (event, newValue) => {
        setTabValue(newValue);
    };

    return (
        <>
        <div id="navigation">
        <Box sx={{ width: 1000 }}>
            <BottomNavigation
                showLabels
                value={navigation}
            >
                <BottomNavigationAction label="Word" icon={<QuizIcon />} component={Link} to=".." />
                <BottomNavigationAction label="Idiom" icon={<QuizIcon />} component={Link} to="/idiom"   />
                <BottomNavigationAction label="Add" icon={<AddIcon />}  component={Link} to="/add" />
                <BottomNavigationAction label="List" icon={<ListAltIcon />}  component={Link} to="/list" />
            </BottomNavigation>
        </Box>
        </div>
        <br></br>
        <div id="tab">
            <Box sx={{ width: '100%', typography: 'body1' }}>
            <TabContext value={tabValue}>
                <Box sx={{ borderBottom: 1, borderColor: 'divider' }}>
                <TabList onChange={onChangeTab} aria-label="lab API tabs example" centered>
                    <Tab label={"fixed"+"("+totalList.fixedList.length+")"} value="1" />
                    <Tab label={"unfixed"+"("+totalList.unfixedList.length+")"} value="2" />
                </TabList>
                </Box>
                <TabPanel value="1">
                    <TableContainer component={Paper}>
                            <Table sx={{ minWidth: 650 }} aria-label="simple table">
                                <TableHead>
                                <TableRow>
                                    <TableCell align="center">Id</TableCell>
                                    <TableCell align="center">Day</TableCell>
                                    <TableCell align="center">Type</TableCell>
                                    <TableCell align="center">Parse</TableCell>
                                    <TableCell align="center">Jpn</TableCell>
                                    <TableCell align="center">Eng</TableCell>
                                    <TableCell align="center">Root</TableCell>
                                    <TableCell align="center">DerivedO</TableCell>
                                    <TableCell align="center">WordO</TableCell>
                                    <TableCell align="center">Prefix</TableCell>
                                    <TableCell align="center">Suffix</TableCell>
                                    <TableCell align="center">Sentence</TableCell>
                                </TableRow>
                                </TableHead>
                                <TableBody>
                                {totalList.fixedList.map((item,i) => (
                                    <TableRow
                                    key={i}
                                    sx={{ '&:last-child td, &:last-child th': { border: 0 } }}
                                    >
                                    <TableCell align="center">{item.id}</TableCell>
                                    <TableCell align="center">{item.created_at}</TableCell>
                                    <TableCell align="center">{item.type}</TableCell>
                                    <TableCell align="center">{item.parse}</TableCell>
                                    <TableCell align="center">{item.jpn}</TableCell>
                                    <TableCell align="center">{item.eng}</TableCell>
                                    <TableCell align="center">{item.root}</TableCell>
                                    <TableCell align="center">{item.origin}</TableCell>
                                    <TableCell align="center">{item.wordOrigin}</TableCell>
                                    <TableCell align="center">{item.prefix}</TableCell>
                                    <TableCell align="center">{item.suffix}</TableCell>
                                    <TableCell align="center">{item.sentence}</TableCell>
                                    </TableRow>
                                ))}
                                </TableBody>
                            </Table>
                        </TableContainer>
                </TabPanel>
                <TabPanel value="2">
                    <TableContainer component={Paper}>
                            <Table sx={{ minWidth: 650 }} aria-label="simple table">
                                <TableHead>
                                <TableRow>
                                <TableCell align="center">Id</TableCell>
                                    <TableCell align="center">Day</TableCell>
                                    <TableCell align="center">Type</TableCell>
                                    <TableCell align="center">Parse</TableCell>
                                    <TableCell align="center">Jpn</TableCell>
                                    <TableCell align="center">Eng</TableCell>
                                    <TableCell align="center">Root</TableCell>
                                    <TableCell align="center">DerivedO</TableCell>
                                    <TableCell align="center">WordO</TableCell>
                                    <TableCell align="center">Prefix</TableCell>
                                    <TableCell align="center">Suffix</TableCell>
                                    <TableCell align="center">Sentence</TableCell>


                                </TableRow>
                                </TableHead>
                                <TableBody>
                                {totalList.unfixedList.map((item,i) => (
                                    <TableRow
                                    key={i}
                                    sx={{ '&:last-child td, &:last-child th': { border: 0 } }}
                                    >
                                    <TableCell align="center">{item.id}</TableCell>
                                    <TableCell align="center">{item.created_at}</TableCell>
                                    <TableCell align="center">{item.type}</TableCell>
                                    <TableCell align="center">{item.parse}</TableCell>
                                    <TableCell align="center">{item.jpn}</TableCell>
                                    <TableCell align="center">{item.eng}</TableCell>
                                    <TableCell align="center">{item.root}</TableCell>
                                    <TableCell align="center">{item.origin}</TableCell>
                                    <TableCell align="center">{item.wordOrigin}</TableCell>
                                    <TableCell align="center">{item.prefix}</TableCell>
                                    <TableCell align="center">{item.suffix}</TableCell>
                                    <TableCell align="center">{item.sentence}</TableCell>
                                    </TableRow>
                                ))}
                                </TableBody>
                            </Table>
                    </TableContainer>
                </TabPanel>
            </TabContext>
            </Box>
        </div>
        <br></br>

        </>
    );
}


