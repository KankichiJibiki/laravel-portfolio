

<?php $__env->startSection('title', 'History'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mx-auto">
        
        <div class="w-100 card p-3" style="background-color: #7d4e23;">
            <div class="justify-content-between align-items-start d-flex">
                <a href="<?php echo e(route('index')); ?>" class="btn btn-outline-light col-2">Back</a>
                <div class="my-3 text-light fs-5"><?php echo e(cache()->get($cache)['time']->diffForHumans()); ?></div>
            </div>
            
            <div class="card_container my-2 d-flex flex-wrap justify-content-center align-items-around">
                <?php $__currentLoopData = cache()->get($cache)['wordSet']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $word): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card_child card col-12 col-lg-4 p-3 text-light border border-light border-2 mb-1" style="background-color: #084d10;">
                        <div class="mb-3 fs-4"><span class="text-warning">Word: </span><br><?php echo e($word->word); ?></div>
                        <div class="mb-3 fs-4 d-wrap"><span class="text-warning">Definition: </span><br><?php echo e($word->definition); ?></div>
                        <div class="mb-3 fs-4"><span class="text-warning">Type: </span><br><?php echo e($word->type->name); ?></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\kan04\OneDrive\デスクトップ\laravel_portfolio\laravel-portfolio\resources\views/words/showHistory.blade.php ENDPATH**/ ?>