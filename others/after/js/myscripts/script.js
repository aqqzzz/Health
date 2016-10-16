//global

function addLoadEvent(func) {
    var oldonload = window.onload;
    if(typeof window.onload != 'function'){
        window.onload = func;
    } else {
        window.onload = function() {
            oldonload();
            func();
        }
    }

}

function insertAfter(newElement, targetElement){
    var parent = targetElement.parentNode;
    if(parent.lastChild == targetElement){
        parent.appendChild(newElement);
    }else {
        parent.insertBefore(newElement, targetElement.nextSibling);
    }
}

function addClass(element, value){
    if(!element.className) {
        element.className = value;
    } else {
        newClassName = element.className;
        newClassName += " ";
        newClassName += value;
        element.className = newClassName;
    }
}

/*thumbnail高度统一的方法，但是如果使用的话thumbnail里的内容 在单行显示的时候 会超出来*/
function equalHeight(group) {
    var windowWidth;
    if(window.innerWidth) {//除IE6之外的浏览器
        if(document.documentElement.clientWidth){
            windowWidth = document.documentElement.clientWidth;
        } else {
            windowWidth = self.innerWidth;
        }
    } else {
        if(document.documentElement) {//IE6
            windowWidth = document.documentElement.clientWidth;
        }else { //其他浏览器
            if(document.body) {
                windowWidth = document.body.clientWidth;
            }

        }

    }



        tallest = 0;

        group.each(function() {

            thisHeight = $(this).height();
            if(thisHeight > tallest) {
                tallest = thisHeight;
            }
        });
        group.each(function() { $(this).height(tallest+5); });




}




/**如何在窗口大小改变时钓友这个函数进行判断*/

//addLoadEvent(equalHeight($("#activities .thumbnail")));
//addLoadEvent(equalHeight($("#blogs .thumbnail")));

