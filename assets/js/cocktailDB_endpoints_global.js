/******************************************** 
 * GLOBAL COCKTAILDB API ENDPOINT VARIABLES *
 ********************************************/

//MAIN Endpoint URL (used as placeholder for other endpoints)
const cocktailDB_url = 'https://www.thecocktaildb.com/api/json/v1/1/';

// Random Drink Endpoint
const randomDrink_endpoint = `${cocktailDB_url}random.php`;
// All Drink Details by ID Endpoint
const drinkDetailsByID_endpoint = `${cocktailDB_url}lookup.php?i=`;
// All Drink Details by Name Endpoint (used for search funtions) 
const drinkName_endpoint = `${cocktailDB_url}search.php?s=`;
// All Drink Details by Name Endpoint (used for search funtions) 
const drinkIngredient_endpoint = `${cocktailDB_url}filter.php?i=`;

// Drink IMAGE Endpoint (special URL - placeholder can't be used)
const drinkImage_endpoint = 'https://www.thecocktaildb.com/images/media/drink/';