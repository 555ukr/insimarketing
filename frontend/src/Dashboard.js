import React, { useState, useEffect }  from 'react';
import axios from 'axios'

import Header from './components/Header';
import MovieTable from './components/MovieTable';

const Dashboard = () => {
    const [rateSearch, setRateSearch] = useState(0);
    const [titleSeach, setTitleSearch] = useState("");
    const [allRowsCount, setAllRowsCount] = useState(0);
    const [pageCurrent, setPageCurrent] = useState(0);
    const [typeSearch, setTypeSerach] = useState("short");
    const [rows, setRows] = useState([]);

    useEffect( () => {
        apiMovieReuest()
    }, [rateSearch, titleSeach, typeSearch]);

    const apiMovieReuest = () => {
        let apiUrl = 'http://localhost:8000/api/movie';
        axios.get(apiUrl, 
            { params:  { rating: rateSearch,
                         title: titleSeach,
                         page: pageCurrent,
                         type: typeSearch,
                         } })
            .then((resp) => {
                const movies = resp.data.data;
                setAllRowsCount(resp.data.metadata.allRowsCounter);
                setRows(movies);
          }).catch(e => (console.log(e)));
    }

    const handlePagination = (pagination) => {
        console.log(pagination);
        setPageCurrent(pagination.page);
        apiMovieReuest();
    }

    return (
        <div>
            <Header onRatingSearchChange={setRateSearch}
                    onTitleSearchChnage={setTitleSearch}
                    onChangeType={setTypeSerach} 
            />
            <MovieTable movieRows={rows}
                        onPaginationChange={handlePagination}
                        allRowsCount={allRowsCount}
            />
        </div>
    )
    
}

export default Dashboard;