﻿// JavaScript source code
// JavaScript source code
// JavaScript source code
function users(Num, Name, sex, EdTime,  result) {
    var div = document.createElement("div");

    if ($("Leo_project_body").lastChild) {
        if ($("Leo_project_body").lastChild.style.backgroundColor == "silver") {
            div.style.backgroundColor = "white";

        } else {
            div.style.backgroundColor = "silver";
        }
    }

    div.style.width = "99.5%";
    div.style.borderLeft = "2px solid silver";
    div.style.borderRight = "2px solid silver";

    div.id = Num;
    div.style.cursor = "pointer";

    var table = document.createElement("table");
    table.cellSpacing = "0";

    table.style.height = "30px";
    table.style.width = "100%";
    table.style.fontSize = "15px";
    table.style.textAlign = "center";
    table.style.margin = "0 auto";


    var tr = document.createElement("tr");
    tr.style.height = "100%";
    tr.style.verticalAlign = "middle";

   

    var tdNum = document.createElement("td");
    tdNum.style.width = "20%";
    tdNum.innerText = Num;
    tdNum.style.textAlign = "center";
   // tdNum.onclick = new Function("Leo_toEdit(this)");

    var tdName = document.createElement("td");
    tdName.style.width = "15%";
    tdName.innerText = Name;
   // tdName.onclick = new Function("Leo_toEdit(this)");

    var tdsex = document.createElement("td");
    tdsex.style.width = "10%";
    tdsex.innerText = sex;
   // tdsex.onclick = new Function("Leo_toEdit(this)");

    var tdisCom = document.createElement("td");
    tdisCom.style.width = "20%";
    if (parseInt(result)) {

        tdisCom.innerText = "是";
        tdisCom.style.color = "green";
    } else {
        tdisCom.innerText = "否";
        tdisCom.style.color = "red";

    }

    var tdEdtime = document.createElement("td");
    tdEdtime.style.width = "20%";
    tdEdtime.innerText = EdTime;

   

    var tdResult = document.createElement("td");
    tdResult.style.width = "15%";


    if (parseInt(result)) {

        var newa = document.createElement("input");
        newa.type = "button";
        newa.onclick = new Function("window.open('Leo_personalResult.html')");
        newa.value = ">>";
        tdResult.appendChild(newa);
    } else {
        tdResult.innerText = "无结果";
        tdResult.style.color = "gray";

    }
    
    



    
    tr.appendChild(tdNum);
    tr.appendChild(tdName);
    tr.appendChild(tdsex);
    tr.appendChild(tdisCom);
    tr.appendChild(tdEdtime);
   
    tr.appendChild(tdResult);

    table.appendChild(tr);
    div.appendChild(table);



    return div;
}






function Leo_exitEdit(t) {
    var content = t.value;
    var s = t.parentNode;
    s.removeChild(t);
    s.innerText = content;
    s.onclick = new Function("Leo_toEdit(this)");

}

function Leo_deleteTdleader(t) {
    var tem = new Array();
    var b = false;
    var l = Leaders_name.length;
    for (var i = 0; i < l; i++) {

        if (!b && Leaders_name[i].substr(0, 5) == t.parentNode.childNodes[1].innerText) {
            b = true;
        }
        if (b) {
            if (i != l - 1) { tem.push(Leaders_name[Leaders_name.length - 1]); }

            Leaders_name.pop();
        }
    }

    if (!b) { alert("wrong"); }

    for (var i = 0; i < tem.length; i++) {
        Leaders_name.push(tem[tem.length - i - 1]);
    }

    initLeaders();

}

//这里的删除其实是存在问题的，按编号去进行删除，这个问题只能通过建立用户的查重机制来解决
function Leo_deleteTduser(t) {
    var tem = new Array();
    var b = false;
    var l = Users_name.length;
    for (var i = 0; i < l; i++) {

        if (!b && Users_name[i].substr(0, 5) == t.parentNode.childNodes[1].innerText) {
            b = true;
        }
        if (b) {
            if (i != l - 1) { tem.push(Users_name[Users_name.length - 1]); }

            Users_name.pop();
        }
    }

    if (!b) { alert("wrong"); }

    for (var i = 0; i < tem.length; i++) {
        Users_name.push(tem[tem.length - i - 1]);
    }

    initusers();

}
function Leo_deleteTdexpert(t) {
    var tem = new Array();
    var b = false;
    var l = Experts_name.length;
    for (var i = 0; i < l; i++) {

        if (!b && Experts_name[i].substr(0, 5) == t.parentNode.childNodes[1].innerText) {
            b = true;
        }
        if (b) {
            if (i != l - 1) { tem.push(Experts_name[Experts_name.length - 1]); }

            Experts_name.pop();
        }
    }

    if (!b) { alert("wrong"); }

    for (var i = 0; i < tem.length; i++) {
        Experts_name.push(tem[tem.length - i - 1]);
    }

    initexperts();

}