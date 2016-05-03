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
(function() {

    var streaming = false,
        video        = document.querySelector('#video'),
        cover        = document.querySelector('#cover'),
        canvas       = document.querySelector('#canvas'),
        photo        = document.querySelector('#photo'),
        startbutton  = document.querySelector('#startbutton'),
        width = 320,
        height = 0;

    navigator.getMedia = ( navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia);

    navigator.getMedia(
        {
            video: true,
            audio: false
        },
        function(stream) {
            if (navigator.mozGetUserMedia) {
                video.mozSrcObject = stream;
            } else {
                var vendorURL = window.URL || window.webkitURL;
                video.src = vendorURL.createObjectURL(stream);
            }
            video.play();
        },
        function(err) {
            console.log("An error occured! " + err);
        }
    );

    video.addEventListener('canplay', function(ev){
        if (!streaming) {
            height = video.videoHeight / (video.videoWidth/width);
            video.setAttribute('width', width);
            video.setAttribute('height', height);
            canvas.setAttribute('width', width);
            canvas.setAttribute('height', height);
            streaming = true;
        }
    }, false);

    function takepicture() {
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        var data = canvas.toDataURL('image/png');
        document.querySelector('#fapfap').innerHTML += "<img src="+ data+ ">";
        //photo.setAttribute('src', data);
        console.log(data);
    }

    startbutton.addEventListener('click', function(ev){
        takepicture();
        ev.preventDefault();
    }, false);

})();