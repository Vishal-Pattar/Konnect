function dispcomm()
{
    var k = document.getElementById("test").innerHTML;
    var x = document.getElementsByClassName("icomm");
    arr = [];
    if(x[k].checked == true)
    {
        for(var h=0; h < x.length; h++)
        {
            x[h].checked = false;
        }
        x[k].checked = true;
    }
    if(x[k].checked == false)
    {
        for(var j=0; j < x.length; j++)
        {
            x[j].checked = false;
        }
    }
    for(var i=0; i < x.length; i++)
    {
        y = x[i].checked;
        arr.push(y);
    }
    for(var c=0; c < arr.length; c++)
    {
        document.getElementsByClassName("wcm-post")[c].style.display="none"; 
    }
    if(x[k].checked == true)
    {
        document.getElementsByClassName("wcm-post")[k].style.display="block";
    }
    else if(x[k].checked == false)
    {
        document.getElementsByClassName("wcm-post")[k].style.display="none";
    }
}
/*function dispcomm()
{
    var x = document.getElementsByClassName("icomm");
    var arr = [];
    var arry = [];
    for(var i=0; i < x.length; i++)
    {
        y = x[i].checked;
        arr.push(y);
        if(y == true)
        {
            var tf = i;
        }
        /*
        z = x[i].checked;
        arry.push(z);
    }
    for(var h=0; h < x.length; h++)
    {
        z = x[h].checked;
        if(arry[])
        z = x[h].checked;
        arry.push(z);
    }
    document.getElementById("test").innerHTML = arry;
    for(var c=0; c < arry.length; c++)
    {
        document.getElementsByClassName("wcm-post")[c].style.display="none"; 
    }
    document.getElementsByClassName("wcm-post")[tf].style.display="block";
    /*
    var scroll = document.getElementById("work-post");
    var ht = 513;
    scroll.scrollTop = (ht*tf + ht);
    */
    //window.alert(arr);
    //window.alert(tf);
    /*
    for(var c=0; c < arr.length; c++)
    {
        if(arr[c] == true)
        {
            document.getElementsByClassName("wcm-post")[c].style.display="block";
            /*var scroll = document.getElementById("work-post");
            scroll.scrollTop = (435*c + 435);*/
        /*}
        else if(arr[c] == false)
        {
            document.getElementsByClassName("wcm-post")[c].style.display="none";
        }
    }
}*/

function validatePost() 
{
    var text = document.getElementById("w-inptmess").value;
    var file = document.getElementById("w-inptfile").value;
    var result = true;
    if (text == "" && file == "") 
    {
        result = false;
    }
    else if (text == "") 
    {
        result = false;
    }
    else if (file == "") 
    {
        result = true;
    }
    return result;
}
function validateUploimg()
{
    var fimg = document.getElementById("prof-uplo-file").value;
    var result = true;
    if (fimg == "") 
    {
        result = false;
    }
    return result;
}
var up = 0;
function showuploadbutt()
{
    var butt = document.getElementById("prof-uplo");
    up += 1;
    if(up % 2 == 0)
    {
        butt.style.display="none"
    }
    else if(up % 2 != 0)
    {
        butt.style.display="block"
    }
}