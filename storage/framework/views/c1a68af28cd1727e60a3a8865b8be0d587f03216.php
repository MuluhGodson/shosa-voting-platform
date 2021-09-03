<div>

        <?php if(Session::has('message')): ?>
            <p class="uppercase text-red-500 bg-red-200 w-auto p-4 text-center"><?php echo e(Session::get('message')); ?></p>
        <?php endif; ?>
        <?php if(Session::has('message_success')): ?>
            <p class="uppercase text-green-500 bg-green-200 w-auto p-4 text-center"><?php echo e(Session::get('message_success')); ?></p>
        <?php endif; ?>

        <div class="my-8">
            <h1 class="text-center text-xl md:text-4xl text-gray-300"> Select a contest you want to vote in</span> </h1>
        </div>
        <div class="grid sm:grid-cols-4 gap-4">
            <?php $__empty_1 = true; $__currentLoopData = $contests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1000" class="shadow-lg transition hover:px-1 duration-500 ease-in-out  col rounded hover:border-r-2 hover:boder-r-white hover:border-l-2 hover:border-l-secondary cursor-pointer hover:transform hover:scale-150">
                    <div wire:click="openView('<?php echo e($contest->slug); ?>')">
                        <img src="<?php echo e(Storage::url($contest->cover_image)); ?>" class="object-cover object-top h-60 w-full" alt="<?php echo e($contest->name); ?>">
                        <div class="my-1 flex justify-end py-1 px-1">
                            <?php if(($contest->active) && ($contest->ending_date >= today()->toDateString())): ?>
                                <small class="my-2 text-right px-2 rounded-full bg-secondary text-white">voting open</small>
                            <?php else: ?>
                                <small class="my-2 text-right px-2 rounded-full bg-red-600 text-white">voting closed</small>
                            <?php endif; ?>
                        </div>
                        <div class="p-2 my-1">
                            <h1 class="text-center text-lg text-secondary font-bold uppercase">
                                <?php echo e($contest->name); ?>

                            </h1>
                            <p class="text-gray-400 text-center"><?php echo e(Str::words($contest->description,15,'...')); ?>

                        </div>
                    </div>
                    <div>
                        <div class="flex justify-center content-end p-3">
                            <div>
                                <a href="<?php echo e(route('vote.candidate', $contest->slug)); ?>" class="rounded-full px-2 py-1 bg-transparent border border-secondary text-secondary font-semibold hover:bg-secondary hover:text-gray-400">Vote Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-gray-400">No contest are available yet.</p>
            <?php endif; ?>
        </div>

        <?php if($viewContest): ?>
        <!-- Modal to view contest -->
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.dialog-modal','data' => ['class' => 'bg-transparent','wire:model' => 'viewContest']]); ?>
<?php $component->withName('jet-dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'bg-transparent','wire:model' => 'viewContest']); ?>
             <?php $__env->slot('title', null, []); ?> 
            
             <?php $__env->endSlot(); ?>

             <?php $__env->slot('content', null, []); ?> 
                <div class="max-w-4xl flex items-center h-auto flex-wrap mx-auto my-32 lg:my-0">
                
                    <!--Main Col-->
                    <div class="w-full lg:w-3/5 rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-black bg-opacity-75 mx-6 lg:mx-0">
                        <div class="p-4 md:p-12 text-center lg:text-left">
                            <!-- Image for mobile view-->
                            <div class="block lg:hidden rounded-full shadow-xl mx-auto -mt-16 h-48 w-48 bg-cover bg-center" style="background-image: url('<?php echo e(Storage::url($event_photo)); ?>')"></div>
                            
                            <h1 class="text-xl font-bold pt-8 lg:pt-0 text-secondary text-left uppercase"><?php echo e($name); ?></h1>
                            <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-gray-500 opacity-25"></div>
                            
                            <div>
                                <p class="text-base uppercase font-bold flex items-center justify-center lg:justify-start">
                                    <?php if($tarrif): ?>
                                        <small class="my-2">VOTING: <?php echo e($vote_fee); ?> per vote</small>
                                    <?php else: ?>
                                        <small class="my-2">VOTING: FREE</small>
                                    <?php endif; ?>
                                </p>
                                <p class="text-base uppercase font-bold flex items-center justify-center lg:justify-start">
                                    <small>Duration: <?php echo e($b_date); ?> - <?php echo e($e_date); ?></small>
                                </p>
                            </div>
                            <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-gray-500 opacity-25"></div>
                            <p class="pt-8 text-sm  text-justify">
                                <?php echo e(Str::words($description, $text_words , '...')); ?>

                                <?php if(!$showText): ?>
                                    <button wire:click="openText('<?php echo e($slug); ?>','y')" class="bg-transparent text-secondary font-bold">See all</button>
                                <?php else: ?>
                                    <button wire:click="openText('<?php echo e($slug); ?>','n')" class="bg-transparent text-secondary font-bold">See less</button>
                                <?php endif; ?>
                            </p>

                            <div class="pt-12 pb-8">
                                <a href="<?php echo e(route('vote.candidate', $slug)); ?>" class="bg-secondary hover:bg-transparent hover:border hover:border-secondary hover:text-secondary text-white font-bold py-2 px-4 rounded-full">
                                Vote Now
                                </a> 
                            </div>

                        </div>

                    </div>
                    
                    <!--Img Col-->
                    <div class="w-full lg:w-2/5">
                        <!-- Big profile image for side bar (desktop) -->
                        <img src="<?php echo e(Storage::url($event_photo)); ?>" class="rounded-none lg:rounded-lg shadow-2xl hidden lg:block">
                    </div>

                    <!-- Pin to top right corner -->
                    <div class="absolute top-0 right-0 h-12 w-18 p-4">
                        <p class="pt-4 text-base font-bold flex items-center justify-center lg:justify-start">
                            <?php if(($active) && ($e_date >= today()->toDateString())): ?>
                                <small class="my-2 text-right px-2 rounded-full bg-secondary text-white">voting open</small>
                            <?php else: ?>
                                <small class="my-2 text-right px-2 rounded-full bg-red-600 text-white">voting closed</small>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
             <?php $__env->endSlot(); ?>

             <?php $__env->slot('footer', null, []); ?> 
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.secondary-button','data' => ['class' => 'bg-transparent text-gray-400','wire:click' => '$toggle(\'viewContest\')','wire:loading.attr' => 'disabled']]); ?>
<?php $component->withName('jet-secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'bg-transparent text-gray-400','wire:click' => '$toggle(\'viewContest\')','wire:loading.attr' => 'disabled']); ?>
                    Close
                 <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

                 <a href="<?php echo e(route('vote.candidate', $slug)); ?>" class="rounded-md px-2 py-1 mx-1 bg-transparent border border-secondary text-secondary font-semibold hover:bg-secondary hover:text-gray-400">Vote Now</a>

             <?php $__env->endSlot(); ?>
         <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        <?php endif; ?>
</div>
<?php /**PATH /var/www/shosa/resources/views/livewire/vote-component.blade.php ENDPATH**/ ?>