function Profile()
{
    var ourRequest = new XMLHttpRequest();
    ourRequest.open('GET','http://localhost/MVC%20Tutorial/dashboard/getProfileLocation')
    ourRequest.onload = function() {
        var path = JSON.parse(ourRequest.responseText);
        //console.log(path[0]);
        Photo(path[0], "100", "100", "Profile Picture", "ProfilePic");
    };
    ourRequest.send();
}

function Photo(data, width, height, alt, id)
{
    var profile = document.createElement("IMG");
    profile.setAttribute("src", data);
    profile.setAttribute("class", 'pozaid');
    profile.setAttribute("width", width);
    profile.setAttribute("height", height);
    profile.setAttribute("alt", alt);
    document.getElementById(id).appendChild(profile);
}
Profile();

var owner = document.getElementById("AllPhotos");
//Numara cate poze sunt in total
function countAll()
{
    var ourRequest2 = new XMLHttpRequest();
    ourRequest2.open('GET','http://localhost/MVC%20Tutorial/dashboard/getCountAllPhoto')
    ourRequest2.onload = function() {
        var path = JSON.parse(ourRequest2.responseText);
        //console.log(path[0]);
        AllPhotosAll(path[0]);
    };
    ourRequest2.send();
}
countAll();

var countedNumber = 0;
///Numara Cate Commenturi sunt
function countComments()
{
    var ourRequest2 = new XMLHttpRequest();
    ourRequest2.open('GET','http://localhost/MVC%20Tutorial/dashboard/getCountComments')
    ourRequest2.onload = function() {
        var path = JSON.parse(ourRequest2.responseText);
        //console.log(path);
        countedNumber = path[0];
    };
    ourRequest2.send();
}
countComments();
///Afiseaza comenturile
function showComments(data, tag)
{
    var ourRequest3 = new XMLHttpRequest();
    ourRequest3.open('GET','http://localhost/MVC%20Tutorial/dashboard/getComments')
    ourRequest3.onload = function() {
        var path = JSON.parse(ourRequest3.responseText);
        //owner.innerHTML=" <div class='comm'>"
        for (var i = 0; i < countedNumber; i++){
            if (data == path[i].ID_post){
                var comm = document.createElement("p");
                comm.innerHTML = path[i].NAME+" : "+path[i].value;
                document.getElementById(tag).appendChild(comm);
                //document.getElementById(tag).insertAdjacentHTML("beforeend",path[i].NAME+" : "+path[i].value);
                //document.getElementById(tag).appendChild(createElement("br"));
            }
        }
        //owner.innerHTML="</div>";

    };
    ourRequest3.send();
}

///afiseaza toate pozele sii comm si userii
function AllPhotosAll(data){
    var ourRequest3 = new XMLHttpRequest();
    ourRequest3.open('GET','http://localhost/MVC%20Tutorial/dashboard/getAllPhotoLocation')
    ourRequest3.onload = function() {
        var path = JSON.parse(ourRequest3.responseText);
        for(var j = 0; j < data; j++){

            var my_name = document.createElement("div");
            my_name.id="NameId" + j;
            my_name.setAttribute("class", "SabauName");
            document.getElementById("AllPhotos").appendChild(my_name);

            var my_div = document.createElement("div");
            my_div.id="PozaId" + j;
            my_div.setAttribute("class", "SabauPhoto");
            document.getElementById("AllPhotos").appendChild(my_div);


            Photo(path[j].Photo, "200", "200", "AllPhotos" +  j, my_div.id);

            var div_forComments = document.createElement("div");
            div_forComments.id="CommentId"+ j;
            div_forComments.setAttribute("class", "SabauComments");
            document.getElementById(my_div.id).appendChild(div_forComments);


            var div_DisplayComments = document.createElement("div");
            div_DisplayComments.id = "CommentIdDisplay" + j;
            div_DisplayComments.setAttribute("class","SabauDisplayComments");
            document.getElementById(div_forComments.id).appendChild(div_DisplayComments);


            var div_SendComments = document.createElement("div");
            div_SendComments.id = "SendId" + j;
            div_SendComments.setAttribute("class","SabauSend");
            document.getElementById(div_forComments.id).appendChild(div_SendComments);


            showComments(path[j].ID, div_DisplayComments.id);
            my_name.insertAdjacentHTML('beforeend', path[j].NAME);

            //owner.innerHTML("<h1>NUPE</h1>");
            //owner.innerHTML = ""
            my_form=document.createElement('FORM');
            my_form.name='comment';
            my_form.method='POST';
            my_form.action='http://localhost/MVC%20Tutorial/dashboard/setComments';

            my_tb=document.createElement('INPUT');
            my_tb.type='TEXT';
            my_tb.name='myInput';
            my_tb.autocomplete='off';
            my_form.appendChild(my_tb);

            my_tb=document.createElement('INPUT');
            my_tb.setAttribute("class","hidButton");
            my_tb.type='submit';
            my_tb.name='submit';
            my_tb.value=path[j].ID;
            my_form.appendChild(my_tb);


            div_SendComments.appendChild(my_form);
            //my_form.submit();
            //console.log(path[j]);
        }

        //console.log(path);
    };
    ourRequest3.send();
}
