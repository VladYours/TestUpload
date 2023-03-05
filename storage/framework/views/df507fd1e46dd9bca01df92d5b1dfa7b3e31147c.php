<?php $__env->startSection('title'); ?>
Upload Users Info File
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="w-100 text-center">Upload File with Users Info</h1>
    <form method="POST" enctype="multipart/form-data" class="row g-3 text-center justify-content-center">
        <?php echo csrf_field(); ?>
        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
          <?php endif; ?>
        <div class="col-auto">
          <label for="formFile" class="form-label">File with Users</label>
          <input class="form-control" type="file" name="csv" id="formFile">
          <button class="btn btn-primary mt-3" type="submit">Upload</button>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vikamade/landos.top/testupload/resources/views/upload.blade.php ENDPATH**/ ?>