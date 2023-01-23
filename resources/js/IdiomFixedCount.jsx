import {useEffect, useState} from 'react';


export default function WordFixedCount(){
    const serverUrl=import.meta.env.VITE_SERVER_API_ADDRESS;

    const [wordFixed,setWordFixed]=useState({wordFixed:[]});

    useEffect(()=>{
    const url=serverUrl+"/wordFixedCount";

    fetch(url).then(response=>response.json()).then(data=>setWordFixed(data));
    },[]);

    return (
        <>
            {wordFixed.idiomTotalCount}&nbsp;fixed&nbsp; /
            &nbsp;{wordFixed.newIdiomFixedCount}&nbsp;new fixed&nbsp; /
            &nbsp;{wordFixed.idiomUnfixedCount}&nbsp;unfixed<br></br>
            &nbsp;{wordFixed.idiomAnswerCountTotal}&nbsp;total answer&nbsp; /
            &nbsp;{wordFixed.idiomAnswerCountCorrect}&nbsp;total correct&nbsp; /
            &nbsp;{wordFixed.idiomWeekState}&nbsp; /
        </>
    );
}
