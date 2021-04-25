const cocktailDB_url = 'https://www.thecocktaildb.com/api/json/v1/1/';
const randomDrink_endpoint = `${cocktailDB_url}random.php`;
const drinkDetailsByID_endpoint = `${cocktailDB_url}lookup.php?i=`;
const drinkName_endpoint = `${cocktailDB_url}search.php?s=`;

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
        console.log('firstWordOfSearchText: <' + firstWordOfSearchText + '>');

        
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
                                            <a class="ui left corner label">
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


function resetCards(){
    document.querySelector('.cards').innerHTML = '';
}
