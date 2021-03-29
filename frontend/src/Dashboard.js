import React, { useState, useEffect }  from 'react';
import axios from 'axios'

import Header from './components/Header';
import MovieTable from './components/MovieTable';

// const rows = [];

const Dashboard = () => {
    const [rateSearch, setRateSearch] = useState(0);
    const [titleSeach, setTitleSearch] = useState("");
    const [rows, setRows] = useState([]);

    useEffect( () => {
        apiMovieReuest({ rating: rateSearch, title: titleSeach })
    }, [rateSearch, titleSeach]);

    const apiMovieReuest = (param) => {
        let apiUrl = 'http://127.0.0.1:8000/api/movie';
        axios.get(apiUrl, 
            { params:  param })
            .then((resp) => {
                const movies = resp.data;
                setRows(movies);
          }).catch(e => (console.log(e)));
    }

    const handlePagination = (pagination) => {
        console.log(pagination);
    }

    return (
        <div>
            <Header onRatingSearchChange={setRateSearch}
                    onTitleSearchChnage={setTitleSearch} 
            />
            <MovieTable movieRows={rows}
                        onPaginationChange={handlePagination}
            />
        </div>
    )
    
}

export default Dashboard;