import * as React from 'react';
import ListItem from '@material-ui/core/ListItem';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import ListItemText from '@material-ui/core/ListItemText';
import ListSubheader from '@material-ui/core/ListSubheader';
import DashboardIcon from '@material-ui/icons/Dashboard';
import ShoppingCartIcon from '@material-ui/icons/ShoppingCart';
import PeopleIcon from '@material-ui/icons/People';
import BarChartIcon from '@material-ui/icons/BarChart';
import LayersIcon from '@material-ui/icons/Layers';
import AssignmentIcon from '@material-ui/icons/Assignment';
import {Link} from 'react-router-dom';
import './listItem.css'

export const mainListItems = (
  <div>
    <Link to="/" replace>
      <ListItem button>
        <ListItemIcon>
          <DashboardIcon />
        </ListItemIcon>
        <ListItemText primary="Dashboard" />
      </ListItem>
    </Link>
    <Link to="/categories" replace>
      <ListItem button>
        <ListItemIcon>
          <ShoppingCartIcon />
        </ListItemIcon>
        <ListItemText primary="Category" />
      </ListItem>
    </Link>
      <Link to="/collections" replace>
          <ListItem button>
              <ListItemIcon>
                  <ShoppingCartIcon />
              </ListItemIcon>
              <ListItemText primary="Collection" />
          </ListItem>
      </Link>
    <Link to="/products" replace>
      <ListItem button>
        <ListItemIcon>
          <PeopleIcon />
        </ListItemIcon>
        <ListItemText primary="Product" />
      </ListItem>
    </Link>
      <Link to="/pages" replace>
          <ListItem button>
              <ListItemIcon>
                  <PeopleIcon />
              </ListItemIcon>
              <ListItemText primary="Pages" />
          </ListItem>
      </Link>
      <Link to="/menus" replace>
          <ListItem button>
              <ListItemIcon>
                  <PeopleIcon />
              </ListItemIcon>
              <ListItemText primary="Menus" />
          </ListItem>
      </Link>
      <Link to="/themes" replace>
          <ListItem button>
              <ListItemIcon>
                  <PeopleIcon />
              </ListItemIcon>
              <ListItemText primary="Themes" />
          </ListItem>
      </Link>
    <ListItem button>
      <ListItemIcon>
        <BarChartIcon />
      </ListItemIcon>
      <ListItemText primary="Reports" />
    </ListItem>
    <ListItem button>
      <ListItemIcon>
        <LayersIcon />
      </ListItemIcon>
      <ListItemText primary="Integrations" />
    </ListItem>
  </div>
);

export const secondaryListItems = (
  <div>
    <ListSubheader inset>Saved reports</ListSubheader>
    <ListItem button>
      <ListItemIcon>
        <AssignmentIcon />
      </ListItemIcon>
      <ListItemText primary="Current month" />
    </ListItem>
    <ListItem button>
      <ListItemIcon>
        <AssignmentIcon />
      </ListItemIcon>
      <ListItemText primary="Last quarter" />
    </ListItem>
    <ListItem button>
      <ListItemIcon>
        <AssignmentIcon />
      </ListItemIcon>
      <ListItemText primary="Year-end sale" />
    </ListItem>
  </div>
);
