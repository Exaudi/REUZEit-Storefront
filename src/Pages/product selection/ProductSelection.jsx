//import React, {Component} from 'react';
import Nav from '../../components/navBar/navbar';
import Banner from '../../components/banner/PageBanner';

//import Dropdown from './dropdown/dropDownMenu';

export default function shop(){
    return(
        
        <div>
            <Nav />
            <div className='PPbanner'>
                <div className='PPbanner_container'>
                <Banner/>
                </div>
            </div>

            
         
        </div>
    );
}
