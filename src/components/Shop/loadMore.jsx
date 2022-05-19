import React, {useState, useEffect} from "react";
//import '../../Styles/shop.scss';
import '../../Styles/showMore.scss';
import {HiChevronDoubleDown} from 'react-icons/hi';
   

const LoadMore = () => {
    const [items, setItems] = useState([]);
    const [visible, setVisible] = useState(5);

    const showMoreItems = () => {
        setVisible((prevValue) => prevValue + 5);

    };

    useEffect(() =>{
        fetch("https://jsonplaceholder.typicode.com/posts")
        .then(res => res.json())
        .then((data) => setItems(data))
    }, []);

    return(
        <body>
        <div className='card2'>
        <div className='card2__container'>
            {items.slice(0, visible).map((item) => (
                <div className="card2__table">
                    <div className="card2__table--item">
                        <span>{item.id}</span> 
                    </div>
                    <div className="card2__table--item2">
                        <p>{item.body} </p>
                    </div>   
                </div>

            ))}
           
        </div>
        </div>
        <div className='showMore'>
            <div className='showMore__container'>
                <div className="showMore__heading">
                    <button onClick={showMoreItems} className="showMore__button"><h5>Show More</h5></button>
                </div>
                <div className="showMore__arrows">
                    <HiChevronDoubleDown />
                </div>    
            </div>
        </div>    

    </body>
    
    
    )
};
export default LoadMore;