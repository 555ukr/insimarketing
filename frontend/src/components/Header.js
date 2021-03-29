import React from 'react';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import Typography from '@material-ui/core/Typography';
import InputBase from '@material-ui/core/InputBase';
import { fade, makeStyles } from '@material-ui/core/styles';
import SearchIcon from '@material-ui/icons/Search';
import CallMadeIcon from '@material-ui/icons/CallMade';
import PropTypes from 'prop-types';

import InputLabel from '@material-ui/core/InputLabel';
import MenuItem from '@material-ui/core/MenuItem';
import FormControl from '@material-ui/core/FormControl';
import Select from '@material-ui/core/Select';

const useStyles = makeStyles((theme) => ({
  root: {
    height: '80px',
    flexGrow: 1,
  },
  title: {
    flexGrow: 1,
    display: 'none',
    [theme.breakpoints.up('sm')]: {
      display: 'block',
    },
  },
  search: {
    position: 'relative',
    borderRadius: theme.shape.borderRadius,
    backgroundColor: fade(theme.palette.common.white, 0.15),
    '&:hover': {
      backgroundColor: fade(theme.palette.common.white, 0.25),
    },
    marginLeft: 0,
    width: '100%',
    [theme.breakpoints.up('sm')]: {
      marginLeft: theme.spacing(1),
      width: 'auto',
    },
    height: '46px',
  },
  searchIcon: {
    padding: theme.spacing(0, 2),
    height: '100%',
    position: 'absolute',
    pointerEvents: 'none',
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
  },
  inputRoot: {
    color: 'inherit',
  },
  inputInput: {
    padding: theme.spacing(1, 1, 1, 0),
    // vertical padding + font size from searchIcon
    paddingLeft: `calc(1em + ${theme.spacing(4)}px)`,
    transition: theme.transitions.create('width'),
    width: '100%',
    [theme.breakpoints.up('sm')]: {
      width: '12ch',
      '&:focus': {
        width: '20ch',
      },
    },
  },
  formControl: {
    margin: theme.spacing(1),
    minWidth: 120,
  },
   typeFormat: {
     backgroundColor: 'rgba(255, 255, 255, 0.15)',
      borderRadius: '5px',
      width: '140px',
   },
   input: {
     marginTop: '5px',
   }
}));

export default function SearchAppBar(props) {
  const classes = useStyles();

  return (
    <div className={classes.root}>
      <AppBar position="static">
        <Toolbar>
          <Typography className={classes.title} variant="h6" noWrap>
            InsideMarketing
          </Typography>
          <div className={classes.typeFormat}>
          <FormControl className={classes.formControl}>
                {/* <InputLabel htmlFor="grouped-select">Type</InputLabel> */}
                <Select onChange={(e) => props.onChangeType(e.target.value)}
                       defaultValue="" id="grouped-select">
                  <MenuItem value="">
                    <em>None</em>
                  </MenuItem>

                  <MenuItem value={"short"}>Short</MenuItem>
                  <MenuItem value={"movie"}>Movie</MenuItem>
                  <MenuItem value={"tvMovie"}>TV movie</MenuItem>
                  <MenuItem value={"video"}>Video</MenuItem>
                  <MenuItem value={"tvEpisode"}>TV episode</MenuItem>
                  <MenuItem value={"tvSeries"}>TV series</MenuItem>
                  <MenuItem value={"tvShort"}>TV short</MenuItem>
                  <MenuItem value={"tvMiniSeries"}>TV MiniSeries</MenuItem>
                  <MenuItem value={"tvSpecial"}>TV Special</MenuItem>
                  <MenuItem value={"videoGame"}>Video Game</MenuItem>
                </Select>
              </FormControl>
            </div>
          <div className={classes.search}>
            <div className={classes.searchIcon}>
              <CallMadeIcon />
              </div>
            <InputBase 
              className={classes.input}
              onChange={(e) => (props.onRatingSearchChange(e.target.value))}
              placeholder="Rating…"
              type="number"
              classes={{
                root: classes.inputRoot,
                input: classes.inputInput,
              }}
            />
          </div>
          <div className={classes.search}>
            <div className={classes.searchIcon}>
              <SearchIcon />
            </div>
            <InputBase
            className={classes.input}
            onChange={ (e) => (props.onTitleSearchChnage(e.target.value) ) }
              placeholder="Search…"
              classes={{
                root: classes.inputRoot,
                input: classes.inputInput,
              }}
              inputProps={{ 'aria-label': 'search' }}
            />
          </div>
        </Toolbar>
      </AppBar>
    </div>
  );
}


SearchAppBar.propTypes = {
  onRatingSearchChange: PropTypes.func,
  onTitleSearchChnage: PropTypes.func,
  onChangeType: PropTypes.func,
}