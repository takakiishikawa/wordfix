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
            {wordFixed.wordTotalCount}&nbsp;fixed&nbsp; /
            &nbsp;{wordFixed.newWordFixedCount}&nbsp;new fixed&nbsp; /
            &nbsp;{wordFixed.wordUnfixedCount}&nbsp;unfixed<br></br>
            &nbsp;{wordFixed.wordAnswerCountTotal}&nbsp;total answer&nbsp; /
            &nbsp;{wordFixed.wordAnswerCountCorrect}&nbsp;total correct&nbsp; /
            &nbsp;{wordFixed.wordWeekState}&nbsp; /
        </>
    );
}
