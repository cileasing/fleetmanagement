/*
 * globals.js
 * This file contains global definintions applying to all or most files
 */

var GLOBALS = {};

GLOBALS = {
    userInfo: {
        id: null,
        email: null,
        userName: null,
        accessStatus: null
    },
    refreshedTaskInfoCookieName: '__w2fkhik_',
    //appRoot: 'http://localhost/payhaven/',
    appRoot: 'http://localhost:8081/',
    lockAllUpdates: false
};



function shuffleArray(response){
    for(var x = response.length - 1; x > 0; x--){
        var holder = Math.floor(Math.random()*(x+1));
        var temp = response[x];
        response[x] = response[holder];
        response[holder] = temp;
    }
    return response;
}


function sortArray(Arr){
    for (var i = 1; i < Arr.length; i++){
        for (var j = 0; j < i; j++)
            if (Arr[i] < Arr[j]) {
              var x = Arr[i];
              Arr[i] = Arr[j];
              Arr[j] = x;
         }

         return x;
     }
}
