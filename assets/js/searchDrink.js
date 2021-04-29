const cocktailDB_url = 'https://www.thecocktaildb.com/api/json/v1/1/';
const randomDrink_endpoint = `${cocktailDB_url}random.php`;
const drinkDetailsByID_endpoint = `${cocktailDB_url}lookup.php?i=`;
const drinkName_endpoint = `${cocktailDB_url}search.php?s=`;
const drinkIngredient_endpoint = `${cocktailDB_url}filter.php?i=`;

const drinkImage_endpoint = 'https://www.thecocktaildb.com/images/media/drink/';



/*** SEARCH DRINK BY TEXT ***/
$('#drinkSearchSubmit').on('click', () => {

    event.preventDefault();

    searchDrinkByText( $('#drinkSearchByName').val() );
})



async function searchDrinkByText( searchDrinkText ){
    //alert('searched: '+searchDrinkText);

    let drinkSearchEndpoint = drinkName_endpoint + searchDrinkText;
    //console.log('endpoint: ' + drinkSearchEndpoint);

    const response = await fetch( drinkSearchEndpoint );
    const data = await response.json();

    console.log(data);


    /*if( !data.drinks == null){ 
        //console.log(data.drinks[0].strDrink);
        //console.log(data.drinks[0].strDrinkThumb);

        let drinkName = data.drinks[0].strDrink;
        let drinkImg = data.drinks[0].strDrinkThumb;
        let drinkID = data.drinks[0].idDrink;
    }*/
    
    //#resultDrinkSearch
    const cardsList = document.querySelector('.cards');

    resetCards();
    if( !(data.drinks == null) ) {

        //on cards:  style="margin:20px" ?
        data.drinks.forEach(drink => {
            //console.log("drinkName:" + drink.strDrink);
            //console.log("imageSRC:"+ drink.strDrinkThumb);

            let ingredients = getIngredientsAndMeasuresOfDrink( drink );

            const exampleTemplate =  `<div class="card">
                                            <a class="image imgHoverEffect" href="drink.php?id=${drink.idDrink}">
                                                <img src="${drink.strDrinkThumb}">
                                            </a>
                                            <div class="content">
                                            <div class="header">${drink.strDrink}</div>
                                            <div class="description">
                                                <i>Ingredients</i>:<br> ${ingredients}
                                            </div>
                                        </div>`;

            cardsList.innerHTML += exampleTemplate;
        })
    }else{

        cardsList.innerHTML = `<h2>Nothing found with search text '${searchDrinkText}', sorry. </h2> <br>`;


        // If nothing was found - try to search for drinks with the first word
        let firstWordOfSearchText = searchDrinkText.split(' ')[0];
        //console.log('firstWordOfSearchText: <' + firstWordOfSearchText + '>');

        
        let drinkSearchEndpoint = drinkName_endpoint + firstWordOfSearchText;
        console.log('endpoint: ' + drinkSearchEndpoint);

        const response = await fetch( drinkSearchEndpoint );
        const data = await response.json();

        console.log(data);

        // If something was found with just the first word - show results, otherwise text about "Nothing found"..
        if(data.drinks != null){
            // search for drinks with only the first word - to show at least some results (if it has) if nothing was found with the whole search phrase..
            cardsList.innerHTML +=  `<div class="ui horizontal divider width100perc"> But.. We found Drinks with <h3>'${firstWordOfSearchText}'</h3> </div> <br>` + getDrinkCards( data );
        }


    }
}

/** Gets all Ingredients & Measures of a Drink 
 * (API provides 16 data.drinks.drink.strIngredient<1-16>  & data.drinks.drink.strMeasure<1-16> 
 * which are combined as '(measure) (ingrediant)' together: e.g. '1/2 lemon' ) ***/
function getIngredientsAndMeasuresOfDrink( drink ){

    let drinkIngredients = '';
    let ingredientVar = 'strIngredient';
    let measureVar = 'strMeasure';

    for(let i=1; i<16; i++){
        // Iterating through all ingredients attributes that the api provides..
        let ingredientValue = drink[`${ingredientVar+i}`]
        let measureValue = drink[`${measureVar+i}`]

        if( ingredientValue != null ){
            // drinkIngredients += measureValue + ' ' + ingredientValue + ', ';
            // if there is a measure there is a ingredient (but not the opposite way around)
            drinkIngredients += ( measureValue == null ? '' : measureValue ) 
                                     + ( (ingredientValue == null || ingredientValue == '')  ? '' : (' <strong>'+  ingredientValue + '</strong> , ') );
                                    //+ ' <strong>'+  ingredientValue + '</strong> , ' ;
        }
    }

    drinkIngredients = drinkIngredients.replace(/,\s*$/, "");

    return drinkIngredients;
}


