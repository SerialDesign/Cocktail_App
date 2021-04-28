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

/* function myProbablyNegligentlySimpleJSONParse(string) {
    let trimmed = string.slice(1, -1);
    let components = trimmed.split(',');
    return components.map(kvString => {
        let kv = kvString.split(':');
        return [ kv[0].trim(), kv[1].trim()  ];
    });
} */


async function getIngredientsByDrinkID( drinkID ){

    //alert($("input#drinkID").val());

    let drinkDetailsByIdURL = drinkDetailsByID_endpoint + drinkID;
    console.log('url: '+drinkDetailsByIdURL);

    const response = await fetch( drinkDetailsByIdURL );
    const data = await response.json();
    //console.log(data);

    let ingredients = '';
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


async function getDrinkObj( drinkID ){

    let endpoint = drinkDetailsByID_endpoint + drinkID;
    //console.log('url: '+endpoint);

    const response = await fetch( endpoint );
    const data = await response.json();
    
    console.log(data);


    /* let drinkIngredients = '';
    let ingredientVar = 'strIngredient'
    for(let i=1; i<16; i++){
        // Iterating through all ingredients attributes that the api provides..
        let ingredientValue = data.drinks[0][`${ingredientVar+i}`]

        if( ingredientValue != null ){
            drinkIngredients += ingredientValue + ', ';
        }
    } */


    let drink_obj = {
        name: data.drinks[0].strDrink,
        image: data.drinks[0].strDrinkThumb,
        ingredients: drinkIngredients,
        instructions: data.drinks[0].strInstructions
    }

    console.log("OBJname: "+drink_obj.name);
    console.log("OBJimage: "+drink_obj.image);
    console.log("OBJing: "+drink_obj.ingredients);
    console.log("OBJinst: "+drink_obj.instructions);

    let IngredientsAndMessures = getLabeledIngredientsAndMeasuresOfDrink( data );
    console.log('func: '+IngredientsAndMessures);

    $('#drinkName').text(drink_obj.name);
    //$('#drinkIngredients').text(drink_obj.ingredients);
    $('#drinkIngredients').html(IngredientsAndMessures);
    
/*     IngredientsAndMessures.forEach( ingredientAndMessure => {
        ingredientAndMessure.
    }) */


    $('#drinkInstructions').html("<h2>Instructions</h2> " + drink_obj.instructions);


    //let url = "https://www.thecocktaildb.com/images/media/drink/drtihp1606768397.jpg";
    $('#drinkImageHeader').css({
        "background-image":'url("'+drink_obj.image+'")', 
        "background-size":'cover'});

    return drink_obj;
}

/* function getIngredientsAndMeasuresOfDrink( data ){

    let drinkIngredients = '';
    let ingredientVar = 'strIngredient';
    let measureVar = 'strMeasure';

    for(let i=1; i<16; i++){
        // Iterating through all ingredients attributes that the api provides..
        let ingredientValue = data.drinks[0][`${ingredientVar+i}`]
        let measureValue = data.drinks[0][`${measureVar+i}`]

        if( ingredientValue != null ){
            drinkIngredients += measureValue + ' ' + ingredientValue + ', ';
        }
    }

    return drinkIngredients;
} */



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

        if( ingredientValue != null ){
            //drinkIngredients += measureValue + ' ' + ingredientValue + ', ';
            drinkIngredients += '<div class="ui large green label">'
                                    + (measureValue == null ? '' : '<div class="measure detail">' +measureValue + '</div> ') 
                                    + ingredientValue 
                              + '</div>';
        }
    }

    return drinkIngredients;
}







function saveDrinkToFavourites ( drinkID ) {

    event.preventDefault();

    //alert('drinkID' + drinkID);
    /* 
    let _form = $(this); //entire form element in variable _form
    
 */
    let _error = $(".js-error");
    let _messageBox = $('#addToFavouritesMessage');
    let _heartIcon = $("#heartIcon");

    let dataObj = {
        drinkID: drinkID
    };
    // dataObj is sent over ajax to the 
/*     if( _form.hasClass('js-login') ){
        dataObj = {
            email: $("input[type='email']", _form).val(), //only searches within form element, not the whole page. Good practise if you have a big page
            password: $("input[type='password']", _form).val()
        }
    }else if ( _form.hasClass('js-register') ){
        dataObj = {
            username: $("#usernameRegister", _form).val(),
            email: $("input[type='email']", _form).val(), //only searches within form element, not the whole page. Good practise if you have a big page
            password: $("#passwordRegister", _form).val(),
            confirm_password: $("#confirmPwRegister", _form).val()
        }
    }

 */
    //Assuming the code gets this far, we can start the AJAX process
    //_error.hide();

    console.log(dataObj);

    $.ajax({
        type: 'POST',
        url: 'ajax/addOrRemoveFavourite.php',
        data: dataObj,
        dataType: 'json',
        async: true,
        /* possible to catch/check statuscode to send more information via the http headers - with using a function 
        statusCode: {
            403: function(){
                alert('Not allowed');
            }
        } */
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
        console.log(e);
    })
    .always(function ajaxAlwaysDoThis(dataObj){
        // Always do
        //console.log("Always");
    })

    return false;
}
