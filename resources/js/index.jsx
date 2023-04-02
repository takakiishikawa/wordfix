import React from 'react';
import ReactDOM from 'react-dom/client';
import{createBrowserRouter,RouterProvider} from 'react-router-dom';
import Word from './Word';


const router=createBrowserRouter([
    {
        path:'',
        element:<Word />,
    },
]);


ReactDOM.createRoot(document.querySelector('#root')).render(
    <RouterProvider router={router} />
);



