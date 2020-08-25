<?php $__env->startSection('content'); ?>

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    <?php if(Auth::user()->user_type == 'seller'): ?>
                        <?php echo $__env->make('frontend.inc.seller_side_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php elseif(Auth::user()->user_type == 'customer'): ?>
                        <?php echo $__env->make('frontend.inc.customer_side_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        <?php echo e(__('Wishlist')); ?>

                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
                                            <li><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
                                            <li class="active"><a href="<?php echo e(route('wishlists.index')); ?>"><?php echo e(__('Wishlist')); ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist items -->

                        <div class="row shop-default-wrapper shop-cards-wrapper shop-tech-wrapper mt-4">
                            <?php $__currentLoopData = $wishlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $wishlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($wishlist->product != null): ?>
                                    <div class="col-xl-4 col-6" id="wishlist_<?php echo e($wishlist->id); ?>">
                                        <div class="card card-product mb-3 product-card-2">
                                            <div class="card-body p-3">
                                                <div class="card-image">
                                                    <a href="<?php echo e(route('product', $wishlist->product->slug)); ?>" class="d-block" style="background-image:url('<?php echo e(asset($wishlist->product->thumbnail_img)); ?>');">
                                                    </a>
                                                </div>

                                                <h2 class="heading heading-6 strong-600 mt-2 text-truncate-2">
                                                    <a href="<?php echo e(route('product', $wishlist->product->slug)); ?>"><?php echo e($wishlist->product->name); ?></a>
                                                </h2>
                                                <div class="star-rating star-rating-sm mb-1">
                                                    <?php echo e(renderStarRating($wishlist->product->rating)); ?>

                                                </div>
                                                <div class="mt-2">
                                                    <div class="price-box">
                                                        <?php if(home_base_price($wishlist->product->id) != home_discounted_base_price($wishlist->product->id)): ?>
                                                            <del class="old-product-price strong-400"><?php echo e(home_base_price($wishlist->product->id)); ?></del>
                                                        <?php endif; ?>
                                                        <span class="product-price strong-600"><?php echo e(home_discounted_base_price($wishlist->product->id)); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer p-3">
                                                <div class="product-buttons">
                                                    <div class="row align-items-center">
                                                        <div class="col-2">
                                                            <a href="#" class="link link--style-3" data-toggle="tooltip" data-placement="top" title="Remove from wishlist" onclick="removeFromWishlist(<?php echo e($wishlist->id); ?>)">
                                                                <i class="la la-close"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-10">
                                                            <button type="button" class="btn btn-block btn-base-1 btn-circle btn-icon-left" onclick="showAddToCartModal(<?php echo e($wishlist->product->id); ?>)">
                                                                <i class="la la-shopping-cart mr-2"></i><?php echo e(__('Add to cart')); ?>

                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                <?php echo e($wishlists->links()); ?>

                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function removeFromWishlist(id){
            $.post('<?php echo e(route('wishlists.remove')); ?>',{_token:'<?php echo e(csrf_token()); ?>', id:id}, function(data){
                $('#wishlist').html(data);
                $('#wishlist_'+id).hide();
                showFrontendAlert('success', 'Item has been renoved from wishlist');
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/per/medloo/resources/views/frontend/view_wishlist.blade.php ENDPATH**/ ?>