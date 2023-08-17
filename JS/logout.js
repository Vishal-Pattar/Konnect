lgct = 1
function logout2()
{
    var lgd = document.getElementById("log-menu");
    var arr = document.getElementById("p-img1");
    lgct += 1;
    if(lgct % 2 == 0)
    {
        lgd.style.display="block";
        arr.style.transform="rotate(180deg)";
    }
    else if(lgct % 2 != 0)
    {
        lgd.style.display="none";
        arr.style.transform="rotate(0deg)";
    }
}

lgctg = 1;
function logout()
{
    var lgd = document.getElementById("log-out");
    lgctg += 1;
    if(lgctg % 2 == 0)
    {
        lgd.style.display="block";
    }
    else if(lgctg % 2 != 0)
    {
        lgd.style.display="none";
    }
}