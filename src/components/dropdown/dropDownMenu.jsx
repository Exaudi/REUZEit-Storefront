import React, {useState} from "react";
import { MenuItems } from "./menuItems";
//import { Link } from "react-router-dom";
import './dropdownStyle.scss';
import HamLogo from '../../Assets/icons/icons8-menu-50.png'

function Dropdown() {
    const [open, setOpen] = useState(false);
    //const handleClick = () => setClick(!click);

    return(
        <div className="dropdown">
            <nav className="dropdown__mNav">
                <img src={HamLogo} className="dropdown__icon" alt="hamburger menu"
                onClick={()=> setOpen(!open)}/>
                <ul className={open ? 'dropdown-menu clicked' : 'dropdown-menu'}>
                    {MenuItems.map((item, index) => {
                        return(
                            <li key={index}>
                                {item.title}
                            </li>
                        );
                    }
                    )}
                
                </ul>
            </nav>
        </div>

    );
}

export default Dropdown;