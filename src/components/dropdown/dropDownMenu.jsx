import React, {useState} from "react";
import { MenuItems } from "./menuItems";
import { Link } from "react-router-dom";

function Dropdown() {
    const [click, setClick] = useState(false);
    const handleClick = () => setClick(!click);

    return(
        <div className="dropdown">
            <ul onClick={handleClick} className="dropdown__list--active">
                {MenuItems.map((item, index) => {
                    return(
                        <li key={index}>
                            {item.title}
                        </li>
                    );
                }
                )}
            
            </ul>
        </div>

    );
}

export default Dropdown;