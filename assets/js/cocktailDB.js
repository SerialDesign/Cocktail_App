/* Global Variables */

//displayData(); - könnte auch hier oben stehen.. Da eh alle function zuerst geladen werden..
const cocktailDB_url = 'https://www.thecocktaildb.com/api/json/v1/1/';
const randomDrink_endpoint = `${cocktailDB_url}random.php`;
const drinkDetailsByID_endpoint = `${cocktailDB_url}lookup.php?i=`;
const drinkName_endpoint = `${cocktailDB_url}search.php?s=`;

const drinkImage_endpoint = 'https://www.thecocktaildb.com/images/media/drink/';

//ingredientField.hide();

async function getRandomDrink(){
    const response = await fetch(randomDrink_endpoint);
    const data = await response.json();

    console.log(data);
    //data.drinks.
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

    resetDetailText();
})


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

/* $('#loveRandomDrink').on('click', () => {
    getRandomDrink();

    messageBox.innerHTML = messageBox.innerHTML + 1;
})
 */


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




function resetDetailText() {
    $('#randomDrinkIngredients').hide();
    $('#randomDrinkDetailText').hide();
}



































async function displayData(){

    //Request to the Amiibo API gameseries endpoint
    //await weil es ein promise ist
    const response = await fetch(games_endpoint);
    const data = await response.json();


    //create new array with all games (some are repeats)
    const onlyNames = [];   
    //ganzes json durchiterieren und jeden gamenamen hinzufügen
    data.amiibo.forEach(game => {
        onlyNames.push(game.name);
    })
    console.log(onlyNames);

    //Filter through the onlyNames array and get rid of repeats
    //new Set rerkennt doppelte namen - es vergleicht ob der Wert schon existiert, wenn ja, wird es nicht hinzugefügt
    const uniqueNames = [...new Set(onlyNames)];
    //console.log(uniqueNames);
    


    //Create DOM elements for each game
    //*** */const gameList = document.createElement('ul'); 
    const gameList = document.querySelector('.menu');
    //gameList.classList.add("menu");
    //gamelist dem 'games' container hinzufügen
    uniqueNames.forEach(gameName => {
        //const exampleTemplate = `<li>${gameName}</li>`;
        const exampleTemplate =  `<div class="item" data-value="af"></i>${gameName}</div>`;
        gameList.innerHTML += exampleTemplate;
    })
    //document.querySelector('.games').appendChild(gameList);
    //document.querySelector('.menu').appendChild(gameList);

    
    document.querySelectorAll('selected').forEach(item => {
       // item.addEventListener('click', function(){
            const gameName = item.innerText;
            console.log(gameName);
            //Pass the clicked name to the displayAmiibos function
            displayAmiibos(gameName);
        //})
    })
}


/* $('.menu').click( function(){
    //alert('test');
    const gameName = document.querySelector('.selected').innerText;

    console.log(gameName);

    displayAmiibos(gameName);
})

$('.menu').on('keypress', function(){
    alert('test');
    const gameName = document.querySelector('.selected').innerText;

    console.log(gameName);

    displayAmiibos(gameName);
}) */

//schöner wenn in separater Methode ausgelagert, könnte aber eig auch in der async function oben stehen
async function displayAmiibos (gameName){
    //Request to the Amiibo API with a query to another endpoint
    const queryURL = amiibos_endpoint + gameName;
    const response = await fetch(queryURL);
    const data = await response.json();

    console.log(data);
    const amiibosContainer = document.querySelector(".amiibos");

    //Log every amiibo of the selected/clicked game
/*     data.amiibo.forEach(amiibo => {
        console.log(amiibo.name);
    }) */

    resetCards();
    const cardsList = document.querySelector('.cards');

    data.amiibo.forEach(amiibo => {
        console.log(amiibo.name);
        console.log("imageSRC:"+amiibo.image);
        const exampleTemplate =  `<div class="card">
                                        <div class="image">
                                            <img src="${amiibo.image}">
                                        </div>
                                        <div class="content">
                                        <div class="header">${amiibo.name}</div>
                                        <div class="description">
                                        Type: ${amiibo.type}
                </div>
                                    </div>`;

        cardsList.innerHTML += exampleTemplate;
    })

}

function resetCards(){
    document.querySelector('.cards').innerHTML = '';
}


//displayData();
