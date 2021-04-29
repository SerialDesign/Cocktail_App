/********************************************************************************************** 
 * THIS JS FILE contains functions to display ALL FAVOURITE DRINKS of a User                  *
 * AND to favourite (and unfavourite) drinks on the drink.php detail page with the heart icon *
 **********************************************************************************************/


/*** GET FAVOURITE DRINKS - used on getFavouriteDrinks.php  ***/
// Displays all favourite drinks of a user (drinkIDs saved in db) and displays Cards of each one
async function getFavouriteDrinks( allFavouriteDrinksObj ){

    let allFavDrinksContainer = document.querySelector('#allFavouriteDrinksCards');


    // Iterating through each favourite drink of user and display a card for it with link to drink detail page
    for(var i=0; i<allFavouriteDrinksObj.length; i++){
        const response = await fetch(drinkDetailsByID_endpoint + allFavouriteDrinksObj[i]['drink_id']);
        const data = await response.json();
        //console.log(data);

        data.drinks.forEach(drink => {
            //console.log("drinkName:" + drink.strDrink);

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

            allFavDrinksContainer.innerHTML += exampleTemplate;
        })

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






/*** FAVOURITE (AND UNFAVOURITE) A DRINK FUNCTIONS - used on drink.php page (Drink Detail view) ***/


/*** SAVE DRINK TO FAVOURITES 
 * - used on drink.php (Drink Detail page)  ***/
function saveDrinkToFavourites ( drinkID ) {

    event.preventDefault();
    //alert('drinkID' + drinkID);

    let _error = $(".js-error");
    let _messageBox = $('#addToFavouritesMessage');
    let _heartIcon = $("#heartIcon");

    let dataObj = {
        drinkID: drinkID
    };
    //console.log(dataObj);

    
    $.ajax({
        type: 'POST',
        url: 'ajax/addOrRemoveFavourite.php',
        data: dataObj,
        dataType: 'json',
        async: true
    })
    .done(function ajaxDone(data) {
        //whatever data is
        console.log("done.. data: "+data);
        if(data.redirect !== undefined){
           window.location = data.redirect; 
        }else if(data.success !== undefined){ //or data.isLoggedIn === true, but we have enough info with error
            /* _error
                .html(data.error) //text(data.error) 
                .show(); */

            _heartIcon.addClass("red");
            _messageBox
                .html(data.success)
                .addClass("green")
                .show()

        }else if(data.successRemovedFav !== undefined){ 
            /* _error
                .html(data.error) //text(data.error) 
                .show(); */

            _heartIcon.removeClass("red");
            _messageBox
                .html(data.successRemovedFav) 
                .addClass("green")
                .show()
        }
        else if(data.error !== undefined){ 
            /* _error
                .html(data.error) //text(data.error) 
                .show(); */

            _messageBox
                .html(data.error) 
                .addClass("red")
                .show()
        }
    })
    .fail(function ajaxFailed(e){
        // This failed
        //console.log(e);
    })
    .always(function ajaxAlwaysDoThis(dataObj){
        // Always do 
        //console.log("Always");
    })

    return false;
}

/** Gets Ingredients as green semanticUI Label fields 
 *  - USED ON drink.php page (Drink Detail page) ***/
function getLabeledIngredientsAndMeasuresOfDrink( data ){

    let drinkIngredients = '';
    let ingredientVar = 'strIngredient';
    let measureVar = 'strMeasure';

    for(let i=1; i<16; i++){
        // Iterating through all ingredients attributes that the api provides..
        let ingredientValue = data.drinks[0][`${ingredientVar+i}`]
        let measureValue = data.drinks[0][`${measureVar+i}`]

        // because API is bad, i have to check if ingredientValue is NOT == null AND also NOT === '' (API should send null back if it has no ingretiend not an empty string..)
        if( ! (ingredientValue == null || ingredientValue === '') ){
            //drinkIngredients += measureValue + ' ' + ingredientValue + ', ';
            drinkIngredients += '<div class="ui large green label">'
                                    + (measureValue == null ? '' : '<div class="measure detail">' +measureValue + '</div> ') 
                                    + ingredientValue 
                              + '</div>';
        }
    }

    //drinkIngredients = drinkIngredients.replace(/,\s*$/, "");

    return drinkIngredients;
}


/************************************************** 
*    Getting Drink Object and fill out Fields     *
*    Drinkname, Image, Ingredients & Instructions *
*            (Used on drink.php)                  *
***************************************************/
async function getDrinkObj( drinkID ){

    let endpoint = drinkDetailsByID_endpoint + drinkID;
    //console.log('url: '+endpoint);

    const response = await fetch( endpoint );
    const data = await response.json();
    
    console.log(data);

    let drink_obj = {
        name: data.drinks[0].strDrink,
        image: data.drinks[0].strDrinkThumb,
        ingredients: drinkIngredients,
        instructions: data.drinks[0].strInstructions
    }
    /* console.log("OBJname: "+drink_obj.name);
    console.log("OBJimage: "+drink_obj.image); */

    let IngredientsAndMessures = getLabeledIngredientsAndMeasuresOfDrink( data );
    console.log('func: '+IngredientsAndMessures);

    $('#drinkName').text(drink_obj.name);

    //$('#drinkIngredients').text(drink_obj.ingredients);
    $('#drinkIngredients').html(IngredientsAndMessures); // .html() used because of special tags and classes
    
    // Setting Instructions Text
    $('#drinkInstructions').html("<h2>Instructions</h2> " + drink_obj.instructions);


    // Setting background image of the Drink - looks nice ! :)
    $('#drinkImageHeader').css({
        "background-image":'url("'+drink_obj.image+'")', 
        "background-size":'cover'});

    return drink_obj;
}