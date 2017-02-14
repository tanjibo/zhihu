<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-pjax-version" content="<?php echo e(elixir('css/app.css')); ?>">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(elixir('/css/app.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="/css/nprogress.css">


    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode( [
            'csrfToken' => csrf_token(),
        ] ); ?>
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    <?php echo e(config('app.name', 'Laravel')); ?>

                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <?php if(Auth::guest()): ?>
                        <li><a href="<?php echo e(url('/login')); ?>">登陆</a></li>
                        <li><a href="<?php echo e(url('/register')); ?>">注册</a></li>
                    <?php else: ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="<?php echo e(url('/logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST"
                                          style="display: none;">
                                        <?php echo e(csrf_field()); ?>

                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php if(session()->has('flash_notification.message')): ?>
        <div class="alert alert-<?php echo e(session('flash_notification.level')); ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

            <?php echo session('flash_notification.message'); ?>

        </div>
    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
</div>

<!-- Scripts -->





<script src="<?php echo e(elixir('js/app.js')); ?>"></script>
<script src="/js/nprogress.js"></script>


<script type="text/javascript">

     $(document).ready(function() {

       $('#flash-overlay-modal').modal();

         $(document).pjax('a', '#app');

         $(document).on('pjax:start', function () {
             NProgress.start();
         });
         $(document).on('pjax:end', function () {
             NProgress.done();
//        self.siteBootUp();
         });
         $(document).on("pjax:timeout", function (event) {
             // 阻止超时导致链接跳转事件发生
             event.preventDefault()
         });

     });



</script>
<?php echo $__env->yieldContent('js'); ?>
</body>
</html>
