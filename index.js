const btnsearch = document.getElementById('btnsearch');
const resultwrap = document.getElementById("brewery-wrap");
var html = "";

jQuery(".breweryform").submit(function() {
    var breweryname = document.getElementById("fbreweryname").value;
    var brewerycity = document.getElementById("fbrewerycity").value;
    var brewerytype = document.getElementById("fbrewerytype").value;
    //console.log(breweryname);

    const url = `https://api.openbrewerydb.org/v1/breweries?by_name=${breweryname}&by_city=${brewerycity}&by_type=${brewerytype}`;
    console.log(url);

    fetch(url)
    //then grab the response and convert to JSON
    .then(function(data){
      return data.json();
    })
    //then render the beer data
    .then(renderBrewery)
    .catch(function(e){
      console.log("Error: " + e);
    });
    html = "";
}); 

const renderBrewery = breweryArray => {
  //console.log(breweryArray);
  html = "";
  if(!(breweryArray.length === 0)){
    breweryArray.forEach(brewery => {
        html += `<div class="col-md-4 mb-5">
        <div class="brewery-info card h-100">
        <div class="card-body p-4">
                        <div class="text-left">
                            <h6 class="fw-bolder">${brewery['name']}</h6>
                            <p><span>Address:</span><br/>${brewery['address_1']}</p>
                            <p>Phone: ${brewery['phone']}</p>
                            <p>Website: ${brewery['website_url']}</p>
                            <p>${brewery['state']}, ${brewery['city']} </p>
                        </div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-left"><a class="btn btn-outline-dark mt-auto" href="details.php?id=${brewery['id']}">View Brewery</a></div>
                    </div></div>
                    </div>`

        resultwrap.innerHTML= html;
      })
  }else{
    html += `<div class="col-md-12"><p>No results found!</p></div>`;
    resultwrap.innerHTML= html;
  }
}

