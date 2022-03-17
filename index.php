<?php 
session_start();
include 'conn.php';
if (empty($_SESSION['member'])){
  
}else{
  $user=$_SESSION['member'];
  $userres=mysqli_query($conn,"select * from login where id=$user");
  $userarr=mysqli_fetch_array($userres);
}
$zongshu=mysqli_query($conn,"SELECT COUNT(id) AS sum FROM goods where zt=1"); 
$count=mysqli_fetch_array($zongshu); 
$sum=$count['sum'];
$page=page($sum,3);
$firstRow=$page['firstRow'];
$listRows=$page['listRows'];
$product=mysqli_query($conn,"select * from goods where zt=1  order by id desc limit $firstRow,$listRows");
while ($product_row=mysqli_fetch_array($product)) {
   $data[]=$product_row;
}
?>
<html>
<head>
<meta charset="utf-8">
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link  href="css/base.css" rel="stylesheet">
<link href="css/index.css" rel="stylesheet">
<link href="css/index1.css" rel="stylesheet">
<style>
body{
  background: url(images/001.png) repeat 0 0;
}
.page{
  width: 1000px;
  margin:20px auto;
  padding-bottom: 50px;
}
.footer{
  text-align: center;
  padding: 20px 0px;
  background-color: #333;
  margin-top: 40px;
  color: #fff
}
#so{
  margin:-40px auto;
  clear: both;
  overflow: hidden;
  width: 30%
}

</style>
</head>
<body >
<header>
  <div class="tophead">
    <nav class="topnav" id="topnav">
      <ul>
      <li id="clock" class="clock_con" style="float: left;color: #fff;font-size: 20px;"></li>
     <li><a href="admin/index.php">后台管理</a></li>
        
       <?php if(isset($user)){ ?>
       
         <li >欢迎 [<?php echo $userarr['username'] ?>] <a href="logout.php">退出</a></li>
        
        <?php }else{ ?>

         <li ><a href="register.php">注册</a></li>
        <li><a href="login.php">登录</a></li>
        <?php } ?>
      </ul>
    </nav>
  </div>
</header>
<article>
  <h1 class="t_nav"><a class="n1" href="index.php" class="n2">首页</a><a class="n2" href="mycar.php" >我的购物车</a><a class="n2" href="myorder.php" >我的订单</a><a class="n2" href="me.php" >个人中心</a>

  </h1>

  <div class="wrap" id="wrap">
    <ul id="pic">
        <li><img height="350" width="1200" src="images/bg_img.jpg" alt=""></li>
         <li><img  height="350" width="1200" src="images/bg_img1.jpg" alt=""></li>
        <li><img height="350" width="1200" src="images/01.jpg" alt=""></li>
        
    </ul>
    <ol id="list">
        <li class="on">1</li>
        <li>2</li>
        <li>3</li>
        
    </ol>
  </div>

  <div  id="so" >
          <form action="search.php" method="get">
                   <div class="input-group">
                      
                       <input style="width: 100%;float: left;" type="text" name="keyword" value="" class="form-control" placeholder="请输入鲜花名搜索"/>
                       <span class="input-group-addon"><button type="submit"> <span >鲜花搜索</span></button></span>
                   </div>
           </form>        
  </div>
  
  <div class="ab_box" style="margin-top: 85px;">
  <h2 style="margin-bottom: 10px;width: 1000px;margin:20px auto;">
  商品列表
  
  
  </h2>
  
   <?php foreach ($data as $k => $v) {
     
   ?> 
    <div class="tianyi">
        <img src="images/<?php echo $v['img']; ?>" />
        <h2 class="orders"><?php echo $v['trade_name']; ?></h2>
       
        <p class="orders" style="">售价：<?php echo $v['price']; ?></p>
        <p class="orders" style="margin-bottom: 5px;color: red;height: 10px;overflow: hidden;">花语：<?php echo $v['introduce']; ?></p>
        <button style="border:none;" class='cart'><a href="detail.php?id=<?php echo $v['id']; ?>">商品详情</a></button>

    </div>
    <?php } ?>
    
    <div class="page"  >
        <div>
          <?php echo $page['show'] ?>
        </div>      
    </div>
  </div>
