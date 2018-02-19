//Created by: Daniel Namyslaw.
//Contributed by: Whole Group.
//This file will generate a graph of days taken to complete tickets per specialist in the system.
//This can be done by selecting a specialist from the scroll down list.
//The first function in the code populates the select box, whilst the second generates the graph for the selected user.
var filteredArr = []; //A global array created so that both functions can access them.
function charts4(){
    $.get('scripts/getFullEmployeeDetails.php', function (result) { //Using php, this interacts with the MySQL server to fetch the required information
                                                                    // from the database. The MySQL query is written in the php file stated.




        result.forEach(function(object){ //Filters through the whole array generated by the code above.
            var filterArr = new Array();
            filterArr[0] = object.userID;       //creates a new array for each array in the result array;
                                                // with each array containing the user ID
                                                // and a concatenated full name from firstName and lastName.
            filterArr[1] = object.firstName + " " + object.lastName;


            filteredArr.push(filterArr); //Puts the new array into another array creating an array of arrays.
        })

        for(var i=0; i< filteredArr.sort().length;i++) //This for loop takes the sorted array that we created and loops through it.
        {

            jQuery('<option/>', {           //JQuery to populate the selectbox, it will take the second value from the array,
                                            //the Full Name and create an options tag with each individual name in the webpage,
                                            //making a list of names in the select box.
                value: filteredArr[i][1],
                html: filteredArr[i][1]
            }).appendTo('#employeeSelect');
        }




    }, 'json')



}


function charts5(){
    var userNameElement = document.getElementById("employeeSelect"); //Fetches the selected name id.
    var userName = userNameElement.options[userNameElement.selectedIndex].text;  //changes that id into a text. (Full Name)

    $.get('scripts/getTickets.php', {sort: 'ticketNumber'}, function (result) { //Fetches the data from the database via PHP and gives the array of the data.


            var i =0;
            var userIDArray = []; //creates a new array that can be filled with filtered results in the code below.
            filteredArr.forEach(arrID);// Filters the array and runs the function at every element.
           function arrID(){
               if(filteredArr[i][1]=== userName){ //checks if the object in the array of arrays is the user name.
                   userIDArray.push(filteredArr[i][0]); //if it is it pushes it to a new array
               }
               i++;

           }


            var userArr = [];
            result.forEach(function(object){//runs through the result array

                if(object.userID == userIDArray) { // if the user ID in the result array is equal to the user id in the newly created array
                    if(object.dateClosed !== null) { //and if the ticket is actually closed, it will take the date created and date closed
                                                        // and store it in an arrray.
                        var filterArr = new Array();
                        filterArr[0] = object.dateCreated;
                        filterArr[1] = object.dateClosed;
                    }
                }
                if(filterArr === undefined){ // This ensures that if there is no more instances of a certain user
                                            //but the array continues that the generated array isn't filled with undefined elements.
                    return
                }

                userArr.push(filterArr);
            });




            var filteredArrs = [];
            for (i = 0; i < userArr.length; i++) {  //this for loop creates an array of the dates.
                                                    //Taking them from 'yyyy-mm-dd' to 'yyyy', 'mm', 'dd'
                var splitArray = new Array();
                splitArray[0] = userArr[i][0].split("-");
                splitArray[1] = userArr[i][1].split("-");
                filteredArrs.push(splitArray);
            }
            console.log(filteredArrs);
            var oneDay = 24 * 60 * 60 * 1000; //calculates milliseconds in a day
            var finalDays = [];
            for (f = 0; f < filteredArrs.length - 1; f ++) {


                var firstDate = new Date(filteredArrs[f][1][0], filteredArrs[f][1][1], filteredArrs[f][1][2]); //sets the date closed
                var secondDate = new Date(filteredArrs[f][0][0], filteredArrs[f][0][1], filteredArrs[f][0][2]); //sets the date created

                var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime()) / (oneDay))); //finds the difference between them and puts the difference in dates
                finalDays.push(diffDays); //puts the value in an array

            }


            var counts = [];
            finalDays.forEach(function (x) { //counts the amount of instances of each day taken in the array
                counts[x] = (counts[x] || 0) + 1;
            });


            var uniqArr = Array.from(new Set(finalDays)) //creates an array of unique values from the other array that has multiple of the same values

            uniqArr.sort().map(String); //changes the array into string


            var data = {
                labels: uniqArr.sort().map(String), //using Chartist.js sets the labels to the unique array
                series: [counts] //sets the values to the array of counted days
            };

            var options = {
                seriesBarDistance: 5 //sets distance between bars
            };

            var responsiveOptions = [
                ['screen and (max-width: 640px)', { //sets how it responds to smaller screens
                    seriesBarDistance: 5,
                    axisX: {
                        labelInterpolationFnc: function (value) {
                            return value[0];
                        }
                    }
                }]
            ];

            new Chartist.Bar('.ct-chart', data, options, responsiveOptions); //creates a new bar chart with that data in the div on the analytics page.

        }
        , 'json')








}
