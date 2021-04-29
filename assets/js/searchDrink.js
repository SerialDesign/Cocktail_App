
/* Global API Endpoint Variables are declared in assets/js/cocktailDB_endpoints_global.js File */


/*** SEARCH DRINK BY TEXT ***/
$('#drinkSearchSubmit').on('click', () => {

    event.preventDefault();

    searchDrinkByText( $('#drinkSearchByName').val() );
})



async function searchDrinkByText( searchDrinkText ){

    let drinkSearchEndpoint = drinkName_endpoint + searchDrinkText;
    //console.log('endpoint: ' + drinkSearchEndpoint);

    const response = await fetch( drinkSearchEndpoint );
    const data = await response.json();
    //console.log(data);
    
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

        // if i have an ingredient i usually have a measure with it (but not mandatory) 
        // - but there it cannot have a measure without an ingredient, 
        // thats why only checking ingredientValue != null
        if( ingredientValue != null ){
            // drinkIngredients += measureValue + ' ' + ingredientValue + ', ';
            // setting Measure and Ingredient together and concatinate to whole string with comma separates
            // e.g. '2 oz Gin, 5 oz Soda Water, 1/4 Lime'

            // Because the API is not perfect, i have to check if i really reveice values for it, and fill out the string accourdingly
            drinkIngredients += ( measureValue == null ? '' : measureValue ) 
                                     + ( ingredientValue == ''  ? '' : (' <strong>'+  ingredientValue + '</strong>, ') );
        }
    }

    drinkIngredients = drinkIngredients.replace(/,\s*$/, "");

    return drinkIngredients;
}


function getDrinkCards( data ){

    resetCards();
    const cardsList = document.querySelector('.cards');

    data.drinks.forEach(drink => {

        let ingredients = getIngredientsAndMeasuresOfDrink(drink);
        
        const exampleTemplate =  `<div class="card">
                                        <a class="image imgHoverEffect" href="drink.php?id=${drink.idDrink}">
                                            <img src="${drink.strDrinkThumb}">
                                        </a>
                                        <div class="content">
                                        <div class="header">${drink.strDrink}</div>
                                        <div class="description">
                                            Ingredients: ${ingredients}
                                        </div>
                                    </div>`;

        cardsList.innerHTML += exampleTemplate;
    })

    return cardsList.innerHTML;
}



/*** Search by INGREDIENT ***/

/* EVENT ON INGREDIENT SEARCH BUTTON */
$('#ingredientSearchSubmit').on('click', () => {

    //alert('skrt');
    event.preventDefault();

    searchDrinkByIngredient( $('#drinkSearchByIngredient').val() );
})



/*** SEARCH BY INGREDIENT FUNCTION ***/
async function searchDrinkByIngredient( drinkIngredientSearch ){

    //check if user search with more than one word - not possible..
    let hasMoreThanOneWord = drinkIngredientSearch.split(' ')[1] ? true : false;
    //console.log('[1] : '+hasMoreThanOneWord);

    const cardsList = document.querySelector('#resultIngredientSearch');

    // IMPORTANT NOTE: because API cocktailDB is not well implemented, 
    // I have to make a try and catch around the response, otherwise if searched by in ingredient where no drink is found
    // it returns not a JSON object, instead it returs something not useful / which got catched if so..
    try{
        if( !hasMoreThanOneWord){
            
            let drinkSearchEndpoint = drinkIngredient_endpoint + drinkIngredientSearch;
            //console.log('endpoint: ' + drinkSearchEndpoint);


            const response = await fetch( drinkSearchEndpoint );
            const data = await response.json();
            //console.log(data);
        
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

            // if Ingredient Seach has more than one word 
            }else{

                cardsList.innerHTML = `<h2>Nothing found with search Ingredient '${drinkIngredientSearch}'. Please search with one Ingredient only.</h2> <br>`;


                // If nothing was found - try to search for drinks with the first word
                let firstWordOfSearchText = drinkIngredientSearch.split(' ')[0];
                //console.log('firstWordOfSearchText: <' + firstWordOfSearchText + '>');

                let drinkSearchEndpoint = drinkName_endpoint + firstWordOfSearchText;
                const response = await fetch( drinkSearchEndpoint );
                const data = await response.json();
                //console.log(data);

                if(data.drinks != null){
                    // search for drinks with only the first word - to show at least some results (if it has) if nothing was found with the whole search phrase..
                    cardsList.innerHTML +=  `<div class="ui horizontal divider width100perc"> We found Drinks though with <h3>'${firstWordOfSearchText}'</h3> </div> <br>` + getDrinkCards( data );
                }

            }
    // Because API is bad, i have to use a CATCH, because it does not return a JSON object over this Endpoint if nothing was found.. 
    }catch{
        document.querySelector('#resultIngredientSearch').innerHTML = `<h2>No Drinks found with searched Ingredient. Please try something else. </h2> <br>`;
        return false;
    }
}









function resetCards(){
    document.querySelector('.cards').innerHTML = '';
}
