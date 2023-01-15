import {useEffect, useState} from 'react';


export default function WordFixedCount(){
    const [wordFixed,setWordFixed]=useState({wordFixed:[]});

    useEffect(()=>{
    const url="http://127.0.0.1:8000/wordFixedCount";
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
