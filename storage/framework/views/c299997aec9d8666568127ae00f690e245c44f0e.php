


<?php $__env->startSection('content'); ?>



    <div class="card card-default">

        <div class="card-header">
            Users
        </div>

        <div class="card-body">
            
            <?php if($users->count() > 0): ?>
            <?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>



                </thead>

                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>

                        <td>
                            
                            <img width="40px" height="40px" style="border-radius: 50%" src="<?php echo e(Gravatar::get($user->email)); ?>" alt="profilePicture">
                        </td>
                        <td>
                            <?php echo e($user->name); ?>

                        </td>

                        <td>
                            <?php echo e($user->email); ?>

                        </td>

                        <?php if(!$user->isAdmin()): ?>
                        <td>


                                <form action="<?php echo e(route('users.make-admin', $user->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-success btn-sm float-right">Make Admin</button>
                                </form>
                            </td>
                            <td>
                                <form action="<?php echo e(route('users.deleteUser', $user->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-danger btn-sm float-right">Delete User</button>
                                    </form>


                        </td>
                        <?php endif; ?>
                        <td></td>
                        <td></td>

                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

            </table>
                <?php else: ?>




               <h3 class="text-center text-muted">No Users Available</h3>



            <?php endif; ?>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\cms\resources\views/users/index.blade.php ENDPATH**/ ?>