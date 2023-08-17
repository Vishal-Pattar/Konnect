function validatexplore()
{
    var chk = document.getElementsByClassName("chk");
    var rt="";
    for(var i=0; i < chk.length; i++)
    {
        chk[i].value = "N";
        if(chk[i].checked == true)
        {
            chk[i].value = "Y";
        }
        var dt = chk[i].value;
        rt += dt;
    }
    document.getElementById("exphid").value = rt;
    return true;
}
function jnn()
{
    var join = document.getElementsByClassName("coit-join");
    var hid = document.getElementById("coit-hid").innerText;
    for(var i = 0; i < join.length; i++)
    {
        var trfg = hid[i];
        if(trfg == "N")
        {
            join[i].style.backgroundColor="#5CDB95";
            join[i].style.color="#fff";
        }
        else if(trfg == "Y")
        {
            join[i].style.backgroundColor="#D9D9D9";
            join[i].style.color="#555";
        }
    }
}