</article>

<div class="footer" >
<p></p>
</div>
</body>


<script>
  function fnCreatClock(){
  //声明时间相关变量
  var dLocal,nYear,nMonth,nDate,nHours,nMinutes,nSeconds;

  //1 获取计算机本地时间
  function fnGetDate(){ 
    //1.1 调用date对象
    dLocal = new Date();
    //1.2 获取当前年份
    nYear = dLocal.getFullYear(); 
    //1.3 获取当前月份，月份是从0开始计数，所以需要加1才是正确的月份
    nMonth = dLocal.getMonth() + 1; 
    //1.4 获取当前日期
    nDate = dLocal.getDate(); 
    //1.5 获取当前小时
    nHours = dLocal.getHours(); 
    //1.6 获取分钟
    nMinutes = dLocal.getMinutes(); 
    //1.7 获取秒数
    nSeconds = dLocal.getSeconds(); 
  }

  //2.1 封装一个函数，用于把单数字前添加字符串0，例如1改为01
  function fnToDouble(num){  
    //声明一个返回结果
    var sResult = ''; 
    if(num<10){
      //判断数字小于10则是单数字，需要在前面添加字符串0
      sResult = '0' + num;
    }else{
      //数字为10以上转换为字符串
      sResult = '' + num;
    }
    //返回格式化后的字符串
    return sResult; 
  }

  function fnFormatDate(){
    //2.2 组合时间数据为字符串。本实例主要针对初学者，所以这里用的是最简单的格式化方式，即把所有数据用+号相连
    return nYear + '-' + fnToDouble(nMonth) + '-' + fnToDouble(nDate) +
           ' ' + fnToDouble(nHours) + ':' + fnToDouble(nMinutes) + ':' + fnToDouble(nSeconds);
  }

  //3.1 获取clock元素
  var eClock = document.getElementById('clock'); 
  //获取时间 
  fnGetDate();
  //3.2 修改clock元素中的时间
  eClock.innerHTML = fnFormatDate(); 

  //使用定时器实时更新时间
  setInterval(function(){ 
    //3.3 每秒更新时间
    fnGetDate();  
    //3.3 修改clock元素中的时间
    eClock.innerHTML = fnFormatDate(); 
  },1000); 
}
fnCreatClock();

</script>

<script>
 window.onload = function() {
      
       
     var wrap = document.getElementById('wrap'),
         pic = document.getElementById('pic'),
         list = document.getElementById('list').getElementsByTagName('li'),
         index = 0,
         timer = null;

     // 若果有在等待的定时器，则清掉
     if (timer) {
         clearInterval(timer);
         timer = null;
     }

     // 自动切换
     timer = setInterval(autoPlay, 2000);

     // 定义并调用自动播放函数
     function autoPlay() {
         index++;
         if (index >= list.length) {
             index = 0;
         }
         changeImg(index);
     }

     // 定义图片切换函数
     function changeImg(curIndex) {
         for (var j = 0; j < list.length; j++) {
             list[j].className = "";
         }
         // 改变当前显示索引
         list[curIndex].className = "on";
         pic.style.marginTop = -350 * curIndex + "px";
         index = curIndex;
     }

     // 鼠标划过整个容器时停止自动播放
     wrap.onmouseover = function() {
         clearInterval(timer);
     }

     // 鼠标离开整个容器时继续播放至下一张
     wrap.onmouseout = function() {
         timer = setInterval(autoPlay, 2000);
     }

     // 遍历所有数字导航实现划过切换至对应的图片
     for (var i = 0; i < list.length; i++) {
         list[i].id = i;
         list[i].onmouseover = function() {
             clearInterval(timer);
             changeImg(this.id);
         }
     }
 }


</script>
</html>