function getDrinkCards( data ){

    resetCards();
    const cardsList = document.querySelector('.cards');

    data.drinks.forEach(drink => {
        console.log("drinkName:" + drink.strDrink);
        console.log("imageSRC:"+ drink.strDrinkThumb);
        /* TODO: check if a tag in a tag can be fixed for heart icon on image below (only found if search by two words.. */
        const exampleTemplate =  `<div class="card">
                                        <a class="image imgHoverEffect" href="drink.php?id=${drink.idDrink}">
                                            <a id="saveToFavourites" class="ui left corner label">
                                                <i class="heart icon"></i>
                                            </a>
                                            <img src="${drink.strDrinkThumb}">
                                        </a>
                                        <div class="content">
                                        <div class="header">${drink.strDrink}</div>
                                        <div class="description">
                                            Ingredients: ${drink.strIngredient1}
                                        </div>
                                    </div>`;

        cardsList.innerHTML += exampleTemplate;
    })

    return cardsList.innerHTML;
}


/*** Search by INGREDIENT ***/

/* EVENT ON SEARCH BUTTON */
$('#ingredientSearchSubmit').on('click', () => {

    //alert('skrt');
    event.preventDefault();

    searchDrinkByIngredient( $('#drinkSearchByIngredient').val() );
})



/*** SEARCH BY INGREDIENT FUNCTION ***/
async function searchDrinkByIngredient( drinkIngredientSearch ){

    //check if user search with more than one word - not possible..
    let hasMoreThanOneWord = drinkIngredientSearch.split(' ')[1] ? true : false;
    console.log('[1] : '+hasMoreThanOneWord);

    const cardsList = document.querySelector('#resultIngredientSearch');

    // IMPORTANT NOTE: because API cocktailDB is not well implemented, 
    // I have to make a try and catch around the response, otherwise if searched by in ingredient where no drink is found
    // it returns not a JSON object, instead it returs something not useful / which got catched if so..
    try{
        if( !hasMoreThanOneWord){
            
            let drinkSearchEndpoint = drinkIngredient_endpoint + drinkIngredientSearch;
            console.log('endpoint: ' + drinkSearchEndpoint);


            const response = await fetch( drinkSearchEndpoint );
            const data = await response.json();
            console.log(data);
        
            resetCards();
            if( !(data.drinks == null) ) {

                data.drinks.forEach(drink => {

                    //IMPORTANT: API does not provide more than drinkID, image & drinkName over this drinkDetailsByID_endpoint..idDrink
                    //so just show Image and Name - if they click on it, anyway they see the ingredients
                    const exampleTemplate =  `<div class="card">
                                                    <a class="image imgHoverEffect" href="drink.php?id=${drink.idDrink}">
                                                        <img src="${drink.strDrinkThumb}">
                                                    </a>
                                                    <div class="content">
                                                    <div class="header">${drink.strDrink}</div>
                                                </div>`;

                    cardsList.innerHTML += exampleTemplate;
                })
            }

            }else{

                cardsList.innerHTML = `<h2>Nothing found with search Ingredient '${drinkIngredientSearch}'. Please only search with one Ingredient </h2> <br>`;


                // If nothing was found - try to search for drinks with the first word
                let firstWordOfSearchText = drinkIngredientSearch.split(' ')[0];
                console.log('firstWordOfSearchText: <' + firstWordOfSearchText + '>');

                
                let drinkSearchEndpoint = drinkName_endpoint + firstWordOfSearchText;
                console.log('endpoint: ' + drinkSearchEndpoint);

                const response = await fetch( drinkSearchEndpoint );
                const data = await response.json();

                console.log(data);

                if(data.drinks != null){
                    // search for drinks with only the first word - to show at least some results (if it has) if nothing was found with the whole search phrase..
                    cardsList.innerHTML +=  `<div class="ui horizontal divider width100perc"> We found Drinks though with <h3>'${firstWordOfSearchText}'</h3> </div> <br>` + getDrinkCards( data );
                }

            }
    }catch{
        document.querySelector('#resultIngredientSearch').innerHTML = `<h2>No Drinks found with searched Ingredient. Please something else. </h2> <br>`;
        return false;
    }
}






/*** GET FAVOURITE DRINKS - used on getFavouriteDrinks.php  ***/
async function getFavouriteDrinks( allFavouriteDrinksObj ){

    let allFavDrinksContainer = document.querySelector('#allFavouriteDrinksCards');


    for(var i=0; i<allFavouriteDrinksObj.length; i++){
        const response = await fetch(drinkDetailsByID_endpoint + allFavouriteDrinksObj[i]['drink_id']);
        const data = await response.json();
        //console.log(data);

        data.drinks.forEach(drink => {
            //console.log("drinkName:" + drink.strDrink);
            const exampleTemplate =  `<div class="card">
                                            <a class="image imgHoverEffect" href="drink.php?id=${drink.idDrink}">
                                                <img src="${drink.strDrinkThumb}">
                                            </a>
                                            <div class="content">
                                            <div class="header">${drink.strDrink}</div>
                                            <div class="description">
                                                Ingredients: ${drink.strIngredient1}
                                            </div>
                                        </div>`;

            allFavDrinksContainer.innerHTML += exampleTemplate;
        })

    } 
}


function resetCards(){
    document.querySelector('.cards').innerHTML = '';
}
