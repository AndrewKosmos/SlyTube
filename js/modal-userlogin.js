window.onload = function()
{
    win = document.getElementById("win");
    shirm = document.getElementById("shirm");
}

function showWin()
{
    shirm.style.filter = "alpha(opacity=80)";
    shirm.style.opacity = 0.8;
    shirm.style.display = 'block';
    win.style.display = 'block';
    win.style.top = "250px";
}

function hideAll()
{
    win.style.display = "none";
    shirm.style.display = "none";
}