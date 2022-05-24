//import React, {Component} from 'react';
import React, {useState, useEffect} from "react";
import Nav from '../navBar/navbar'
import LoadMore from "./loadMore";
//import PS from '../product selection/ProductSelection';
import '../../Styles/shop.scss'
import { Link } from "react-router-dom";

export default function shop(){


    return(
        
        <body>
            <Nav />
        <div className='shop'>
            <h2 className='shop__title'>Top Catergories</h2>
            <div className='card'>
                <div className='card__container'>
                <ul className='card__table'>
                    <div className='card__table--item'>
                        <li>Analytical</li>
                    </div>
                    <div className='card__table--item'>
                        <li>Mass Specs</li>
                    </div>
                    <div className='card__table--item'>
                        <li>HPLC's</li>
                    </div>
                    <div className='card__table--item'>
                        <li>Cold Storage</li>
                    </div>
                    <div className='card__table--item'>
                        <li>Molecular Biology</li>
                    </div>
                </ul>
            </div>
               
            </div>

            <h2 className='shop__title2'>All Catergories</h2>
            <div className='showMore'>
                <LoadMore />
                <Link to='/slection'><button>Next page</button></Link>
            </div>
            
            </div>
        </body>
    );
    };



