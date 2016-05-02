/**
 * Get json
 * @param url
 * @param callback
 */
var getJSON = function(url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open("get", url, true);
    xhr.responseType = "json";
    xhr.onload = function() {
        var status = xhr.status;
        if (status == 200) {
            callback(null, xhr.response);
        } else {
            callback(status);
        }
    };
    xhr.send();
};

function postValue($id){
    var xhr = new XMLHttpRequest($id);
    xhr.open('POST', 'index.php?page=index&action=add_basket');
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('productId=' + $id);
}

function finishCommand(){
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?page=command&action=add');
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('savecom=ok');
}

function countBasket($data) {
    $count = parseInt('0');
    $data.forEach(function(entry) {
        $count +=parseInt(entry.quantity);
    });
    return ($count);
}

/**
 * 
 * @param $id
 * @param $stock
 */
function addToBasket($id,$stock){
    if($stock)
    {
        postValue($id);

        getJSON("index.php?page=basket&action=json",
            function(err, data) {
                if (err != null) {
                } else {
                    document.querySelector("#basket_nb").innerHTML = countBasket(data);
                }
            });


    }
}
//
// getJSON("index.php?page=basket&action=json",
//     function(err, data) {
//         if (err != null) {
//         } else {
//             document.querySelector("#basket_nb").innerHTML = countBasket(data);
//
//         }
//     });

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
    finishCommand();
}