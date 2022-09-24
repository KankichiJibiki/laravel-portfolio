

<?php $__env->startSection('title', 'Slot'); ?>

<?php $__env->startSection('content'); ?>
    <div class="main_container container mx-auto">
        <div class="col-lg-12 col-11 d-flex flex-wrap justify-content-around align-items-start border">
            
            <div class="left_top_container col-lg-4 col-12 p-3 mb-3 border-success">
                <h4 class="text-center mb-3">Slot History</h4>
                <div class="cache_container">
                    <?php if(cache()->has('oldest')): ?>
                        <a href="<?php echo e(route('showCache', 'oldest')); ?>" class="container card p-2">
                            <div><?php echo e(cache()->get('oldest')['time']->diffForHumans()); ?></div>
                            <?php $__currentLoopData = cache()->get('oldest')['wordSet']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wordHistory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="text-muted text-center p-1"><?php echo e($wordHistory->word); ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </a>
                    <?php endif; ?>
                    <?php if(cache()->has('second')): ?>
                        <a href="<?php echo e(route('showCache', 'second')); ?>" class="container card p-2">
                            <div><?php echo e(cache()->get('second')['time']->diffForHumans()); ?></div>
                            <?php $__currentLoopData = cache()->get('second')['wordSet']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wordHistory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="text-muted text-center p-1"><?php echo e($wordHistory->word); ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </a>
                    <?php endif; ?>
                    <?php if(cache()->has('latest')): ?>
                        <a href="<?php echo e(route('showCache', 'latest')); ?>" class="container card p-2">
                            <div><?php echo e(cache()->get('latest')['time']->diffForHumans()); ?></div>
                            <?php $__currentLoopData = cache()->get('latest')['wordSet']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wordHistory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="text-muted text-center p-1"><?php echo e($wordHistory->word); ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </a>
                    <?php endif; ?>
                    <?php if(!cache('oldest')): ?>
                        <div class="text-muted text-center my-5 fs-3">No History</div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="right_down_container col-lg-7 col-12 p-3 mb-3" style="background-color: #7d4e23;">
                
                <div class="col-12 d-flex justify-content-center">
                    <a href="<?php echo e(route('displaySlotResult')); ?>" class="btn btn-success btn-lg">Slot Now!</a>
                </div>

                
                <div class="card_container my-2 d-flex flex-wrap justify-content-center align-items-around">
                    <?php $__currentLoopData = $wordSet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $word): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card_child card col-12 col-lg-4 p-3 text-light border border-light border-2 mb-1" style="background-color: #084d10;">
                            <div class="mb-3 fs-4"><span class="text-warning">Word: </span><br><?php echo e($word->word); ?></div>
                            <div class="mb-3 fs-4 d-wrap"><span class="text-warning">Definition: </span><br><?php echo e($word->definition); ?></div>
                            <div class="mb-3 fs-4"><span class="text-warning">Type: </span><br><?php echo e($word->type->name); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\kan04\OneDrive\デスクトップ\laravel_portfolio\laravel-portfolio\resources\views/words/slot.blade.php ENDPATH**/ ?>