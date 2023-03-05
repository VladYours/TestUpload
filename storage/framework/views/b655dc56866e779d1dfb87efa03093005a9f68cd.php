<?php $__env->startSection('title'); ?>
Users Info
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form class="row text-center" method="POST">
        <?php echo csrf_field(); ?>
        <div class="col">
            <a href="/upload" class="btn btn-secondary">TO UPLOAD</a>
            <button class="btn btn-primary mr-3" id="filter">FILTER</button>
            <button class="btn btn-success" id="export">EXPORT</button>
            <input type="hidden" value="0" name="export" id="checkExp"/>
        </div>
        
    <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
          <?php endif; ?>
    
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">
              Category
              <select class="form-select"cat name="cat" aria-label="Category select">
                  <option value="all">All</option>
                  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->category); ?>"><?php echo e($category->category); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
          </th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">
              Gender
              <select class="form-select" name="gender" aria-label="Gender select">
                  <option value="all">All</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
          </th>
          <th scope="col">
              Birth Date
              <div class="input-group">
                  <input type="date" class="form-control" id="bd" name="bd" placeholder="Date of Birth"><br/>
                  <span class="input-group-text">or</span>
                  <input type="number" class="form-control" id="age" name="age" placeholder="Age"><br/>
              </div>
              or <br/>
              <div class="input-group">
                  <span class="input-group-text">From</span> <input type="number" class="form-control" id="from" name="from" placeholder="From Age"> 
                  <span class="input-group-text">To</span> <input type="number" class="form-control" id="to" name="to" placeholder="To Age">
                </div>
          </th>
        </tr>
      </thead>
      <tbody>
          <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <th scope="row"><?php echo e($user->id); ?></th>
              <td>
                  <?php echo e($user->category); ?>

              </td>
              <td>
                  <?php echo e($user->fname); ?>

              </td>
              <td>
                  <?php echo e($user->lname); ?>

              </td>
              <td>
                  <?php echo e($user->email); ?>

              </td>
              <td>
                  <?php echo e($user->gender); ?>

              </td>
              <td>
                  <?php echo e($user->birthdate); ?>

              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
    
    <?php echo e($users->links()); ?>

    
    
    
    </form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    let form = document.querySelector('form');
    let filterb = document.querySelector('#filter');
    let exportb = document.querySelector('#export');
    let exportc = document.querySelector('#checkExp');
    exportb.onclick = function () {
        exportc.value = '1';
        form.submit();
    }
    filterb.onclick = function () {
        exportc.value = '0';
        form.submit();
    }
    
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vikamade/landos.top/testupload/resources/views/review.blade.php ENDPATH**/ ?>