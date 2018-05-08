function Photo(data, width, height, alt, id)
{
    var profile = document.createElement("IMG");
    profile.setAttribute("src", data);
    profile.setAttribute("id", 'pozzzzz');
    profile.setAttribute("width", width);
    profile.setAttribute("height", height);
    profile.setAttribute("alt", alt);
    document.getElementById(id).appendChild(profile);
}

function AllPhotos(data){
    var ourRequest1 = new XMLHttpRequest();
    ourRequest1.open('GET','myphoto/getPhotoLocation')
    ourRequest1.onload = function() {
        var path = JSON.parse(ourRequest1.responseText);
        for(var j = 0; j < data; j++){
            Photo(path[j].Photo, "200", "200", "Photos" +  j, "Photos");
        }
        //console.log(path);
    };
    ourRequest1.send();
}
function count()
{
    var ourRequest = new XMLHttpRequest();
    ourRequest.open('GET','http://localhost/MVC%20Tutorial/myphoto/countPhotoUser')
    ourRequest.onload = function() {
        var path = JSON.parse(ourRequest.responseText);
        //console.log(path[0]);
        AllPhotos(path[0]);
    };
    ourRequest.send();
}
count();

var nr = 0;
function WebCam(data) {

    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

    if(navigator.getUserMedia) {
        navigator.getUserMedia({video: data}, handleVideo, videoError);
    }

    function handleVideo(stream){
        document.querySelector('#vidDisplay').src = window.URL.createObjectURL(stream);
    }

    function videoError (e){
        alert("Error");
    }
    var video = document.getElementById("vidDisplay");
    var c = document.getElementById("myCanvas");
    var ctx = c.getContext("2d");
    var photo = document.getElementById('photo');
    document.getElementById("capture").addEventListener("click", function() {
        ctx.drawImage(video, 0 , 0, 400, 300); 
        var img = document.getElementById("myCanvas").toDataURL("image/png");
        //document.getElementById(booth).innerHTML(img);
/*		
        var new_photo = document.createElement("div");
        new_photo.id = "New_photo";
        new_photo.setAttribute("class","NewPhoto");
        document.getElementById(booth).appendChild(new_photo);
        */
        var str = img.substr(22, img.lenght);
        //console.log(str);
        var image = atob(str);

        if (nr % 2 == 0){


            var div_forid1 = document.createElement("div");
            div_forid1.id="id" + nr;
            div_forid1.setAttribute("class", "divid1");
            document.getElementById("booth").appendChild(div_forid1);


            var my_formImage;
            var my_tab;
            my_formImage=document.createElement('FORM');
            my_formImage.name='comment';
            my_formImage.id = 'formid1';
            my_formImage.setAttribute('action',"myphoto/saveImg");

            my_tb=document.createElement('INPUT');
            my_tb.setAttribute('type','IMAGE');
            my_tb.name='myImage';
            my_tb.setAttribute('src',img);
            //my_tb.autocomplete='off';
            my_formImage.appendChild(my_tb);

            my_tb=document.createElement('input');
            my_tb.type='button';
            my_tb.name='Apasa';
            my_tb.value='Dai click';
            my_tb.id='saveImg';
            my_formImage.appendChild(my_tb);


            document.getElementById(div_forid1.id).appendChild(my_formImage);


            document.getElementById("saveImg").addEventListener("click", function() {
                uploadImg(str);
                });
            if (nr > 0)
            {
                document.getElementById('id' + (nr - 1)).style.display="none";
                var i0 = document.getElementById("id" + (nr - 1));
                i0.parentNode.removeChild(i0);
            }
            nr++;
        }
        else {
            var div_forid2 = document.createElement("div");
            div_forid2.id="id"+nr;
            div_forid2.setAttribute("class", "divid2");
            document.getElementById("booth").appendChild(div_forid2);
            var my_formImage;
            var my_tab;
            my_formImage=document.createElement('FORM');
            my_formImage.name='comment';
            my_formImage.id = 'formid2';
            my_formImage.setAttribute('action',"myphoto/saveImg");

            my_tb=document.createElement('INPUT');
            my_tb.setAttribute('type','IMAGE');
            my_tb.name='myImage';
            my_tb.setAttribute('src',img);
            //my_tb.autocomplete='off';
            my_formImage.appendChild(my_tb);

            my_tb=document.createElement('input');
            my_tb.type='button';
            my_tb.name='Apasa';
            my_tb.value='Dai click';
            my_tb.id='saveImg';
            my_formImage.appendChild(my_tb);


             document.getElementById(div_forid2.id).appendChild(my_formImage);


            document.getElementById("saveImg").addEventListener("click", function() {
                uploadImg(str);
            });
            document.getElementById('id' + (nr - 1)).style.display="none";
            var i1 = document.getElementById("id" + (nr - 1));
            i1.parentNode.removeChild(i1);
            nr++;
            console.log(nr);
        }


        //document.getElementById('booth').removeChild(my_formImage);

        /*
        var img2 = document.createElement("img")
        img2.setAttribute("src", img);
        img2.setAttribute("width", "250");
    	img2.setAttribute("height", "250");
        //photo.setAttribute('src', myCanvas);
        //document.getElementById("save").style.display("none");
        document.getElementById("booth").appendChild(img2);
        */
    });

}

function uploadImg(str){
        var dataString = 'name1='+ str;
        $.ajax({
        url: "myphoto/saveImg",
        type: "post",
        data: {nume: str},
            success: function (response) {
               // you will get response from your php page (what you echo or print)
               console.log(response);                 
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });

}
document.getElementById("capture").addEventListener("click", function() {
    WebCam(true);
    //document.getElementById("back-button").style.display = "block";
});
/*
document.getElementById("back-button").addEventListener("click", function() {

    document.getElementById("back-button").style.display = "none";
});
*/
