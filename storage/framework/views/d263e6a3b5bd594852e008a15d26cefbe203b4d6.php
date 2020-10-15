


<?php $__env->startSection('content'); ?>

    

    <div class="card card-default">
        <div class="card-header">
            tags
            <a href="<?php echo e(route('tags.create')); ?>" class="btn btn-success float-right">Add</a>
        </div>

        <div class="card-body">
            <?php if($tags->count() > 0): ?>

            <table class="table">

                <thead>
                    <th>Name</th>
                    <th>Posts Count</th>
                    <th></th>
                </thead>

                <tbody>
                    
                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div id="getName" data-tagName="<?php echo e($tag->name); ?>"> <?php echo e($tag->name); ?> </div>
                        </td>

                        <td>
                            <?php echo e($tag->posts->count()); ?>

                        </td>

                        <td>
                            <a href="<?php echo e(route('tags.edit', $tag->id)); ?>" class="btn btn-info btn-sm  float-right mx-2 text-light">Edit</a>

                           
                                <button class="btn btn-danger btn-sm float-right" onclick="handleDelete(<?php echo e($tag->id); ?>)">Delete</button>
                             

                        </td>
                        
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              
            </table>

                <form action="" method="POST" id="deletetagForm">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Delete tag</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-center font-weight-bold">Are You Sure you want to delete this tag :  <span id="showName"></span>?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>

                </form>
                <?php else: ?>
                <h3 class="text-center text-muted">No tags Available.</h3>
                <?php endif; ?>
        </div>

    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script>

    function handleDelete(id){

        var form = document.getElementById('deletetagForm')
        var elmnt = document.getElementById("getName");
        var attr = elmnt.getAttributeNode("data-tagName").value;
        document.getElementById("showName").innerHTML = attr;
        form.action = '/tags/' + id
        $('#deleteModal').modal('show')
    }

</script>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\cms\resources\views/tags/index.blade.php ENDPATH**/ ?>