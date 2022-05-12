//import React, {Component} from 'react';
import Nav from '../navBar/navbar'
import '../../Styles/shop.scss'

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
                    <li className='card__table--item'>Mass Specs</li>
                    <li className='card__table--item'>HPLC’s</li>
                    <li className='card__table--item'>Cold Storage</li>
                    <li className='card__table--item'>Molecular Biology</li>
                </ul>
            </div>
               
            </div>

            <h2 className='shop__title2'>All Catergories</h2>
            
            </div>
           
        </body>
    );
}
