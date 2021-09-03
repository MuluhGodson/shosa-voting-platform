<div>

    <div class="flex flex-col sm:justify-center items-center bg-black">
        <div>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.authentication-card-logo','data' => []]); ?>
<?php $component->withName('jet-authentication-card-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        </div>
    </div>

    <?php if(Session::has('message')): ?>
        <p class="uppercase text-red-500 bg-red-200 w-auto p-4 text-center"><?php echo e(Session::get('message')); ?></p>
    <?php endif; ?>
    <?php if(Session::has('message_success')): ?>
        <p class="uppercase text-green-600 font-bold bg-green-100 w-auto p-4 text-center"><?php echo e(Session::get('message_success')); ?></p>
    <?php endif; ?>

    <div class="my-8">
        <h1 class="text-center text-xl md:text-4xl text-gray-300"> Vote your favorite contestant for <span class="text-secondary uppercase font-bold"><?php echo e($contest->name); ?></span> </h1>
    </div>
    <div class="my-4">
        <div class="grid sm:grid-cols-4 gap-4">
            <?php $__empty_1 = true; $__currentLoopData = $contest->candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1000" class="shadow-lg rounded transition hover:px-1 duration-500 ease-in-out  col hover:border-r-2 hover:boder-r-white hover:border-l-2 hover:border-l-secondary cursor-pointer hover:transform hover:scale-150">
                    <div wire:click="openCandidate('<?php echo e($cand->slug); ?>')">
                        <img src="<?php echo e(Storage::url($cand->photo)); ?>" class="object-cover object-top h-60 w-full rounded-md" alt="<?php echo e($cand->name); ?>">
                        <div class="my-1 flex justify-center gap-4 py-1 px-1">
                            <p class="text-sm text-gray-400"><i class="fas fa-birthday-cake"></i> <?php echo e($cand->dob); ?></p>
                            <p class="text-sm text-gray-400"><i class="fas fa-city"></i> <?php echo e($cand->town); ?></p>
                        </div>
                        <div class="p-2 my-1">
                            <h1 class="text-center text-lg text-secondary font-bold uppercase">
                                <span class="font-bold text-gray-200">#<?php echo e($cand->pivot->candidate_number); ?></span>
                                <?php echo e($cand->name); ?>

                            </h1>
                            <p class="text-gray-400 text-center"><?php echo e(Str::words($cand->bio,15,'...')); ?>

                        </div>
                         <!-- Pin to right corner -->
                        <div class="absolute top-0 right-0 h-10 w-18 p-1 bg-secondary text-white">
                            <p class="p-1 font-bold flex items-center justify-center lg:justify-start uppercase text-xl">
                                <?php
                                    $vote_number = $cand->votes()->sum('vote_count');
                                ?>
                                <span class="font-bold"><?php echo e($vote_number); ?> <?php if($vote_number > 1 || $vote_number == 0): ?>Votes <?php else: ?> Vote <?php endif; ?></span>
                            </p>
                        </div>
                    </div>
                    <div>
                         <div class="flex justify-center content-end p-3">
                            <div>
                                <button class="rounded px-2 py-2 bg-transparent border border-secondary text-secondary font-semibold hover:bg-secondary hover:text-gray-400" wire:click="openVote('<?php echo e($cand->slug); ?>')">Vote</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-gray-400">No contestants applied yet.</p>
            <?php endif; ?>
        </div>
    </div>


     <?php if($viewCandidate): ?>
        <!-- Modal to view candidate -->
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.dialog-modal','data' => ['class' => 'bg-transparent','wire:model' => 'viewCandidate']]); ?>
<?php $component->withName('jet-dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'bg-transparent','wire:model' => 'viewCandidate']); ?>
                 <?php $__env->slot('title', null, []); ?> 
                    
                 <?php $__env->endSlot(); ?>

                 <?php $__env->slot('content', null, []); ?> 

                    <div class="max-w-4xl flex items-center h-auto flex-wrap mx-auto my-32 lg:my-0">
                        
                        <!--Main Col-->
                        <div class="w-full lg:w-3/5 rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-black bg-opacity-75 mx-6 lg:mx-0">
                        

                            <div class="p-4 md:p-12 text-center lg:text-left">
                                <!-- Image for mobile view-->
                                <div class="block lg:hidden rounded-full shadow-xl object-top mx-auto -mt-16 h-48 w-48 bg-cover bg-center" style="background-image: url('<?php echo e(Storage::url($candidate->photo)); ?>')"></div>
                                
                                <h1 class="text-xl font-bold pt-8 lg:pt-0 text-secondary text-left uppercase"><?php echo e($candidate->name); ?> - <?php echo e($candidate->town); ?></h1>
                                <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-gray-500 opacity-25"></div>
                                
                                <div class="text-md text-left">
                                    <p>
                                        Date of Birth: <?php echo e($candidate->dob); ?>

                                    </p>
                                    <p>
                                        Division of Origin: <?php echo e($candidate->division->name); ?>

                                    </p>
                                    <p>
                                        Height: <?php echo e($candidate->height); ?>

                                    </p>
                                    <p>
                                        Profession: <?php echo e($candidate->profession); ?>

                                    </p>
                                   
                                </div>
                                <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-gray-500 opacity-25"></div>
                                <p class="pt-8 text-sm">
                                    <?php echo e(Str::words($candidate->bio, $text_words , '...')); ?>

                                    <?php if(!$showText): ?>
                                        <button wire:click="openText('<?php echo e($candidate->slug); ?>','y')" class="bg-transparent text-secondary font-bold">See all</button>
                                    <?php else: ?>
                                        <button wire:click="openText('<?php echo e($candidate->slug); ?>','n')" class="bg-transparent text-secondary font-bold">See less</button>
                                    <?php endif; ?>
                                </p>

                                <div class="pt-12 pb-8">
                                    <button wire:click="openVote('<?php echo e($candidate->slug); ?>')" class="bg-secondary hover:bg-transparent hover:border hover:border-secondary hover:text-secondary text-white font-bold py-2 px-4 rounded-full">
                                    Vote Now
                                    </button> 
                                </div>

                                
                                
                                <!-- Use https://simpleicons.org/ to find the svg for your preferred product --> 

                            </div>

                        </div>
                        
                        <!--Img Col-->
                        <div class="w-full lg:w-2/5">
                            <!-- Big profile image for side bar (desktop) -->
                            <img src="<?php echo e(Storage::url($candidate->photo)); ?>" class="rounded-none lg:rounded-lg shadow-2xl hidden lg:block">
                        </div>

                        <!-- Pin to top right corner -->
                        <div class="absolute top-0 right-0 h-12 w-18 p-4">
                            <p class="pt-4 font-bold flex items-center justify-center lg:justify-start uppercase text-3xl">
                               #<span class="text-secondary"> </span>
                            </p>
                        </div>

                        <!-- Pin to left corner -->
                        <?php if($candidate->fb_link || $candidate->ig_link || $candidate->twitter_link): ?>
                        <div class="absolute top-0 left-0 h-10 w-18 p-1 text-white">
                            <div class="flex justify-center gap-1 text-sm p-2">
                                <?php if($candidate->fb_link): ?>
                                    <div><a target="_blank" href="<?php echo e($candidate->fb_link); ?>"><i class="fab fa-facebook p-1 border rounded text-gray-200"></i></a></div>
                                <?php endif; ?>
                                <?php if($candidate->ig_link): ?>
                                    <div><a target="_blank" href="<?php echo e($candidate->ig_link); ?>"><i class="fab fa-instagram p-1 border rounded text-gray-200"></i></a></div>
                                <?php endif; ?>
                                <?php if($candidate->twitter_link): ?>
                                    <div><a target="_blank" href="<?php echo e($candidate->twitter_link); ?>"><i class="fab fa-twitter p-1 border rounded text-gray-200"></i></a></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        

                    </div>
                 <?php $__env->endSlot(); ?>

                     <?php $__env->slot('footer', null, []); ?> 
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.secondary-button','data' => ['class' => 'bg-transparent text-gray-400','wire:click' => '$toggle(\'viewCandidate\')','wire:loading.attr' => 'disabled']]); ?>
<?php $component->withName('jet-secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'bg-transparent text-gray-400','wire:click' => '$toggle(\'viewCandidate\')','wire:loading.attr' => 'disabled']); ?>
                            Close
                         <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['class' => 'ml-2 bg-transparent border border-secondary','wire:click' => 'openVote(\''.e($candidate->slug).'\')','wire:loading.class' => 'bg-transparent']]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'ml-2 bg-transparent border border-secondary','wire:click' => 'openVote(\''.e($candidate->slug).'\')','wire:loading.class' => 'bg-transparent']); ?>
                            Vote
                            <div wire:loading wire:target="openEdit">
                                <img width="20px" src="<?php echo e(asset("images/logo/loading.png")); ?>" class="animate-spin">
                            </div>
                         <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                 <?php $__env->endSlot(); ?>
             <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        <?php endif; ?>



            <!-- Payment -->
        <?php if($vote_payment): ?>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.dialog-modal','data' => ['wire:model' => 'vote_payment']]); ?>
