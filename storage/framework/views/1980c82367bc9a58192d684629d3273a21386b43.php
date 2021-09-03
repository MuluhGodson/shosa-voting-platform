<div>
     <div>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['wire:click' => 'openCreate']]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wire:click' => 'openCreate']); ?>
            <?php echo e(__('Withdraw')); ?>

         <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
    </div>

    
        <div  class="my-5">
            <div class="grid md:grid-cols-3 grid-cols-1  gap-4">
                <?php $__empty_1 = true; $__currentLoopData = $balance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1000" class="shadow-lg rounded border-t-2 border-t-secondary border-b-2 border-b-secondary">
                            <div class="my-1 flex justify-around py-1 px-1">
                                <?php if($b['provider'] == 'ORANGE'): ?>
                                    <div class="rounded-full"> 
                                        <img src="<?php echo e(asset('images/orange.png')); ?>" width="50px">
                                    </div>
                                <?php elseif($b['provider'] == 'MTN'): ?>
                                    <div class="rounded-full">
                                        <img src="<?php echo e(asset('images/mtn.jpg')); ?>" width="50px" height="50px">
                                    </div>
                                <?php else: ?>
                                    <img src="" width="50px">
                                <?php endif; ?>
                                <div>
                                    <small class="my-2 px-2 text-right rounded bg-secondary text-white uppercase"><?php echo e($b['provider']); ?></small>
                                </div>
                            </div>
                            <div class="p-2 my-1">
                                <h1 class="text-center text-lg text-secondary font-bold uppercase">
                                    <?php echo e($b['value']); ?> <?php echo e($b['currency']); ?>

                                </h1>
                                <p class="text-gray-400 text-center"><?php echo e($b['service_name']); ?></p>
                            </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-gray-400">No Finance data available yet.</p>
                <?php endif; ?>
                <div data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1000" class="shadow-lg rounded border-t-2 border-t-secondary border-b-2 border-b-secondary">
                    <div class="my-1 flex justify-between py-1 px-1">
                        <div class="rounded-full">
                            <img src="<?php echo e(asset('images/paypal.jpg')); ?>" width="100px">
                        </div>
                        <div>
                            <small class="my-2 text-right px-2 rounded bg-secondary text-white uppercase">FlutterWave</small>
                        </div>
                    </div>
                    <div class="p-2 my-1">
                        <h1 class="text-center text-lg text-secondary font-bold uppercase">
                                NAN
                        </h1>
                        <p class="text-gray-400 text-center">Visa/Mastercard/International</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
        <section class="container mx-auto p-6 font-mono">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-400 uppercase border-b border-secondary">
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3">Service</th>
                    <th class="px-4 py-3">Amount</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Fees</th>
                </tr>
                </thead>
                <tbody class="">
                
                <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="text-gray-400">
                        <td class="px-4 py-3 border">
                            <p class="font-semibold"><?php echo e($transaction['type']); ?></p>
                        </td>
                        <td class="px-4 py-3 border text-md font-semibold">
                            <p class="font-semibold"><?php echo e($transaction['service']); ?></p>
                        </td>
                        <td class="px-4 py-3 border text-md font-semibold">
                            <p class="font-semibold"><?php echo e($transaction['amount']); ?></p>
                        </td>
                        <td class="px-4 py-3 border text-md font-semibold">
                            <p class="font-semibold"><?php echo e($transaction['status']); ?></p>
                        </td>
                        <td class="px-4 py-3 border text-md font-semibold">
                            <p class="font-semibold"><?php echo e($transaction['fees']); ?></p>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    No Financial Data available as of now
                <?php endif; ?>

                </tbody>
            </table>
            
            </div>
        </div>
        </section>
    </div>
</div>
<?php /**PATH /var/www/shosa/resources/views/livewire/finance-component.blade.php ENDPATH**/ ?>