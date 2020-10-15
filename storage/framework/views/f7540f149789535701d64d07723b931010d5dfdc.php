


<?php $__env->startSection('content'); ?>

    

    <div class="card card-default">
       
        <div class="card-header">
            Post
            
            <a href="<?php echo e(route('posts.create')); ?>" class="btn btn-success float-right <?php echo e(Request::is('trashed-posts') ? 'd-none' : ''); ?>">Add</a>
           
        </div>
       
        <div class="card-body">
            <?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php if($posts->count() > 0): ?>


            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th></th>
                    <th></th>
                </thead>

                <tbody>
               
                    <?php $__currentLoopData = $user->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>

                        <td>
                            <img src="<?php echo e(asset($post->image)); ?>" alt="<?php echo e($post->image); ?>" width="120px" height="60px">

                        </td>
                        <td>
                            <?php echo e($post->title); ?>

                        </td>

                        <td>
                            <a href="<?php echo e(route('categories.edit',$post->category->id)); ?>">
                                <?php echo e($post->category->name); ?>

                            </a>
                        </td>

                        <?php if($post->trashed()): ?>

                        <td>
                            <form action="<?php echo e(route('restore-posts.index', $post->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                               <button class="btn btn-success btn-sm float-right">Restore</button>

                            </form>
                        </td>

                        <?php else: ?>


                        <td>

                            <a href="<?php echo e(route('posts.edit',$post->id)); ?>" class="btn btn-info btn-sm float-right text-light">Edit</a>

                        </td>

                        <?php endif; ?>
                        <td>
                            <form action="<?php echo e(route('posts.destroy', $post->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-danger btn-sm float-right">

                                    <?php echo e($post->trashed() ? 'Delete' : 'Trash'); ?>


                                </button>
                            </form>
                        </td>




                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

            </table>
                <?php else: ?>



               <?php if(Route::current()->getName() == 'trashed-posts.index'): ?>
               <h3 class="text-center text-muted">No Files Deleted</h3>
               <?php else: ?>
               <h3 class="text-center text-muted">No Post Available</h3>
               <?php endif; ?>


            <?php endif; ?>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\cms\resources\views/posts/index.blade.php ENDPATH**/ ?>