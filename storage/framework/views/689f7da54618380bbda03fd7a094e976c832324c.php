<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('vendor.ueditor.assets', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="title_wrap">
                            <p class="title"><?php echo e($question->title); ?></p>
                            <p class="topic_wrap">
                                <?php $__currentLoopData = $question->topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <span><?php echo e($v->name); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </p>
                        </div>

                    </div>

                    <div class="panel-body">
                        <div><?php echo $question->body; ?></div>
                        <?php if(Auth::check() && Auth::user()->owner($question)): ?>
                            <div class="edit"><a href="/questions/<?php echo e($question->id); ?>/edit">编辑</a></div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="title_wrap">
                            <p class="title"><?php echo e($question->answers_counts); ?>问题</p>
                        </div>

                    </div>
                    <div class="panel-body">

                        <?php $__currentLoopData = $question->answer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object answerUserAnwer" src="<?php echo e($v->user->avatar); ?>" alt="<?php echo e($v->user->name); ?>">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="javascript:void()"><?php echo e($v->user->name); ?></a></h4>
                                    <?php echo $v->body; ?>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                        <form action="/answer/<?php echo e($question->id); ?>" method="post">
                        <?php echo csrf_field(); ?>


                        <!-- 编辑器容器 -->
                            <div class="from-group <?php echo e($errors->has('body') ? ' has-error' : ''); ?>">
                                <label for="body">输入您要描述的问题</label>
                                <script id="container" name="body" type="text/plain"><?php echo old('body'); ?></script>
                                <?php if($errors->has('title')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('body')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="回答问题" class="btn btn-primary btn-block">
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '<?php echo e(csrf_token()); ?>'); // 设置 CSRF token.
        });

    </script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>