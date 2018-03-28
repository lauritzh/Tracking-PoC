console.log('start logging routines');

var storageTracker = function() {
    var d = new Date();
    var n = d.getTime();

    try {
        var id = localStorage.getItem("trackingID");
        // Check if Tracking Data is storage
        if(id)
            console.log("Found TrackingID: " + id);
        else {
            id = btoa(Math.random(0, 999999999999).toString());
            localStorage.setItem("trackingID", id);
            console.log("Set TrackingID: " + localStorage.getItem("trackingID"));
        }

        // Send our Information to AJAX Endpoint
        var data = "type=1&id=" + id + "&ua=" + encodeURI(navigator.userAgent) + "&ts=" + n.toString();
        var xhr = new XMLHttpRequest();
        xhr.withCredentials = true;

        xhr.addEventListener("readystatechange", function () {
            if (this.readyState === 4) {
                console.log(this.responseText);
            }
        });
        xhr.open("POST", "ajax.php");
        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        xhr.send(data);
    }
    catch(e) {
      console.log('An error occured: ' + e.message)
    }
};

storageTracker();