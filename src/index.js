import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter, Routes,Route } from 'react-router-dom';
//import './index.css';
import App from './App.js';
import Shop from './components/Shop/shop.jsx';
import Cart from './components/cart'
//import reportWebVitals from './reportWebVitals';
import * as serviceWorker from './serviceWorker';

const root = ReactDOM.createRoot(
  document.getElementById("root")
);
root.render(
  <BrowserRouter>
    <Routes>  
        <Route path="/" element={<App />} />
        <Route path="Shop" element={<Shop />} />
        <Route path="cart" element={<Cart />} />
    </Routes>
  </BrowserRouter>   
    
);

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister();
