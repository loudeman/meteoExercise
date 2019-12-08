ajaxGet("https://geo.api.gouv.fr/communes?fields=nom", function (response) {
    let citiesNameArray = []
    let citiesBigArray = JSON.parse(response);
    citiesBigArray.forEach( element => {
        citiesNameArray.push(element["nom"])
    });
    
    autocomplete(document.getElementById("searchInput"), citiesNameArray);
    
    document.getElementById('searchButton').onclick = function (e) {
        e.preventDefault()
        if (document.getElementById('searchInput').value){
            ajaxGet('https://api-adresse.data.gouv.fr/search/?q=' + document.getElementById('searchInput').value, function (response) {
                let responseArray = JSON.parse(response)
                if (responseArray["features"].length === 0) {
                    // show error
                }else {
                    document.getElementById('lat1').value = responseArray["features"][0]['geometry']['coordinates'][1]
                    document.getElementById('lon0').value = responseArray["features"][0]['geometry']['coordinates'][0]
                    document.getElementById('city').value = responseArray["features"][0]['properties']['city']
                    document.getElementsByClassName('autocomplete')[0].submit()
                }
            })
        }
    }
})

