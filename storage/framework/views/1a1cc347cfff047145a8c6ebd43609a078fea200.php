

<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('jsName', 'main.js'); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success_update')): ?>
        <div class="alert alert-success"><?php echo e(session('success_update')); ?></div>
    <?php elseif(session('success_create')): ?>
        <div class="alert alert-success"><?php echo e(session('success_create')); ?></div>
    <?php endif; ?>
    <div class="main_container container">
        <div class="col-lg-12 col-11 d-flex flex-wrap justify-content-around align-items-start">
            
            <div class="left_top_container col-lg-4 col-12 p-3 mb-3 border-success">
                <h4 class="text-center">Slot History</h4>
                <p class="mb-3"><span class="text-danger">Note: </span>Store histories up to 3 content and 1 day</p>
                <div class="cache_container">

                    <?php if(Cache::has('oldest')): ?>
                        <a href="<?php echo e(route('showCache', 'oldest')); ?>" class="cache_anchor container card mb-3">
                        <div class="mb-2"><?php echo e(cache()->get('oldest')['time']->diffForHumans()); ?></div>
                        <?php $__currentLoopData = Cache::get('oldest')['wordSet']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wordhistory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="text-muted text-center p-1"><?php echo e($wordhistory->word); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </a>
                    <?php endif; ?>
                    <?php if(cache()->has('second')): ?>
                        <a href="<?php echo e(route('showCache', 'second')); ?>" class="cache_anchor container card mb-3">
                        <div class="mb-2"><?php echo e(cache()->get('second')['time']->diffForHumans()); ?></div>
                        <?php $__currentLoopData = Cache::get('second')['wordSet']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wordhistory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="text-muted text-center p-1"><?php echo e($wordhistory->word); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </a>
                    <?php endif; ?>
                    <?php if(cache()->has('latest')): ?>
                        <a href="<?php echo e(route('showCache', 'latest')); ?>" class="cache_anchor container card mb-3">
                        <div class="mb-2"><?php echo e(cache()->get('latest')['time']->diffForHumans()); ?></div>
                        <?php $__currentLoopData = Cache::get('latest')['wordSet']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wordhistory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="text-muted text-center p-1"><?php echo e($wordhistory->word); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </a>
                    <?php endif; ?>
                    <?php if(!cache()->has('oldest')): ?>
                        <div class="text-muted text-center my-5 fs-3">No History</div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="right_down_container col-lg-7 col-12 p-3 mb-3" style="background-color: #7d4e23;">
                <div class="header_slot d-flex flex-wrap justify-content-center">
                    <div class="col-12 d-flex justify-content-center">
                        <a href="<?php echo e(route('displaySlotResult')); ?>" class="btn btn-lg btn-success text-light border border-light border-3 col-4">
                            <span class="toolTip" data-descr="You slot 5 numbers and it applies to words id displaying">Slot</span>
                        </a>

                        <span class='tooltip' data-descr="each of a pair of flashing lights on a vehicle, warning that it is stationary or unexpectedly slowing down or reversing.">
                    </div>
                </div>
                <?php if($words->isEmpty()): ?>
                
                    <div class="text-center mt-3">
                        <div class="text-light fs-5">You haven't registered any words yet!</div>

                        
                        <!-- Button trigger modal -->
                        <button type="button" class="" data-bs-toggle="modal" data-bs-target="#createword">
                            Register Words
                        </button>


                        
                    </div>
                <?php else: ?>
                    <div class="card_container mt-3 d-flex flex-wrap justify-content-center align-items-around">
                        <?php $__currentLoopData = $words; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $word): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                            <div class="card_child card col-12 col-lg-4 p-3 text-light border border-light border-2 mb-1" style="background-color: #084d10;">
                                <div class="row mt-3 justify-content-center">
                                    <div class="col-md-5 col-6">
                                        <a href="/words/<?php echo e($word->uuid); ?>/edit" class="btn btn-warning btn-sm d-grid">Edit</a>
                                    </div>
                                    <div class="col-md-5 col-6">
                                        <form action="/words/<?php echo e($word->uuid); ?>" method="post" class="d-grid">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('delete'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" onsubmit="return confirm_delete()">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="fs-5 mb-3">Word: <span class="fw-bold fs-4"><?php echo e($word->word); ?></span></div>
                                <div class="fs-5 mb-3">Definition: <span class="fw-bold fs-4"><?php echo e($word->definition); ?></span></div>
                                <div class="fs-5 mb-3">Type: <span class="fw-bold fs-4">
                                    <?php echo e($word->type->name); ?>    
                                </span></div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="d-flex flex-wrap aligh-items-center justify-content-center">
                        <div class="">
                            <?php echo e($words->links()); ?>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\kan04\OneDrive\デスクトップ\laravel_portfolio\laravel-portfolio\resources\views/words/index.blade.php ENDPATH**/ ?>