<?php $component->withName('jet-dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wire:model' => 'vote_payment']); ?>
                 <?php $__env->slot('title', null, []); ?> 
                    Voting Fee <span class="text-secondary"><?php echo e($currency_symbol); ?> for <?php echo e($vote_count); ?> vote(s)</span>
                 <?php $__env->endSlot(); ?>

                 <?php $__env->slot('content', null, []); ?> 
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.validation-errors','data' => ['class' => 'mb-4']]); ?>
<?php $component->withName('jet-validation-errors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'mb-4']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                    <div class="p-4">
                    <?php if(!$payStatus): ?>
                        <h1 class="font-bold text-xl text-center">Payment Method</h1>
                    <?php endif; ?>
                        <div class="p-3 my-2">

                            <div class="grid md:grid-cols-2 grid-cols-1 justify-between space-x-4 content-center <?php echo e($isLocal || $isIntl ? 'hidden' : 'block'); ?>">
                                <div class="justify-self-center p-2">
                                    <button wire:click="getPaymentType('1')" class="font-bold">
                                        <p class="text-center text-sm">In Cameroon?</p>
                                        <img width="190px" src="<?php echo e(asset('images/local.jpeg')); ?>" class="rounded object-cover" alt="">
                                    </button>
                                </div>

                                <div class="justify-self-center p-2">
                                    <button wire:click="getPaymentType('2')" class="font-bold">
                                        <p class="text-center text-sm">Not in Cameroon?</p>
                                        <img width="2000px" src="<?php echo e(asset('images/paypal.jpg')); ?>" class="rounded object-cover" alt="">
                                    </button>
                                </div>              
                            </div>

                            <?php if($isLocal && !$payStatus): ?>
                                <div class="mt-2">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'name','value' => ''.e(__('Amount')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'name','value' => ''.e(__('Amount')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'vote_amount','class' => 'cam-amount block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'vote_amount','type' => 'text','name' => 'vote_amount','value' => old('vote_amount'),'required' => true]]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'vote_amount','class' => 'cam-amount block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'vote_amount','type' => 'text','name' => 'vote_amount','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('vote_amount')),'required' => true]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                </div>
                                <div class="mt-4">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'momo-tel','value' => ''.e(__('Momo Number')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'momo-tel','value' => ''.e(__('Momo Number')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                    <small class="text-gray-500">Both Orange and MTN are accepted </small>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['wire:loading.attr' => 'disabled','wire:loading.class' => 'bg-gray-600 disabled','wire:target' => 'initiatePay()','id' => 'momo-tel','class' => 'cam-tel block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'momo_tel','type' => 'text','name' => 'momo-tel','value' => old('momo-tel'),'required' => true]]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wire:loading.attr' => 'disabled','wire:loading.class' => 'bg-gray-600 disabled','wire:target' => 'initiatePay()','id' => 'momo-tel','class' => 'cam-tel block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'momo_tel','type' => 'text','name' => 'momo-tel','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('momo-tel')),'required' => true]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                </div>
                            <?php endif; ?>

                
                        </div>
                    </div> 

                    <?php if($isLocal): ?>
                        <div wire:loading wire:target="initiatePay" class="w-full">
                            <div class="grid grid-cols-1 justify-items-center  justify-center">
                                <div>
                                <p class="text-gray-400 text-center"> Check your phone to authorize the payment. Do not use the back button. </p>
                                </div>
                                <div>
                                    <img src="<?php echo e(asset("images/logo/loading.png")); ?>" class="animate-spin">
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($isIntl): ?>
                            <div class="grid md:grid-cols-2 grid-cols-1 gap-3 justify-between">
                                <div class="mt-2">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'name','value' => ''.e(__('Amount')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'name','value' => ''.e(__('Amount')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'vote_amount','class' => 'cam-amount block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'vote_amount','type' => 'text','name' => 'vote_amount','value' => old('vote_amount'),'required' => true]]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'vote_amount','class' => 'cam-amount block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'vote_amount','type' => 'text','name' => 'vote_amount','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('vote_amount')),'required' => true]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                </div>
                                <div class="mt-2">
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'currency','value' => ''.e(__('Choose your preffered currency')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'currency','value' => ''.e(__('Choose your preffered currency')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                    <select wire:model="currency" class="block mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm">
                                        <option>Select a Currency</option>
                                        <?php $__empty_1 = true; $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <option value="<?php echo e($cur->code); ?>"><?php echo e($cur->name); ?> - (<?php echo e($cur->symbol); ?>)</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            No Currencies available yet
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-2">
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'name','value' => ''.e(__('Name')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'name','value' => ''.e(__('Name')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'name','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'name','type' => 'text','name' => 'name','value' => old('name'),'required' => true]]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'name','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'name','type' => 'text','name' => 'name','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('name')),'required' => true]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                            </div>
                            <div class="mt-2">
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'name','value' => ''.e(__('Email')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'name','value' => ''.e(__('Email')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'email','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'email','type' => 'text','name' => 'email','value' => old('email'),'required' => true]]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'email','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'email','type' => 'text','name' => 'email','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('email')),'required' => true]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                            </div>
                        <div wire:loading wire:target="initiatePay" class="w-full">
                            <div class="grid grid-cols-1 justify-items-center  justify-center">
                                <div>
                                <p class="text-gray-400 text-center"> Do not close this window. You will be redirected to a payment service for Visa/Mastercard payments </p>
                                </div>
                                <div>
                                    <img src="<?php echo e(asset("images/logo/loading.png")); ?>" class="animate-spin">
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>


                    <?php if($payStatus): ?>
                        <h1 class="text-center text-secondary uppercase text-3xl"> Payment succesful. Added <?php echo e($vote_count); ?> vote(s). </h1>
                        <p class="text-center"><i class="fas fa-check-circle animate-spin text-4xl text-green-600"></i></p>
                        <p class="text-center">Wait a moment...</p>
                    <?php endif; ?>
                        
                    
                 <?php $__env->endSlot(); ?>

                 <?php $__env->slot('footer', null, []); ?> 
                    <?php if(($isLocal || $isIntl) && !$payStatus): ?>
                       <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['class' => 'ml-2','wire:click' => 'initiatePay()','wire:loading.class' => 'bg-transparent']]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'ml-2','wire:click' => 'initiatePay()','wire:loading.class' => 'bg-transparent']); ?>
                            Pay <?php echo e($currency_symbol); ?>

                            <div wire:loading wire:target="initiatePay">
                                <img width="20px" src="<?php echo e(asset("images/logo/loading.png")); ?>" class="animate-spin">
                            </div>
                         <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                    <?php endif; ?>

                    <?php if($isLocal): ?>
                    <div class="my-4 p-2 flex justify-start">
                        <button wire:click="getPaymentType('2')" class="font-bold">
                        <p class="text-center text-sm text-gray-400">Not in Cameroon? Pay with</p>
                        <img width="190px" src="<?php echo e(asset('images/paypal.jpg')); ?>" class="rounded" alt="">
                        </button>
                    </div>
                    <?php endif; ?>
                    <?php if($isIntl): ?>
                    <div class="my-4 p-2 flex justify-start">
                        <button wire:click="getPaymentType('1')" class="font-bold">
                            <p class="text-center text-sm text-gray-400">In Cameroon? Pay with</p>
                            <img width="190px" src="<?php echo e(asset('images/local.jpeg')); ?>" class="rounded object-cover" alt="">
                        </button>
                    </div>
                    <?php endif; ?>
                 <?php $__env->endSlot(); ?>
             <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        <?php endif; ?>


        <?php if($free_vote): ?>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.dialog-modal','data' => ['wire:model' => 'free_vote']]); ?>
<?php $component->withName('jet-dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wire:model' => 'free_vote']); ?>
                 <?php $__env->slot('title', null, []); ?> 
                    <?php if(!$voted_already && !$vote_succesful): ?>
                        Confirm Vote
                    <?php endif; ?>
                 <?php $__env->endSlot(); ?>

                 <?php $__env->slot('content', null, []); ?> 

                    <?php if(!$voted_already && !$vote_succesful): ?>
                        Vote for <span class="text-secondary uppercase font-semibold"><?php echo e($candidate->name); ?> </span> ?
                    <?php endif; ?>

                    <?php if($voted_already): ?>
                        <h1 class="text-center text-secondary uppercase text-3xl"> You already Voted! </h1>
                        <p class="text-center"><i class="fas fa-times animate-spin text-4xl text-red-600"></i></p>
                    <?php endif; ?>

                    <?php if($vote_succesful): ?>
                        <h1 class="text-center text-secondary uppercase text-3xl"> You vote is Succesful </h1>
                        <p class="text-center"><i class="fas fa-check-circle animate-spin text-4xl text-green-600"></i></p>
                    <?php endif; ?>
                 <?php $__env->endSlot(); ?>

                 <?php $__env->slot('footer', null, []); ?> 
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.secondary-button','data' => ['wire:click' => '$toggle(\'free_vote\')','wire:loading.attr' => 'disabled']]); ?>
<?php $component->withName('jet-secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wire:click' => '$toggle(\'free_vote\')','wire:loading.attr' => 'disabled']); ?>
                        Close
                     <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

                    <?php if(!$voted_already && !$vote_succesful): ?>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['class' => 'ml-2','wire:click' => 'vote(\''.e($candidate->slug).'\')','wire:loading.class' => 'bg-transparent']]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'ml-2','wire:click' => 'vote(\''.e($candidate->slug).'\')','wire:loading.class' => 'bg-transparent']); ?>
                            Vote
                            <div wire:loading wire:target="vote">
                                <img width="20px" src="<?php echo e(asset("images/logo/loading.png")); ?>" class="animate-spin">
                            </div>
                         <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                    <?php endif; ?>
                 <?php $__env->endSlot(); ?>
             <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        <?php endif; ?>


        <script>
            window.addEventListener('tel-number', event => {
                var amountsCollection = document.getElementsByClassName("cam-amount");
                var amounts = Array.from(amountsCollection);

                amounts.forEach(function (el) {
                    var cleave = new Cleave(el, {
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand',
                        numeralPositiveOnly: true,
                        rawValueTrimPrefix: true,
                    });
                });
                var cleave = new Cleave('.cam-tel', {
                    phone: true,
                    phoneRegionCode: 'CM',
                    prefix: '+237',
                    noImmediatePrefix: true,
                });
            });
        </script>
        
        <script>
            var em = "<?php echo e($this->email); ?>";
            var nm = "<?php echo e($this->name); ?>";
            var cr = "<?php echo e($this->currency); ?>";
            var am = "<?php echo e($this->vote_amount); ?>";

            window.addEventListener('flutterpay', event => {  
                    console.log(event.detail.em);
                    console.log(event.detail.nm);
                    console.log(event.detail.cr);
                    console.log(event.detail.am);
                    FlutterwaveCheckout({
                        public_key: event.detail.pub,
                        tx_ref: event.detail.refs,
                        amount: event.detail.am,
                        currency: event.detail.cr,
                        //country: "",
                        payment_options: "card, mobilemoneyghana, mobilemoneyrwanda, ussd, mpesa, mobilemoneyzambia, qr, mobilemoneyuganda, mobilemoneytanzania",
                        //redirect_url: // specified redirect URL
                        //"",
                        meta: {
                        consumer_id: 23,
                        consumer_mac: "92a3-912ba-1192a",
                        },
                        customer: {
                        email: event.detail.em,
                        phone_number: "",
                        name: event.detail.nm,
                        },
                        callback: function (data) {
                        window.Livewire.emit('flutterTrans', data);
                        console.log(data);
                        },
                        onclose: function() {
                        window.Livewire.emit('flutterClose');
                        },
                        customizations: {
                        title: event.detail.des,
                        description: event.detail.des,
                        logo: "<?php echo e(asset('images/logo/logo.png')); ?>",
                        },
                    });      
            });
        </script>



</div>
<?php /**PATH /var/www/shosa/resources/views/livewire/contestant-vote-component.blade.php ENDPATH**/ ?>