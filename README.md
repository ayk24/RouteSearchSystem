# Route Search System

## Description
<img src="https://github.com/ayk24/RouteSearchSystem/blob/master/doc/ui.png" width=50%>  

## Feature
### Database Structure
- **users**: user's registration information
<img src="https://github.com/ayk24/RouteSearchSystem/blob/master/doc/users_database.png" width=50%>  

- **history**: history of searched routes
<img src="https://github.com/ayk24/RouteSearchSystem/blob/master/doc/history_database.png" width=50%>  

## Usage
1. Register a user in signup.php, or log in with login.php  
2. Once you're logged in, redirect to home.php.  
   Enter your starting point in the "From" form and your destination in the "To" form.  
3. The route is drawn on the map and the guide to the destination is shown at the right part of the page.
4. If you switch to the navigation bar of "History", you can see your (the logged-in user) search history.  
   If you check the checkbox, you can share your route history with others.  

## Anything Else
**RouteSearchSystem**  
　├ core  
　│　└ config.php : Database login information  
　├ css  
　├ img  
　├ js : It contains programs for bootstrapping and map generation.    
　│　└ googlemap.js    : Part of the process of generating the first map, finding a route, and registering the search history.  
　├ checked.php 　     : Database-side processing when the sharing is allowed or disallowed  
　├ dbconnect.php      : Make a connection to the database.  
　├ home.php           : You can enter the information of the route you want to search and view the results.  
　├ insert_history.php : The process of storing the search history in the database.  
　├ login.php  
　├ logout.php  
　├ show_history.php   : View your search history. (You can't see other people's stuff.)    
　├ show_shareinfo.php : View the history of routes that are allowed to be shared.  
　└ signup.php  
