<div>
	<div class="">
		<div class="my-2 mx-2">
			<small class="font-semibold text-gray-500" for="country"><?php echo e(__('Country')); ?></small>
			<select class="rblock mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm" wire:model="country" name="" id="">
				<option><?php echo e(__('Select a county')); ?></option>
				<?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($c->id); ?>"><?php echo e($c->name); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
		
		<?php if($regions): ?>
			<div class="my-2 mx-2">
				<?php if(count($regions) > 0): ?>
				<small class="font-semibold text-gray-500" for="region"><?php echo e(__('Region')); ?></small>
				<select class="rblock mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm" wire:model="region" name="" id="">
					<option><?php echo e(__('Select a region')); ?></option>
					<?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($r->id); ?>"><?php echo e($r->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		
		<?php if($divisions): ?>
			<div class="my-2 mx-2">
				<?php if(count($divisions) > 0): ?>
				<small class="font-semibold text-gray-500" for="division"><?php echo e(__('Division')); ?></small>
				<select class="rblock mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm" wire:model="division" name="" id="">
					<option><?php echo e(__('Select a division')); ?></option>
					<?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($dv->id); ?>"><?php echo e($dv->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		
	</div>
</div><?php /**PATH /var/www/shosa/resources/views/livewire/utils/location.blade.php ENDPATH**/ ?>