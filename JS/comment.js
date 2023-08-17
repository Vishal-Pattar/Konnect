function comnju()
{
    var inpt = document.getElementsByClassName("wcm-inpt-text");
    for(var c=0; c < inpt.length; c++)
    {
        cval = inpt[c].value;
        if(cval != "")
        {
            val = c;
            document.getElementsByClassName("wcm-inpt-hidden")[c].value = val;
        }
        else if(cval == "")
        {
            val = c;
            document.getElementsByClassName("wcm-inpt-hidden")[c].value = val;
        }
    }
}
/*
function scroll() 
{
    const element = document.getElementById("myDIV");
    element.scrollLeft = 50;
    element.scrollTop = 10;
}
*/