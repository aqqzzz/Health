function hide(el, offset) {
    var opacity = el.style.opacity||1;
    setTimeout(function() {
        el.style.opacity = String(parseFloat(opacity) - offset);
        parseFloat(el.style.opacity) > 0 && hide(el,offset);
    }, 20);
}

function createXHR() {
    var xhr = null;
    if(window.ActiveXObject) {
        xhr = new ActiveXObject("microsoft.xmlhttp");
    } else {
        xhr = new XMLHttpRequest();
    }
    return xhr;
}

function send(xhr, url, str) {
    // 准备以POST方式发送请求
    xhr.open("post", url + "?time=" + new Date().getTime());
    // 设置请求头，只有是POST方式下，才设置该请求头
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    // 设置为 post时，就可以在send函数中添加参数列表。当为get时，下面的send中参数为null。
    xhr.send(str);
}

function AJAX(page, url, data){
    // 创建ajax引擎对象
    var xhr = createXHR();
    btn = document.getElementById(data + "_" + page);
    div = document.getElementById("div_" + data + "_" + page);
    op = 0;
    if(btn.value == "参加") {
        op = 1;
    } else if(btn.value == "退出") {
        op = 2;
    } else if(btn.value == "删除") {
        op = 3;
    }
    // 创建ajax状态监听
    xhr.onreadystatechange = function(){
        // 接受返回字符串
        msg = xhr.responseText;
        // 使用返回的字符串信息
        hint = document.getElementById("hint");
        hint.innerHTML = msg;
        hint.style.visibility = "visible";
        hint.style.opacity = 1;
        hide(hint, 0.02);	// 几秒后消失
        if(op == 1) {   // 参加成功
            btn.value = "退出";
        } else if(op == 2) {    // 退出成功
            btn.value = "参加";
            if(page == "my") {
                div.style.display = "none";
            }
        } else if(op == 3) {    // 删除成功
            div.style.display = "none";
        }
    };
    send(xhr, url, "id=" + data + "&op=" + op);
}

function send_text(uid, text_id, url) {
    var textarea = document.getElementById(text_id);
    var info = textarea.value;
    var xhr = createXHR();
    xhr.onreadystatechange = function(){
        msg = xhr.responseText;
        hint = document.getElementById("hint");
        hint.innerHTML = msg;
        hint.style.visibility = "visible";
        hint.style.opacity = 1;
        hide(hint, 0.02);	// 几秒后消失
        textarea.value = "";
    }
    send(xhr, url, "uid=" + uid + "&info=" + info);
}

// 删除动态
function delete_moment(m_id, div_id, url) {
    var div = document.getElementById(div_id);
    var xhr = createXHR();
    xhr.onreadystatechange = function(){
        msg = xhr.responseText;
        hint = document.getElementById("hint");
        hint.innerHTML = msg;
        hint.style.visibility = "visible";
        hint.style.opacity = 1;
        hide(hint, 0.02);	// 几秒后消失
        div.style.display = "none";
    }
    send(xhr, url, "m_id=" + m_id);
}
