function drag(id){
    var dv = document.getElementById(id);
    var x = 0;
    var y = 0;
    var l = 0;
    var t = 0;
    var isDown = false;
    //鼠标按下事件
    dv.onmousedown = function(e) {
        //获取x坐标和y坐标
        x = e.clientX;
        y = e.clientY;

        //获取左部和顶部的偏移量
        l = dv.offsetLeft;
        t = dv.offsetTop;
        //开关打开
        isDown = true;
        //设置样式
    }
    //鼠标移动
    document.onmousemove = function(e) {
        if (isDown == false) {
            return;
        }
        //获取x和y
        var nx = e.clientX;
        var ny = e.clientY;
        //计算移动后的左偏移量和顶部的偏移量
        var nl = nx - (x - l);
        var nt = ny - (y - t);
        // 控制左右范围
        if(nl < 0){
            dv.style.left ='0px';
        }else if(nl > document.body.clientWidth - 85){
            dv.style.left = document.body.clientWidth - 85 + 'px';
        }else{
            dv.style.left = nl + 'px';
        }
        // 控制上下
        if(nt < 0){
            dv.style.top ='0px';
        }else if(nt > document.body.clientHeight - 100){
            dv.style.top = document.body.clientHeight - 100 + 'px';
        }else{
            dv.style.top = nt + 'px';
        }
    }
    //鼠标抬起事件
    document.onmouseup = function() {
        //开关关闭
        isDown = false;
        dv.style.cursor = 'default';
    } 
}
function nof12(){
    document.onkeydown=function(){
        var e = window.event||arguments[0];
        if(e.keyCode==123){
            //F12
            return false;
        }else if((e.ctrlKey)&&(e.shiftKey)&&(e.keyCode==73)){
            //ctrl + shift + i
            return false;
        }else if((e.ctrlKey)&&(e.keyCode==85)){
            //ctrl + U
            return false;
        }else if((e.ctrlKey)&&(e.keyCode==83)){
            //ctrl + U
            return false;
        }
    }
}
function contextmenu(e,elem){
    e.oncontextmenu = function(env){

        //env 表示event事件
        // 兼容event事件写法
        var e = env || window.event;

        // 获取菜单，让菜单显示出来
    var context = document.getElementById(elem);
        context.style.display = 'block';
        context.style.transition = 'none';
        context.style.opacity = '0';
        context.style.transform = 'scale(.7)';
        setTimeout(()=>{
            context.style.transition = 'all .15s';
            context.style.opacity = '1';
            context.style.transform = 'scale(1)';
        },30)

    //  让菜单随着鼠标的移动而移动
    //  获取鼠标的坐标
    var x = e.clientX;
    var y = e.clientY;

    //  获取窗口的宽度和高度
    var w = window.innerWidth;
    var h = window.innerHeight;

    //  调整宽度和高度
    context.style.left = Math.min(w-202,x)+"px";
    context.style.top = Math.min(h-230,y)+"px";

    // return false可以关闭系统默认菜单
    return false;
    };

    //   当鼠标点击后关闭右键菜单
    document.onclick = function(){
    var contextmenu = document.getElementById(elem);
    context.style.opacity = '0';
    context.style.transform = 'scale(.7)';
    setTimeout(()=>{
            contextmenu.style.display = "none";
        },200)
    };

}