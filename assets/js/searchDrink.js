const cocktailDB_url = 'https://www.thecocktaildb.com/api/json/v1/1/';
const randomDrink_endpoint = `${cocktailDB_url}random.php`;
const drinkDetailsByID_endpoint = `${cocktailDB_url}lookup.php?i=`;
const drinkName_endpoint = `${cocktailDB_url}search.php?s=`;
const drinkIngredient_endpoint = `${cocktailDB_url}filter.php?i=`;

const drinkImage_endpoint = 'https://www.thecocktaildb.com/images/media/drink/';



$('#drinkSearchSubmit').on('click', () => {

    //alert('skrt');
    event.preventDefault();

    searchDrinkByText( $('#drinkSearchByName').val() );
})



async function searchDrinkByText( searchDrinkText ){
    //alert('skrt skrt');
    //alert('searched: '+searchDrinkText);

    let drinkSearchEndpoint = drinkName_endpoint + searchDrinkText;
    console.log('endpoint: ' + drinkSearchEndpoint);

    const response = await fetch( drinkSearchEndpoint );
    const data = await response.json();

    console.log(data);
    //data.drinks.


    if( !data.drinks == null){ 
        console.log(data.drinks[0].strDrink);
        console.log(data.drinks[0].strDrinkThumb);

        let drinkName = data.drinks[0].strDrink;
        let drinkImg = data.drinks[0].strDrinkThumb;
        let drinkID = data.drinks[0].idDrink;
    }
    
    
    //#resultDrinkSearch
    const cardsList = document.querySelector('.cards');

    resetCards();
    if( !(data.drinks == null) ) {

        //on cards:  style="margin:20px" ?
        data.drinks.forEach(drink => {
            console.log("drinkName:" + drink.strDrink);
            console.log("imageSRC:"+ drink.strDrinkThumb);
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

        if(data.drinks != null){
            // search for drinks with only the first word - to show at least some results (if it has) if nothing was found with the whole search phrase..
            cardsList.innerHTML +=  `<div class="ui horizontal divider width100perc"> But.. We found Drinks with <h3>'${firstWordOfSearchText}'</h3> </div> <br>` + getDrinkCards( data );
        }


    }

     //$("#drinkID").attr("value", drinkID);
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



/* SEARCH BY INGREDIENT FUNCTION */
async function searchDrinkByIngredient( drinkIngredientSearch ){

    //check if user search with more than one word - not possible..
    let hasMoreThanOneWord = drinkIngredientSearch.split(' ')[1] ? true : false;
    console.log('[1] : '+hasMoreThanOneWord);

    const cardsList = document.querySelector('#resultIngredientSearch');

    if( !hasMoreThanOneWord){
        
        let drinkSearchEndpoint = drinkIngredient_endpoint + drinkIngredientSearch;
        console.log('endpoint: ' + drinkSearchEndpoint);

        try{

            const response = await fetch( drinkSearchEndpoint );
            const data = await response.json();
            console.log(data);
    
        }catch{
            document.querySelector('#resultIngredientSearch').innerHTML = `<h2>balbaNothing found with search Ingredient. Please only search with one Ingredient </h2> <br>`;
            return;
        }



        resetCards();
        if( !(data.drinks == null) ) {

            //todo: on cards:  style="margin:20px" ?
            data.drinks.forEach(drink => {
                //console.log("drinkName:" + drink.strDrink);
                //console.log("imageSRC:"+ drink.strDrinkThumb);

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
}



/*** SAVE DRINK TO FAVOURITES - used on drink.php (Drink Detail page)  ***/
function saveDrinkToFavourites ( drinkID ) {

    event.preventDefault();

    alert('drinkID' + drinkID);
    /* 
    let _form = $(this); //entire form element in variable _form
    let _error = $(".js-error", _form);
 */
    let dataObj;
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
        url: 'ajax/saveToFavourites.php',
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
        console.log(data);
        if(data.redirect !== undefined){
           window.location = data.redirect; 
        }else if(data.error !== undefined){ //or data.isLoggedIn === true, but we have enough info with error
            _error
                .html(data.error) //text(data.error) 
                .show();
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


/*** GET FAVOURITE DRINKS - used on getFavouriteDrinks.php  ***/
async function getFavouriteDrinks( allFavouriteDrinksObj ){

    let allFavDrinksContainer = document.querySelector('#allFavouriteDrinksCards');


    for(var i=0; i<allFavouriteDrinksObj.length; i++){
        //alert(allFavouriteDrinksObj[i]['drink_id']);
        const response = await fetch(drinkDetailsByID_endpoint + allFavouriteDrinksObj[i]['drink_id']);
        const data = await response.json();

        console.log(data);

        data.drinks.forEach(drink => {
            console.log("drinkName:" + drink.strDrink);
            console.log("imageSRC:"+ drink.strDrinkThumb);
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
