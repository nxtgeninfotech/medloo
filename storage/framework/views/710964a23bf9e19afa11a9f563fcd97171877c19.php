<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link name="favicon" type="image/x-icon" href="<?php echo e(asset('img/favicon.png')); ?>" rel="shortcut icon" />

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!--Font Awesome [ OPTIONAL ]-->
    <link href="<?php echo e(asset('plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">

    <!--active-shop Stylesheet [ REQUIRED ]-->
    <link href="<?php echo e(asset('css/active-shop.min.css')); ?>" rel="stylesheet">

    <!--active-shop Premium Icon [ DEMONSTRATION ]-->
    <link href="<?php echo e(asset('css/demo/active-shop-demo-icons.min.css')); ?>" rel="stylesheet">

    <!--Demo [ DEMONSTRATION ]-->
    <link href="<?php echo e(asset('css/demo/active-shop-demo.min.css')); ?>" rel="stylesheet">

    <!--Theme [ DEMONSTRATION ]-->
    <link href="<?php echo e(asset('css/themes/type-c/theme-navy.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">

    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    <script src=" <?php echo e(asset('js/jquery.min.js')); ?>"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>


    <!--active-shop [ RECOMMENDED ]-->
    <script src="<?php echo e(asset('js/active-shop.min.js')); ?>"></script>

    <!--Alerts [ SAMPLE ]-->
    <script src="<?php echo e(asset('js/demo/ui-alerts.js')); ?>"></script>

    <!--Switchery [ OPTIONAL ]-->
    <script src="<?php echo e(asset('plugins/switchery/switchery.min.js')); ?>"></script>

    <!--DataTables [ OPTIONAL ]-->
    <script src="<?php echo e(asset('plugins/datatables/media/js/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables/media/js/dataTables.bootstrap.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js')); ?>"></script>

    <!--DataTables Sample [ SAMPLE ]-->
    <script src="<?php echo e(asset('js/demo/tables-datatables.js')); ?>"></script>

    <!--Select2 [ OPTIONAL ]-->
    <script src="<?php echo e(asset('plugins/select2/js/select2.min.js')); ?>"></script>

    <!--Summernote [ OPTIONAL ]-->
    <script src="<?php echo e(asset('js/jodit.min.js')); ?>"></script>

    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <script src="<?php echo e(asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')); ?>"></script>

    <!--Bootstrap Validator [ OPTIONAL ]-->
    <script src="<?php echo e(asset('plugins/bootstrap-validator/bootstrapValidator.min.js')); ?>"></script>

    <!--Bootstrap Wizard [ OPTIONAL ]-->
    <script src="<?php echo e(asset('plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js')); ?>"></script>

    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <script src="<?php echo e(asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>

    <!--Form Component [ SAMPLE ]-->
    <script src="<?php echo e(asset('js/demo/form-wizard.js')); ?>"></script>

    <!--Spectrum JavaScript [ REQUIRED ]-->
    <script src="<?php echo e(asset('js/spectrum.js')); ?>"></script>

    <!--Spartan Image JavaScript [ REQUIRED ]-->
    <script src="<?php echo e(asset('js/spartan-multi-image-picker-min.js')); ?>"></script>

    <!--Custom JavaScript [ REQUIRED ]-->
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>

</head>
<body>
    <?php $__currentLoopData = session('flash_notification', collect())->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script type="text/javascript">
            $(document).on('nifty.ready', function() {
                showAlert('<?php echo e($message['level']); ?>', '<?php echo e($message['message']); ?>');
            });
        </script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div id="container" class="">
        <div class="cls-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel">
                            <div class="panel-body">
                                <?php echo $__env->yieldContent('content'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->yieldContent('script'); ?>

</body>
</html>
<?php /**PATH /var/www/html/per/medloo/resources/views/layouts/blank.blade.php ENDPATH**/ ?>