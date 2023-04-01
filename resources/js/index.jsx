import React from 'react';
import ReactDOM from 'react-dom/client';
import{createBrowserRouter,RouterProvider} from 'react-router-dom';
import Word from './Word';
import Add from './Add';
import Idiom from './Idiom';
import FixList from './FixList';


const router=createBrowserRouter([
    {
        path:'',
        element:<Word />,
    },
    {
        path:'idiom',
        element:<Idiom />,
    },

]);


ReactDOM.createRoot(document.querySelector('#root')).render(
    <RouterProvider router={router} />
);



