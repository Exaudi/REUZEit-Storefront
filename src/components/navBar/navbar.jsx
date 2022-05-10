import React, {Component} from 'react';
import "../../Styles/navbar.scss";
import logo from '../..//Assets/Logos/REUZEit Marketing Branding Logos and Icons for use/REUZEit No Tagline ® Official High res.png';
//import {Link} from "react-router-dom";

class navbar extends Component{
    render(){

        return (
            <navBar className='nav'>
                <div className='nav__logo'>
                    <img src={logo} alt="REUZEit logo"/>
                </div>
                <div className='nav__buttons'>
                    <button className='nav__buttons--home'>HOME</button>
                    <button className='nav__buttons--shop'>SHOP</button>
                    <button className='nav__buttons--about'>ABOUT US</button>
                    <button className='nav__buttons--library'>RESOURCE LIBRARY</button>
                    <button className='nav__buttons--faq'>FAQ</button>
                    <button className='nav__buttons--contactUs'>CONTACT US</button>
                    <button className='nav__buttons--Cart'></button>
                </div>
                <div className="nav__searchBar">
                    <input className="search" placeholder='Search for Equipemnt'></input>

                </div>
            </navBar>
        );
    }
}

//export default navbar;
