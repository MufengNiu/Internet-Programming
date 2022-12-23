var item;

/*
readyState 	Holds the status of the XMLHttpRequest. Changes from 0 to 4:
0: request not initialized
1: server connection established
2: request received
3: processing request
4: request finished and response is ready
status 	
200: "OK"
403: "Forbidden"
404: "Not Found"
*/
$(document).ready(function() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            item = JSON.parse(this.responseText);
            for(var i = 1;i<=item.car.length;i++){
                var description_id = "#" + "description_" + i.toString(); 
                var description = "<strong>Category:</strong> " + item.car[i-1].Category + "<br><strong>Brand:</strong> " + item.car[i-1].Brand
                + "<br><strong>Model:</strong> " + item.car[i-1].Model + "<br><strong>Model Year:</strong> " + item.car[i-1].Model_year
                + "<br><strong>Mileage:</strong> " + item.car[i-1].Mileage + "<br><strong>Price Per Day:</strong> " + item.car[i-1].Price_per_day;
                
                if(item.car[i-1].Availability == true){
                    description += "<br><strong>Availability:</strong> Yes";
                }else{
                    description += "<br><strong>Availability:</strong> No";
                }
                description += "<br><strong>Description:</strong> " + item.car[i-1].Description;
                // jQuery.html() treats the string as HTML, jQuery.text() treats the content as text
                $(description_id).html(description);
            }
        }
    };
    xhttp.open("GET", "cars.json", true);
    xhttp.send();
});

function addCart(id){

    if(item.car[id].Availability == false){
        alert("Sorry, The car is not available now, please try other cars");
    }else{
        var img = item.car[id].Model + ".png";
        var name = item.car[id].Brand + " " + item.car[id].Model + " " + item.car[id].Model_year;
        var price = item.car[id].Price_per_day;
        var quantity = 1;
        var car_info = [img,name,price,quantity];
        
        $.post("addcar.php",{
            passedValue:car_info
        });
        alert("Add to cart successfully");
    }
}

