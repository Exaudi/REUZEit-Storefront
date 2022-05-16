import React, {useState, useEffect} from "react";
import '../../Styles/shop.scss';
   

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
        <div className='card'>
        <div className='card__container'>
            {items.slice(0, visible).map((item) => (
                <div className="card__table">
                    <div className="card__table--item">
                        <span>{item.id}</span> 
                    
                    <p>{item.body} </p>
                    </div>
                </div>

            ))}
            <div className='showMore__container'>
            <div className='showMore__heading'>
                <button onClick={showMoreItems}><h5>Show More</h5></button>
            </div>
      
    </div>
       
    </div>


    </div>
    )
};
export default LoadMore;