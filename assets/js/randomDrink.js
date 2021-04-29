
/* Global API Endpoint Variables are declared in assets/js/cocktailDB_endpoints_global.js File */


/******************************************************** 
 *** FEATURE RANDOM DRINK (is only used on HOME site) ***
 ********************************************************/
// Gets a random drink from CocktailDB API 
// which will be display in a card
// by clicking Button 'Get another random Drink' - it calls the API again and gets a new random drink


async function getRandomDrink(){
    const response = await fetch(randomDrink_endpoint);
    const data = await response.json();
    //console.log(data);
    //console.log(data.drinks[0].strDrinkThumb);


    // Random Drink API always returns just one drink object - so data.drinks[0]
    let drinkName = data.drinks[0].strDrink;
    let drinkImg = data.drinks[0].strDrinkThumb;
    let drinkID = data.drinks[0].idDrink;

    document.querySelector('#randomDrink').innerText = drinkName;
    //document.querySelector('#drinkOfTheDayImg') = drinkName;

    // Setting Image
    $("#randomDrinkImg").attr("src", drinkImg);

    // Setting DrinkID on a hidden field 
    // - used if the user presses on Button 'Ingredients' or 'Inscrutions' 
    // - if pressed on a button - it gets data asynchron accordingle (e.g. printing out all ingredients)
    $("#drinkID").attr("value", drinkID);
}


async function getIngredientsByDrinkID( drinkID ){

    let drinkDetailsByIdURL = drinkDetailsByID_endpoint + drinkID;
    //console.log('url: '+drinkDetailsByIdURL);

    const response = await fetch( drinkDetailsByIdURL );
    const data = await response.json();
    //console.log(data);

    // Getting Ingredients including Measure of a Dink and fill out a text
    let ingredients = getIngredientsAndMeasuresOfDrink(data.drinks[0]);
    //console.log('ing: '+ingredients);

    let ingredientField = $('#randomDrinkIngredients');
    ingredientField.html(ingredients)
    ingredientField.show();
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
                                  + ( (ingredientValue == null || ingredientValue == '')  ? '' : (ingredientValue + ', ') );
        }
    }

    // remove the last comma of the string
    drinkIngredients = drinkIngredients.replace(/,\s*$/, "");

    return drinkIngredients;
}


async function getInstructionsByDrinkID( drinkID ){

    //alert($("input#drinkID").val());

    let drinkDetailsByIdURL = drinkDetailsByID_endpoint + drinkID;
    console.log('url: '+drinkDetailsByIdURL);

    const response = await fetch( drinkDetailsByIdURL );
    const data = await response.json();
    //console.log(data);

    let instructions = '';
    instructions = data.drinks[0].strInstructions;
    //ingredients = ingredients.replace(new RegExp("null", "g"), " ");
    //ingredients.trim();

    console.log('instructions: '+instructions);

    let detailText = $('#randomDrinkDetailText');
    detailText.text(instructions)
    //vanillajs: document.querySelector('#randomDrinkIngredients').innerText = ingredients;
    detailText.show();
}


// Click on Button 'Get another random Drink' 
// Gets a new random drink and resets potential opened detail text (Ingredients & Instruction)
$('#generateRandomDrink').on('click', () => {
    getRandomDrink();

    resetDetailText(); // resets / closes opened Ingredients and Inscrution fields.
})


// Resetting Ingredients & Inscrution Fields - they are requested new from API if the user is interested and clicks on it
// used when a new random Drink gets pulled from api (by click of user on 'Get another random Drink' )
function resetDetailText() {
    $('#randomDrinkIngredients').hide();
    $('#randomDrinkDetailText').hide();
}





/*** EVENT LISTENERS ***
for Ingredients and Instructions Buttons 
of Random Drink Feature */


// User clicks on 'Ingredients' Button
// - the Ingredients are pulled from API and filled in the Ingredients text
$('#drinkIngredients').on('click', () => {

    // Toggling Ingredients Text (open close)
    if( $('#randomDrinkIngredients').text() != ''){

        $('#randomDrinkIngredients').slideToggle('slow');
        //return;
    }

    let drinkID = $("input#drinkID").val();

    getIngredientsByDrinkID(drinkID);
})

// User clicks on 'Instructions' Button
// - the Instructions are pulled from API and filled in the Detail text
$('#drinkInstructions').on('click', () => {

    // Toggling Insructions Text 
    // - if Insructions are already pulled from API and filled in text in just opens and closes and then exits the function with return (not requesting API again and again)
    if( $('#randomDrinkDetailText').text() != ''){

        $('#randomDrinkDetailText').slideToggle('slow');
        return;
    }

    let drinkID = $("input#drinkID").val()

    getInstructionsByDrinkID(drinkID);
})










