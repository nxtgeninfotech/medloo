<?php $__env->startSection('content'); ?>

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    <?php echo $__env->make('frontend.inc.customer_side_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-lg-9">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-12">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                    <?php echo e(__('Dashboard')); ?>

                                </h2>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                        <li><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
                                        <li class="active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- dashboard content -->
                    <div class="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center green-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-shopping-cart"></i>
                                        <?php if(Session::has('cart')): ?>
                                            <span class="d-block title"><?php echo e(count(Session::get('cart'))); ?> <?php echo e(__('Product(s)')); ?></span>
                                        <?php else: ?>
                                            <span class="d-block title">0 <?php echo e(__('Product')); ?></span>
                                        <?php endif; ?>
                                        <span class="d-block sub-title"><?php echo e(__('in your cart')); ?></span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center red-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-heart"></i>
                                        <span class="d-block title"><?php echo e(count(Auth::user()->wishlists)); ?> <?php echo e(__('Product(s)')); ?></span>
                                        <span class="d-block sub-title"><?php echo e(__('in your wishlist')); ?></span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="dashboard-widget text-center yellow-widget mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-building"></i>
                                        <?php
                                            $orders = \App\Order::where('user_id', Auth::user()->id)->get();
                                            $total = 0;
                                            foreach ($orders as $key => $order) {
                                                $total += count($order->orderDetails);
                                            }
                                        ?>
                                        <span class="d-block title"><?php echo e($total); ?> <?php echo e(__('Product(s)')); ?></span>
                                        <span class="d-block sub-title"><?php echo e(__('you ordered')); ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2 clearfix ">
                                        <?php echo e(__('Default Shipping Address')); ?>

                                        <div class="float-right">
                                            <a href="<?php echo e(route('profile')); ?>" class="btn btn-link btn-sm"><?php echo e(__('Edit')); ?></a>
                                        </div>
                                    </div>
                                    <div class="form-box-content p-3">
                                        <?php if(Auth::user()->addresses != null): ?>
                                            <?php
                                                $address = Auth::user()->addresses->where('set_default', 1)->first();
                                            ?>
                                            <?php if($address != null): ?>
                                                <table>
                                                    <tr>
                                                        <td><?php echo e(__('Address')); ?>:</td>
                                                        <td class="p-2"><?php echo e($address->address); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo e(__('Country')); ?>:</td>
                                                        <td class="p-2">
                                                            <?php echo e($address->country); ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo e(__('City')); ?>:</td>
                                                        <td class="p-2"><?php echo e($address->city); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo e(__('Postal Code')); ?>:</td>
                                                        <td class="p-2"><?php echo e($address->postal_code); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo e(__('Phone')); ?>:</td>
                                                        <td class="p-2"><?php echo e($address->phone); ?></td>
                                                    </tr>
                                                </table>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php if(\App\BusinessSetting::where('type', 'classified_product')->first()->value): ?>
                                <div class="col-md-6">
                                    <div class="form-box bg-white mt-4">
                                        <div class="form-box-title px-3 py-2 clearfix ">
                                            <?php echo e(__('Purchased Package')); ?>

                                        </div>
                                        <?php
                                            $customer_package = \App\CustomerPackage::find(Auth::user()->customer_package_id);
                                        ?>
                                        <div class="form-box-content p-3">
                                            <?php if($customer_package != null): ?>
                                                <div class="form-box-content p-2 category-widget text-center">
                                                    <center><img alt="Package Logo" src="<?php echo e(asset($customer_package->logo)); ?>" style="height:100px; width:90px;"></center>
                                                    <br>
                                                    <left> <strong><p><?php echo e(__('Product Upload')); ?>: <?php echo e($customer_package->product_upload); ?> <?php echo e(__('Times')); ?></p></strong></left>
                                                    <strong><p><?php echo e(__('Product Upload Remaining')); ?>: <?php echo e(Auth::user()->remaining_uploads); ?> <?php echo e(__('Times')); ?></p></strong>
                                                    <strong><p><div class="name mb-0"><?php echo e(__('Current Package')); ?>: <?php echo e($customer_package->name); ?> <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span></div></p></strong>
                                                </div>
                                            <?php else: ?>
                                                <div class="form-box-content p-2 category-widget text-center">
                                                    <center><strong><p><?php echo e(__('Package Not Found')); ?></p></strong></center>
                                                </div>
                                            <?php endif; ?>
                                            <div class="text-center">
                                                <a href="<?php echo e(route('customer_packages_list_show')); ?>" class="btn btn-styled btn-base-1 btn-outline btn-sm"><?php echo e(__('Upgrade Package')); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/per/medloo/resources/views/frontend/customer/dashboard.blade.php ENDPATH**/ ?>