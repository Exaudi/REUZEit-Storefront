import React, {useState} from 'react';
import "../../Styles/navbar.scss";
import logo from '../..//Assets/Logos/REUZEit Marketing Branding Logos and Icons for use/REUZEit No Tagline ® Official High res.png';
import cartIcon from '../../Assets/icons/cart.png';
import {Link} from 'react-router-dom'
import hamMenu from '../../Assets/icons/icons8-menu-50.png'

//import {Link} from "react-router-dom";

    const NavBar = () =>{
        // const [click, setClick] = useState(false);
        // const [dropdown, setDropdown] = useState(false);

        // const handleClick = () => setClick(!click);
        // const closeMobileMenu = () => setClick(false);

        // const onMouseEnter = () =>{
        //     if (window.innerWidth < 1080){
        //         setDropdown(false);
        //     } else{
        //         setDropdown(true);
        //     }
        // };

        // const onMouseLeave = () =>{
        //     if (window.innerWidth < 1080){
        //         setDropdown(true);
        //     } else{
        //         setDropdown(false);
        //     }
        // };


        return (
           
                <nav className='nav'>
                    <div className='nav__containerR'>
                        <div className='nav__logo'>
                            <Link to='/'><img src={logo} className='hero' alt="REUZEit_logo"/></Link>
                        </div>
                        <div className="nav__searchBar">
                            <input  placeholder='Search for Equipemnt'></input>
                        </div>
                    </div>
                    <div className='nav__containerL'>
                   <div className='nav__links'>
                        
                            <Link to="/"><button className='nav__buttons'>HOME</button></Link>
                            <Link to="/shop"><button className='nav__buttons'>SHOP</button></Link>
                            <button className='nav__buttons'>ABOUT US</button>
                            <button className='nav__buttons'>RESOURCE LIBRARY</button>
                            <button className='nav__buttons'>FAQ</button>
                            <button className='nav__buttons'>CONTACT US</button>
                            <Link to="/cart"><button className='nav__buttons'><img src={cartIcon} className="nav__cartIcon" alt="cart"/></button></Link>
        
                    </div>
                    </div>
                    <div className='hiddenNav'>
                    <div className="hiddenNav__container">
                        <button><img src={hamMenu} alt="menuHidden"/></button>
                    </div>
                </div>
                   
                
                    
                </nav>
            
        );
    
}


export default NavBar;
