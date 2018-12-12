<?php
include dirname(__DIR__) . '/inc/header.php';
?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.10.0/js/md5.min.js"></script>
  <script src="<?php echo $url_static;?>/vue/login.js?111"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $URL_AdminLTE;?>/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo $URL_AdminLTE;?>/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
  <style>
@font-face {
  font-family: 'Source Sans Pro';
  font-style: italic;
  font-weight: 300;
  src: local('Source Sans Pro Light Italic'), local('SourceSansPro-LightItalic'), url(<?php echo $URL_GFONTS;?>/6xKwdSBYKcSV-LCoeQqfX1RYOo3qPZZMkids18I.woff) format('woff');
}
@font-face {
  font-family: 'Source Sans Pro';
  font-style: italic;
  font-weight: 400;
  src: local('Source Sans Pro Italic'), local('SourceSansPro-Italic'), url(<?php echo $URL_GFONTS;?>/6xK1dSBYKcSV-LCoeQqfX1RYOo3qPZ7nsDQ.woff) format('woff');
}
@font-face {
  font-family: 'Source Sans Pro';
  font-style: italic;
  font-weight: 600;
  src: local('Source Sans Pro SemiBold Italic'), local('SourceSansPro-SemiBoldItalic'), url(<?php echo $URL_GFONTS;?>/6xKwdSBYKcSV-LCoeQqfX1RYOo3qPZY4lCds18I.woff) format('woff');
}
@font-face {
  font-family: 'Source Sans Pro';
  font-style: normal;
  font-weight: 300;
  src: local('Source Sans Pro Light'), local('SourceSansPro-Light'), url(<?php echo $URL_GFONTS;?>/6xKydSBYKcSV-LCoeQqfX1RYOo3ik4zwlxdo.woff) format('woff');
}
@font-face {
  font-family: 'Source Sans Pro';
  font-style: normal;
  font-weight: 400;
  src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(<?php echo $URL_GFONTS;?>/6xK3dSBYKcSV-LCoeQqfX1RYOo3qOK7j.woff) format('woff');
}
@font-face {
  font-family: 'Source Sans Pro';
  font-style: normal;
  font-weight: 600;
  src: local('Source Sans Pro SemiBold'), local('SourceSansPro-SemiBold'), url(<?php echo $URL_GFONTS;?>/6xKydSBYKcSV-LCoeQqfX1RYOo3i54rwlxdo.woff) format('woff');
}
@font-face {
  font-family: 'Source Sans Pro';
  font-style: normal;
  font-weight: 700;
  src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(<?php echo $URL_GFONTS;?>/6xKydSBYKcSV-LCoeQqfX1RYOo3ig4vwlxdo.woff) format('woff');
}
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box" id="app">
  <div class="login-logo">
    <!--<a href="javascript:void(0)">--><b>飞儿云</b>管理系统<!--</a>-->
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">简单&nbsp;&nbsp;&nbsp;高效&nbsp;&nbsp;&nbsp;安全&nbsp;&nbsp;&nbsp;可靠</p>

    <form action="" method="post" v-on:submit="submit">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email邮箱" v-model="form.email" />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="请输入登录密码" v-model="form.password" autocomplete="new-password" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row" style="margin-left: 6px;">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" v-model="form.remember"> 记住账号
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
<!--
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    -->
    <!-- /.social-auth-links -->

    <a href="#">忘记登录密码</a><br>
    <a href="register.html" class="text-center">注册新账号</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo $URL_AdminLTE;?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $URL_AdminLTE;?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo $URL_AdminLTE;?>/plugins/iCheck/icheck.min.js"></script>
<script>
  new Vue(vue);
  $(function () {
/*
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });//*/
    $('form').submit(function() {
      return false;
    });
  });
</script>
</body>
</html>
