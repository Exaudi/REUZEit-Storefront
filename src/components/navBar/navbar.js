import React, {Component} from 'react';
import "../../Styles/navbar.scss";
import logo from '../..//Assets/Logos/REUZEit Marketing Branding Logos and Icons for use/REUZEit No Tagline ® Official High res.png';
import {Link} from 'react-router-dom'
//import {Link} from "react-router-dom";

class navbar extends Component{
    render(){

        return (
            <header>
                <nav className='nav'>
                    <div className='nav__container'>
                        <div className='logo'>
                            
                        </div>
                   
                    <div className='buttons'>
                        <img src={logo} alt="REUZEit logo"/>
                        <button className='buttons__home'>HOME</button>
                        <Link to="/shop"><button className='buttons__shop'>SHOP</button></Link>
                        <button className='buttons__about'>ABOUT US</button>
                        <button className='buttons__library'>RESOURCE LIBRARY</button>
                        <button className='buttons__faq'>FAQ</button>
                        <button className='buttons__contactUs'>CONTACT US</button>
                        <button className='buttons__Cart'></button>
                    </div>
                    <div className="searchBar">
                        <input className="searchBar__input" placeholder='Search for Equipemnt'></input>

                    </div>
                    </div>
                </nav>
            </header>
        );
    }
}

export default navbar;
