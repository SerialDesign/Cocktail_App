/* Global Variables */
const cocktailDB_url = 'https://www.thecocktaildb.com/api/json/v1/1/';
const randomDrink_endpoint = `${cocktailDB_url}random.php`;
const drinkDetailsByID_endpoint = `${cocktailDB_url}lookup.php?i=`;
const drinkName_endpoint = `${cocktailDB_url}search.php?s=`;

const drinkImage_endpoint = 'https://www.thecocktaildb.com/images/media/drink/';


async function getRandomDrink(){
    const response = await fetch(randomDrink_endpoint);
    const data = await response.json();

    console.log(data);

    console.log(data.drinks[0].strDrink);
    console.log(data.drinks[0].strDrinkThumb);

    let drinkName = data.drinks[0].strDrink;
    let drinkImg = data.drinks[0].strDrinkThumb;
    let drinkID = data.drinks[0].idDrink;

    document.querySelector('#randomDrink').innerText = drinkName;
    //document.querySelector('#drinkOfTheDayImg') = drinkName;

     $("#randomDrinkImg").attr("src", drinkImg);

     $("#drinkID").attr("value", drinkID);
     



    let drinkIngredients = ''; //data.drinks[0].strIngredient1;
    let ingredientVar = 'strIngredient'
     for(let i=1; i<16; i++){
        drinkIngredients += data.drinks[0][`${ingredientVar+i}`] + ' ';
        console.log('ingredient'+ i+' :'+ drinkIngredients);
    }


    /* Better solution? 
    let result = myProbablyNegligentlySimpleJSONParse(JSON.stringify(data));
    //console.log('stringify: '+JSON.stringify(data));
    result.forEach(function (pair, index) {
        let [k, v] = pair;  // now k and v are your key and value
        console.log(`key is ${k} value is ${v}`)
        if (index < result.length-1) {
            let [nextK, nextV] = result[index+1];
            console.log(`next key is ${nextK} next value is ${nextV}`);

            if( nextK.includes('strIngredient') && nextV != 'null' ){
                drinkIngredients += nextV + ' '; // += nextV.replace('"', '') + ' ';
                console.log('nextV: ' + nextv );
            }
        }
    }); 

    console.log(drinkIngredients);
    document.querySelector('#randomDrinkIngredients').innerText = drinkIngredients;*/
}


async function getIngredientsByDrinkID( drinkID ){

    //alert($("input#drinkID").val());

    let drinkDetailsByIdURL = drinkDetailsByID_endpoint + drinkID;
    console.log('url: '+drinkDetailsByIdURL);

    const response = await fetch( drinkDetailsByIdURL );
    const data = await response.json();
    //console.log(data);

    let ingredients = '';
    // TODO: replace with better function of getting all Ingredients
    ingredients = data.drinks[0].strMeasure1 + data.drinks[0].strIngredient1 + ', ' + data.drinks[0].strMeasure2 + data.drinks[0].strIngredient2 + ', ' + data.drinks[0].strMeasure3 + data.drinks[0].strIngredient3 + ', ' + data.drinks[0].strMeasure4 + data.drinks[0].strIngredient4 + ', ' + data.drinks[0].strMeasure5 + data.drinks[0].strIngredient5 + ', ' + data.drinks[0].strMeasure6 + data.drinks[0].strIngredient6;
    ingredients = ingredients.replace(new RegExp("null", "g"), " ");
    //ingredients.replace("null", " ");
    ingredients.trim();

    console.log('ing: '+ingredients);

    let ingredientField = $('#randomDrinkIngredients');
    ingredientField.text(ingredients)
    //vanillajs: document.querySelector('#randomDrinkIngredients').innerText = ingredients;
    ingredientField.show();
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

$('#generateRandomDrink').on('click', () => {
    getRandomDrink();

    resetDetailText(); // resets / closes opened Ingredients and Inscrution fields.
})

function resetDetailText() {
    $('#randomDrinkIngredients').hide();
    $('#randomDrinkDetailText').hide();
}



$('#drinkIngredients').on('click', () => {

    if( $('#randomDrinkIngredients').text() != ''){
        console.log('toggling');
        $('#randomDrinkIngredients').slideToggle('slow');
        return;
    }

    let drinkID = $("input#drinkID").val();

    getIngredientsByDrinkID(drinkID);
})


$('#drinkInstructions').on('click', () => {

    if( $('#randomDrinkDetailText').text() != ''){
        console.log('toggling');
        $('#randomDrinkDetailText').slideToggle('slow');
        return;
    }

    let drinkID = $("input#drinkID").val()

    getInstructionsByDrinkID(drinkID);
})










