<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object indexUserAvatar" src="<?php echo e($v->user->avatar); ?>" alt="<?php echo e($v->user->name); ?>">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><a href="/questions/<?php echo e($v->id); ?>"><?php echo e($v->title); ?></a></h4>
                        
                    </div>
                </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            </div>
        </div>
    </div>

    <!-- 实例化编辑器 -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>